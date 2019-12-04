A form was submitted from the page "<?= page($page_id)->title() ?>",  from your site "<?= site()->title() ?>".

The submitted information is as follows:

<?php foreach ($fields as $field => $value): ?>
------------------------------------------------
* <?= $field ?>:
<?= $value ?>

<?php endforeach;
