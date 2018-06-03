<!--    <script src="../../Scripts/MainAnimation.js"></script>-->
<!--    <link rel="stylesheet" href="../../Content/main.css">-->
<!--    <link rel="stylesheet" href="../font-awesome/css/font-awesome.min.css">-->
<!--    <link href="../../Content/media.css" rel="stylesheet"/>-->
<!--    <link href="../../Content/grid.css" rel="stylesheet"/>-->
<!--    <link href="../../Content/media-for-bud.css" rel="stylesheet"/>-->

<meta charset="utf-8"/>
<meta name="description"
      content="Квартира дешево в Києві. Найновітніший район з дитячим майданчиком. Теплий будинок за новітнішими технологіями. "/>
<meta name="keywords"
      content="Квартири Київ, Квартири подобово, Київ квартири подобово, Квартира посуточно,Киев квартира посуточно, Квартира киев купить,Киев кварира снять ,Квартира Киев,Квартира в киеве,Квартира аренда киев,Купить квартиру киев,Снять квартиру киев,Однокомнатная квартира,Однокомнатная квартира киев,Квартира поусточно киев,Квартира в киеве купить,Олх квартира киев,Квартира без посредников киев,Квартира долгосрочно киев,Аренда квартир киев,Сландо киев,Киев квартира на сутки"/>
<meta http-equiv="content-language"/>

<link href="../../Content/buyhome.css" rel="stylesheet"/>

<?php
if (isset($apartment)) {

    ?>
    <main>
        <div class="options">
            <div class="all-home"><a href="main"> <img src="../../images/bud_arrow-left.png"/> Всі квартири </a></div>

            <div class="container">
                <div class="items">
                    <div class="item">
                        <div class="opt_header">Загальна площа</div>
                        <div class="opt_value"><strong><?= $apartment->areaGeneral ?> м<sup>2</sup></strong></div>
                    </div>
                    <div class="item">
                        <div class="opt_header">Житлова площа</div>
                        <div class="opt_value"><strong><?= $apartment->areaLiving ?> м<sup>2</sup></strong></div>
                    </div>
                    <div class="item">

                        <div class="opt_header">Кухня</div>
                        <div class="opt_value"><strong><?= $apartment->areaKitchen ?> м<sup>2</sup></strong></div>
                    </div>

                    <div class="item">
                        <div class="opt_header">Станція метро</div>
                        <div class="opt_value"><b><?= $apartment->metro ?></b></div>
                    </div>
                    <div class="item">
                        <div class="opt_header">Кількість кімнат</div>
                        <div class="opt_value"><b><?= $apartment->room ?></b></div>
                    </div>

                    <div class="item">
                        <div class="opt_header">Район</div>
                        <div class="opt_value"><b><?= $apartment->areaLocation ?></b></div>
                    </div>

                </div>

                <div class="bud_count" href="#">від <span><?= $apartment->price * $apartment->areaGeneral ?></span> грн
                </div>
                <button>УТОЧНИТИ ВАРТІСТЬ</button>
            </div>


        </div>


        <div class="main">
            <h1><strong>Квартири в Києві</strong></h1>
            <h2><?= $apartment->room ?></h2>
            <div class="container">
                <div class="next-switch-room"><img src="../../images/img-next.png" alt="Previous Room"/></div>
                <div class="bud-images">
                    <div class="bud-col smallImages">
                        <?php
                        $i = 0;
                        foreach ($apartmentImages as $image) {

                            $image->ToHTML();

                            $i++;
                            if ($i % 4 == 0 )
                                echo "</div><div class=\"bud-col smallImages\">";
                            if($i % 3 == 0)
                                echo "</div><div class=\"bud-col bigImages\">";


                        } ?>
                        <div class="more-photo"><a href="#">Більше фото</a></div>
                    </div>

                </div>
                <div class="dop-info">
                    <div><img src="../../images/bud-location.png" alt="mark"/> Доступна в будинках</div>
                    <div><img src="../../images/bud-adobe.png" alt="png"/> Планування квартири</div>

                </div>
                <div class="next-switch-room"><img src="../../images/img-next-reverse.png" alt="Next Room"/></div>

            </div>

        </div>
    </main>
<?php } else {
    echo "<h2>Something go wrong!</h2>";
    echo $message;
}

?>
