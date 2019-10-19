<?php if($fld->form_field_structure()->toBool()): ?>
    <div<?php if($fld->form_field_class()->isNotEmpty()): ?> class="<?= $fld->form_field_class() ?>"<?php endif; ?>>
        <?php if($fld->form_field_email_label()->isNotEmpty()):?><label for="<?= $fld->form_field_name() ?>"><?= $fld->form_field_email_label()->html() ?></label><?php endif; ?>

        <input type="email" name="<?= $fld->form_field_name() ?>" id="<?= $fld->form_field_name() ?>"<?php if($fld->form_field_email_placeholder()->isNotEmpty()): ?> placeholder="<?= $fld->form_field_email_placeholder()->html() ?>"<?php endif; ?><?php if($fld->form_field_email_min()->isNotEmpty()):?> minlength="<?= $fld->form_field_email_min() ?>"<?php endif; ?><?php if($fld->form_field_email_max()->isNotEmpty()):?> maxlength="<?= $fld->form_field_email_max() ?>"<?php endif; ?><?php if($fld->form_field_email_pattern()->isNotEmpty()):?> pattern="<?= $fld->form_field_email_pattern() ?>"<?php endif; ?><?php if($fld->form_field_email_req()->toBool()):?> required<?php endif; ?>>
    </div>
<?php else: ?>
    <?php if($fld->form_field_email_label()->isNotEmpty()):?><label for="<?= $fld->form_field_name() ?>"><?= $fld->form_field_email_label()->html() ?></label><?php endif; ?>

    <input type="email" name="<?= $fld->form_field_name() ?>" id="<?= $fld->form_field_name() ?>"<?php if($fld->form_field_class()->isNotEmpty()): ?> class="<?= $fld->form_field_class() ?>"<?php endif; ?><?php if($fld->form_field_email_placeholder()->isNotEmpty()): ?> placeholder="<?= $fld->form_field_email_placeholder()->html() ?>"<?php endif; ?><?php if($fld->form_field_email_min()->isNotEmpty()):?> minlength="<?= $fld->form_field_email_min() ?>"<?php endif; ?><?php if($fld->form_field_email_max()->isNotEmpty()):?> maxlength="<?= $fld->form_field_email_max() ?>"<?php endif; ?><?php if($fld->form_field_email_pattern()->isNotEmpty()):?> pattern="<?= $fld->form_field_email_pattern() ?>"<?php endif; ?><?php if($fld->form_field_email_req()->toBool()):?> required<?php endif; ?>>

<?php endif; ?>
