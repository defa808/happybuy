function openMenu() {

    var menu = document.getElementById("menu-mobile");
    var ulList = document.getElementById("ullistmenu");
    var language = document.getElementById("language");


    menu.style.animation = '';
    ulList.style.animation = "";
    language.style.animation = "";


    var height = menu.clientHeight;

    if (height < 231) {
        menu.style.animation = "open_menu";
        menu.style.animationDuration = "1s";
        menu.style.height = "231px";

        setTimeout(function () {
            ulList.style.height = "134px";
            ulList.style.display = "flex";
            ulList.style.animation = "show_menu";
            ulList.style.animationDuration = "3s";
            ulList.style.flexDirection = "column";
            ulList.style.justifyContent = "space-around";
            ulList.style.alignItems = "center";
            language.style.display = "block";
            language.style.animation = "show_menu";
            language.style.animationDuration = "3s";
        }, 500)
        

    }
    if(height >= 231) {
        ulList.style.animation = "show_menu";
        ulList.style.animationDirection = "reverse";
        ulList.style.animationDuration = "1s";
        language.style.animation = "show_menu";
        language.style.animationDirection = "reverse";
        language.style.animationDuration = "1s";

        setTimeout(function () {
            ulList.style.display = "none";
            language.style.display = "none";

        }, 1000);
        setTimeout(function () {
            menu.style.animation = "open_menu";
            menu.style.animationDirection = "reverse";
            menu.style.animationDuration = "1s";
            menu.style.height = "43px";
        }, 1000);

       
    }

    menu.onclick("openMenu()");

}