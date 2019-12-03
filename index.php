<?php

Kirby::plugin('cre8ivclick/formbuilder', [
    'blueprints' => [
        'formbuilder' => __DIR__ . '/blueprints/formbuilder.yml',
        'formbuilder/fields/name' => __DIR__ . '/blueprints/fields/name.yml',
        'formbuilder/fields/class' => __DIR__ . '/blueprints/fields/class.yml',
        'formbuilder/fields/req' => __DIR__ . '/blueprints/fields/req.yml',
        'formbuilder/fields/label' => __DIR__ . '/blueprints/fields/label.yml',
        'formbuilder/fields/placeholder' => __DIR__ . '/blueprints/fields/placeholder.yml',
        'formbuilder/fields/value' => __DIR__ . '/blueprints/fields/value.yml',
        'formbuilder/fields/min' => __DIR__ . '/blueprints/fields/min.yml',
        'formbuilder/fields/max' => __DIR__ . '/blueprints/fields/max.yml',
        'formbuilder/fields/pattern' => __DIR__ . '/blueprints/fields/pattern.yml',
        'formbuilder/blocks/fb_text' => __DIR__ . '/blueprints/blocks/fb_text.yml',
        'formbuilder/blocks/fb_textarea' => __DIR__ . '/blueprints/blocks/fb_textarea.yml',
        'formbuilder/blocks/fb_email' => __DIR__ . '/blueprints/blocks/fb_email.yml',
        'formbuilder/blocks/fb_tel' => __DIR__ . '/blueprints/blocks/fb_tel.yml',
        'formbuilder/blocks/fb_number' => __DIR__ . '/blueprints/blocks/fb_number.yml',
        'formbuilder/blocks/fb_url' => __DIR__ . '/blueprints/blocks/fb_url.yml',
        'formbuilder/blocks/fb_checkbox' => __DIR__ . '/blueprints/blocks/fb_checkbox.yml',
        'formbuilder/blocks/fb_radio' => __DIR__ . '/blueprints/blocks/fb_radio.yml',
        'formbuilder/blocks/fb_select' => __DIR__ . '/blueprints/blocks/fb_select.yml',
        'formbuilder/blocks/fb_date' => __DIR__ . '/blueprints/blocks/fb_date.yml',
        'formbuilder/blocks/fb_time' => __DIR__ . '/blueprints/blocks/fb_time.yml',
        'formbuilder/blocks/fb_password' => __DIR__ . '/blueprints/blocks/fb_password.yml',
        'formbuilder/blocks/fb_hidden' => __DIR__ . '/blueprints/blocks/fb_hidden.yml',
        'formbuilder/blocks/fb_honeypot' => __DIR__ . '/blueprints/blocks/fb_honeypot.yml'
    ],
    'snippets' => [
        'formbuilder' => __DIR__ . '/snippets/formbuilder.php',
        'formbuilder/input' => __DIR__ . '/snippets/fields/input.php',
        'formbuilder/password' => __DIR__ . '/snippets/fields/password.php',
        'formbuilder/textarea' => __DIR__ . '/snippets/fields/textarea.php',
        'formbuilder/number' => __DIR__ . '/snippets/fields/number.php',
        'formbuilder/checkbox' => __DIR__ . '/snippets/fields/checkbox.php',
        'formbuilder/select' => __DIR__ . '/snippets/fields/select.php',
        'formbuilder/radio' => __DIR__ . '/snippets/fields/radio.php',
        'formbuilder/hidden' => __DIR__ . '/snippets/fields/hidden.php',
        'formbuilder/honeypot' => __DIR__ . '/snippets/fields/honeypot.php',
        'formbuilder/text_preview' => __DIR__ . '/snippets/previews/text.php',
        'formbuilder/textarea_preview' => __DIR__ . '/snippets/previews/textarea.php',
        'formbuilder/number_preview' => __DIR__ . '/snippets/previews/number.php',
        'formbuilder/checkbox_preview' => __DIR__ . '/snippets/previews/checkbox.php',
        'formbuilder/radio_preview' => __DIR__ . '/snippets/previews/radio.php',
        'formbuilder/select_preview' => __DIR__ . '/snippets/previews/select.php',
        'formbuilder/date_preview' => __DIR__ . '/snippets/previews/date.php',
        'formbuilder/time_preview' => __DIR__ . '/snippets/previews/time.php',
        'formbuilder/password_preview' => __DIR__ . '/snippets/previews/password.php',
        'formbuilder/hidden_preview' => __DIR__ . '/snippets/previews/hidden.php'
    ],
    'routes' => [
        [
            'pattern' => 'formbuilder/formhandler',
            'method' => 'POST',
            'action'  => function () {
                // VALIDATION CHECKES:
                $data = get();
                $result = array();
                $result['success'] = false; // assume the worst
                // start by checking whether this is a formbuilder submission -
                // by checking, for example, whether we can get a page id:
                if(!isset($data['fb_pg_id'])) {
                    $body = '<h1>Processing Error 400</h1><p>Page ID information not found.</p>';
                    return new Response($body,'text/html', 400,['Warning'=>'Page ID not found']);
                }
                // then, check whether the page exists:
                if(!$pg = page($data['fb_pg_id'])) {
                    $body = '<h1>Processing Error 406</h1><p>Referenced Page ID does not exist.</p>';
                    return new Response($body,'text/html', 406,['Warning'=>'Page ID does not exist']);
                }
                // then, check whether the page has formbuilder fields:
                if(!$pg->fb_form_id()->exists() and $pg->fb_builder()->exists()) {
                    $body = '<h1>Processing Error 422</h1><p>Page does not contain needed fields.</p>';
                    return new Response($body,'text/html', 422,['Warning'=>'Page does not have needed fields']);
                }
                // if user has selected to redirect to success/error pages,
                // let's make sure these pages exist:
                $ajax = $pg->fb_is_ajax()->exists() ? $pg->fb_is_ajax()->toBool() : false;
                $sPage = $pg->fb_success_page()->exists() ? $pg->fb_success_page()->toPage() : false;
                $ePage = $pg->fb_error_page()->exists() ? $pg->fb_error_page()->toPage() : false;
                if(!$ajax and (!$sPage or !$ePage)){
                    $body = '<h1>Processing Error 422</h1><p>Missing success/error page.</p>';
                    return new Response($body,'text/html', 422,['Warning'=>'Missing success/error page']);
                }

                // check the CSRF token:
                if(!isset($data['fb_csrf']) or csrf($data['fb_csrf']) !== true) {
                    if (!$ajax) {
                        // if the form is not using ajax, we send the user
                        // to the error page, with appropriate data & info:
                        $data = [
                            'fb_data' => $data,
                            'error' => 'No valid CSRF token received.'
                        ];
                        return $ePage->render($data);
                    }
                    // if the user is using ajax, we return an error:
                    $body = '<h1>Processing Error 403</h1><p>No valid CSRF token received.</p>';
                    return new Response($body,'text/html', 403,['Warning'=>'No valid CSRF token']);
                }

                // check honeypots:
                $fields = $pg->fb_builder()->toBuilderBlocks()->filterBy('_key','==','fb_honeypot');
                if(count($fields) > 0){
                    foreach ($fields as $field) {
                        // the honeypot field should be empty -
                        // if it's not, it was probably filled in by a spammer bot:
                        if(!empty($data[$field->field_name()->value()])) {
                            if (!$ajax) {
                                // if the form is not using ajax, we send the user
                                // to the error page, with appropriate data & info:
                                $data = [
                                    'fb_data' => $data,
                                    'error' => 'Bot submission violation.'
                                ];
                                return $ePage->render($data);
                            }
                            // if the user is using ajax, we return an error:
                            $body = '<h1>Processing Error 403</h1><p>Bot submission detected.</p>';
                            return new Response($body,'text/html', 403,['Warning'=>'Bot submission detected']);
                        }
                    }
                }
                // hCaptcha check - if it is being used:
                if($pg->fb_captcha()->exists and $pg->fb_captcha()->toBool() and $pg->fb_captcha_sitekey()->isNotEmpty() and $pg->fb_captcha_secretkey()->isNotEmpty()) {
                    // check that the hCaptcha token has been set -
                    // that is, the captcha has been answered and submitted::
                    if(isset($data['h-captcha-response']) and !empty($data['h-captcha-response'])) {
                        $hData = [
                            'response' => $data['h-captcha-response'],
                            'secret' => $pg->fb_captcha_secretkey()->value()
                        ];
                        $options = [
                            'method'  => 'POST',
                            'data'    => http_build_query($hData)
                        ];
                        $response = Remote::request('https://hcaptcha.com/siteverify',$options);
                        $response = $response->json();
                        // check whether the hCaptcha was answered successfully::
                        if($response['success'] == false){
                            if (!$ajax) {
                                // if the form is not using ajax, we send the user
                                // to the error page, with appropriate data & info:
                                $data = [
                                    'fb_data' => $data,
                                    'error' => 'hCatpcha not validated.'
                                ];
                                return $ePage->render($data);
                            }
                            // if the user is using ajax, we return an error:
                            $body = '<h1>Processing Error 403</h1><p>hCaptcha not validated.</p>';
                            return new Response($body,'text/html', 403,['Warning'=>'hCaptcha not validated']);
                        }
                    } else {
                        // captcha token hasn't been set - possible form hijacking:
                        if (!$ajax) {
                            // if the form is not using ajax, we send the user
                            // to the error page, with appropriate data & info:
                            $data = [
                                'fb_data' => $data,
                                'error' => 'hCaptcha expected.'
                            ];
                            return $ePage->render($data);
                        }
                        // if the user is using ajax, we return an error:
                        $body = '<h1>Processing Error 403</h1><p>hCaptcha expected.</p>';
                        return new Response($body,'text/html', 403,['Warning'=>'hCaptcha expected']);
                    }
                }
                // PROCESS RECEIVED DATA:
                // check whether we need to store the data in the panel:

                // check whether we need to send the data via email:

                // return report on success/failure of operations:
                $result['success'] = true;
                $result['msg'] = 'reached the end';
                $result['errors'] = array();
                if($pg->fb_is_ajax()->toBool()){
                    // send response via ajax:
                    return $result;
                } else {
                    // Try to direct the submitter to the success page.
                    // If that fails, throw an error:
                    if($p = $pg->fb_success_page()->toPage()) {
                        return $p;
                    } else {
                        return new Response('<h1>Error 500</h1><p>Invalid Success Page ID</p>','text/html', 500);
                    }

                }
          }
        ]
      ]
]);
