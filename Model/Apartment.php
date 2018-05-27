<?php

namespace Model;

use core\DataLib\ORM;
use core\DataLib\SQLBuilder;
use Exception;

class Apartment extends ORM implements IToHtml
{
    protected $Id;
    protected $mainImage;
    protected $countImage;
    protected $room_Id;
    protected $room;
    protected $areaLocation_Id;
    protected $areaLocation;
    protected $metro_Id;
    protected $metro;
    protected $areaGeneral;
    protected $areaKitchen;
    protected $areaLiving;
    protected $floor;
    protected $floorGeneral;
    protected $price;

    public function __construct()
    {
        $this->mainImage = "../images/{$this->mainImage}";
    }

    public function Apartment($urlImage, $countImage, $roomId, $areaLocationId, $metroId, $areaGeneral, $areaKitchen, $areaLiving, $floor, $floorGeneral, $price)
    {
        $this->mainImage = $urlImage;
        $this->countImage = $countImage;
        $this->room_Id = $roomId;
        $this->areaLocation_Id = $areaLocationId;
        $this->metro_Id = $metroId;
        $this->areaGeneral = $areaGeneral;
        $this->areaKitchen = $areaKitchen;
        $this->areaLiving = $areaLiving;
        $this->floor = $floor;
        $this->floorGeneral = $floorGeneral;
        $this->price = $price;
    }

    public function include($object)
    {

        if (!($object instanceof ORM))
            throw new Exception(get_class($object) . " don't extends ORM");

        $db = new SQLBuilder();
        $table = $object::getNameInDatabase();
        $db->table($table);
        $db->className(get_class($object));
        $nameClass = join('', array_slice(explode('\\', get_class($object)), -1));
        $nameField = lcfirst($nameClass);
        $nameFieldId = $nameField . "_Id";
        $field = $this->__get($nameFieldId);
        $db->where($field);
        $this->__set($nameField, $db->get());

        return $this;
    }

    public function __get($property)
    {
        if (property_exists($this, $property)) {
            return $this->$property;
        }
        return null;
    }

    public function __set($property, $value)
    {
        if (property_exists($this, $property))
            return $this->$property = $value;
        return null;
    }

    public static function getList($route) {
        $db = new SQLBuilder();

        $max = 8;
        $start = (($route['page'] ?? 1) - 1) * $max;

        return $db->table("apartments")->className(get_called_class())->orderBy("Id","DESC")->limit($start, $max)->getAll();
    }

    public function ToHtml()
    {
        ?>
        <div class="col-xsm-12 col-sm-6 col-md-4 col-lg-3">
            <form class="content-item" method="GET" class="form_favourite" action="apartment">
                <input type="hidden" value="<?= $this->Id ?>" name="Id">
                <div class="readmore"><a href="">Подробніше</a><a class="favourite"/><i
                            class="far fa-star"></i></a></div>
                <img src="<?= $this->mainImage ?>" class="image-for-content"/>
                <div class="content">
                    <div class="count-photo"><a href="#"><?= $this->countImage ?> фото</a></div>
                    <div class="option">
                        <div class="count-room">
                            <strong><?= $this->room != null ? $this->room->getText() : "Undefined" ?></strong></div>
                        <div class="content-location">
                            <?= $this->areaLocation != null ? $this->areaLocation->getText() : "Undefined" ?>
                            район<br/>
                            <?= $this->metro != null ? $this->metro->getText() : "Undefined" ?> станція
                        </div>
                    </div>
                    <div class="option">
                        <div class="apartment-item">Площа</div>
                        <div class="apartment-item-value"><strong>
                                <?= $this->areaGeneral ?> /
                                <?= $this->areaKitchen ?> /
                                <?= $this->areaLiving ?></strong></div>
                    </div>
                    <div class="option">
                        <div class="apartment-item">Поверх</div>
                        <div class="apartment-item-value"><?= $this->floor ?>/<?= $this->floorGeneral ?>
                        </div>
                    </div>
                    <div class="option">
                        <div class="count-for-one-meter apartment-item ">За 1 кв.м.</div>
                        <input class="btn-buy" type="submit" value="<?= $this->price ?> грн"/>
                    </div>
                </div>
        </div>
        </form>

        <?php
    }

    static function getNameInDatabase()
    {
        return "apartments";
    }
}
