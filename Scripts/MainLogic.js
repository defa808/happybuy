window.onload = function () {
    var forms = document.getElementsByClassName("form_favourite");
    var checkers = document.getElementsByClassName("favourite");
    for (var i = 0; i < checkers.length; i++) {
        checkers[i].onclick = function () {
            if (this.classList.contains("active")) {
                this.innerHTML = '<i class="far fa-star" ></i>'
                this.classList.remove("active");
            } else {
                this.innerHTML = '<i class="fas fa-star" ></i>'
                this.classList.add("active");
            }

        }

    }

}

