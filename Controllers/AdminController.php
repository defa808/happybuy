<?php

namespace Controllers;

use core\Controller;
use Model\Account;
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

    public function showUsersAction(){
        $items = Account::takeAll();
        $vars = [
            'items' => $items
        ];
        $this->view->render("Адмінка", $vars);
    }

    public function saveUserAction()
    {
        $data = $_POST;
        $id = strip_tags($data["Id"]);
        if ($id != "") {
            $user = Account::findId($id);
            if ($user != null) {
                $user->initUser($data);
                Account::update($user);
            }
        } else {
            $user = new Account();
            $user->initUser($data);
            Account::create($user);
        }
    }


    public function deleteUserAction()
    {
        $data = $_POST;
        $id = strip_tags($data["Id"]);
        if ($id != "") {
            $user = Account::findId($id);
            if ($user != null) {
                Account::remove($user);
            }
        }
    }

    public function createUserAction()
    {
        $user = new Account();
        $user->GetCRUD();
    }



}