function verifica(value) {
  var input = document.getElementById("editsituacao");
  var slt = document.getElementById("editsit");

  if(value == "LIVRE"){
    slt.style.backgroundColor = "green";
    slt.style.fontWeight = "bold";
    slt.style.color = "#fff";

  }else if(value == "EM USO"){
    slt.style.backgroundColor = "blue";
    slt.style.fontWeight = "bold";
    slt.style.color = "#fff";

  }else if(value == "MANUTENÇÃO"){
    slt.style.backgroundColor = "red";
    slt.style.fontWeight = "bold";
    slt.style.color = "#fff";

  }else{
    slt.style.backgroundColor = "#fff";
    slt.style.fontWeight = "bold";
    slt.style.color = "#fff";
  }

}