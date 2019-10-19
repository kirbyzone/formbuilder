<?php
    $id = $page->form_id()->or('form-'.time());
    $fields = $page->form_fields()->toStructure();
?>

<form action="" id="<?= $id ?>"<?php if($page->form_class()->isNotEmpty()):?> class="<?= $page->form_class()->html() ?>"<?php endif; ?>>

<?php
    foreach($fields as $field):
        switch ($field->form_field_type()) {
            case 'text':
            case 'email':
            case 'url':
            case 'tel':
            case 'date':
            case 'time':
            case 'password':
                snippet('formbuilder/input', ['pg' => $page, 'fld' => $field]);
                break;
            case 'hidden':
                snippet('formbuilder/hidden', ['fld' => $field]);
                break;
            default:
                # code...
                break;
        }
    endforeach;
?>

</form>
