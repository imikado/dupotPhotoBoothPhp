<?php

class App
{

    const HOME = 'home';

    public function run($page)
    {
    }
}

$page = isset($_GET['page']) ? $_GET['page'] : Pages::HOME;

$app = new App();
$app->run($page);
