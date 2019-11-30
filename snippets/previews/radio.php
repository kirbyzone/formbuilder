<div style="padding: 9px">
<?php
if($data->field_label()->isNotEmpty()):
?>
<p style="font-family: sans-serif; font-size: 1em; margin-bottom: 6px; padding-left: 6px;"><?= $data->field_label()->html() ?></p>
<?php
endif;
foreach ($data->btns()->toStructure() as $btn):
    $id = 'rb-'. uniqid();
?>
    <input type="radio"
        name="<?= $data->field_name() ?>"
        id="<?= $id ?>"
        value="<?= $btn->radio_btn_value()->html() ?>"
        <?php if($btn->radio_btn_state()->toBool()): ?> checked<?php endif; ?>
        style="font-family: sans-serif; font-size: 1em; display: inline-block; padding: 6px; margin-top: 6px;"
    disabled>
    <label
        for="<?= $id ?>"
        style="font-family: sans-serif; font-size: 0.85em; display: inline-block; padding: 9px 9px 9px 3px;"
        ><?= $btn->radio_btn_label()->or($btn->radio_btn_value())->html() ?></label>
<?php
endforeach;
?>
