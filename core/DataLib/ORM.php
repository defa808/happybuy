<?php

namespace core\DataLib;

abstract class ORM
{
    static protected function setup()
    {
        $db = new SQLBuilder();

        $table = get_called_class()::getNameInDatabase();
        $db->table($table);
        $db->className(get_called_class());
        return $db;
    }

    public static function findId($id)
    {
        $db = self::setup();
        $res = $db->where($id)->get();
        return $res;
    }

    public static function takeAllCount(){
        $db = new SQLBuilder();
        $table = get_called_class()::getNameInDatabase();

        $res = $db->query("SELECT count(*)")->table($table)->exec();

        return $res;
    }

    public static function takeAll(){
        $db = self::setup();
        $res = $db->getAll();
        return $res;
    }

    public static function remove($currentObj)
    {
        if (!is_object($currentObj))
            return false;
        $id = key(get_class_vars(get_called_class()));
        if (empty($id))
            return false;
        $db = self::setup();
        return $db->delete($id);

    }

    public static function create($currentObj)
    {
        if (!is_object($currentObj))
            return false;
        $db = self::setup();
        $myArrayValue = array();
        foreach ($currentObj as $k => $v) {
            if ($k != "Id")
                $myArrayValue[$k] = $v;
        }
        $db->insert($myArrayValue);
        return $currentObj;
    }

    public static function update($currentObj)
    {
        if (!is_object($currentObj))
            return false;
        $id = key(get_class_vars(get_called_class()));
        if (empty($id))
            return false;
        $db = self::setup();
        $myArrayValue = array();
        foreach ($currentObj as $k => $v) {
            if ($k != "Id")
                $myArrayValue[$k] = $v;
        }
        return $db->update($myArrayValue, $id);
    }

    abstract static function getNameInDatabase();

}