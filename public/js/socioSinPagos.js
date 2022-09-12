function cambiarMonto(valor) {
    //var meses = document.getElementById('meses');
    var monto = document.getElementById("monto");

    if (valor === "1") {
        monto.value = 20;
    }
    if (valor === "2") {
        monto.value = 40;
    }
    if (valor === "3") {
        monto.value = "60";
    }
    if (valor === "4") {
        monto.value = "80";
    }
    if (valor === "5") {
        monto.value = "100";
    }
    if (valor === "6") {
        monto.value = "120";
    }
    if (valor === "7") {
        monto.value = "140";
    }
    if (valor === "8") {
        monto.value = "160";
    }
    if (valor === "9") {
        monto.value = "180";
    }
    if (valor === "10") {
        monto.value = "200";
    }
    if (valor === "11") {
        monto.value = "220";
    }
    if (valor === "12") {
        monto.value = "240";
    }

    var ultimoMes = document.getElementById("ultimo").value;
    var mesesPagar = document.getElementById("mesesPagar");
    var vector = [];
    var numero = Number(valor);
    var currentTime = new Date();
    var year = currentTime.getFullYear();
    var añosgte = year + 1;

    if (ultimoMes === "Enero "+year) {
        numero = Number(valor);
        var totalMeses = numero + 1;

        if (totalMeses === 2) {
            mesesPagar.value = "Febrero";
            vector.push("Febrero-"+year);
        }

        if (totalMeses === 3) {
            mesesPagar.value = "Febrero, Marzo";
            vector.push("Febrero-"+year, "Marzo-"+year);
        }

        if (totalMeses === 4) {
            mesesPagar.value = "Febrero, Marzo, Abril";
            vector.push("Febrero-"+year, "Marzo-"+year, "Abril-"+year);
        }

        if (totalMeses === 5) {
            mesesPagar.value = "Febrero, Marzo, Abril,Mayo";
            vector.push("Febrero-"+year, "Marzo-"+year, "Abril-"+year, "Mayo-"+year);
        }

        if (totalMeses === 6) {
            mesesPagar.value = "Febrero, Marzo, Abril,Mayo,Junio";
            vector.push("Febrero-"+year, "Marzo-"+year, "Abril-"+year, "Mayo-"+year, "Junio-"+year);
        }

        if (totalMeses === 7) {
            mesesPagar.value = "Febrero, Marzo, Abril, Mayo, Junio, Julio";
            vector.push("Febrero-"+year, "Marzo-"+year, "Abril-"+year, "Mayo-"+year, "Junio-"+year, "Julio-"+year);
        }

        if (totalMeses === 8) {
            mesesPagar.value =
                "Febrero, Marzo, Abril, Mayo, Junio, Julio, Agosto";
            vector.push(
                "Febrero-"+year,
                "Marzo-"+year,
                "Abril-"+year,
                "Mayo-"+year,
                "Junio-"+year,
                "Julio-"+year,
                "Agosto-"+year
            );
        }

        if (totalMeses === 9) {
            mesesPagar.value =
                "Febrero, Marzo, Abril, Mayo, Junio, Julio, Agosto, Setiembre";
            vector.push(
                "Febrero-"+year,
                "Marzo-"+year,
                "Abril-"+year,
                "Mayo-"+year,
                "Junio-"+year,
                "Julio-"+year,
                "Agosto-"+year,
                "Setiembre-"+year
            );
        }

        if (totalMeses === 10) {
            mesesPagar.value =
                "Febrero, Marzo, Abril, Mayo, Junio, Julio, Agosto, Setiembre, Octubre";
            vector.push(
                "Febrero-"+year,
                "Marzo-"+year,
                "Abril-"+year,
                "Mayo-"+year,
                "Junio-"+year,
                "Julio-"+year,
                "Agosto-"+year,
                "Setiembre-"+year,
                "Octubre-"+year
            );
        }

        if (totalMeses === 11) {
            mesesPagar.value =
                "Febrero, Marzo, Abril, Mayo, Junio, Julio, Agosto, Setiembre, Octubre, Noviembre";
            vector.push(
                "Febrero-"+year,
                "Marzo-"+year,
                "Abril-"+year,
                "Mayo-"+year,
                "Junio-"+year,
                "Julio-"+year,
                "Agosto-"+year,
                "Setiembre-"+year,
                "Octubre-"+year,
                "Noviembre-"+year
            );
        }
        if (totalMeses === 12) {
            mesesPagar.value =
                "Febrero, Marzo, Abril, Mayo, Junio, Julio, Agosto, Setiembre, Octubre, Noviembre, Diciembre";
            vector.push(
                "Febrero-"+year,
                "Marzo-"+year,
                "Abril-"+year,
                "Mayo-"+year,
                "Junio-"+year,
                "Julio-"+year,
                "Agosto-"+year,
                "Setiembre-"+year,
                "Octubre-"+year,
                "Noviembre-"+year,
                "Diciembre-"+year
            );
        }
    }

    if (ultimoMes === "Febrero "+year) {
        numero = Number(valor);
        var totalMeses = numero + 1;

        if (totalMeses === 2) {
            mesesPagar.value = "Marzo";
            vector.push("Marzo-"+year);
        }

        if (totalMeses === 3) {
            mesesPagar.value = "Marzo, Abril";
            vector.push("Marzo-"+year, "Abril-"+year);
        }

        if (totalMeses === 4) {
            mesesPagar.value = "Marzo, Abril, Mayo";
            vector.push("Marzo-"+year, "Abril-"+year, "Mayo-"+year);
        }

        if (totalMeses === 5) {
            mesesPagar.value = "Marzo, Abril,Mayo, Junio";
            vector.push("Marzo-"+year, "Abril-"+year, "Mayo-"+year, "Junio-"+year);
        }

        if (totalMeses === 6) {
            mesesPagar.value = "Marzo, Abril,mayo,junio, Julio";
            vector.push("Marzo-"+year, "Abril-"+year, "Mayo-"+year, "Junio-"+year, "Julio-"+year);
        }

        if (totalMeses === 7) {
            mesesPagar.value = "Marzo, Abril, Mayo, Junio, Julio, Agosto";
            vector.push("Marzo-"+year, "Abril-"+year, "Mayo-"+year, "Junio-"+year, "Julio-"+year, "Agosto-"+year);
        }

        if (totalMeses === 8) {
            mesesPagar.value =
                " Marzo, Abril, Mayo, Junio, Julio, Agosto, Setiembre";
            vector.push(
                "Marzo-"+year,
                "Abril-"+year,
                "Mayo-"+year,
                "Junio-"+year,
                "Julio-"+year,
                "Agosto-"+year,
                "Setiembre-"+year
            );
        }

        if (totalMeses === 9) {
            mesesPagar.value =
                "Marzo, Abril, Mayo, Junio, Julio, Agosto, Setiembre, Octubre";
            vector.push(
                "Marzo-"+year,
                "Abril-"+year,
                "Mayo-"+year,
                "Junio-"+year,
                "Julio-"+year,
                "Agosto-"+year,
                "Setiembre-"+year,
                "Octubre-"+year
            );
        }

        if (totalMeses === 10) {
            mesesPagar.value =
                "Marzo, Abril, Mayo, Junio, Julio, Agosto, Setiembre, Octubre, Noviembre";
            vector.push(
                "Marzo-"+year,
                "Abril-"+year,
                "Mayo-"+year,
                "Junio-"+year,
                "Julio-"+year,
                "Agosto-"+year,
                "Setiembre-"+year,
                "Octubre-"+year,
                "Noviembre-"+year
            );
        }

        if (totalMeses === 11) {
            mesesPagar.value =
                " Marzo, Abril, Mayo, Junio, Julio, Agosto, Setiembre, Octubre, Noviembre,Diciembre";
            vector.push(
                "Marzo-"+year,
                "Abril-"+year,
                "Mayo-"+year,
                "Junio-"+year,
                "Julio-"+year,
                "Agosto-"+year,
                "Setiembre-"+year,
                "Octubre-"+year,
                "Noviembre-"+year,
                "Diciembre-"+year
            );
        }
    }

    if (ultimoMes === "Marzo "+year) {
        numero = Number(valor);
        var totalMeses = numero + 1;

        if (totalMeses === 2) {
            mesesPagar.value = "Abril";
            vector.push("Abril-"+year);
        }

        if (totalMeses === 3) {
            mesesPagar.value = "Abril, Mayo";
            vector.push("Abril-"+year, "Mayo-"+year);
        }

        if (totalMeses === 4) {
            mesesPagar.value = "Abril, Mayo, Junio";
            vector.push("Abril-"+year, "Mayo-"+year, "Junio-"+year);
        }

        if (totalMeses === 5) {
            mesesPagar.value = "Abril, Mayo, Junio, Julio";
            vector.push("Abril-"+year, "Mayo-"+year, "Junio-"+year, "Julio-"+year);
        }

        if (totalMeses === 6) {
            mesesPagar.value = "Abril, Mayo, Junio, Julio, Agosto";
            vector.push("Abril-"+year, "Mayo-"+year, "Junio-"+year, "Julio-"+year, "Agosto-"+year);
        }

        if (totalMeses === 7) {
            mesesPagar.value = "Abril, Mayo, Junio, Julio, Agosto, Setiembre";
            vector.push(
                "Abril-"+year,
                "Mayo-"+year,
                "Junio-"+year,
                "Julio-"+year,
                "Agosto-"+year,
                "Setiembre-"+year
            );
        }

        if (totalMeses === 8) {
            mesesPagar.value =
                "Abril, Mayo, Junio, Julio, Agosto, Setiembre, Octubre";
            vector.push(
                "Abril-"+year,
                "Mayo-"+year,
                "Junio-"+year,
                "Julio-"+year,
                "Agosto-"+year,
                "Setiembre-"+year,
                "Octubre-"+year
            );
        }

        if (totalMeses === 9) {
            mesesPagar.value =
                "Abril, Mayo, Junio, Julio, Agosto, Setiembre, Octubre, Noviembre";
            vector.push(
                "Abril-"+year,
                "Mayo-"+year,
                "Junio-"+year,
                "Julio-"+year,
                "Agosto-"+year,
                "Setiembre-"+year,
                "Octubre-"+year,
                "Noviembre-"+year
            );
        }

        if (totalMeses === 10) {
            mesesPagar.value =
                "Abril, Mayo, Junio, Julio, Agosto, Setiembre, Octubre, Noviembre, Diciembre";
            vector.push(
                "Abril-"+year,
                "Mayo-"+year,
                "Junio-"+year,
                "Julio-"+year,
                "Agosto-"+year,
                "Setiembre-"+year,
                "Octubre-"+year,
                "Noviembre-"+year,
                "Diciembre-"+year
            );
        }
    }

    if (ultimoMes === "Abril "+year) {
        numero = Number(valor);
        var totalMeses = numero + 1;

        if (totalMeses === 2) {
            mesesPagar.value = "Mayo";
            vector.push("Mayo-"+year);
        }

        if (totalMeses === 3) {
            mesesPagar.value = "Mayo, Junio";
            vector.push("Mayo-"+year, "Junio-"+year);
        }

        if (totalMeses === 4) {
            mesesPagar.value = "Mayo, Junio, Julio";
            vector.push("Mayo-"+year, "Junio-"+year, "Julio-"+year);
        }

        if (totalMeses === 5) {
            mesesPagar.value = "Mayo, Junio, Julio, Agosto";
            vector.push("Mayo-"+year, "Junio-"+year, "Julio-"+year, "Agosto-"+year);
        }

        if (totalMeses === 6) {
            mesesPagar.value = "Mayo, Junio, Julio, Agosto, Setiembre";
            vector.push("Mayo-"+year, "Junio-"+year, "Julio-"+year, "Agosto-"+year, "Setiembre-"+year);
        }

        if (totalMeses === 7) {
            mesesPagar.value = "Mayo, Junio, Julio, Agosto, Setiembre, Octubre";
            vector.push(
                "Mayo-"+year,
                "Junio-"+year,
                "Julio-"+year,
                "Agosto-"+year,
                "Setiembre-"+year,
                "Octubre-"+year
            );
        }

        if (totalMeses === 8) {
            mesesPagar.value =
                "Mayo, Junio, Julio, Agosto, Setiembre, Octubre, Noviembre";
            vector.push(
                "Mayo-"+year,
                "Junio-"+year,
                "Julio-"+year,
                "Agosto-"+year,
                "Setiembre-"+year,
                "Octubre-"+year,
                "Noviembre-"+year
            );
        }

        if (totalMeses === 9) {
            mesesPagar.value =
                "Mayo, Junio, Julio, Agosto, Setiembre, Octubre, Noviembre, Diciembre";
            vector.push(
                "Mayo-"+year,
                "Junio-"+year,
                "Julio-"+year,
                "Agosto-"+year,
                "Setiembre-"+year,
                "Octubre-"+year,
                "Noviembre-"+year,
                "Diciembre-"+year
            );
        }
    }

    if (ultimoMes === "Mayo "+year) {
        numero = Number(valor);
        var totalMeses = numero + 1;

        if (totalMeses === 2) {
            mesesPagar.value = "Junio";
            vector.push("Junio-"+year);
        }

        if (totalMeses === 3) {
            mesesPagar.value = "Junio, Julio";
            vector.push("Junio-"+year, "Julio-"+year);
        }

        if (totalMeses === 4) {
            mesesPagar.value = "Junio, Julio, Agosto";
            vector.push("Junio-"+year, "Julio-"+year, "Agosto-"+year);
        }

        if (totalMeses === 5) {
            mesesPagar.value = "Junio, Julio, Agosto, Setiembre";
            vector.push("Junio-"+year, "Julio-"+year, "Agosto-"+year, "Setiembre-"+year);
        }
        if (totalMeses === 6) {
            mesesPagar.value = "Junio, Julio, Agosto, Setiembre, Octubre";
            vector.push("Junio-"+year, "Julio-"+year, "Agosto-"+year, "Setiembre-"+year, "Octubre-"+year);
        }

        if (totalMeses === 7) {
            mesesPagar.value =
                "Junio, Julio, Agosto, Setiembre, Octubre, Noviembre";
            vector.push(
                "Junio-"+year,
                "Julio-"+year,
                "Agosto-"+year,
                "Setiembre-"+year,
                "Octubre-"+year,
                "Noviembre-"+year
            );
        }

        if (totalMeses === 8) {
            mesesPagar.value =
                "Junio, Julio, Agosto, Setiembre, Octubre, Noviembre, Diciembre";
            vector.push(
                "Junio-"+year,
                "Julio-"+year,
                "Agosto-"+year,
                "Setiembre-"+year,
                "Octubre-"+year,
                "Noviembre-"+year,
                "Diciembre-"+year
            );
        }
    }

    if (ultimoMes === "Junio "+year) {
        numero = Number(valor);
        var totalMeses = numero + 1;

        if (totalMeses === 2) {
            mesesPagar.value = "Julio";
            vector.push("Julio-"+year);
        }

        if (totalMeses === 3) {
            mesesPagar.value = "Julio, Agosto";
            vector.push("Julio-"+year, "Agosto-"+year);
        }

        if (totalMeses === 4) {
            mesesPagar.value = "Julio, Agosto, Setiembre";
            vector.push("Julio-"+year, "Agosto-"+year, "Setiembre-"+year);
        }

        if (totalMeses === 5) {
            mesesPagar.value = "Julio, Agosto, Setiembre, Octubre";
            vector.push("Julio-"+year, "Agosto-"+year, "Setiembre-"+year, "Octubre-"+year);
        }

        if (totalMeses === 6) {
            mesesPagar.value = "Julio, Agosto, Setiembre, Octubre, Noviembre";
            vector.push("Julio-"+year, "Agosto-"+year, "Setiembre-"+year, "Octubre-"+year, "Noviembre-"+year);
        }

        if (totalMeses === 7) {
            mesesPagar.value =
                "Julio, Agosto, Setiembre, Octubre, Noviembre, Diciembre";
            vector.push(
                "Julio-"+year,
                "Agosto-"+year,
                "Setiembre-"+year,
                "Octubre-"+year,
                "Noviembre-"+year,
                "Diciembre-"+year
            );
        }
    }

    if (ultimoMes === "Julio "+year) {
        numero = Number(valor);
        var totalMeses = numero + 1;

        if (totalMeses === 2) {
            mesesPagar.value = "Agosto";
            vector.push("Agosto-"+year);
        }

        if (totalMeses === 3) {
            mesesPagar.value = "Agosto, Setiembre";
            vector.push("Agosto-"+year, "Setiembre-"+year);
        }

        if (totalMeses === 4) {
            mesesPagar.value = "Agosto, Setiembre, Octubre";
            vector.push("Agosto-"+year, "Setiembre-"+year, "Octubre-"+year);
        }

        if (totalMeses === 5) {
            mesesPagar.value = "Agosto, Setiembre, Octubre, Noviembre";
            vector.push("Agosto-"+year, "Setiembre-"+year, "Octubre-"+year, "Noviembre-"+year);
        }

        if (totalMeses === 6) {
            mesesPagar.value =
                "Agosto, Setiembre, Octubre, Noviembre, Diciembre";
            vector.push(
                "Agosto-"+year,
                "Setiembre-"+year,
                "Octubre-"+year,
                "Noviembre-"+year,
                "Diciembre-"+year
            );
        }
        if (totalMeses === 6) {
            mesesPagar.value =
                "Agosto, Setiembre, Octubre, Noviembre, Diciembre, Enero";
            vector.push(
                "Agosto-"+year,
                "Setiembre-"+year,
                "Octubre-"+year,
                "Noviembre-"+year,
                "Diciembre-"+year,
                "Enero-"+year
            );
        }
    }
    if (ultimoMes === "Agosto " + year) {
        numero = Number(valor);
        var totalMeses = numero + 1;

        if (totalMeses === 2) {
            mesesPagar.value = "Setiembre";
            vector.push("Setiembre-" + year);
        }

        if (totalMeses === 3) {
            mesesPagar.value = "Setiembre, Octubre";
            vector.push("Setiembre-" + year, "Octubre-" + year);
        }

        if (totalMeses === 4) {
            mesesPagar.value = "Setiembre, Octubre, Noviembre";
            vector.push(
                "Setiembre-" + year,
                "Octubre-" + year,
                "Noviembre-" + year
            );
        }

        if (totalMeses === 5) {
            mesesPagar.value = "Setiembre, Octubre, Noviembre, Diciembre";
            vector.push(
                "Setiembre-" + year,
                "Octubre-" + year,
                "Noviembre-" + year,
                "Diciembre-" + year
            );
        }
        if (totalMeses === 6) {
            mesesPagar.value =
                "Setiembre, Octubre, Noviembre, Diciembre, Enero";
            vector.push(
                "Setiembre-" + year,
                "Octubre-" + year,
                "Noviembre-" + year,
                "Diciembre-" + year,
                "Enero-" + añosgte
            );
        }
        if (totalMeses === 7) {
            mesesPagar.value =
                "Setiembre, Octubre, Noviembre, Diciembre, Enero, Febrero";
            vector.push(
                "Setiembre-"+year,
                "Octubre-"+year,
                "Noviembre-",+year,
                "Diciembre-"+year,
                "Enero-"+year,
                "Febrero-"+year,
            );
        }
    }

    if (ultimoMes === "Seitiembre "+year) {
        numero = Number(valor);
        var totalMeses = numero + 1;

        if (totalMeses === 2) {
            mesesPagar.value = "Octubre";
            vector.push("Octubre-"+year);
        }

        if (totalMeses === 3) {
            mesesPagar.value = "Octubre, Noviembre";
            vector.push("Octubre-"+year, "Noviembre-"+year);
        }

        if (totalMeses === 4) {
            mesesPagar.value = "Octubre, Noviembre, Diciembre";
            vector.push("Octubre-"+year, "Noviembre-"+year, "Diciembre-"+year);
        }

        if (totalMeses === 4) {
            mesesPagar.value = "Octubre, Noviembre, Diciembre, Enero";
            vector.push("Octubre-"+year, "Noviembre-"+year, "Diciembre-"+year, "Enero-"+añosgte);
        }
        if (totalMeses === 5) {
            mesesPagar.value = "Octubre, Noviembre, Diciembre, Enero, Febrero";
            vector.push(
                "Octubre-"+year,
                "Noviembre-"+year,
                "Diciembre-"+year,
                "Enero-"+añosgte,
                "Febrero-"+añosgte
            );
        }

        if (totalMeses === 6) {
            mesesPagar.value =
                "Octubre, Noviembre, Diciembre, Enero, Febrero, Marzo";
            vector.push(
                "Octubre-"+year,
                "Noviembre-"+year,
                "Diciembre-"+year,
                "Enero-"+añosgte,
                "Febrero-"+añosgte,
                "Marzo-"+añosgte
            );
        }
    }

    if (ultimoMes === "Octubre "+year) {
        numero = Number(valor);
        var totalMeses = numero + 1;

        if (totalMeses === 2) {
            mesesPagar.value = "Noviembre";
            vector.push("Noviembre-"+year);
        }

        if (totalMeses === 3) {
            mesesPagar.value = "Noviembre, Diciembre";
            vector.push("Noviembre-"+year, "Diciembre-"+year);
        }
        if (totalMeses === 4) {
            mesesPagar.value = "Noviembre, Diciembre, Enero";
            vector.push("Noviembre-"+year, "Diciembre-"+year, "Enero-"+añosgte);
        }
        if (totalMeses === 5) {
            mesesPagar.value = "Noviembre, Diciembre, Enero, Febrero";
            vector.push("Noviembre-"+year, "Diciembre-"+year, "Enero-"+añosgte, "Febrero-"+añosgte);
        }
        if (totalMeses === 6) {
            mesesPagar.value = "Noviembre, Diciembre, Enero, Febrero, Marzo";
            vector.push("Noviembre-"+year, "Diciembre-"+year, "Enero-"+añosgte, "Febrero-"+añosgte, "Marzo-"+añosgte);
        }
        if (totalMeses === 7) {
            mesesPagar.value =
                "Noviembre, Diciembre, Enero, Febrero, Marzo, Abril";
            vector.push(
                "Noviembre-"+year,
                "Diciembre-"+year,
                "Enero-"+añosgte,
                "Febrero-"+añosgte,
                "Marzo-"+añosgte,
                "Abril-"+añosgte
            );
        }
    }

    if (ultimoMes === "Noviembre "+year) {
        numero = Number(valor);
        var totalMeses = numero + 1;

        if (totalMeses === 2) {
            mesesPagar.value = "Diciembre";
            vector.push("Diciembre-"+year);
        }
        if (totalMeses === 3) {
            mesesPagar.value = "Diciembre, Enero";
            vector.push("Diciembre-"+year, "Enero-"+añosgte);
        }
        if (totalMeses === 4) {
            mesesPagar.value = "Diciembre, Enero, Febrero";
            vector.push("Diciembre-"+year, "Enero-"+añosgte, "Febrero-"+añosgte);
        }
        if (totalMeses === 5) {
            mesesPagar.value = "Diciembre, Enero, Febrero,Marzo";
            vector.push("Diciembre-"+year, "Enero-"+añosgte, "Febrero-"+añosgte, "Marzo-"+añosgte);
        }
        if (totalMeses === 6) {
            mesesPagar.value = "Diciembre, Enero, Febrero,Marzo, Abril";
            vector.push("Diciembre-"+year, "Enero-"+añosgte, "Febrero-"+añosgte, "Marzo-"+añosgte, "Abril-"+añosgte);
        }
    }

    if (ultimoMes === "Diciembre "+year) {
        numero = Number(valor);
        var totalMeses = numero + 1;

        if (totalMeses === 2) {
            mesesPagar.value = "Enero";
            vector.push("Enero-"+añosgte);
        }
        if (totalMeses === 3) {
            mesesPagar.value = "Enero, Febrero";
            vector.push("Enero-"+añosgte, "Febrero-"+añosgte);
        }
        if (totalMeses === 4) {
            mesesPagar.value = "Enero, Febrero,Marzo";
            vector.push("Enero-"+añosgte, "Febrero-"+añosgte, "Marzo-"+añosgte);
        }
        if (totalMeses === 5) {
            mesesPagar.value = "Enero, Febrero,Marzo,Abril";
            vector.push("Enero-"+añosgte, "Febrero-"+añosgte, "Marzo-"+añosgte, "Abril-"+añosgte);
        }
        if (totalMeses === 5) {
            mesesPagar.value = "Enero, Febrero,Marzo,Abril,Mayo";
            vector.push("Enero-"+añosgte, "Febrero-"+añosgte, "Marzo-"+añosgte, "Abril-"+añosgte, "Mayo-"+añosgte);
        }
    }

    mesesArray = document.getElementById("mesesArray");
    mesesArray.value = vector;
}

