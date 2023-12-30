// const optionMenu = document.querySelector(".select-menu-1"),
//        selectBtn = optionMenu.querySelector(".select-btn-1"),
//        options = optionMenu.querySelectorAll(".option-1"),
//        sBtn_text = optionMenu.querySelector(".sBtn-text-1");

// selectBtn.addEventListener("click", () => optionMenu.classList.toggle("active"));       


// options.forEach(option =>{
//     option.addEventListener("click", ()=>{
//         let selectedOption = option.querySelector(".option-text-1").innerText;
//         sBtn_text.innerText = selectedOption;

//         optionMenu.classList.remove("active");
//     })
// })

const slider1 = document.querySelector('.slider_in1');
const progressBar1 = document.querySelector('.prog_bar_in1');

let sliderGrabbed = false;

slider1.parentElement.addEventListener('scroll', (e) => {
    progressBar1.style.width  = `${getScrollPercentage()}%`
})

slider1.addEventListener('mousedown', (e) => {
    sliderGrabbed = true;
    slider1.style.cursor = 'grabbing';
})

slider1.addEventListener('mouseup', (e) => {
    sliderGrabbed = false;
    slider1.style.cursor = 'grab';
})

slider1.addEventListener('mouseleave', (e) => {
    sliderGrabbed = false;
})

slider1.addEventListener('mousemove', (e) => {
    if(sliderGrabbed){
        slider1.parentElement.scrollLeft -= e.movementX;
    }
})

slider1.addEventListener('wheel', (e) =>{
    e.preventDefault()
    slider1.parentElement.scrollLeft += e.deltaY;
})

function getScrollPercentage(){
   return ((slider1.parentElement.scrollLeft / (slider1.parentElement.scrollWidth - slider1.parentElement.clientWidth) ) * 100);
}



const slider2 = document.querySelector('.slider_in2');
const progressBar2 = document.querySelector('.prog_bar_in2');

let sliderGrabbed2 = false;

slider2.parentElement.addEventListener('scroll', (e) => {
    progressBar2.style.width  = `${getScrollPercentagee()}%`
})

slider2.addEventListener('mousedown', (e) => {
    sliderGrabbed2 = true;
    slider2.style.cursor = 'grabbing';
})

slider2.addEventListener('mouseup', (e) => {
    sliderGrabbed2 = false;
    slider2.style.cursor = 'grab';
})

slider2.addEventListener('mouseleave', (e) => {
    sliderGrabbed2 = false;
})

slider2.addEventListener('mousemove', (e) => {
    if(sliderGrabbed2){
        slider2.parentElement.scrollLeft -= e.movementX;
    }
})

slider2.addEventListener('wheel', (e) =>{
    e.preventDefault()
    slider2.parentElement.scrollLeft += e.deltaY;
})

function getScrollPercentagee(){
   return ((slider2.parentElement.scrollLeft / (slider2.parentElement.scrollWidth - slider2.parentElement.clientWidth) ) * 100);
}



const slider3 = document.querySelector('.slider_in3');
const progressBar3 = document.querySelector('.prog_bar_in3');

let sliderGrabbed3 = false;

slider3.parentElement.addEventListener('scroll', (e) => {
    progressBar3.style.width  = `${getScrollPercentageee()}%`
})

slider3.addEventListener('mousedown', (e) => {
    sliderGrabbed3 = true;
    slider3.style.cursor = 'grabbing';
})

slider3.addEventListener('mouseup', (e) => {
    sliderGrabbed3 = false;
    slider3.style.cursor = 'grab';
})

slider3.addEventListener('mouseleave', (e) => {
    sliderGrabbed3 = false;
})

slider3.addEventListener('mousemove', (e) => {
    if(sliderGrabbed3){
        slider3.parentElement.scrollLeft -= e.movementX;
    }
})

slider3.addEventListener('wheel', (e) =>{
    e.preventDefault()
    slider3.parentElement.scrollLeft += e.deltaY;
})

function getScrollPercentageee(){
   return ((slider3.parentElement.scrollLeft / (slider3.parentElement.scrollWidth - slider3.parentElement.clientWidth) ) * 100);
}



// const accordionContent = document.querySelectorAll(".accordion-content-meal");

// accordionContent.forEach((item, index) => {
//     let header = item.querySelector("header");
//     header.addEventListener("click", () =>{
//         item.classList.toggle("open");

//         let description = item.querySelector(".description-meal");
//         if(item.classList.contains("open")){
//             description.style.height = `${description.scrollHeight}px`; //scrollHeight property returns the height of an element including padding , but excluding borders, scrollbar or margin
//             item.querySelector("i").classList.replace("fa-plus", "fa-minus");
//         }else{
//             description.style.height = "0px";
//             item.querySelector("i").classList.replace("fa-minus", "fa-plus");
//         }
//         removeOpen(index); //calling the funtion and also passing the index number of the clicked header
//     })
// })

// function removeOpen(index1){
//     accordionContent.forEach((item2, index2) => {
//         if(index1 != index2){
//             item2.classList.remove("open");

//             let des = item2.querySelector(".description-meal");
//             des.style.height = "0px";
//             item2.querySelector("i").classList.replace("fa-minus", "fa-plus");
//         }
//     })
// }


// dragable navigation


// getting HTML elements
const navdrag = document.querySelector(".nav-drag"),
      toggleBtn = navdrag.querySelector(".toggle-btn");

  toggleBtn.addEventListener("click" , () =>{
    navdrag.classList.toggle("open");
  });

// js code to make draggable nav
function onDrag({movementY}) { //movementY gets mouse vertical value
  const navStyle = window.getComputedStyle(navdrag), //getting all css style of nav
        navTop = parseInt(navStyle.top), // getting nav top value & convert it into string
        navHeight = parseInt(navStyle.height), // getting nav height value & convert it into string
        windHeight = window.innerHeight; // getting window height

  navdrag.style.top = navTop > 0 ? `${navTop + movementY}px` : "1px";
  if(navTop > windHeight - navHeight){
    navdrag.style.top = `${windHeight - navHeight}px`;
  }
}

//this function will call when user click mouse's button and  move mouse on nav
navdrag.addEventListener("mousedown", () =>{
    navdrag.addEventListener("mousemove", onDrag);
});

//these function will call when user relase mouse button and leave mouse from nav
navdrag.addEventListener("mouseup", () =>{
    navdrag.removeEventListener("mousemove", onDrag);
});
navdrag.addEventListener("mouseleave", () =>{
    navdrag.removeEventListener("mousemove", onDrag);
});