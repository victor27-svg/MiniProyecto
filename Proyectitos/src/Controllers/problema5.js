function evitarFallosCampos() {
    const persona1 = document.getElementById("edad1");
    const persona2 = document.getElementById("edad2");
    const persona3 = document.getElementById("edad3");
    const persona4 = document.getElementById("edad4");
    const persona5 = document.getElementById("edad5");

    if (
        persona1.value === "" ||
        persona2.value === "" ||
        persona3.value === "" ||
        persona4.value === "" ||
        persona5.value === ""
    ) {
        alert("Debe ingresar todas las edades.");
        return false;
    }

    if (
        Number(persona1.value) < 0 ||
        Number(persona2.value) <0 ||
        Number(persona3.value) < 0 ||
        Number(persona4.value) < 0 ||
        Number(persona5.value) < 0
    ) {
        alert("Las edades no pueden ser menores a 0.");
        return false;
    }

    return true;
}