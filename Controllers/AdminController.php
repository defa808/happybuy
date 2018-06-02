<?php

namespace Controllers;

use core\Controller;
use Model\Apartment;

/**
 * Created by PhpStorm.
 * User: alexg
 * Date: 02.06.2018
 * Time: 13:37
 */
class AdminController extends Controller
{

    public function IndexAction()
    {
        $items = Apartment::takeAll();
        $vars = [
            'items' => $items
        ];
        $this->view->render("Адмінка", $vars);
    }

    public function saveApartmentAction()
    {
        $data = $_POST;
        $id = strip_tags($data["Id"]);
        var_dump($id);
        if ($id != "") {
            $apartment = Apartment::findId($id);
            if ($apartment != null) {
                $apartment->initApartment($data);
                Apartment::update($apartment);
            }
        } else {
            $apartment = new Apartment();
            $apartment->initApartment($data);
            Apartment::create($apartment);
        }


    }


    public function deleteApartmentAction()
    {
        $data = $_POST;
        $id = strip_tags($data["Id"]);
        if ($id != "") {
            $apartment = Apartment::findId($id);
            if ($apartment != null) {
                Apartment::remove($apartment);
            }
        }
    }

    public function createApartmentAction()
    {
        $apartment = new Apartment();
        $apartment->GetCRUD();
    }

}