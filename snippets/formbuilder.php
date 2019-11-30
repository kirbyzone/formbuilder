<?php
    $id = $page->fb_form_id()->or('form-'.time());
    $class = $page->fb_form_class()->isEmpty() ? false : $page->fb_form_class()->html();
    $fields = $page->fb_builder()->toBuilderBlocks();
    $useDiv = $page->fb_usediv()->toBool();
?>

<form action="" id="<?= $id ?>"<?php if($class):?> class="<?= $class ?>"<?php endif; ?>>

<?php
    foreach($fields as $field):
        switch ($field->_key()) {
            case 'fb_password':
                snippet('formbuilder/password', ['pg' => $page, 'fld' => $field]);
                break;
            case 'fb_textarea':
                snippet('formbuilder/textarea', ['pg' => $page, 'fld' => $field]);
                break;
            case 'fb_number':
                snippet('formbuilder/number', ['pg' => $page, 'fld' => $field]);
                break;
            case 'fb_checkbox':
                snippet('formbuilder/checkbox', ['pg' => $page, 'fld' => $field]);
                break;
            case 'fb_select':
                snippet('formbuilder/select', ['pg' => $page, 'fld' => $field]);
                break;
            case 'fb_radio':
                snippet('formbuilder/radio', ['pg' => $page, 'fld' => $field]);
                break;
            case 'fb_hidden':
                snippet('formbuilder/hidden', ['fld' => $field]);
                break;
            case 'fb_honeypot':
                snippet('formbuilder/honeypot', ['pg' => $page, 'fld' => $field]);
                break;
            default:
                snippet('formbuilder/input', ['pg' => $page, 'fld' => $field]);
                break;
        }
    endforeach;
?>
<?php if($page->fb_captcha()->toBool() and $page->fb_captcha_sitekey()->isNotEmpty() and $page->fb_captcha_secretkey()->isNotEmpty()): ?>
<div class="h-captcha" data-sitekey="<?= $page->fb_captcha_sitekey() ?>"></div>
<script src="https://hcaptcha.com/1/api.js" async defer></script>
<?php endif; ?>
<?php if($useDiv): ?>
<div<?php if($class): ?> class="<?= $class ?>"<?php endif; ?>>
<?php endif; ?>
    <button type="submit" name="submit"><?= $page->fb_submit_label()->or("Submit")->html() ?></button>
<?php if($page->fb_cancel_label()->isNotEmpty()): ?>
    <button type="reset"><?= $page->fb_cancel_label()->html() ?></button>
<?php endif; ?>
<?php if($useDiv): ?>
</div>
<?php endif; ?>
</form>
