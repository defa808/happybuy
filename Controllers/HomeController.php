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
use lib\Pagination;
use Model\Account;
use Model\Apartment;
use Model\AreaLocation;
use Model\Metro;
use Model\Room;

class HomeController extends Controller
{
    public function IndexAction()
    {
        $this->route['action'] = "main";

        $pagination = new Pagination($this->route, Apartment::takeAllCount());
        $items = $this->initModel();
        $districts = AreaLocation::takeAll();
        $rooms = Room::takeAll();

        $vars = [
            'pagination' => $pagination->get(),
            'items' => $items,
            'districts' => $districts,
            'rooms' =>$rooms
        ];
        $this->view->render('Головна сторінка', $vars);
    }
    public function AdvertisingAction()
    {
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
            $this->view->render('Ваш вибір квартири', $vars);
        }

    }



    private function initModel()
    {
       $items =  Apartment::getList($this->route);

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