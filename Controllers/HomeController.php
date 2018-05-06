<?php

/**
 * Created by PhpStorm.
 * User: alexg
 * Date: 06.05.2018
 * Time: 15:00
 */

namespace Controllers;

use core\Controller;
use Exception;
use Model\Apartment;
use Model\AreaLocation;
use Model\Metro;
use Model\Room;

class HomeController extends Controller
{
    public function IndexAction($param = null)
    {
        $items = $this->initModel();

        $vars = [
            'items' => $items
        ];
        if (isset($param))
            $_GET = array_merge($_GET, $param);

        $this->view->render('Головна сторінка', $vars);
//        $this->View("buyhome.php");
    }

    public function AdvertisingAction($param = null){
        $this->view->layout = null;
        $this->view->render("Ласкаво просимо");
    }

    private function View($nameFile)
    {
        $pathFile = "Views/" . $nameFile;
//        $info = include $pathFile;
//        return $info;
        header('Refresh: 0; URL=' . $pathFile);

    }

    private function initModel()
    {
        $items = Apartment::takeAll();
        try {
            foreach ($items as $item) {
                $item->include(new Room())->include(new Metro())->include(new AreaLocation());
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        }


        return $items;
    }

}