<div style="padding: 9px">
<?php if($data->field_label()->isNotEmpty()): ?>
    <label
        for="<?= $data->field_name()->html() ?>"
        style="font-family: sans-serif; font-size: 0.85em; display: block; padding: 9px;"
        ><?= $data->field_label()->html() ?></label>
<?php endif; ?>
    <select
        name="<?= $data->field_name()->html() ?>"
        id="<?= $data->field_name()->html() ?>"
<?php if($data->multiple()->toBool()):?>        multiple<?php endif; ?>
        style="font-family: sans-serif; display: block; margin-left: 9px;"
    >

<?php foreach ($data->menuitems()->toStructure() as $item): ?>
        <option value="<?= $item->item_value()->html() ?>"<?php if($item->item_state()->toBool()):?> selected<?php endif; ?>><?= $item->item_label()->or($item->item_value())->html() ?></option>

<?php endforeach;?>
    </select>
</div>
