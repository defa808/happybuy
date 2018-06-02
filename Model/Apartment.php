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
    protected $areaLocation_Id;
    protected $metro_Id;
    protected $areaGeneral;
    protected $areaKitchen;
    protected $areaLiving;
    protected $floor;
    protected $floorGeneral;
    protected $price;

    public function __construct()
    {
    }

    public function initApartment($data)
    {
        $this->mainImage = strip_tags($data["mainImage"]);
        $this->countImage = strip_tags($data["countImage"]);
        $this->room_Id = strip_tags($data["room_Id"]);
        $this->areaLocation_Id = strip_tags($data["areaLocation_Id"]);
        $this->metro_Id = strip_tags($data["metro_Id"]);
        $this->areaGeneral = strip_tags($data["areaGeneral"]);
        $this->areaKitchen = strip_tags($data["areaKitchen"]);
        $this->areaLiving = strip_tags($data["areaLiving"]);
        $this->floor = strip_tags($data["floor"]);
        $this->floorGeneral = strip_tags($data["floorGeneral"]);
        $this->price = strip_tags($data["price"]);
    }

    public static function includeAllRelations($items)
    {
        try {
            foreach ($items as $item) {
                $item->include(new Room())->include(new Metro())->include(new AreaLocation());
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        }
        return $items;
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
        $this->$property = $value;
    }

    public static function getList($route)
    {
        $db = new SQLBuilder();

        $max = 8;
        $start = (($route['page'] ?? 1) - 1) * $max;

        return $db->table("apartments")->className(get_called_class())->orderBy("Id", "DESC")->limit($start, $max)->getAll();
    }

    public function getMainImage()
    {
        return "../images/{$this->mainImage}";
    }

    public function ToHtml()
    {
        ?>
        <div class="col-xsm-12 col-sm-6 col-md-4 col-lg-3">
            <div class="content-item">
                <div class="readmore">
                    <a href="#">Подробніше</a>
                    <span onclick="addFavourite(<?= $this->Id ?>)">
                        <a class="favourite">
                            <i class="far fa-star"></i>
                        </a>
                    </span>
                </div>
                <form method="GET" class="form_favourite" action="/apartment" onclick="submit()">
                    <input type="hidden" value="<?= $this->Id ?>" name="Id">

                    <img src="<?= $this->getMainImage() ?>" class="image-for-content"/>
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
                </form>
            </div>
        </div>

        <?php
    }

    public function GetCRUD()
    {
        if (isset($this->Id))
            $this->include(new Room)->include(new AreaLocation())->include(new Metro());
        $rooms = Room::takeAll();
        $areaLocationList = AreaLocation::takeAll();
        $metroList = Metro::takeAll();
        ?>
        <tr>
            <td>
                <div class="form-group">
                    <input form="form<?= $this->Id ?>" type="text" maxlength="200" name="mainImage" class="form-control"
                           value="<?= $this->mainImage ?>">
                </div>
            </td>
            <td>
                <div class="form-group">
                    <input form="form<?= $this->Id ?>" type="number" maxlength="20" name="countImage"
                           class="form-control"
                           value="<?= $this->countImage ?>">
                </div>
            </td>
            <td>
                <div class="form-group">
                    <select class="form-control" form="form<?= $this->Id ?>" name="room_Id">
                        <?php foreach ($rooms as $room) { ?>
                            <option
                                <?= $this->room_Id == $room->Id ? "selected = 'selected'" : '' ?>
                                    value="<?= $room->Id ?>"><?= $room ?></option>
                            <?php
                        } ?>
                    </select>
                </div>
            </td>
            <td>
                <div class="form-group" form="form<?= $this->Id ?>" name="areaLocation_Id">
                    <select form="form<?= $this->Id ?>" class="form-control" name="areaLocation_Id">
                        <?php foreach ($areaLocationList as $area) { ?>
                            <option
                                <?= $this->areaLocation_Id == $area->Id ? "selected = 'selected'" : '' ?>
                                    value="<?= $area->Id ?>"><?= $area ?></option>
                            <?php
                        } ?>
                    </select>
                </div>

            </td>
            <td>
                <div class="form-group" form="form<?= $this->Id ?>" name="metro_Id">
                    <select class="form-control" form="form<?= $this->Id ?>" name="metro_Id">
                        <?php foreach ($metroList as $metro) { ?>
                            <option
                                <?= $this->metro_Id == $metro->Id ? "selected = 'selected'" : '' ?>
                                    value="<?= $metro->Id ?>"><?= $metro ?></option>
                            <?php
                        } ?>
                    </select>
                </div>
            </td>
            <td>
                <div class="form-group">
                    <input form="form<?= $this->Id ?>" type="number" name="areaGeneral" class="form-control"
                           maxlength="20"
                           value="<?= $this->areaGeneral ?>">
                </div>
            </td>
            <td>
                <div class="form-group">
                    <input form="form<?= $this->Id ?>"
                           type="number" name="areaKitchen" class="form-control"
                           maxlength="20"
                           value="<?= $this->areaKitchen ?>">
                </div>
            </td>
            <td>
                <div class="form-group">
                    <input form="form<?= $this->Id ?>"
                           type="number" name="areaLiving" class="form-control"
                           maxlength="20"
                           value="<?= $this->areaLiving ?>">
                </div>
            </td>
            <td>
                <div class="form-group">
                    <input form="form<?= $this->Id ?>"
                           type="number" name="floor" class="form-control"
                           maxlength="20"
                           value="<?= $this->floor ?>"/>
                </div>
            </td>
            <td>
                <div class="form-group">
                    <input form="form<?= $this->Id ?>"
                           type="number" name="floorGeneral" class="form-control"
                           maxlength="20"
                           value="<?= $this->floorGeneral ?>"/>
                </div>
            </td>
            <td>
                <div class="form-group">
                    <input form="form<?= $this->Id ?>"
                           type="number" name="price" class="form-control"
                           maxlength="20"
                           value="<?= $this->price ?>"/>
                </div>
            </td>
            <td>
                <div class="form-group">
                    <form id="form<?= $this->Id ?>" action="Admin/SaveApartment" method="POST"></form>
                    <input form="form<?= $this->Id ?>"
                           type="hidden"
                           name="Id"
                           value="<?= $this->Id ?>"/>
                    <button form="form<?= $this->Id ?>"
                            onclick="saveApartment('form<?= $this->Id ?>')"
                            type="button"
                            class="btn btn-info">
                        <i class="fa fa-save" aria-hidden="true"></i>
                    </button>
                </div>
                <div class="form-group">
                    <form id="delete<?= $this->Id ?>" action="Admin/DeleteApartment" method="POST"></form>
                    <input form="delete<?= $this->Id ?>"
                           type="hidden" name="Id" value="<?= $this->Id ?>"/>
                    <button form="delete<?= $this->Id ?>"
                            onclick="deleteApartment('form<?= $this->Id ?>')"
                            type="button"
                            class="btn btn-danger">
                        <i class="fa fa-trash" aria-hidden="true"></i>
                    </button>
                </div>
            </td>
        </tr>


        <?php
    }

    static function getNameInDatabase()
    {
        return "apartments";
    }
}