var numeroMes = document.getElementById("numeroMes").value;
var sinPagos = document.getElementById("mesActual");
var currentTime = new Date();
var year = currentTime.getFullYear();
var añosgte = year + 1;

if (numeroMes === "01") {
    sinPagos.value = "Enero " + year;
}
if (numeroMes === "02") {
    sinPagos.value = "Febrero " + year;
}
if (numeroMes === "03") {
    sinPagos.value = "Marzo " + year;
}
if (numeroMes === "04") {
    sinPagos.value = "Abril " + year;
}
if (numeroMes === "05") {
    sinPagos.value = "Mayo " + year;
}
if (numeroMes === "06") {
    sinPagos.value = "Junio " + year;
}
if (numeroMes === "07") {
    sinPagos.value = "Julio " + year;
}
if (numeroMes === "08") {
    sinPagos.value = "Agosto " + year;
}
if (numeroMes === "09") {
    sinPagos.value = "Setiembre " + year;
}
if (numeroMes === "10") {
    sinPagos.value = "Octubre " + year;
}
if (numeroMes === "11") {
    sinPagos.value = "Noviembre " + year;
}
if (numeroMes === "12") {
    sinPagos.value = "Diciembre " + year;
}

function primerPago(valor) {
    var monto = document.getElementById("monto");

    if (valor === "1") {
        monto.value = 20;
    }
    if (valor === "2") {
        monto.value = 40;
    }
    if (valor === "3") {
        monto.value = "60";
    }
    if (valor === "4") {
        monto.value = "80";
    }
    if (valor === "5") {
        monto.value = "100";
    }
    if (valor === "6") {
        monto.value = "120";
    }
    if (valor === "7") {
        monto.value = "140";
    }
    if (valor === "8") {
        monto.value = "160";
    }
    if (valor === "9") {
        monto.value = "180";
    }
    if (valor === "10") {
        monto.value = "200";
    }
    if (valor === "11") {
        monto.value = "220";
    }
    if (valor === "12") {
        monto.value = "240";
    }

    var mes = document.getElementById("mesActual").value;
    var mesesPagar = document.getElementById("mesesPagar");
    var vector = [];

    if (mes === "Abril " + year) {
        var numero = Number(valor);
        if (numero === 1) {
            mesesPagar.value = "Abril";
            vector.push("Abril");
        }

        if (numero === 2) {
            mesesPagar.value = "Abril, Mayo";
            vector.push("Abril", "Mayo");
        }

        if (numero === 3) {
            mesesPagar.value = "Abril, Mayo, Junio";
            vector.push("Abril", "Mayo", "Junio");
        }
        if (numero === 4) {
            mesesPagar.value = "Abril, Mayo, Junio, Julio";
            vector.push("Abril", "Mayo", "Junio", "Julio");
        }
        if (numero === 5) {
            mesesPagar.value = "Abril, Mayo, Junio, Julio, Agosto";
            vector.push("Abril", "Mayo", "Junio", "Julio", "Agosto");
        }
        if (numero === 6) {
            mesesPagar.value = "Abril, Mayo, Junio, Julio, Agosto, Setiembre";
            vector.push(
                "Abril",
                "Mayo",
                "Junio",
                "Julio",
                "Agosto",
                "Setiembre"
            );
        }
        if (numero === 7) {
            mesesPagar.value =
                "Abril, Mayo, Junio, Julio, Agosto, Setiembre, Octubre";
            vector.push(
                "Abril",
                "Mayo",
                "Junio",
                "Julio",
                "Agosto",
                "Setiembre",
                "Octubre"
            );
        }
        if (numero === 8) {
            mesesPagar.value =
                "Abril, Mayo, Junio, Julio, Agosto, Setiembre, Octubre, Noviembre";
            vector.push(
                "Abril",
                "Mayo",
                "Junio",
                "Julio",
                "Agosto",
                "Setiembre",
                "Octubre",
                "Noviembre"
            );
        }
        if (numero === 8) {
            mesesPagar.value =
                "Abril, Mayo, Junio, Julio, Agosto, Setiembre, Octubre, Noviembre, Diciembre ";
            vector.push(
                "Abril",
                "Mayo",
                "Junio",
                "Julio",
                "Agosto",
                "Setiembre",
                "Octubre",
                "Noviembre",
                "Diciembre"
            );
        }
    }

    if (mes === "Mayo " + year) {
        var numero = Number(valor);
        if (numero === 1) {
            mesesPagar.value = "Mayo";
            vector.push("Mayo-" + year);
        }
        if (numero === 2) {
            mesesPagar.value = "Mayo, Junio";
            vector.push("Mayo-" + year, "Junio-" + year);
        }
        if (numero === 3) {
            mesesPagar.value = "Mayo, Junio, Julio";
            vector.push("Mayo-" + year, "Junio-" + year, "Julio-" + year);
        }
        if (numero === 4) {
            mesesPagar.value = "Mayo, Junio, Julio, Agosto";
            vector.push(
                "Mayo-" + year,
                "Junio-" + year,
                "Julio-" + year,
                "Agosto-" + year
            );
        }
        if (numero === 5) {
            mesesPagar.value = "Mayo, Junio, Julio, Agosto, Setiembre";
            vector.push(
                "Mayo-" + year,
                "Junio-" + year,
                "Julio-" + year,
                "Agosto-" + year,
                "Setiembre-" + year
            );
        }
        if (numero === 6) {
            mesesPagar.value = "Mayo, Junio, Julio, Agosto, Setiembre, Octubre";
            vector.push(
                "Mayo-" + year,
                "Junio-" + year,
                "Julio-" + year,
                "Agosto-" + year,
                "Setiembre-" + year,
                "Octubre-" + year
            );
        }
        if (numero === 7) {
            mesesPagar.value =
                "Mayo, Junio, Julio, Agosto, Setiembre, Octubre, Noviembre";
            vector.push(
                "Mayo-" + year,
                "Junio-" + year,
                "Julio-" + year,
                "Agosto-" + year,
                "Setiembre-" + year,
                "Octubre-" + year,
                "Noviembre-" + year
            );
        }
        if (numero === 8) {
            mesesPagar.value =
                "Mayo, Junio, Julio, Agosto, Setiembre, Octubre, Noviembre, Diciembre";
            vector.push(
                "Mayo-" + year,
                "Junio-" + year,
                "Julio-" + year,
                "Agosto-" + year,
                "Setiembre-" + year,
                "Octubre-" + year,
                "Noviembre-" + year,
                "Diciembre-" + year
            );
        }
        if (numero === 9) {
            mesesPagar.value =
                "Mayo, Junio, Julio, Agosto, Setiembre, Octubre, Noviembre, Diciembre, Enero";
            vector.push(
                "Mayo-" + year,
                "Junio-" + year,
                "Julio-" + year,
                "Agosto-" + year,
                "Setiembre-" + year,
                "Octubre-" + year,
                "Noviembre-" + year,
                "Diciembre-" + year,
                "Enero-" + añosgte
            );
        }
        if (numero === 10) {
            mesesPagar.value =
                "Mayo, Junio, Julio, Agosto, Setiembre, Octubre, Noviembre, Diciembre, Enero, Febrero";
            vector.push(
                "Mayo-" + year,
                "Junio-" + year,
                "Julio-" + year,
                "Agosto-" + year,
                "Setiembre-" + year,
                "Octubre-" + year,
                "Noviembre-" + year,
                "Diciembre-" + year,
                "Enero-" + añosgte,
                "Febrero-" + añosgte
            );
        }
        if (numero === 11) {
            mesesPagar.value =
                "Mayo, Junio, Julio, Agosto, Setiembre, Octubre, Noviembre, Diciembre, Enero, Febrero, Marzo";
            vector.push(
                "Mayo-" + year,
                "Junio-" + year,
                "Julio-" + year,
                "Agosto-" + year,
                "Setiembre-" + year,
                "Octubre-" + year,
                "Noviembre-" + year,
                "Diciembre-" + year,
                "Enero-" + añosgte,
                "Febrero-" + añosgte,
                "Marzo-" + añosgte
            );
        }
        if (numero === 12) {
            mesesPagar.value =
                "Mayo, Junio, Julio, Agosto, Setiembre, Octubre, Noviembre, Diciembre, Enero, Febrero, Marzo, Abril";
            vector.push(
                "Mayo-" + year,
                "Junio-" + year,
                "Julio-" + year,
                "Agosto-" + year,
                "Setiembre-" + year,
                "Octubre-" + year,
                "Noviembre-" + year,
                "Diciembre-" + year,
                "Enero-" + añosgte,
                "Febrero-" + añosgte,
                "Marzo-" + añosgte,
                "Abril-" + añosgte
            );
        }
        if (numero === 13) {
            mesesPagar.value =
                "Mayo, Junio, Julio, Agosto, Setiembre, Octubre, Noviembre, Diciembre, Enero, Febrero, Marzo, Abril, Mayo";
            vector.push(
                "Mayo-" + year,
                "Junio-" + year,
                "Julio-" + year,
                "Agosto-" + year,
                "Setiembre-" + year,
                "Octubre-" + year,
                "Noviembre-" + year,
                "Diciembre-" + year,
                "Enero-" + añosgte,
                "Febrero-" + añosgte,
                "Marzo-" + añosgte,
                "Abril-" + añosgte,
                "Mayo-" + añosgte
            );
        }
    }

    if (mes === "Junio " + year) {
        var numero = Number(valor);
        if (numero === 1) {
            mesesPagar.value = "Junio";
            vector.push("Junio-" + year);
        }
        if (numero === 2) {
            mesesPagar.value = "Junio, Julio";
            vector.push("Junio-" + year, "Julio-" + year);
        }
        if (numero === 3) {
            mesesPagar.value = "Junio, Julio, Agosto";
            vector.push("Junio-" + year, "Julio-" + year, "Agosto-" + year);
        }
        if (numero === 4) {
            mesesPagar.value = "Junio, Julio, Agosto, Setiembre";
            vector.push(
                "Junio-" + year,
                "Julio-" + year,
                "Agosto-" + year,
                "Setiembre-" + year
            );
        }
        if (numero === 5) {
            mesesPagar.value = "Junio, Julio, Agosto, Setiembre, Octubre";
            vector.push(
                "Junio-" + year,
                "Julio-" + year,
                "Agosto-" + year,
                "Setiembre-" + year,
                "Octubre-" + year
            );
        }
        if (numero === 6) {
            mesesPagar.value =
                "Junio, Julio, Agosto, Setiembre, Octubre, Noviembre";
            vector.push(
                "Junio-" + year,
                "Julio-" + year,
                "Agosto-" + year,
                "Setiembre-" + year,
                "Octubre-" + year,
                "Noviembre-" + year
            );
        }
        if (numero === 7) {
            mesesPagar.value =
                "Junio, Julio, Agosto, Setiembre, Octubre, Noviembre, Diciembre";
            vector.push(
                "Junio-" + year,
                "Julio-" + year,
                "Agosto-" + year,
                "Setiembre-" + year,
                "Octubre-" + year,
                "Noviembre-" + year,
                "Diciembre-" + year
            );
        }
        if (numero === 8) {
            mesesPagar.value =
                "Junio, Julio, Agosto, Setiembre, Octubre, Noviembre, Diciembre, Enero";
            vector.push(
                "Junio-" + year,
                "Julio-" + year,
                "Agosto-" + year,
                "Setiembre-" + year,
                "Octubre-" + year,
                "Noviembre-" + year,
                "Diciembre-" + year,
                "Enero" + añosgte
            );
        }
        if (numero === 9) {
            mesesPagar.value =
                "Junio, Julio, Agosto, Setiembre, Octubre, Noviembre, Diciembre, Enero, Febrero";
            vector.push(
                "Junio-" + year,
                "Julio-" + year,
                "Agosto-" + year,
                "Setiembre-" + year,
                "Octubre-" + year,
                "Noviembre-" + year,
                "Diciembre-" + year,
                "Enero-" + añosgte,
                "Febrero-" + añosgte
            );
        }
        if (numero === 10) {
            mesesPagar.value =
                "Junio, Julio, Agosto, Setiembre, Octubre, Noviembre, Diciembre, Enero, Febrero, Marzo";
            vector.push(
                "Junio-" + year,
                "Julio-" + year,
                "Agosto-" + year,
                "Setiembre-" + year,
                "Octubre-" + year,
                "Noviembre-" + year,
                "Diciembre-" + year,
                "Enero-" + añosgte,
                "Febrero-" + añosgte,
                "Marzo-" + añosgte
            );
        }
        if (numero === 11) {
            mesesPagar.value =
                "Junio, Julio, Agosto, Setiembre, Octubre, Noviembre, Diciembre, Enero, Febrero, Marzo, Abril";
            vector.push(
                "Junio-" + year,
                "Julio-" + year,
                "Agosto-" + year,
                "Setiembre-" + year,
                "Octubre-" + year,
                "Noviembre-" + year,
                "Diciembre-" + year,
                "Enero-" + añosgte,
                "Febrero-" + añosgte,
                "Marzo-" + añosgte,
                "Abril-" + añosgte
            );
        }
        if (numero === 12) {
            mesesPagar.value =
                "Junio, Julio, Agosto, Setiembre, Octubre, Noviembre, Diciembre, Enero, Febrero, Marzo, Abril, Mayo";
            vector.push(
                "Junio-" + year,
                "Julio-" + year,
                "Agosto-" + year,
                "Setiembre-" + year,
                "Octubre-" + year,
                "Noviembre-" + year,
                "Diciembre-" + year,
                "Enero-" + añosgte,
                "Febrero-" + añosgte,
                "Marzo-" + añosgte,
                "Abril-" + añosgte,
                "Mayo-" + añosgte
            );
        }
    }

    if (mes === "Julio " + year) {
        var numero = Number(valor);
        if (numero === 1) {
            mesesPagar.value = "Julio";
            vector.push("Julio-" + year);
        }
        if (numero === 2) {
            mesesPagar.value = "Julio, Agosto";
            vector.push("Julio-" + year, "Agosto-" + year);
        }
        if (numero === 3) {
            mesesPagar.value = "Julio, Agosto, Setiembre";
            vector.push("Julio-" + year, "Agosto-" + year, "Setiembre-" + year);
        }
        if (numero === 4) {
            mesesPagar.value = "Julio, Agosto, Setiembre, Octubre";
            vector.push(
                "Julio-" + year,
                "Agosto-" + year,
                "Setiembre-" + year,
                "Octubre-" + year
            );
        }
        if (numero === 5) {
            mesesPagar.value = "Julio, Agosto, Setiembre, Octubre, Noviembre";
            vector.push(
                "Julio-" + year,
                "Agosto-" + year,
                "Setiembre-" + year,
                "Octubre-" + year,
                "Noviembre-" + year
            );
        }
        if (numero === 6) {
            mesesPagar.value =
                "Julio, Agosto, Setiembre, Octubre, Noviembre, Diciembre";
            vector.push(
                "Julio-" + year,
                "Agosto-" + year,
                "Setiembre-" + year,
                "Octubre-" + year,
                "Noviembre-" + year,
                "Diciembre-" + year
            );
        }
        if (numero === 7) {
            mesesPagar.value =
                "Julio, Agosto, Setiembre, Octubre, Noviembre, Diciembre, Enero";
            vector.push(
                "Julio-" + year,
                "Agosto-" + year,
                "Setiembre-" + year,
                "Octubre-" + year,
                "Noviembre-" + year,
                "Diciembre-" + year,
                "Enero-" + añosgte
            );
        }
        if (numero === 8) {
            mesesPagar.value =
                "Julio, Agosto, Setiembre, Octubre, Noviembre, Diciembre, Enero, Febrero";
            vector.push(
                "Julio-" + year,
                "Agosto-" + year,
                "Setiembre-" + year,
                "Octubre-" + year,
                "Noviembre-" + year,
                "Diciembre-" + year,
                "Enero-" + añosgte,
                "Febrero-" + añosgte
            );
        }
        if (numero == 9) {
            mesesPagar.value =
                "Julio, Agosto, Setiembre, Octubre, Noviembre, Diciembre, Enero, Febrero, Marzo";
            vector.push(
                "Julio-" + year,
                "Agosto-" + year,
                "Setiembre-" + year,
                "Octubre-" + year,
                "Noviembre-" + year,
                "Diciembre-" + year,
                "Enero-" + añosgte,
                "Febrero-" + añosgte,
                "Marzo-" + añosgte
            );
        }
        if (numero == 10) {
            mesesPagar.value =
                "Julio, Agosto, Setiembre, Octubre, Noviembre, Diciembre, Enero, Febrero, Marzo, Abril";
            vector.push(
                "Julio-" + year,
                "Agosto-" + year,
                "Setiembre-" + year,
                "Octubre-" + year,
                "Noviembre-" + year,
                "Diciembre-" + year,
                "Enero-" + añosgte,
                "Febrero-" + añosgte,
                "Marzo-" + añosgte,
                "Abril" + añosgte
            );
        }
        if (numero == 11) {
            mesesPagar.value =
                "Julio, Agosto, Setiembre, Octubre, Noviembre, Diciembre, Enero, Febrero, Marzo, Abril, Mayo";
            vector.push(
                "Julio-" + year,
                "Agosto-" + year,
                "Setiembre-" + year,
                "Octubre-" + year,
                "Noviembre-" + year,
                "Diciembre-" + year,
                "Enero-" + añosgte,
                "Febrero-" + añosgte,
                "Marzo-" + añosgte,
                "Abril" + añosgte,
                "Mayo" + añosgte
            );
        }
    }

    if (mes === "Agosto " + year) {
        var numero = Number(valor);
        if (numero === 1) {
            mesesPagar.value = "Agosto";
            vector.push("Agosto-" + year);
        }
        if (numero === 2) {
            mesesPagar.value = "Agosto, Setiembre";
            vector.push("Agosto-" + year, "Setiembre-" + year);
        }
        if (numero === 3) {
            mesesPagar.value = "Agosto, Setiembre, Octubre";
            vector.push(
                "Agosto-" + year,
                "Setiembre-" + year,
                "Octubre-" + year
            );
        }
        if (numero === 4) {
            mesesPagar.value = "Agosto, Setiembre, Octubre, Noviembre";
            vector.push(
                "Agosto-" + year,
                "Setiembre-" + year,
                "Octubre-" + year,
                "Noviembre-" + year
            );
        }
        if (numero === 5) {
            mesesPagar.value =
                "Agosto, Setiembre, Octubre, Noviembre, Diciembre";
            vector.push(
                "Agosto-" + year,
                "Setiembre-" + year,
                "Octubre-" + year,
                "Noviembre-" + year,
                "Diciembre-" + year
            );
        }
        if (numero === 6) {
            mesesPagar.value =
                "Agosto, Setiembre, Octubre, Noviembre, Diciembre";
            vector.push(
                "Agosto-" + year,
                "Setiembre-" + year,
                "Octubre-" + year,
                "Noviembre-" + year,
                "Diciembre-" + year
            );
        }
        if (numero === 7) {
            mesesPagar.value =
                "Agosto, Setiembre, Octubre, Noviembre, Diciembre, Enero";
            vector.push(
                "Agosto-" + year,
                "Setiembre-" + year,
                "Octubre-" + year,
                "Noviembre-" + year,
                "Diciembre-" + year,
                "Enero-" + añosgte
            );
        }
        if (numero === 8) {
            mesesPagar.value =
                "Agosto, Setiembre, Octubre, Noviembre, Diciembre, Enero, Febrero";
            vector.push(
                "Agosto-" + year,
                "Setiembre-" + year,
                "Octubre-" + year,
                "Noviembre-" + year,
                "Diciembre-" + year,
                "Enero-" + añosgte,
                "Febrero-" + añosgte
            );
        }
        if (numero === 9) {
            mesesPagar.value =
                "Agosto, Setiembre, Octubre, Noviembre, Diciembre, Enero, Febrero, Marzo";
            vector.push(
                "Agosto-" + year,
                "Setiembre-" + year,
                "Octubre-" + year,
                "Noviembre-" + year,
                "Diciembre-" + year,
                "Enero-" + añosgte,
                "Febrero-" + añosgte,
                "Marzo-" + añosgte
            );
        }
        if (numero === 10) {
            mesesPagar.value =
                "Agosto, Setiembre, Octubre, Noviembre, Diciembre, Enero, Febrero, Marzo, Abril";
            vector.push(
                "Agosto-" + year,
                "Setiembre-" + year,
                "Octubre-" + year,
                "Noviembre-" + year,
                "Diciembre-" + year,
                "Enero-" + añosgte,
                "Febrero-" + añosgte,
                "Marzo-" + añosgte,
                "Abril-" + añosgte
            );
        }
        if (numero === 11) {
            mesesPagar.value =
                "Agosto, Setiembre, Octubre, Noviembre, Diciembre, Enero, Febrero, Marzo, Abril, Mayo";
            vector.push(
                "Agosto-" + year,
                "Setiembre-" + year,
                "Octubre-" + year,
                "Noviembre-" + year,
                "Diciembre-" + year,
                "Enero-" + añosgte,
                "Febrero-" + añosgte,
                "Marzo-" + añosgte,
                "Abril-" + añosgte,
                "Mayo-" + añosgte
            );
        }
    }

    if (mes === "Setiembre " + year) {
        var numero = Number(valor);
        if (numero === 1) {
            mesesPagar.value = "Setiembre";
            vector.push("Setiembre-" + year);
        }
        if (numero === 2) {
            mesesPagar.value = "Setiembre, Octubre";
            vector.push("Setiembre-" + year, "Octubre-" + year);
        }
        if (numero === 3) {
            mesesPagar.value = "Setiembre, Octubre, Noviembre";
            vector.push(
                "Setiembre-" + year,
                "Octubre-" + year,
                "Noviembre-" + year
            );
        }
        if (numero === 4) {
            mesesPagar.value = "Setiembre, Octubre, Noviembre, Diciembre";
            vector.push(
                "Setiembre-" + year,
                "Octubre-" + year,
                "Noviembre-" + year,
                "Diciembre-" + year
            );
        }
        if (numero === 5) {
            mesesPagar.value =
                "Setiembre, Octubre, Noviembre, Diciembre, Enero";
            vector.push(
                "Setiembre-" + year,
                "Octubre-" + year,
                "Noviembre-" + year,
                "Diciembre-" + year,
                "Enero-" + añosgte
            );
        }
        if (numero === 6) {
            mesesPagar.value =
                "Setiembre, Octubre, Noviembre, Diciembre, Enero, Febrero";
            vector.push(
                "Setiembre-" + year,
                "Octubre-" + year,
                "Noviembre-" + year,
                "Diciembre-" + year,
                "Enero-" + añosgte,
                "Febrero+" + añosgte
            );
        }
        if (numero === 7) {
            mesesPagar.value =
                "Setiembre, Octubre, Noviembre, Diciembre, Enero, Febrero, Marzo";
            vector.push(
                "Setiembre-" + year,
                "Octubre-" + year,
                "Noviembre-" + year,
                "Diciembre-" + year,
                "Enero-" + añosgte,
                "Febrero-" + añosgte,
                "Marzo-" + añosgte
            );
        }
        if (numero === 8) {
            mesesPagar.value =
                "Setiembre, Octubre, Noviembre, Diciembre, Enero, Febrero, Marzo, Abril";
            vector.push(
                "Setiembre-" + year,
                "Octubre-" + year,
                "Noviembre-" + year,
                "Diciembre-" + year,
                "Enero-" + añosgte,
                "Febrero-" + añosgte,
                "Marzo-" + añosgte,
                "Abril-" + añosgte
            );
        }
        if (numero === 9) {
            mesesPagar.value =
                "Setiembre, Octubre, Noviembre, Diciembre, Enero, Febrero, Marzo, Abril, Mayo";
            vector.push(
                "Setiembre-" + year,
                "Octubre-" + year,
                "Noviembre-" + year,
                "Diciembre-" + year,
                "Enero-" + añosgte,
                "Febrero-" + añosgte,
                "Marzo-" + añosgte,
                "Abril-" + añosgte,
                "Mayo-" + añosgte
            );
        }
    }

    if (mes === "Octubre " + year) {
        var numero = Number(valor);
        if (numero === 1) {
            mesesPagar.value = "Octubre";
            vector.push("Octubre-" + year);
        }
        if (numero === 2) {
            mesesPagar.value = "Octubre, Noviembre";
            vector.push("Octubre-" + year, "Noviembre-" + year);
        }
        if (numero === 3) {
            mesesPagar.value = "Octubre, Noviembre, Diciembre";
            vector.push(
                "Octubre-" + year,
                "Noviembre-" + year,
                "Diciembre-" + year
            );
        }
        if (numero === 4) {
            mesesPagar.value = "Octubre, Noviembre, Diciembre, Enero";
            vector.push(
                "Octubre-" + year,
                "Noviembre-" + year,
                "Diciembre-" + year,
                "Enero-" + añosgte
            );
        }
        if (numero === 5) {
            mesesPagar.value = "Octubre, Noviembre, Diciembre, Enero, Febrero";
            vector.push(
                "Octubre-" + year,
                "Noviembre-" + year,
                "Diciembre-" + year,
                "Enero-" + añosgte,
                "Febrero-" + añosgte
            );
        }
        if (numero === 6) {
            mesesPagar.value =
                "Octubre, Noviembre, Diciembre, Enero, Febrero, Marzo";
            vector.push(
                "Octubre-" + year,
                "Noviembre-" + year,
                "Diciembre-" + year,
                "Enero-" + añosgte,
                "Febrero-" + añosgte,
                "Marzo-" + añosgte
            );
        }
        if (numero === 7) {
            mesesPagar.value =
                "Octubre, Noviembre, Diciembre, Enero, Febrero, Marzo, Abril";
            vector.push(
                "Octubre-" + year,
                "Noviembre-" + year,
                "Diciembre-" + year,
                "Enero-" + añosgte,
                "Febrero-" + añosgte,
                "Marzo-" + añosgte,
                "Abril-" + añosgte
            );
        }
        if (numero === 8) {
            mesesPagar.value =
                "Octubre, Noviembre, Diciembre, Enero, Febrero, Marzo, Abril, Mayo";
            vector.push(
                "Octubre-" + year,
                "Noviembre-" + year,
                "Diciembre-" + year,
                "Enero-" + añosgte,
                "Febrero-" + añosgte,
                "Marzo-" + añosgte,
                "Abril-" + añosgte,
                "Mayo-" + añosgte
            );
        }

        if (mes === "Noviembre " + year) {
            var numero = Number(valor);
            if (numero === 1) {
                mesesPagar.value = "Noviembre";
                vector.push("Noviembre-" + year);
            }
            if (numero === 2) {
                mesesPagar.value = "Noviembre, Diciembre";
                vector.push("Noviembre-" + year, "Diciembre-" + year);
            }
            if (numero === 3) {
                mesesPagar.value = "Noviembre, Diciembre, Enero";
                vector.push(
                    "Noviembre-" + year,
                    "Diciembre-" + year,
                    "Enero-" + añosgte
                );
            }
            if (numero === 4) {
                mesesPagar.value = "Noviembre, Diciembre, Enero, Febrero";
                vector.push(
                    "Noviembre-" + year,
                    "Diciembre-" + year,
                    "Enero-" + añosgte,
                    "Febrero-" + añosgte
                );
            }
            if (numero === 5) {
                mesesPagar.value =
                    "Noviembre, Diciembre, Enero, Febrero, Marzo";
                vector.push(
                    "Noviembre-" + year,
                    "Diciembre-" + year,
                    "Enero-" + añosgte,
                    "Febrero-" + añosgte,
                    "Marzo-" + añosgte
                );
            }
            if (numero === 6) {
                mesesPagar.value =
                    "Noviembre, Diciembre, Enero, Febrero, Marzo, Abril";
                vector.push(
                    "Noviembre-" + year,
                    "Diciembre-" + year,
                    "Enero-" + añosgte,
                    "Febrero-" + añosgte,
                    "Marzo-" + añosgte,
                    "Abril-" + añosgte
                );
            }
            if (numero === 7) {
                mesesPagar.value =
                    "Noviembre, Diciembre, Enero, Febrero, Marzo, Abril, Mayo";
                vector.push(
                    "Noviembre-" + year,
                    "Diciembre-" + year,
                    "Enero-" + añosgte,
                    "Febrero-" + añosgte,
                    "Marzo-" + añosgte,
                    "Abril-" + añosgte,
                    "Mayo-" + añosgte
                );
            }
        }
    }
    mesesArray = document.getElementById("mesesArray");
    mesesArray.value = vector;
}
