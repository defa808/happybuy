<?php
/**
 * Created by PhpStorm.
 * User: alexg
 * Date: 02.06.2018
 * Time: 21:10
 */
?>
<main>
    <link href="../Content/bootstrap.css" rel="stylesheet">
    <div class="leftPanel">
        <div class="list-group">
            <a href="/admin" class="list-group-item list-group-item-action ">
                Квартири
            </a>
            <a href="/admin/users" class="list-group-item list-group-item-action active">Користувачі</a>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table">
            <thead>
            <tr>
                <th>login</th>
                <th>email</th>
                <th>password hash</th>
                <th>status</th>
                <th>token</th>
                <th>role User</th>
            </tr>
            </thead>
            <tbody id="tableApartment">
            <?php
            foreach ($items as $item) {
                $item->GetCRUD();
            } ?>
            </tbody>
        </table>
        <input type="button" class="btn btn-primary" onclick="createUser()" value="Створити запис"/>
    </div>

</main>

<script>
    function saveUser($formId) {
        var dataForm = $("#" + $formId).serialize();
        $.ajax({
            type: 'POST',
            url: '/Admin/SaveUser',
            data: dataForm,
            success: function (data, textstatus) {
                alert("Збережено запис"+ data);

            }
        });
    }

    function deleteUser($formId) {
        var dataForm = $("#" + $formId).serialize();

        if(confirm('Ви впевненні?')) {
            $.ajax({
                type: 'POST',
                url: '/Admin/DeleteUser',
                data: dataForm,
                success: function (data, textstatus) {
                    alert("Запис видалено");

                }
            });
        }
    }

    function createUser() {
        $.ajax({
            type: 'GET',
            url: '/Admin/CreateUser',
            success: function (data, textstatus) {
                $("#tableApartment").append(data);
            }
        });
    }
</script>