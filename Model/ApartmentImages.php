<?php
/**
 * Created by PhpStorm.
 * User: alexg
 * Date: 02.06.2018
 * Time: 22:01
 */

namespace Model;


use core\DataLib\ORM;
use core\DataLib\SQLBuilder;

class ApartmentImages extends ORM implements IToHTML
{

    protected $Id;
    protected $apartment_Id;
    protected $image_url;


    public static function findByApartmentId($id)
    {
        $db = new SQLBuilder();
        $db->table(self::getNameInDatabase())->className(get_called_class());
        $db->where("apartment_Id", "=", $id);
        return $db->getAll();
    }

    public function getImageUrl()
    {
        return '../../images/' . $this->image_url;
    }

    static function getNameInDatabase()
    {
        return 'apartments_images';
    }

    public function ToHtml()
    {
        ?>
        <div class="imagesApartment"><img src="<?=$this->getImageUrl()?>"/></div>
        <?php
    }
}