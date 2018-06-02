function loadAll() {
    var dataForm = $("#filterForm").serialize();
    if (dataForm === "") {
        $(location).attr('href', '/main')
    }
    else {
        $.ajax({
            type: 'GET',
            url: '/load',
            data: dataForm,
            success: function (data, textstatus) {
                $("#apartments").html("").append(data);

            }
        });
    }
}

function addFavourite(id) {
    $.ajax({
        type: 'GET',
        url: '/addFavourite',
        data: "Id=" + id,
    });
}

checkBoxHandler();

function checkBoxHandler() {
    var checkBoxes = $(".checked-items").toArray();
    $('#filterForm :checkbox').change(function () {
        if (this.checked) {
            showParams(this.id, $("#" + this.id + "value")[0].innerHTML);
        } else {
            removeParams(this.id);
        }
        loadAll();
    });
}



function showParams(typeParamId, textParam) {
    var buttonSearching = document.createElement("div");
    buttonSearching.innerHTML = textParam + '<a onclick="removeParams(\''+typeParamId+'\')"><i class="far fa-times-circle close"></i></a>';
    buttonSearching.className = "choosed";
    buttonSearching.id = "params" + typeParamId;

    var cancelBtn = document.createElement("a");
    cancelBtn.innerHTML = '<div class="clear-search">Скинути</div>';
    cancelBtn.id = "cancelBtnParams";
    cancelBtn.setAttribute("href", "/main");

    var divImportant = document.createElement("div");
    divImportant.id = "clearFixed";

    if ($('#cancelBtnParams')) {
        $("#cancelBtnParams").remove();
        $("#clearFixed").remove();
    }

    $("#choosedPanel").append(buttonSearching);
    $("#choosedPanel").append(cancelBtn);
    $("#choosedPanel").append(divImportant);
}

function removeParams(typeParamId) {
    var param = $("#params" + typeParamId)[0];
    console.log($("#"+typeParamId));
    $("#"+typeParamId)[0].checked = false;
    param.remove();

    loadAll();
}
