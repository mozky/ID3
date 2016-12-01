document.getElementById("crearReglas").addEventListener("click", demoCrearReglas);

function crear_reglas(arbol, regla){
  if (arbol.childs.length == 0) {
    var newRegla = regla.concat("THEN " + arbol.class + " = " + arbol.value + ";,");
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

function demoCrearReglas() {
  var arbolClima = {
    "top": true,
    "root":"general",
    "childs":[
      {
        "atributo":"asoleado",
        "entropia":0.970950594455,
        "childs":[
          {
            "atributo":"no",
            "entropia":0.811278124459,
            "childs":[],
            "class": "play",
            "value": true
          },
          {
            "atributo":"si",
            "entropia":1,
            "childs":[],
            "class": "play",
            "value": false
          }
        ],
        "root":"viento"
      },
      {
        "atributo":"nublado",
        "entropia":0,
        "childs":[],
        "class": "play",
        "value": true
      },
      {
        "atributo":"lluvioso",
        "entropia":0.970950594455,
        "childs":[
          {
            "atributo":"alta",
            "entropia":0.985228136034,
            "childs":[],
            "class": "play",
            "value": false
          },
          {
            "atributo":"normal",
            "entropia":0.591672778582,
            "childs":[],
            "class": "play",
            "value": true
          }
        ],
        "root":"humedad"
      }
    ]
  }

  crear_reglas(arbolClima, "");
  alert(reglas.replace(/,/g, "\n"));
}

window.reglas = "";
