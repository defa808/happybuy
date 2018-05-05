<?php
include 'IToHtml.php';
include_once "SQLBuilder/ORM.php";
include_once "IEntityDatabase.php";

class Apartment extends ORM implements IEntityDatabase, IToHtml
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

        if (!($object instanceof IEntityDatabase))
            throw new Exception(get_class($object) . " don't implements IEntutyDatabase");

        $db = new SQLBuilder();
        $table = $object->NameInDatabase();
        $db->table($table);
        $db->className(get_class($object));
        $nameField = lcfirst(get_class($object));
        $nameFieldId = $nameField . "_Id";
        $field = $this->__get($nameFieldId);
        $this->__set($nameField, $db->where($field)->get());

        return $this;
    }

    public function __get($property)
    {
        if (property_exists($this, $property)) {
            return $this->$property;
        }
        return false;
    }

    public function __set($property, $value)
    {
        if (property_exists($this, $property))
            return $this->$property = $value;
        return false;
    }

    public function ToHtml()
    {
        ?>
        <div class="col-xsm-12 col-sm-6 col-md-4 col-lg-3">
            <div class=" content-item">
                <form method="GET" class="form_favourite" action="buyhome.php">
                    <input type="hidden" value="<?= $this->Id ?>" name="Id">
                    <div class="readmore"><a href="">Подробніше</a><a class="favourite"/><i
                                class="far fa-star"></i></a></div>
                    <div class="image-for-content"><img src="<?= $this->mainImage ?>"/></div>
                    <div class="count-photo"><a href="#"><?= $this->countImage ?> фото</a></div>
                    <div class="count-room">
                        <strong><?= $this->room != null ? $this->room->getText() : "Undefined" ?></strong></div>
                    <div class="content-location">
                        <?= $this->areaLocation != null ? $this->areaLocation->getText() : "Undefined" ?> район<br/>
                        <?= $this->metro != null ? $this->metro->getText() : "Undefined" ?> станція
                    </div>
                    <div class="apartment-item">Площа</div>
                    <div class="apartment-item-value"><b><?= $this->areaGeneral ?> / <?= $this->areaKitchen ?>
                            / <?= $this->areaLiving ?></b></div>
                    <div class="apartment-item">Поверх</div>
                    <div class="apartment-item-value"><?= $this->floor ?>/<?= $this->floorGeneral ?>
                    </div>
                    <div class="count-for-one-meter apartment-item ">За 1 кв.м.</div>
                    <input class="btn-buy" type="submit" value="<?= $this->price ?> грн"/>
            </div>
            </form>

        </div>
        <?php
    }

    static function NameInDatabase()
    {
        return "apartments";
    }
}
