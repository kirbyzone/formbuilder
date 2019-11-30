<div style="padding: 9px">
<?php if($data->field_label()->isNotEmpty()): ?>
    <label
        for="<?= $data->field_name() ?>"
        style="font-family: sans-serif; font-size: 0.85em; display: block; padding: 9px;"
        ><?= $data->field_label()->html() ?></label>
<?php endif; ?>
    <input
        type="number"
        id="<?= $data->field_name() ?>"
        name="<?= $data->field_name() ?>"
        placeholder="<?= $data->placeholder()->html() ?>"
<?php if($data->default()->isNotEmpty()): ?>        value="<?= $data->default()->html() ?>"<?php endif; ?>

        style="font-family: sans-serif; font-size: 1em; display: block; padding: 6px; margin-top: 6px; width: 200px"
        readonly>
</div>
