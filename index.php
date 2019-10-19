<?php

Kirby::plugin('cre8ivclick/formbuilder', [
    'blueprints' => [
        'formbuilder' => __DIR__ . '/blueprints/formbuilder.yml'
    ],
    'snippets' => [
        'formbuilder' => __DIR__ . '/snippets/formbuilder.php',
        'formbuilder/text' => __DIR__ . '/snippets/fields/text.php'
    ]
]);
