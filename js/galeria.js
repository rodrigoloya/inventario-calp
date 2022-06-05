//inicializacion de variables de entorno
let slideIndex = 1;
let automatico = true;

//funcion para avanzar
function plusSlides(n) {
  showSlides(slideIndex += n);
}


function currentSlide(n) {
  showSlides(slideIndex = n);
}

//Funcion para mostrar las imágnes
function showSlides(n) {
  let i;
  let slides = document.getElementsByClassName("mySlides");
  let dots = document.getElementsByClassName("dot");
  if (n > slides.length) {slideIndex = 1}    
  if (n < 1) {slideIndex = slides.length}
  for (i = 0; i < slides.length; i++) {
    slides[i].style.display = "none";  
  }
  for (i = 0; i < dots.length; i++) {
    dots[i].className = dots[i].className.replace(" active", "");
  }
  slides[slideIndex-1].style.display = "block";  
  dots[slideIndex-1].className += " active";
}

//funcion para iniciar animación de imagenes automático
function showSlidesAuto(){
    let i;
    let slides = document.getElementsByClassName("mySlides");
    for (i = 0; i < slides.length; i++) {
      slides[i].style.display = "none";
    }
    slideIndex++;
    if (slideIndex > slides.length) {slideIndex = 1}
    slides[slideIndex-1].style.display = "block";
    
    //Bandera para controlar que se detenga la animacion
    if(automatico) {
        setTimeout(showSlidesAuto, 2000); // Change image every 2 seconds
    }
}

//funcion para asignar los eventos a cada imagen en onmouseover
function setCarusselImgHandlers(){
    
    let imags = document.getElementsByClassName("img-slide");
    for(let i = 0 ; i < imags.length ; i++){
        imags[i].onmouseover = (event) => {
            
            //desactivamos bandera de entorno para detener la animación
            automatico = false;

            //recuperar el texto para mostrarlo cuando el mouse esta sobre
            let texto = imags[i].parentNode.querySelector('.text');            
            texto.style.visibility = 'visible';
        };
    }
}

//funcion onload para iniciar el script cuando la pagina se ha cargado completamente
window.onload= () => {
    setCarusselImgHandlers();
    showSlidesAuto();

    //agregamos el evento onmouseleave para que la animacion se reinicie automaticamente
    document.querySelector('.slideshow-container').onmouseleave  = (event) =>{
        if(!automatico){
            automatico = true;
            document.querySelectorAll('.text').forEach(element => {
                element.style.visibility = 'hidden';
            });
            showSlidesAuto();
        }
    };
}