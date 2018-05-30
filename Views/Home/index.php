<link href="../Content/media.css" rel="stylesheet"/>


<main>
    <div class="sort">
        <form id="filterForm">

            <div class="location">
                <div class="title">
                    <div class="title-head">Розташування</div>
                    <div class="icon-arrow"></div>
                </div>
                <?php
                foreach ($districts as $district) {
                    $district->ToHtml();
                } ?>
            </div>

            <div class="count-place">
                <div class="title">
                    <div class="title-head">Кількість спальних місць</div>
                    <div class="icon-arrow"></div>
                </div>
                <?php
                foreach ($rooms as $room) {
                    $room->ToHtml();
                } ?>

            </div>
        </form>

    </div>

    <div class="main">
        <h1>Квартири</h1>
        <div class="searching-panel" id="choosedPanel">
            <div style="clear:both;"></div>
        </div>
        <br/>

        <div class="row" id="apartments">
            <?php
            foreach ($items as $item) {
                $item->ToHtml();
            }

            ?>

            <div class="center">
                <?php echo $pagination; ?>
            </div>
        </div>
    </div>

    <div class="new-houses">
        <span>Найновітніші житлові комплекси Києва</span>
        <div class="building">
            <img src="../../images/bud1.png"/>
            <div class="discription-build">ЖК «Сучасник» <br/>р-н Солом’янський,<br/> вул. Борщагівська 7</div>
            <div class="down-building">
                <div class="count-building">від 16000 грн</div>
                <div class="more-info"><a href="#">Подробніше --></a></div>
            </div>
        </div>
        <div class="building">
            <img src="../../images/bud2.png"/>
            <div class="discription-build">ЖК «Зірка» <br/>р-н Солом’янський,<br/> вул. Борщагівська 7</div>
            <div class="down-building">
                <div class="count-building">від 16000 грн</div>
                <div class="more-info"><a href="#">Подробніше --></a></div>
            </div>

        </div>
        <div>

        </div>
    </div>

</main>
<script>
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

</script>
