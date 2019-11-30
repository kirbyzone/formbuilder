<div style="padding: 9px">
    <input
        type="text"
        id="<?= $data->field_name() ?>"
        name="<?= $data->field_name() ?>"
        value="<?= $data->default()->html() ?>"
        style="font-family: sans-serif; font-size: 1em; display: block; padding: 6px; margin-top: 6px; width: 100%; border: none; background: rgba(0,0,0,0.03); color: #555"
        disabled>
</div>
