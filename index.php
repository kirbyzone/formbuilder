<?php

Kirby::plugin('cre8ivclick/formbuilder', [
    'blueprints' => [
        'formbuilder' => __DIR__ . '/blueprints/formbuilder.yml',
        'formbuilder/fields/name' => __DIR__ . '/blueprints/fields/name.yml',
        'formbuilder/fields/class' => __DIR__ . '/blueprints/fields/class.yml',
        'formbuilder/fields/req' => __DIR__ . '/blueprints/fields/req.yml',
        'formbuilder/fields/label' => __DIR__ . '/blueprints/fields/label.yml',
        'formbuilder/fields/placeholder' => __DIR__ . '/blueprints/fields/placeholder.yml',
        'formbuilder/fields/value' => __DIR__ . '/blueprints/fields/value.yml',
        'formbuilder/fields/min' => __DIR__ . '/blueprints/fields/min.yml',
        'formbuilder/fields/max' => __DIR__ . '/blueprints/fields/max.yml',
        'formbuilder/fields/pattern' => __DIR__ . '/blueprints/fields/pattern.yml',
        'formbuilder/blocks/fb_text' => __DIR__ . '/blueprints/blocks/fb_text.yml',
        'formbuilder/blocks/fb_textarea' => __DIR__ . '/blueprints/blocks/fb_textarea.yml',
        'formbuilder/blocks/fb_email' => __DIR__ . '/blueprints/blocks/fb_email.yml',
        'formbuilder/blocks/fb_tel' => __DIR__ . '/blueprints/blocks/fb_tel.yml'
    ],
    'snippets' => [
        'formbuilder' => __DIR__ . '/snippets/formbuilder.php',
        'formbuilder/input' => __DIR__ . '/snippets/fields/input.php',
        'formbuilder/password' => __DIR__ . '/snippets/fields/password.php',
        'formbuilder/textarea' => __DIR__ . '/snippets/fields/textarea.php',
        'formbuilder/number' => __DIR__ . '/snippets/fields/number.php',
        'formbuilder/checkbox' => __DIR__ . '/snippets/fields/checkbox.php',
        'formbuilder/select' => __DIR__ . '/snippets/fields/select.php',
        'formbuilder/radio' => __DIR__ . '/snippets/fields/radio.php',
        'formbuilder/hidden' => __DIR__ . '/snippets/fields/hidden.php',
        'formbuilder/honeypot' => __DIR__ . '/snippets/fields/honeypot.php',
        'formbuilder/text_preview' => __DIR__ . '/snippets/previews/text.php',
        'formbuilder/textarea_preview' => __DIR__ . '/snippets/previews/textarea.php'
    ]
]);
