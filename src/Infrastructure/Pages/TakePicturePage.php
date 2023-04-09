<?php

namespace My\Infrastructure\Pages;

use Dupot\StaticManagementFramework\Page\PageAbstract;
use Dupot\StaticManagementFramework\Render\Layout;
use Dupot\StaticManagementFramework\Render\View;

class TakePicturePage extends PageAbstract
{


    protected $layout = null;

    public function __construct()
    {



        $this->layout = new Layout(__DIR__ . '/Layouts/default.php');
    }



    public function take()
    {
        //$errorList = $this->processLogin();

        $view = new View(
            __DIR__ . '/View/take.php',
            []
        );

        $this->layout->appendContext('contentList', $view);

        return $this->render();
    }

    /*
    public function processLogin()
    {
        if (!$this->getRequest()->isMethodPost()) {
            return [];
        }

        $username = $this->getRequest()->getPostParam('username');
        $password = $this->getRequest()->getPostParam('password');

        if (isset($this->userList[$username]) and $this->userList[$username] == $this->hashPassword($password)) {
            $this->getRequest()->setSessionParam('userConnected', true);
            return $this->getResponse()->redirect(WEB_ROOT . '/index.php/news.html');
        }

        $this->getRequest()->setSessionParam('userConnected', false);

        return [
            'bad credentials'
        ];
    }*/

    public function render()
    {

        echo $this->layout->render();
    }
}
