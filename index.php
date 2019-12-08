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
        'formbuilder/blocks/fb_honeypot' => __DIR__ . '/blueprints/blocks/fb_honeypot.yml',
        'formbuilder/blocks/fb_line' => __DIR__ . '/blueprints/blocks/fb_line.yml',
        'formbuilder/blocks/fb_displaytext' => __DIR__ . '/blueprints/blocks/fb_displaytext.yml'
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
        'formbuilder/line' => __DIR__ . '/snippets/fields/line.php',
        'formbuilder/displaytext' => __DIR__ . '/snippets/fields/displaytext.php'
    ],
    'templates' => [
        'emails/fb_default' => __DIR__ . '/templates/emails/fb_default.php'
    ],
    'routes' => [
        [
            'pattern' => 'formbuilder/formhandler',
            'method' => 'POST',
            'action'  => function () {
                // VALIDATION CHECKES:
                $data = get();
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
                } else {
                    // page ID has now been stored in the $pg variable,
                    // so we can remove the pg_id field from our data array:
                    unset($data['fb_pg_id']);
                }
                // then, check whether the page has all the fields required for our logic:
                if(!$pg->fb_builder()->exists() or !$pg->fb_is_ajax()->exists() or !$pg->fb_captcha()->exists() or !$pg->fb_send_email()->exists() or !$pg->fb_save_submissions()->exists()) {
                    $body = '<h1>Processing Error 422</h1><p>Page does not contain needed fields.</p>';
                    return new Response($body,'text/html', 422,['Warning'=>'Page does not have needed fields']);
                }
                // if user has selected to redirect to success/error pages,
                // let's make sure these pages exist:
                $ajax = $pg->fb_is_ajax()->toBool();
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
                            'fields' => $data,
                            'error' => 'No valid CSRF token received.'
                        ];
                        return $ePage->render($data);
                    }
                    // if the user is using ajax, we return an error:
                    $body = '<h1>Processing Error 403</h1><p>No valid CSRF token received.</p>';
                    return new Response($body,'text/html', 403,['Warning'=>'No valid CSRF token']);
                } else {
                    // passed CSRF check, so we can delete the CSRF field from our data array:
                    unset($data['fb_csrf']);
                }

                // check honeypots:
                $honeyfields = $pg->fb_builder()->toBuilderBlocks()->filterBy('_key','==','fb_honeypot');
                if(count($honeyfields) > 0){
                    foreach ($honeyfields as $field) {
                        // the honeypot field should be empty -
                        // if it's not, it was probably filled in by a spammer bot:
                        if(!empty($data[$field->field_name()->value()])) {
                            if (!$ajax) {
                                // if the form is not using ajax, we send the user
                                // to the error page, with appropriate data & info:
                                $data = [
                                    'fields' => $data,
                                    'error' => 'Bot submission violation.'
                                ];
                                return $ePage->render($data);
                            }
                            // if the user is using ajax, we return an error:
                            $body = '<h1>Processing Error 403</h1><p>Bot submission detected.</p>';
                            return new Response($body,'text/html', 403,['Warning'=>'Bot submission detected']);
                        }
                        // honeypot is empty - we can remove the field from our data array:
                        unset($data[$field->field_name()->value()]);
                    }
                }
                // hCaptcha check - if it is being used:
                if($pg->fb_captcha()->toBool() and $pg->fb_captcha_sitekey()->isNotEmpty() and $pg->fb_captcha_secretkey()->isNotEmpty()) {
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
                                    'fields' => $data,
                                    'error' => 'hCatpcha not validated.'
                                ];
                                return $ePage->render($data);
                            }
                            // if the user is using ajax, we return an error:
                            $body = '<h1>Processing Error 403</h1><p>hCaptcha not validated.</p>';
                            return new Response($body,'text/html', 403,['Warning'=>'hCaptcha not validated']);
                        } else {
                            // captcha has been answered successfully,
                            // so we can now remove it from our data array:
                            unset($data['h-captcha-response']);
                            if(isset($data['g-recaptcha-response'])) {
                                unset($data['g-recaptcha-response']);
                            }
                        }
                    } else {
                        // captcha token hasn't been set - possible form hijacking:
                        if (!$ajax) {
                            // if the form is not using ajax, we send the user
                            // to the error page, with appropriate data & info:
                            $data = [
                                'fields' => $data,
                                'error' => 'hCaptcha expected.'
                            ];
                            return $ePage->render($data);
                        }
                        // if the user is using ajax, we return an error:
                        $body = '<h1>Processing Error 403</h1><p>hCaptcha expected.</p>';
                        return new Response($body,'text/html', 403,['Warning'=>'hCaptcha expected']);
                    }
                }

                // With all validation done, we now start data processing.
                // We will store processing errors in an $errors array, and
                // report to the user at the end if any of the functions fail:
                $errors = '';

                // remove unnecessary fields from the data array,
                // so they don't get included in the sent/stored data:
                unset($data['submit']); // remove the value sent by the 'submit' button
                foreach ($data as $field => $value) {
                    // remove any fields with empty values:
                    if(empty($data[$field])) { unset($data[$field]); }
                }

                // EMAILING THE RECEIVED DATA:
                // check whether we need to send the data via email:
                if($pg->fb_send_email()->toBool() and $pg->fb_email_recipient()->exists() and $pg->fb_email_recipient()->isNotEmpty() and $pg->fb_email_sender_type()->exists()) {
                    // determine the sender:
                    if($pg->fb_email_sender_type()->toBool()) {
                        // we get the sender from a form field:
                        if(isset($data[$pg->fb_email_sender_field()->value()]) and !empty($data[$pg->fb_email_sender_field()->value()])){
                            $sender = $data[$pg->fb_email_sender_field()->value()];
                        } else {
                            $sender = 'form@' . parse_url(kirby()->request()->domain(),PHP_URL_HOST);
                        }
                    } else {
                        // we get the sender from a panel field:
                        if($pg->fb_email_sender()->isNotEmpty()){
                            $sender = $pg->fb_email_sender()->value();
                        } else {
                            $sender = 'form@' . parse_url(kirby()->request()->domain(),PHP_URL_HOST);
                        }
                    }
                    // determine the subject:
                    if($pg->fb_email_subject()->exists()){
                        $subject = $pg->fb_email_subject()->or('Website Form Submission');
                    } else {
                        $subject = 'Website Form Submission';
                    }
                    // determining which email template to use:
                    if(file_exists(kirby()->roots()->templates() . '/emails/fb.html.php') and file_exists(kirby()->roots()->templates() . '/emails/fb.text.php')) {
                        // user has created html email templates, so we use those:
                        $template = 'fb';
                    } else if(file_exists(kirby()->roots()->templates() . '/emails/fb.php')) {
                        // user has created a plain-text email template, so we'll use that:
                        $template = 'fb';
                    } else {
                        // we'll use our default template:
                        $template = 'fb_default';
                    }
                    // sending the email:
                    try {
                      kirby()->email([
                        'from' => $sender,
                        'replyTo' => $sender,
                        'to' => $pg->fb_email_recipient()->value(),
                        'subject' => $subject,
                        'template' => $template,
                        'data' => ['page_id' => $pg->id(), 'fields' => $data]
                      ]);
                    } catch (Exception $error) {
                        $errors .= 'Mail server error: ' . $error->getMessage() . '. ';
                    }
                }

                // STORING THE SUBMISSION IN THE CONTENT FILE:
                // check whether we need to store the data in the panel:
                if($pg->fb_save_submissions()->toBool()){
                    if($pg->fb_received_submissions()->exists()) {
                        // gather the values we need to store:
                        $submission_date = date('Y-m-d H:i:s'); // datetime stamp
                        if($pg->fb_key_field()->exists() and $pg->fb_key_field()->isNotEmpty() and isset($data[$pg->fb_key_field()->value()])) {
                            // this is the field that will be shown in the 'key' column in the panel:
                            $submission_key = $data[$pg->fb_key_field()->value()];
                        } else {
                            // if we can't find the field, we'll show show info from
                            // whatever is the first field in our data array:
                            $submission_key = Str::excerpt(array_values($data)[0],50);
                        }
                        // build the content of the submission in readable format:
                        $submission_content = '';
                        foreach ($data as $field => $value) {
                            $field = mb_strtoupper($field);
                            $submission_content .= <<<CONTENT

$field: $value

CONTENT;
                        }
                        $submission = [
                            'entry_date' => $submission_date,
                            'entry_key' => $submission_key,
                            'entry_content' => $submission_content
                        ];
                        // store the current contents of the log:
                        $log = $pg->fb_received_submissions()->yaml();
                        // add our new submission:
                        $log[] = $submission;
                        // finally, try to update the field in the content file:
                        try {
                            kirby()->impersonate('kirby');
                            $pg->update([
                              'fb_received_submissions' => Yaml::encode($log)
                            ]);
                        } catch (Exception $error) {
                            $errors .= 'Submission logging failed: ' . $error->getMessage() . '. ';
                        }

                    } else {
                        // the field where we're supposed to store our submissions
                        // is not present on the page - we must advise the user:
                        $errors .= 'Submission log field missing.';
                    }
                }
                // return report on success/failure of operations:
                if(!empty($errors)) {
                    if (!$ajax) {
                        // if the form is not using ajax, we send the user
                        // to the error page, with appropriate data & info:
                        $data = [
                            'fields' => $data,
                            'error' => $errors
                        ];
                        return $ePage->render($data);
                    }
                    // if the user is using ajax, we return an error:
                    $body = '<h1>Server Error 500</h1><p>Server error: '. $errors . '.</p>';
                    return new Response($body,'text/html', 500,['Warning'=>'Server error: ' . $errors]);
                }
                // everything went fine - we have a successfull submission!:
                if(!$ajax) {
                    // if the form is not using ajax, we send the user
                    // to the success page, with appropriate data & info:
                    $data = [
                        'fields' => $data,
                        'error' => ''
                    ];
                    return $sPage->render($data);
                }
                // if the user is using ajax, we return a success message:
                return ['msg' => 'Form submitted successfully'];
          }
        ]
      ]
]);
