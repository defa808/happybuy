<?php

/**
 * Created by PhpStorm.
 * User: alexg
 * Date: 06.05.2018
 * Time: 15:00
 */

namespace Controllers;

use core\Controller;
use core\DataLib\SQLBuilder;
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
        $items = $this->initModelForOnePage();
        $districts = AreaLocation::takeAll();
        $rooms = Room::takeAll();

        $vars = [
            'pagination' => $pagination->get(),
            'items' => $items,
            'districts' => $districts,
            'rooms' => $rooms
        ];
        $this->view->render('Головна сторінка', $vars);
    }

    private function initModelForOnePage()
    {
        $items = Apartment::getList($this->route);
        Apartment::includeAll($items);

        return $items;
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

    //TODO: add pagination!
    public function LoadApartmentAction()
    {
        $this->route['action'] = "main";

        $db = new SQLBuilder();
        $sqlApartments = $db->table(Apartment::getNameInDatabase())->className(Apartment::class);

        $params = $this->proper_parse_str($_SERVER['QUERY_STRING']);
        foreach ($params as $key => $values) {
            if (is_array($values)) {
                foreach ($values as $value) {
                    $sqlApartments->orWhere($key, "=", $value);
                }
            } else {
                $sqlApartments->where($key, "=", $values);
            }

        }
        $newItems = $sqlApartments->getAll();
        Apartment::includeAll($newItems);
        $pagination = new Pagination($this->route, count($newItems));
        foreach ($newItems as $newItem) {
            $newItem->ToHtml();
        }
        echo '<div class="center">'.$pagination->get().'</div>';
    }


}