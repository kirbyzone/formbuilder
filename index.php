<?php

Kirby::plugin('cre8ivclick/formbuilder', [
    'blueprints' => [
        'formbuilder' => __DIR__ . '/blueprints/formbuilder.yml'
    ],
    'snippets' => [
        'formbuilder' => __DIR__ . '/snippets/formbuilder.php',
        'formbuilder/text' => __DIR__ . '/snippets/fields/text.php',
        'formbuilder/email' => __DIR__ . '/snippets/fields/email.php',
        'formbuilder/url' => __DIR__ . '/snippets/fields/url.php',
        'formbuilder/tel' => __DIR__ . '/snippets/fields/tel.php'
    ]
]);
