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

    let arregloHoraInicio = inputHoraInicio.value.split(':');
    
    if ((parseInt(arregloHoraInicio[0]) < 10))
        arregloHoraInicio[0] = `0${(parseInt(arregloHoraInicio[0]) + 1)}`;
    else
        arregloHoraInicio[0] = (parseInt(arregloHoraInicio[0]) + 1).toString();
    
    inputHoraFinal.setAttribute("min", arregloHoraInicio.join(':'));
    console.log(inputHoraFinal.value);
}