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

function validarHora()
{
    let inputHoraInicio = document.getElementById("inputHoraInicio");
    let inputHoraFinal = document.getElementById("inputHoraFinal");

    inputHoraFinal.setAttribute("min", inputHoraInicio.value);

    if (!inputHoraFinal.value) // si todavia no puso hora final
        inputHoraFinal.disabled = false;
    else if (inputFechaInicio.value >= inputHoraFinal.value)// si ya habia puesto hora final y la nueva inicial es mayor
        inputHoraFinal.value = inputHoraInicio.value;
}