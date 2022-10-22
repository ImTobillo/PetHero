function validarFecha()
{
    let inputFechaInicio = document.getElementById("inputFechaInicio");
    let inputFechaFinal = document.getElementById("inputFechaFinal");

    inputFechaFinal.setAttribute("min", inputFechaInicio.value);

    if (!inputFechaFinal.value) // si todavia no puso fecha final
        inputFechaFinal.disabled = false;
    else if (inputFechaInicio.value >= inputFechaFinal.value)// si ya habia puesto fecha final y la nueva inicial es mayor
        inputFechaFinal.value = inputFechaInicio.value;
}