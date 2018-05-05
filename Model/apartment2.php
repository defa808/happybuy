<?php
include "Apartment.php";

class apartment2 extends Apartment{
    public $arrayImage;
    public $arrayRoomArea;

    public function __get( $key )
    {
        return $this->arrayImage[ $key ];
    }

    public function __set( $key, $value )
    {
        $this->arrayImage[ $key ] = $value;
    }

}
/**
 * Created by PhpStorm.
 * User: alexg
 * Date: 25.02.2018
 * Time: 21:47
 */