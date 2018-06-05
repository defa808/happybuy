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
use Model\ApartmentImages;
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
        Apartment::includeAllRelations($items);

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
            $apartment = Apartment::findId($Id)->include(new Room())->include(new AreaLocation())->include(new Metro());

            $apartmentImageList = ApartmentImages::findByApartmentId($apartment->Id);
            $vars = [
                'apartment' => $apartment,
                'apartmentImages' => $apartmentImageList
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
        $this->buildWhere($stringWhere, $bindValues);

        $newItems = $sqlApartments->table(Apartment::getNameInDatabase())->className(Apartment::class)->
        setWhere($stringWhere, $bindValues)->getAll();

        Apartment::includeAllRelations($newItems);

        foreach ($newItems as $newItem) {
            $newItem->ToHtml();
        }
    }

    private function buildWhere(&$stringWhere, &$buildValues)
    {
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
            if (next($params)) {
                $stringWhere .= ") AND (";
            }
        }
        $stringWhere .= ")";
    }

    public function AddFavouriteAction()
    {
        $id = $_GET["Id"];
        $favourite = (array)$_SESSION["favourite"] ?? array();
        if (!in_array($id, $favourite)) {
            $favourite[] = $id;
        } else {
            $key = array_search($id, $favourite);
            unset($favourite[$key]);
        }
        $_SESSION["favourite"] = $favourite;
    }

    public function RemoveFavouriteAction()
    {
        $data = $_GET;
        $id = $data["Id"] ?? null;
        if ($id != null) {
            foreach ($_SESSION["favourite"] as $k => $v)
                if ($v == $id)
                    unset($_SESSION['favourite'][$k]);
        }
    }

    public function ShowFavouriteAction()
    {

        $favouritesId = (array)$_SESSION["favourite"];
        $favouriteApartments = array();
        foreach ($favouritesId as $id) {
            $favouriteApartments[] = Apartment::findId($id);
        }
        Apartment::includeAllRelations($favouriteApartments);
        $vars = [
            'apartments' => $favouriteApartments
        ];
        $this->view->render("Обрані квартири", $vars);
    }


}