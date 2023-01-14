<?php

require __DIR__ . '/../vendor/autoload.php';

// Instantiate app
$app = Slim\Factory\AppFactory::create();

// Add Error Handling Middleware
$app->addErrorMiddleware(true, false, false);

// Add route callbacks
$app->get('/', App\Controllers\HomeCtr::class);
$app->get('/{slug}', App\Controllers\PostCtr::class);

// Run application
$app->run();