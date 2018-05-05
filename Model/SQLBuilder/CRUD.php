<?php
/**
 * Created by PhpStorm.
 * User: alexg
 * Date: 01.04.2018
 * Time: 17:50
 */

interface CRUD
{
    public function insert($fields = [] );

    public function select($columns);

    public function update($fields = [], $id=null);

    public function delete($table_name, $id=null);

}