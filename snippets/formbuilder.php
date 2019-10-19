<?php
    $id = $page->form_id()->or('form-'.time());
    $fields = $page->form_fields()->toStructure();
?>

<form action="" id="<?= $id ?>"<?php if($page->form_class()->isNotEmpty()):?> class="<?= $page->form_class()->html() ?>"<?php endif; ?>>

<?php
    foreach($fields as $field):
        if(in_array($field->form_field_type(),['text','email','url','tel','date','time','password'])){
            snippet('formbuilder/input', ['pg' => $page, 'fld' => $field]);
        }
    endforeach;
?>

</form>
