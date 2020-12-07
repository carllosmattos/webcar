var coll = document.getElementsByClassName("collapsible");
var coll1 = document.getElementById("coll-01");
var coll2 = document.getElementById("coll-02");
var icoCollapse1 = document.getElementById("icon-collapse-1");
var icoCollapse2 = document.getElementById("icon-collapse-2");
var i;
saveVal = document.getElementById("carId").value;

// Função para exibir e esconder parte do formulário
coll1.addEventListener("click", function () {
    var content = this.nextElementSibling;
    if (content.style.display === "block") {
        content.style.display = "none";
        icoCollapse1.innerHTML = '<i class="ls-ico-circle-down ls-ico-right"></i>';

    } else {
        this.classList.toggle("active");
        content.style.display = "block";
        icoCollapse1.innerHTML = '<i class="ls-ico-circle-up ls-ico-right"></i>';

    }

});

coll2.addEventListener("click", function () {
    var content = this.nextElementSibling;
    if (content.style.display === "none") {
        content.style.display = "block";
        this.classList.toggle("active");
        icoCollapse2.innerHTML = '<i class="ls-ico-circle-up ls-ico-right"></i>';
    } else {
        content.style.display = "none";
        icoCollapse2.innerHTML = '<i class="ls-ico-circle-down ls-ico-right"></i>';
    }

});

function controlSts(value) {
    var sts_realizada = document.getElementById("sts_realizada")
    var sts_nao_realizada = document.getElementById("sts_nao_realizada")
    var sts_km = document.getElementById("mileage")
    var labelUnauthorized = document.getElementById("labelUnauthorized");
    if (value != saveVal) {
        sts_realizada.style.display = "none";
        sts_nao_realizada.style.display = "none";
        sts_km.style.display = "none";
        labelUnauthorized.style.display = "block";
    } else {
        sts_realizada.style.display = "block";
        sts_nao_realizada.style.display = "block";
        sts_km.style.display = "block";
        labelUnauthorized.style.display = "none";
    }
}