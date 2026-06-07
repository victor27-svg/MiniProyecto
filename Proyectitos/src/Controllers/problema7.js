function evitarFallosCantidad() {
    const cant = document.getElementById("cantidad");

    if (cant.value === "" ) {
        alert("Debe ingresar aunque sea 2 nota");
        return false;
    }

    if (Number(cant.value) <= 1 ) {
        alert("No puede tener solo una notas");
        return false;
    }

    return true;
}

function evitarFallosNotas(){

    let cant = Number(document.getElementById("totalNotas").value);

    for(let i = 0; i < cant; i++){

        let nota = document.getElementById("nota" + i);

        if(nota.value === ""){
            alert("Debe ingresar todas las notas.");
            nota.focus();
            return false;
        }

        let valor = Number(nota.value);

        if(valor < 0){
            alert("Las notas no pueden ser negativas.");
            nota.focus();
            return false;
        }

        if(valor > 100){
            alert("Las notas no pueden ser mayores que 100.");
            nota.focus();
            return false;
        }
    }

    return true;
}