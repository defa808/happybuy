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
if(isset($apartment)){
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

                    <div class="opt_header">Кімната</div>
                    <div class="opt_value"><strong>17.2 м<sup>2</sup></strong></div>
                </div>
                <div class="item">

                    <div class="opt_header">Кухня</div>
                    <div class="opt_value"><strong><?= $apartment->areaKitchen ?> м<sup>2</sup></strong></div>
                </div>

                <div class="item">
                    <div class="opt_header">Ванна кімната</div>
                    <div class="opt_value"><strong>4.16 м<sup>2</sup></strong></div>
                </div>

                <div class="item">
                    <div class="opt_header">Коридор</div>
                    <div class="opt_value"><strong>4.05 м<sup>2</sup></strong></div>
                </div>

            </div>

            <div class="bud_count" href="#">від <span><?= $apartment->price ?></span> грн</div>
            <button>УТОЧНИТИ ВАРТІСТЬ</button>
        </div>


    </div>


    <div class="main">
        <h1><strong>Квартири в Києві</strong></h1>
        <h2>Однокімнатна</h2>
        <div class="container">
            <div class="next-switch-room"><img src="../../images/img-next.png" alt="Previous Room"/></div>
            <div class="bud-images">
                <div class="bud-col">
                    <img src="../../images/img-sm-1.png" alt="Кухня"/>
                    <img src="../../images/img-sm-2.png" alt="Гостиниця"/>
                    <img src="../../images/img-sm-1.png" alt="Гостиниця"/>
                </div>
                <div class="bud-col">
                    <img src="../../images/img-lg-1.png" alt="Планування"/>
                </div>
                <div class="bud-col">
                    <img src="../../images/img-sm-1.png" alt="Гостиниця"/>
                    <img src="../../images/img-sm-2.png" alt="Кухня"/>

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
<?php }
else{
    echo "<h2>Something go wrong!</h2>";
    echo $message;
}

?>
