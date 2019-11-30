<div style="padding: 9px">
<?php if($data->field_label()->isNotEmpty()): ?>
    <label
        for="<?= $data->field_name() ?>"
        style="font-family: sans-serif; font-size: 0.85em; display: block; padding: 6px;"
        ><?= $data->field_label()->html() ?></label>
<?php endif; ?>
    <textarea
        type="text"
        id="<?= $data->field_name() ?>"
        name="<?= $data->field_name() ?>"
<?php if($data->rows()->isNotEmpty()): ?>        rows="<?= $data->rows()->toInt() ?>"<?php endif; ?>

        style="font-family: sans-serif; font-size: 1em; display: block; padding: 9px; margin-top: 6px; width: 100%;<?php if($data->placeholder()->isNotEmpty() && $data->default()->isEmpty()): ?> color: #999;<?php endif; ?>"
        readonly>
<?php if($data->placeholder()->isNotEmpty() && $data->default()->isEmpty()): ?>
<?= $data->placeholder()->html() ?>
<?php elseif($data->default()->isNotEmpty()): ?>
<?= $data->default()->html() ?>
<?php endif; ?>
    </textarea>
</div>
