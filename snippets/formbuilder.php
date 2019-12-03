<?php
    $fb_id = $page->fb_form_id()->or('form-'.time());
    $fb_class = $page->fb_form_class()->isEmpty() ? false : $page->fb_form_class()->html();
    $fb_fields = $page->fb_builder()->toBuilderBlocks();
    $useDiv = $page->fb_usediv()->toBool();
    $actionURL = $site->url() . '/formbuilder/formhandler';
    $error = $error ?? false;
    $fb_data = $fb_data ?? false;
?>
<style type="text/css">
    .messagebox {
        background: rgba(0,255,0,0.1);
    }
    .messagebox.error {
        background: rgba(255,0,0,0.1);
    }
</style>
<form id="<?= $fb_id ?>"<?php if($fb_class):?> class="<?= $fb_class ?>"<?php endif; ?> action="<?= $actionURL ?>" method="post">
<?php if($page->fb_is_ajax()->toBool() and $page->fb_msg_position()->toBool()): ?>    <div class="messagebox"></div><?php endif; ?>
<?php
    foreach($fb_fields as $field):
        switch ($field->_key()) {
            case 'fb_password':
                snippet('formbuilder/password', ['pg' => $page, 'fld' => $field, 'data' => $fb_data]);
                break;
            case 'fb_textarea':
                snippet('formbuilder/textarea', ['pg' => $page, 'fld' => $field, 'data' => $fb_data]);
                break;
            case 'fb_number':
                snippet('formbuilder/number', ['pg' => $page, 'fld' => $field, 'data' => $fb_data]);
                break;
            case 'fb_checkbox':
                snippet('formbuilder/checkbox', ['pg' => $page, 'fld' => $field, 'data' => $fb_data]);
                break;
            case 'fb_select':
                snippet('formbuilder/select', ['pg' => $page, 'fld' => $field, 'data' => $fb_data]);
                break;
            case 'fb_radio':
                snippet('formbuilder/radio', ['pg' => $page, 'fld' => $field, 'data' => $fb_data]);
                break;
            case 'fb_hidden':
                snippet('formbuilder/hidden', ['fld' => $field]);
                break;
            case 'fb_honeypot':
                snippet('formbuilder/honeypot', ['pg' => $page, 'fld' => $field, 'data' => $fb_data]);
                break;
            default:
                snippet('formbuilder/input', ['pg' => $page, 'fld' => $field, 'data' => $fb_data]);
                break;
        }
    endforeach;
?>
    <input type="hidden" name="fb_pg_id" id="fb_pg_id" value="<?= $page->id() ?>">
    <!-- <input type="hidden" name="fb_csrf" id="fb_csrf" value="<?= csrf() ?>"> -->
<?php if($page->fb_captcha()->toBool() and $page->fb_captcha_sitekey()->isNotEmpty() and $page->fb_captcha_secretkey()->isNotEmpty()): ?>
<div class="h-captcha" data-sitekey="<?= $page->fb_captcha_sitekey() ?>"<?php if($page->fb_captcha_theme()->toBool()): ?> data-theme="dark"<?php endif; ?>></div>
<script src="https://hcaptcha.com/1/api.js" async defer></script>
<?php endif; ?>
<?php if($useDiv): ?>
<div<?php if($fb_class): ?> class="<?= $fb_class ?>"<?php endif; ?>>
<?php endif; ?>
    <button type="submit" name="submit"><?= $page->fb_submit_label()->or("Submit")->html() ?></button>
<?php if($page->fb_cancel_label()->isNotEmpty()): ?>
    <button type="reset"><?= $page->fb_cancel_label()->html() ?></button>
<?php endif; ?>
<?php if($useDiv): ?>
</div>
<?php endif; ?>
<?php if($page->fb_is_ajax()->toBool() and !$page->fb_msg_position()->toBool()): ?>    <div class="messagebox"></div><?php endif; ?>
</form>
<?php if($page->fb_is_ajax()->toBool()): ?>
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
          if(data.success){
            // truly successfull response:
            msgBox.innerHTML = `<?= $page->fb_success_msg()->kt(); ?>`;
            msgBox.classList.remove('error');
          } else {
            // If success == false, we have processing or validation errors -
            // let's throw an error so we can warn the user:
            throw new Error(data.msg + ' (' + data.errors.join() + ')');
          }
        })
        .catch(error => {
          // Display error message along with response error info:
          let msg = `<?= $page->fb_error_msg()->kt(); ?>`;
          msgBox.innerHTML = msg;
          let errorMsg = document.createElement('p');
          errorMsg.textContent = error;
          msgBox.appendChild(errorMsg);
          msgBox.classList.add('error');
        });
        msgBox.removeAttribute('hidden');
        hcaptcha.reset();
      });

    // function to hide the messagebox on reset:
    const fbreset = fbform.querySelector('button[type=reset]');
    fbreset.addEventListener('click',function(e){
        msgBox.setAttribute('hidden', '');
        hcaptcha.reset();
    });
</script>
<?php endif;
