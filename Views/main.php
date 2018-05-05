<?php
include_once("Shared/header.php");
include '../Controllers/MainController.php';

$items = initModel();

?>

<link href="../Content/media.css" rel="stylesheet"/>
<link href="../Content/grid.css" rel="stylesheet"/>


<main>
    <div class="sort">
        <div class="location">
            <div class="title">
                <div class="title-head">Розташування</div>
                <div class="icon-arrow"></div>
            </div>
            <div class="items">
                <input class="checked-items" type="checkbox" name="Golosiivskyi district" value="Golosiivskyi district">

                <label for="checkbox">Голосіївський район</label>
            </div>

            <div class="items">
                <input class="checked-items" type="checkbox" name="Obolonsky district" value="Obolonsky district">

                <label for="checkbox">Оболонський район</label>
            </div>

            <div class="items">
                <input class="checked-items" type="checkbox" name="Pechersky district" value="Pechersky district">

                <label for="checkbox">Печерський район</label>
            </div>

            <div class="items">
                <input class="checked-items" type="checkbox" name="Podilsky district" value="Podilsky district">

                <label for="checkbox">Подільський район</label>
            </div>

            <div class="items">
                <input class="checked-items" type="checkbox" name="Svyatoshinsky district"
                       value="Svyatoshinsky district">

                <label for="checkbox">Святошинський район</label>
            </div>

            <div class="items">
                <input class="checked-items" type="checkbox" name="Solomyan district" value="Solomyan district">

                <label for="checkbox">Солом'янський район</label>
            </div>

            <div class="items">
                <input class="checked-items" type="checkbox" name="Shevchenko district" value="Shevchenko district">

                <label for="checkbox">Шевченківський район</label>
            </div>

            <div class="items">
                <input class="checked-items" type="checkbox" name="Darnytskyi District" value="Darnytskyi District">

                <label for="checkbox">Дарницький район</label>
            </div>

            <div class="items">
                <input class="checked-items" type="checkbox" name="Dnipro area" value="Dnipro area">

                <label for="checkbox">Дніпровський район</label>
            </div>

            <div class="items">
                <input class="checked-items" type="checkbox" name="Desnianskyi area" value="Desnianskyi area">

                <label for="checkbox">Деснянський район</label>
            </div>

        </div>

        <div class="count-place">
            <div class="title">
                <div class="title-head">Кількість спальних місць</div>
                <div class="icon-arrow"></div>
            </div>
            <div class="items">
                <input class="checked-items" type="checkbox" name="one-room" value="one-room">

                <label for="checkbox">1 кіманата</label>
            </div>

            <div class="items">
                <input class="checked-items" type="checkbox" name="two-room" value="two-room">

                <label for="checkbox">2 кімнати</label>
            </div>

            <div class="items">
                <input class="checked-items" type="checkbox" name="three-room" value="three-room">

                <label for="checkbox">3 кімнати</label>
            </div>

            <div class="items">
                <input class="checked-items" type="checkbox" name="four-room" value="four-room">

                <label for="checkbox">4 кімнати</label>
            </div>

            <div class="items">
                <input class="checked-items" type="checkbox" name="five-room" value="five-room">

                <label for="checkbox">5 кімнат</label>
            </div>

        </div>
    </div>

    <div class="main">
        <h1>Квартири</h1>
        <div class="searching-panel">
            <div class="choosed">1 кімната <a href="#">
                    <div class="close"></div>
                </a></div>
            <a href="#">
                <div class="clear-search">Скинути</div>
            </a>
        </div>
        <hr/>

        <div class="row">
            <?php
            for ($i = 0; $i < 8; $i++) {
                $items[0]->ToHtml();
            }
            ?>
        </div>


    </div>

    <div class="new-houses">
        <span>Найновітніші житлові комплекси Києва</span>
        <div class="building">
            <img src="../images/bud1.png"/>
            <div class="discription-build">ЖК «Сучасник» <br/>р-н Солом’янський,<br/> вул. Борщагівська 7</div>
            <div class="down-building">
                <div class="count-building">від 16000 грн</div>
                <div class="more-info"><a href="#">Подробніше --></a></div>
            </div>
        </div>
        <div class="building">
            <img src="../images/bud2.png"/>
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

<?php
include_once("Shared/footer.php");
?>


</body>

</html>