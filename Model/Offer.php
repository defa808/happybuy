<?php
include 'IToHtml.php';

class Offer implements IToHtml
{
    protected $Id;
    protected $mainImage;
    protected $countImage;
    protected $countRoom;
    protected $areaLocation;
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

//    public function __construct($Id, $urlImage, $countImage, $countRoom, $areaLocation_id, $metro_id, $areaGeneral, $areaKitchen, $areaLiving, $floor, $floorGeneral, $price)
//    {
//        $this->Id = $Id;
//        $this->mainImage = $urlImage;
//        $this->countImage = $countImage;
//        $this->countRoom = $countRoom;
//        $this->areaLocation_id = $areaLocation_id;
//        $this->metro_id = $metro_id;
//        $this->areaGeneral = $areaGeneral;
//        $this->areaKitchen = $areaKitchen;
//        $this->areaLiving = $areaLiving;
//        $this->floor = $floor;
//        $this->floorGeneral = $floorGeneral;
//        $this->price = $price;
//    }

    public function __get($property)
    {
        if (property_exists($this, $property)) {
            return $this->$property;
        }
    }

    public function __set($property, $value)
    {
        if (property_exists($this, $property))
            return $this->$property = $value;
    }


    public function ToHtml()
    {

        ?>
        <div class="col-xsm-12 col-sm-6 col-md-4 col-lg-3">
            <div class=" content-item">
                <form method="GET" class="form_favourite" action="buyhome.php">
                    <input type="hidden" value="<?= $this->Id ?>" name="Id">
                    <div class="readmore"><a href="buyhome.php">Подробніше</a><a class="favourite"/><i
                                class="far fa-star"></i></a></div>
                    <div class="image-for-content"><img src="<?= $this->mainImage ?>"/></div>
                    <div class="count-photo"><a href="#"><?= $this->countImage ?> фото</a></div>
                    <div class="count-room"><strong><?= $this->countRoom ?> кімнат</strong></div>
                    <div class="content-location">
                        <?= $this->areaLocation ?> район<br/>
                       <?= $this->metro ?> станція
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

}
