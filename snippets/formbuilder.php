<?php
    //determining which page the FormBuilder is in:
    if(!isset($pg)) {
        $pg = $page;
    } else {
        // check whether the varibale is a page id string:
        if(is_string($pg)) { $pg = page($pg); }
    }
    // check whether page exists:
    if(!is_object($pg) or !is_a($pg,'Kirby\Cms\Page') or !$pg->exists()): ?>
<h3>Unable to generate form: invalid page info</h3>
<?php
    elseif(!$pg->fb_builder()->exists()):
?>
<h3>Unable to generate form: required fields missing</h3>
<?php
    else:
        // setting variables that make our code easier to read:
        $fb_id = $pg->fb_form_id()->or('form-'.time());
        $fb_class = $pg->fb_form_class()->isEmpty() ? false : $pg->fb_form_class()->html();
        $fb_blocks = $pg->fb_builder()->toBuilderBlocks();
        $useDiv = $pg->fb_usediv()->exists() ? $pg->fb_usediv()->toBool() : true;
        $isAjax = $pg->fb_is_ajax()->exists() ? $pg->fb_is_ajax()->toBool() : true;
        $msgPos = $pg->fb_msg_position()->exists() ? $pg->fb_msg_position()->toBool() : false;
        $hasCaptcha = $pg->fb_captcha()->exists() ? $pg->fb_captcha()->toBool() : false;
        $captchaSiteKey = $pg->fb_captcha_sitekey()->exists() ? $pg->fb_captcha_sitekey() : '';
        $captchaSecretKey = $pg->fb_captcha_secretkey()->exists() ? $pg->fb_captcha_secretkey() : '';
        $captchaTheme = $pg->fb_captcha_theme()->exists() ? $pg->fb_captcha_theme()->toBool() : false;
        $actionURL = $site->url() . '/formbuilder/formhandler';
        $error = $error ?? false;
        $fields = $fields ?? false;
?>
<form id="<?= $fb_id ?>"<?php if($fb_class):?> class="<?= $fb_class ?>"<?php endif; ?> action="<?= $actionURL ?>" method="post">
<?php if($isAjax and $msgPos): ?>    <div class="messagebox" hidden></div><?php endif; ?>
<?php
        foreach($fb_blocks as $field):
            switch ($field->_key()) {
                case 'fb_password':
                    snippet('formbuilder/password', ['pg' => $pg, 'fld' => $field, 'data' => $fields]);
                    break;
                case 'fb_textarea':
                    snippet('formbuilder/textarea', ['pg' => $pg, 'fld' => $field, 'data' => $fields]);
                    break;
                case 'fb_number':
                    snippet('formbuilder/number', ['pg' => $pg, 'fld' => $field, 'data' => $fields]);
                    break;
                case 'fb_checkbox':
                    snippet('formbuilder/checkbox', ['pg' => $pg, 'fld' => $field, 'data' => $fields]);
                    break;
                case 'fb_select':
                    snippet('formbuilder/select', ['pg' => $pg, 'fld' => $field, 'data' => $fields]);
                    break;
                case 'fb_radio':
                    snippet('formbuilder/radio', ['pg' => $pg, 'fld' => $field, 'data' => $fields]);
                    break;
                case 'fb_hidden':
                    snippet('formbuilder/hidden', ['fld' => $field]);
                    break;
                case 'fb_honeypot':
                    snippet('formbuilder/honeypot', ['pg' => $pg, 'fld' => $field, 'data' => $fields]);
                    break;
                case 'fb_line':
                    snippet('formbuilder/line', ['fld' => $field]);
                    break;
                case 'fb_displaytext':
                    snippet('formbuilder/displaytext', ['fld' => $field]);
                    break;
                default:
                    snippet('formbuilder/input', ['pg' => $pg, 'fld' => $field, 'data' => $fields]);
                    break;
            }
        endforeach;
?>
    <input type="hidden" name="fb_pg_id" id="fb_pg_id" value="<?= $pg->id() ?>">
    <input type="hidden" name="fb_csrf" id="fb_csrf" value="<?= csrf() ?>">
<?php if($hasCaptcha and !empty($captchaSiteKey) and !empty($captchaSecretKey)): ?>
<div class="h-captcha" data-sitekey="<?= $captchaSiteKey ?>"<?php if($captchaTheme): ?> data-theme="dark"<?php endif; ?>></div>
<script src="https://hcaptcha.com/1/api.js" async defer></script>
<?php endif; ?>
<div<?php if($pg->fb_formbtns_class()->isNotEmpty()): ?> class="<?= $pg->fb_formbtns_class()->html() ?>"<?php endif; ?>>
    <button type="submit" name="submit"><?= $pg->fb_submit_label()->or("Submit")->html() ?></button>
<?php if($pg->fb_cancel_label()->isNotEmpty()): ?>
    <button type="reset"><?= $pg->fb_cancel_label()->html() ?></button>
<?php endif; ?>
</div>
<?php if($isAjax and !$msgPos): ?>    <div class="messagebox" hidden></div><?php endif; ?>
</form>
<?php if($isAjax): ?>
<script type="text/javascript">
    // function to handle the form submission via ajax:
    const fbform = document.getElementById('<?= $fb_id ?>');
    const msgBox = fbform.querySelector('.messagebox');
    fbform.addEventListener('submit',function(e){
        e.preventDefault();
        msgBox.setAttribute('hidden', '');
        fetch('<?= $actionURL ?>',{
          body: new FormData(fbform),
          method: 'POST'
        })
        .then(response => {
          if(response.ok) {
            // We have reached the formhandler script,
            // and have received a response - simply pass it to the next 'then' method:
            return response.json();
          } else {
            // We have received an error - such as a 500 error from the server -
            // so we throw an Error to pass it to the 'catch' method below:
            let warning = 'Unidentified Processing Error';
            if(response.headers.has('Warning')){
                warning = response.headers.get('Warning');
            };
            throw new Error(response.status + ' | ' + warning);
          }
        })
        .then(data => {
          // truly successfull response:
          msgBox.innerHTML = `<?= $pg->fb_success_msg()->kt(); ?>`;
          msgBox.classList.remove('error');
        })
        .catch(error => {
          // Display error message along with response error info:
          let msg = `<?= $pg->fb_error_msg()->kt(); ?>`;
          msgBox.innerHTML = msg;
          let errorMsg = document.createElement('p');
          errorMsg.textContent = error;
          msgBox.appendChild(errorMsg);
          msgBox.classList.add('error');
        });
        msgBox.removeAttribute('hidden');
<?php if($hasCaptcha and !empty($captchaSiteKey) and !empty($captchaSecretKey)): ?>        hcaptcha.reset();
<?php endif; ?>
      });

    // function to hide the messagebox on reset:
    const fbreset = fbform.querySelector('button[type=reset]');
    fbreset.addEventListener('click',function(e){
        msgBox.setAttribute('hidden', '');
<?php if($hasCaptcha and !empty($captchaSiteKey) and !empty($captchaSecretKey)): ?>        hcaptcha.reset();
<?php endif; ?>
    });
</script>
<?php endif;
    endif;
