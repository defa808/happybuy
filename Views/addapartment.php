

<?php
/**
 * Created by PhpStorm.
 * User: alexg
 * Date: 22.04.2018
 * Time: 23:54
 */

include_once "Shared/default.php";
?>
<link rel="stylesheet" href="../Content/bootstrap.min.css">
<link rel="stylesheet" href="../Content/main.css">

<main>
    <form action="../Controllers/AddApartmentController.php" method="POST">
        <div class="form-group">
            <label for="mainImage">Main Image</label>
            <input type="text" class="form-control" id="mainImage" name="mainImage" aria-describedby="mainImage"
                   placeholder="Enter mainImage">
        </div>
        <div class="form-group">
            <label for="CountImage">Count Image</label>
            <input type="text" class="form-control" id="CountImage" name="CountImage" aria-describedby="CountImage"
                   placeholder="Enter CountImage">
        </div>

        <div class="form-group">
            <label for="roomId">roomId</label>
            <input type="text" class="form-control" id="roomId" name="roomId" aria-describedby="roomId" placeholder="Enter roomId">
        </div>

        <div class="form-group">
            <label for="metroId">metro Id</label>
            <input type="text" class="form-control" id="metroId" name="metroId" aria-describedby="metroId" placeholder="Enter metroId">
        </div>

        <div class="form-group">
            <label for="areaLocationId">areaLocation_Id</label>
            <input type="text" class="form-control" id="areaLocationId" name="areaLocationId" aria-describedby="areaLocationIdy"
                   placeholder="Enter areaLocation_Id">
        </div>

        <div class="form-group">
            <label for="areaGeneral">areaGeneral</label>
            <input type="text" class="form-control" id="areaGeneral" name="areaGeneral" aria-describedby="areaGeneral"
                   placeholder="Enter areaGeneral">
        </div>

        <div class="form-group">
            <label for="areaKitchen">areaKitchen</label>
            <input type="text" class="form-control" id="areaKitchen" name="areaKitchen" aria-describedby="areaKitchen"
                   placeholder="Enter areaKitchen">
        </div>

        <div class="form-group">
            <label for="areaLiving">areaLiving</label>
            <input type="text" class="form-control" id="areaLiving"name="areaLiving"  aria-describedby="areaLiving"
                   placeholder="Enter areaLiving">
        </div>

        <div class="form-group">
            <label for="floor">floor</label>
            <input type="text" class="form-control" id="floor" name="floor" aria-describedby="floor" placeholder="Enter floor">
        </div>

        <div class="form-group">
            <label for="floorGeneral">floorGeneral</label>
            <input type="text" class="form-control" id="floorGeneral" name="floorGeneral" aria-describedby="floorGeneral"
                   placeholder="Enter floorGeneral">
        </div>

        <div class="form-group">
            <label for="price">price</label>
            <input type="text" class="form-control" id="price" name="price" aria-describedby="price" placeholder="Enter price">
        </div>
        <input type="submit" name="do_addApart" value="Submit">
    </form>

</main>

