var input;
var slt;
var mileage;

function verifica(value) {
  input = document.getElementById("situacao");
  slt = document.getElementById("sit");
  mileage = document.getElementById("mileage");

  if ((value == "LIVRE") || (value == "AUTORIZADA")) {
    slt.style.backgroundColor = "green";
    slt.style.fontWeight = "bold";
    slt.style.color = "#fff";
    mileage.style.display = "none";

  } else if ((value == "EM USO") || (value == "NÃO REALIZADA")) {
    slt.style.backgroundColor = "blue";
    slt.style.fontWeight = "bold";
    slt.style.color = "#fff";
    mileage.style.display = "none";

  } else if ((value == "MANUTENÇÃO") || (value == "PENDENTE")) {
    slt.style.backgroundColor = "red";
    slt.style.fontWeight = "bold";
    slt.style.color = "#fff";
    mileage.style.display = "none";

  } else if((value == "REALIZADA")) {
    slt.style.backgroundColor = "MediumAquamarine";
    slt.style.fontWeight = "bold";
    slt.style.color = "#fff";
    mileage.style.display = "block";
  } else {
    slt.style.backgroundColor = "#fff";
    slt.style.fontWeight = "bold";
    slt.style.color = "#fff";
    mileage.style.display = "none";
  }

}