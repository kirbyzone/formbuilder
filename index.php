<?php

Kirby::plugin('cre8ivclick/formbuilder', [
    'blueprints' => [
        'formbuilder' => __DIR__ . '/blueprints/formbuilder.yml'
    ],
    'snippets' => [
        'formbuilder' => __DIR__ . '/snippets/formbuilder.php',
        'formbuilder/input' => __DIR__ . '/snippets/fields/input.php',
        'formbuilder/textarea' => __DIR__ . '/snippets/fields/textarea.php',
        'formbuilder/hidden' => __DIR__ . '/snippets/fields/hidden.php',
        'formbuilder/honeypot' => __DIR__ . '/snippets/fields/honeypot.php'
    ]
]);
