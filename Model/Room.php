<?php
/**
 * Created by PhpStorm.
 * User: alexg
 * Date: 05.05.2018
 * Time: 16:14
 */

namespace Model;

use core\DataLib\ORM;

class Room extends ORM implements IToHTML
{
    protected $Id;
    protected $Text;

    public function getText()
    {
        return $this->Text;
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

    static function getNameInDatabase()
    {
        return "rooms";
    }

    public function ToHtml()
    {
        ?>
        <div class="items">
                <input class="checked-items" onclick="loadAll()"  type="checkbox" name="room_Id" value="<?=$this->Id?>">

                <label for="checkbox"><?=$this->getText()?></label>
            </div>
    <?php
    }
}