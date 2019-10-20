<?php
    $id = $page->fb_form_id()->or('form-'.time());
    $class = $page->fb_form_class()->isEmpty() ? false : $page->fb_form_class()->html();
    $fields = $page->fb_fields()->toStructure();
    $useDiv = $page->fb_usediv()->toBool();
?>

<form action="" id="<?= $id ?>"<?php if($class):?> class="<?= $class ?>"<?php endif; ?>>

<?php
    foreach($fields as $field):
        switch ($field->fbf_type()) {
            case 'password':
                snippet('formbuilder/password', ['pg' => $page, 'fld' => $field]);
                break;
            case 'textarea':
                snippet('formbuilder/textarea', ['pg' => $page, 'fld' => $field]);
                break;
            case 'number':
                snippet('formbuilder/number', ['pg' => $page, 'fld' => $field]);
                break;
            case 'checkbox':
                snippet('formbuilder/checkbox', ['pg' => $page, 'fld' => $field]);
                break;
            case 'select':
                snippet('formbuilder/select', ['pg' => $page, 'fld' => $field]);
                break;
            case 'radio':
                snippet('formbuilder/radio', ['pg' => $page, 'fld' => $field]);
                break;
            case 'hidden':
                snippet('formbuilder/hidden', ['fld' => $field]);
                break;
            case 'honeypot':
                snippet('formbuilder/honeypot', ['pg' => $page, 'fld' => $field]);
                break;
            default:
                snippet('formbuilder/input', ['pg' => $page, 'fld' => $field]);
                break;
        }
    endforeach;

    if($useDiv):
?>
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
