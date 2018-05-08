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
    public function IndexAction()
    {

        $items = $this->initModel();
        $vars = [
            'items' => $items
        ];
        $this->view->render('Головна сторінка', $vars);
    public function AdvertisingAction()
    {
        if (isset($_POST['exit'])) {
            $this->LogOut();
        }
        $this->view->layout = null;
        $this->view->render("Ласкаво просимо");
    }

    public function ShowApartmentAction()
    {
        if (isset($_GET['Id'])) {
            $Id = $_GET['Id'];
            $apartment = Apartment::findId($Id);
            $vars = [
                'apartment' => $apartment
            ];
            $this->view->render('Ваш вибір квартири', $vars);
        } else {
            $vars = [
                'message' => "Something go wrong"
            ];
            var_dump($this->route);
            $this->view->render('Ваш вибір квартири', $vars);
        }


    }

    private function LogOut()
    {
        $_SESSION['authorize'] = null;
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