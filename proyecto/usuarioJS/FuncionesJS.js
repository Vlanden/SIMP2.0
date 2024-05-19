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

/*

FUNCION PARA COMPROBAR QUE LAS CONTRASEÑAS SEAN IDENTICAS EN "recuperacion.html"

P1 Y P2: Variables paa contener los valores de P-New y P-New2 respectivamente

*/

/* document.getElementById('checkID').addEventListener('change', (event) =>{
    if(event.target.checked){
        document.getElementById('ID').readOnly = false;
    }
}) */

function check(){
    var c = document.getElementById("checkID");
    var id = document.getElementById('ID');

    if(c.checked){
        id.removeAttribute('readonly');
    }
    else{
        id.readOnly = true;
    }
}

function comprobacion(){
    let P1 = document.getElementById("P-New").value
    let P2 = document.getElementById("P-New2").value

    if (P1 == P2) {
       document.getElementById("formRe").submit();
    } else {
       alert("Las dos claves son distintas...\nPor favor vuelva a hacer el formulario")
    }
}