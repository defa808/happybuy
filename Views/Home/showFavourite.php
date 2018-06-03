<?php
/**
 * Created by PhpStorm.
 * User: alexg
 * Date: 28.05.2018
 * Time: 23:23
 */
?>
<link href="../Content/bootstrap.css" rel="stylesheet"/>

<main class="favouriteMain">

    <div class="main">
        <h1>Обрані</h1>

        <hr/>

        <div class="row" id="apartments">
            <?php
            foreach ($apartments as $f) {
                $f->ToHtmlWithButton();
                echo "";
            }

            ?>


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

<!--Script Area-->
<script>
    function removeFromFavourite(id) {
        $.ajax({
            type: 'GET',
            url: '/removeFavourite',
            data: "Id=" + id,
            success: function (data, textstatus) {
                location.reload();
            }
        });

    }
</script>
