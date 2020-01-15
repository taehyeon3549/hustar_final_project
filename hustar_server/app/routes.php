<?php
// Routes

$app->get('/', 'App\Controller\HomeController:dispatch')
    ->setName('homepage');

$app->get('/post/{id}', 'App\Controller\HomeController:viewPost')
    ->setName('view_post');


// TEST
$app->get('/test', 'App\Controller\HomeController:test')
    ->setName('test');
