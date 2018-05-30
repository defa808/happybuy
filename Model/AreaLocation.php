<?php
/**
 * Created by PhpStorm.
 * User: alexg
 * Date: 05.05.2018
 * Time: 17:13
 */

namespace Model;


use core\DataLib\ORM;

class AreaLocation extends ORM implements IToHTML
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
        return "arealocations";
    }

    public function ToHtml()
    {
        ?>
        <div class="items" >
            <input class="checked-items"  type="checkbox" name="areaLocation_Id"
                   id="<?= "area".$this->Id ?>" value="<?= $this->Id ?>">
            <label for="<?= "area".$this->Id ?>" id="<?= "area".$this->Id."value"?>" ><?= $this->GetText() ?> район</label>
        </div>
        <?php
    }
}