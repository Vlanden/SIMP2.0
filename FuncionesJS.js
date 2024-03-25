/*const preguntas = document.querySelectorAll("preguntas");

FUNCION DE PREGUNTAS QUE AUN NO SE SI USAR

preguntas.array.forEach(preguntas2 => {
    preguntas2.addEventListener("click", () =>{
        preguntas2.nextElementSibiling.classList.toggle("activa");
    });
});

function removeractiva(){
    preguntas.array.forEach(preguntas2 => {
        preguntas2.addEventListener("click", () =>{
            preguntas2.nextElementSibiling.classList.toggle("activa");
        });
    });

} */

//FUNCION PARA COMPROBAR QUE LAS CONTRASEÑAS SEAN IDENTICAS EN "recuperacion.html"

function comprobaciopn(){
    let P1 = document.getElementById("P-New").value
    let P2 = document.getElementById("P-New2").value

    if (clave1 == clave2) {
       document.getElementById("formRe").submit();
    } else {
       alert("Las dos claves son distintas...\nPor favor vuelva a hacer el formulario")
    }
}