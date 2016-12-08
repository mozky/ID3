document.getElementById("crearReglas").addEventListener("click", crearReglas);

function crear_reglas(arbol, regla){
  if (arbol.childs.length == 0) {
    var newRegla = regla.concat("THEN 'DECISION' = " + arbol.answer + ";,");
    console.log(newRegla);
    reglas = reglas.concat(newRegla);
  } else {
    arbol.childs.forEach(function(item){
      if (arbol.top && arbol.top == true) {
        // console.log("IF ( " + arbol.root + " = " + item.atributo + " ) " + crear_reglas(item));
        var newRegla = regla.concat("IF ( " + arbol.root + " = " + item.atributo + " ) ");
        crear_reglas(item, newRegla);
      } else {
        // console.log("AND ( " + arbol.root + " = " + item.atributo + " ) " + crear_reglas(item));
        var newRegla = regla.concat("AND ( " + arbol.root + " = " + item.atributo + " ) ");
        crear_reglas(item, newRegla);
      }
    })
  }
}

function crearReglas() {
  crear_reglas(window.arbol, "");
  alert(reglas.replace(/,/g, "\n"));
}

window.reglas = "";
