<?php

namespace Controllers;

use core\Controller;

/**
 * Created by PhpStorm.
 * User: alexg
 * Date: 02.06.2018
 * Time: 13:37
 */
class AdminController extends Controller{

    public function IndexAction(){
        $this->view->render("Адмінка");
    }
}