<?php

/**
 * Created by PhpStorm.
 * User: alexg
 * Date: 06.05.2018
 * Time: 15:00
 */

namespace Controllers;

use core\Controller;

class HomeController extends Controller
{
    public function IndexAction($param = null)
    {
        if (isset($param))
            $_GET = array_merge($_GET, $param);

        $this->view->render('Главная страница');
//        $this->View("buyhome.php");
    }

    private function View($nameFile)
    {
        $pathFile = "Views/" . $nameFile;
//        $info = include $pathFile;
//        return $info;
        header('Refresh: 0; URL=' . $pathFile);

    }
}