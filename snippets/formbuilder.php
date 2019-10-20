<?php
    $id = $page->fb_form_id()->or('form-'.time());
    $class = $page->fb_form_class()->isEmpty() ? false : $page->fb_form_class()->html();
    $fields = $page->fb_fields()->toStructure();
?>

<form action="" id="<?= $id ?>"<?php if($class):?> class="<?= $class ?>"<?php endif; ?>>

<?php
    foreach($fields as $field):
        switch ($field->fbf_type()) {
            case 'text':
            case 'email':
            case 'url':
            case 'tel':
            case 'date':
            case 'time':
            case 'password':
                snippet('formbuilder/input', ['pg' => $page, 'fld' => $field]);
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
            case 'hidden':
                snippet('formbuilder/hidden', ['fld' => $field]);
                break;
            case 'honeypot':
                snippet('formbuilder/honeypot', ['pg' => $page, 'fld' => $field]);
                break;
        }
    endforeach;
?>

</form>
