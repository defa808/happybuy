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

    public function LoadApartmentAction()
    {
        $this->route['action'] = "load";

        $db = new SQLBuilder();
        $sqlApartments = $db->table(Apartment::getNameInDatabase())->className(Apartment::class);

        $this->buildWhere($stringWhere,$bindValues);

        $max = 8;
        $start = (($route['page'] ?? 1) - 1) * $max;

        $newItems= $sqlApartments->table(Apartment::getNameInDatabase())->className(Apartment::class)->
        setWhere($stringWhere, $bindValues)->getAll();
        Apartment::includeAll($newItems);

        foreach ($newItems as $newItem) {
            $newItem->ToHtml();
        }
    }

    private function buildWhere(&$stringWhere, &$buildValues){
        $stringWhere = "";
        $buildValues = array();
        $params = $this->proper_parse_str($_SERVER['QUERY_STRING']);
        $stringWhere .= "(";

        foreach ($params as $key => $values) {
            if (is_array($values)) {
                $stringWhere .= $key . "=?";
                $buildValues[] = array_shift($values);
                foreach ($values as $value) {
                    $stringWhere .= " OR " . $key . "=?  ";
                    $buildValues[] = $value;
                }
            } else {
                $stringWhere .= $key . "=?";
                $buildValues[] = $values;
            }
            if(next($params)) {
                $stringWhere .= ") AND (";
            }
        }
        $stringWhere .= ")";
    }
}