<?php

    $id = $page->form_id()->or('form-'.time());
    $class = $page->form_class()->isEmpty() ? 'formbuilder' : 'formbuilder ' . $page->form_class();
    $fields = $page->form_fields()->toStructure();
?>

<form action="" id="<?= $id ?>" class="<?= $class ?>">

<?php
    foreach($fields as $field):
        snippet('formbuilder/'. $field->form_field_type(), ['pg' => $page, 'fld' => $field]);

    endforeach;
?>

</form>
