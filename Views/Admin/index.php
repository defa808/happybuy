<?php
/**
 * Created by PhpStorm.
 * User: alexg
 * Date: 02.06.2018
 * Time: 13:39
 */
?>
<link href="../Content/media.css" rel="stylesheet"/>


<main>
    <link href="../Content/bootstrap.css" rel="stylesheet">
    <div class="leftPanel">
        <div class="list-group">
            <a href="#" class="list-group-item list-group-item-action active">
                Квартири
            </a>
            <a href="#" class="list-group-item list-group-item-action">Користувачі</a>
        </div>
    </div>


    <div class="table-responsive">
        <table class="table">
            <thead>
            <tr>
                <th>mainImage</th>
                <th>countImage</th>
                <th>Room</th>
                <th>Area Location</th>
                <th>Metro</th>
                <th>areaGeneral</th>
                <th>areaKitchen</th>
                <th>areaLiving</th>
                <th>floor</th>
                <th>floorGeneral</th>
                <th>Price</th>
                <th>Tools</th>
            </tr>
            </thead>
            <tbody id="tableApartment">
            <?php
            foreach ($items as $item) {
                $item->GetCRUD();
            } ?>
            </tbody>
        </table>
        <input type="button" class="btn btn-primary" onclick="createApartment()" value="Створити запис"/>
    </div>

</main>

<script>
    function saveApartment($formId) {
        var dataForm = $("#" + $formId).serialize();
        $.ajax({
            type: 'POST',
            url: '/Admin/SaveApartment',
            data: dataForm,
            success: function (data, textstatus) {
                alert("Збережено"+data);

            }
        });
    }

    function deleteApartment($formId) {
        var dataForm = $("#" + $formId).serialize();

        if(confirm('Ви впевненні?')) {
            $.ajax({
                type: 'POST',
                url: '/Admin/DeleteApartment',
                data: dataForm,
                success: function (data, textstatus) {
                    alert("Запис видалено");

                }
            });
        }
    }

    function createApartment() {
            $.ajax({
                type: 'GET',
                url: '/Admin/CreateApartment',
                success: function (data, textstatus) {
                    $("#tableApartment").append(data);
                }
            });
    }

</script>
