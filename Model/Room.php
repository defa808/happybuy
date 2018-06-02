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
        return $this->$property = $value;
    }

    static function getNameInDatabase()
    {
        return "rooms";
    }

    public function __toString()
    {
        return (string)$this->Text;
    }

    public function ToHtml()
    {
        ?>
        <div class="items">
            <input class="checked-items"
                   id="<?= "room" . $this->Id ?>"
                   type="checkbox"
                   name="room_Id"
                   value="<?= $this->Id ?>">

            <label for="<?= "room" . $this->Id ?>"
                   id="<?= "room" . $this->Id ?>value"><?= $this->getText() ?></label>
        </div>
        <?php
    }
}