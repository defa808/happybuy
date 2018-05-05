<?php
/**
 * Created by PhpStorm.
 * User: alexg
 * Date: 22.04.2018
 * Time: 23:58
 */
include_once "../Model/Apartment.php";
$data = $_POST;
$errors = array();

if(isset($data["do_addApart"])){

    if(isset($data["mainImage"]))
        $mainImage = $data["mainImage"];
    else
        $errors[] = "Empty field";

    if(isset($data["CountImage"]))
        $countImage = $data["CountImage"];
    else
        $errors[] = "Empty field";

    if(isset($data["roomId"]))
        $roomId = $data["roomId"];
    else
        $errors[] = "Empty field";

    if(isset($data["areaLocationId"]))
        $areaLocationId = $data["areaLocationId"];
    else
        $errors[] = "Empty field";

    if(isset($data["metroId"]))
        $metroId = $data["metroId"];
    else
        $errors[] = "Empty field";

    if(isset($data["areaGeneral"]))
        $areaGeneral = $data["areaGeneral"];
    else
        $errors[] = "Empty field";

    if(isset($data["areaKitchen"]))
        $areaKitchen = $data["areaKitchen"];
    else
        $errors[] = "Empty field";

    if(isset($data["areaLiving"]))
        $areaLiving = $data["areaLiving"];
    else
        $errors[] = "Empty field";

    if(isset($data["floor"]))
        $floor = $data["floor"];
    else
        $errors[] = "Empty field";

    if(isset($data["floorGeneral"]))
        $floorGeneral = $data["floorGeneral"];
    else
        $errors[] = "Empty field";

    if(isset($data["price"]))
        $price = $data["price"];
    else
        $errors[] = "Empty field";



    $offer = new Apartment();
    $offer->Apartment($mainImage, $countImage, $roomId, $areaLocationId,$metroId, $areaGeneral, $areaKitchen,
        $areaLiving,$floor, $floorGeneral, $price);

    Apartment::create($offer);

    var_dump(Apartment::findId(1));
//
//    $a = new Apartment();
//    $a->dsdds = 456;
//
//    $a = Apartment::where('dgdg','fgfgg')->first();
//    $a ->fdff = fgg;
//




    $a->save();

}

