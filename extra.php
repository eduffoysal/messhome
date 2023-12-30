<!DOCTYPE html>
<!-- Coding By CodingNepal - youtube.com/codingnepal -->
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Detect Pressed Key in JavaScript | CodingNepal</title>
    <link rel="stylesheet" href="style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

<style media="screen">
/* Import Google Font - Poppins */
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap');
*{
margin: 0;
padding: 0;
box-sizing: border-box;
font-family: 'Poppins', sans-serif;
}
body{
display: flex;
min-height: 100vh;
align-items: center;
justify-content: center;
background: #17A2B8;
}
.box{
padding: 25px;
width: 290px;
border-radius: 15px;
background: #fff;
box-shadow: 7px 7px 20px rgba(0, 0, 0, 0.05);
}
.text, .key-code, .key-name{
font-size: 45px;
color: #17A2B8;
font-weight: 500;
}
.text{
font-size: 30px;
text-align: center;
pointer-events: none;
}
.box.active .text{
display: none;
}
.content, .key-code, .details{
display: flex;
align-items: center;
justify-content: center;
}
.content{
display: none;
flex-direction: column;
}
.box.active .content{
display: flex;
}
.content .key-code{
height: 110px;
width: 110px;
background: #fff;
border-radius: 50%;
margin-bottom: 15px;
pointer-events: none;
border: 5px solid #17A2B8;
box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}
.content .details{
width: 100%;
margin-top: 15px;
justify-content: space-evenly;
}
.details p{
width: 100%;
font-size: 18px;
text-align: center;
}
.details p:last-child{
border-left: 1px solid #bfbfbf;
}
</style>

  </head>
  <body>
    <div class="box">
      <p class="text">Press any key</p>
      <div class="content">
        <div class="key-code"></div>
        <div class="key-name"></div>
        <div class="details">
          <p class="key">Key: <span></span></p>
          <p class="code">Code: <span></span></p>
        </div>
      </div>
    </div>

    <script>
      const box = document.querySelector(".box");
      document.addEventListener("keydown", e =>{
        let keyName = e.keyCode === 32 ? "Space" : e.key;
        box.querySelector(".key-code").innerText = e.keyCode;
        box.querySelector(".key-name").innerText = keyName.toUpperCase();
        box.querySelector(".key span").innerText = keyName;
        box.querySelector(".code span").innerText = e.keyCode;
        box.classList.add("active");
      });
    </script>

  </body>
</html>


<!DOCTYPE html>
<!-- Created By CodingNepal -->
<html lang="en" dir="ltr">
   <head>
      <meta charset="utf-8">
      <title>Responsive Owl-Carousel Slider | CodingNepal</title>
      <link rel="stylesheet" href="style.css">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
   </head>
   <body>
      <div class="wrapper">
         <div class="carousel owl-carousel">
            <div class="card card-1">
               A
            </div>
            <div class="card card-2">
               B
            </div>
            <div class="card card-3">
               C
            </div>
            <div class="card card-4">
               D
            </div>
            <div class="card card-5">
               E
            </div>
         </div>
      </div>
      <script>
         $(".carousel").owlCarousel({
           margin: 20,
           loop: true,
           autoplay: true,
           autoplayTimeout: 2000,
           autoplayHoverPause: true,
           responsive: {
             0:{
               items:1,
               nav: false
             },
             600:{
               items:2,
               nav: false
             },
             1000:{
               items:3,
               nav: false
             }
           }
         });
      </script>
   </body>
</html>


<style media="screen">
  /* carowsol */

  @import url('https://fonts.googleapis.com/css?family=Poppins:400,500,600,700&display=swap');
  *{
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Poppins', sans-serif;
  }
  body{
    min-height: 100vh;
    display: flex;
    align-items: center;
  }
  .wrapper{
    width: 100%;
  }
  .carousel{
    max-width: 1200px;
    margin: auto;
    padding: 0 30px;
  }
  .carousel .card{
    color: #fff;
    text-align: center;
    margin: 20px 0;
    line-height: 250px;
    font-size: 90px;
    font-weight: 600;
    border-radius: 10px;
    box-shadow: 0px 4px 15px rgba(0,0,0,0.2);
  }
  .carousel .card-1{
    background: #ed1c24;
  }
  .carousel .card-2{
    background: #0072bc;
  }
  .carousel .card-3{
    background: #39b54a;
  }
  .carousel .card-4{
    background: #f26522;
  }
  .carousel .card-5{
    background: #630460;
  }
  .owl-dots{
    text-align: center;
    margin-top: 40px;
  }
  .owl-dot{
    height: 15px;
    width: 45px;
    margin: 0 5px;
    outline: none;
    border-radius: 14px;
    border: 2px solid #0072bc!important;
    box-shadow: 0px 4px 15px rgba(0,0,0,0.2);
    transition: all 0.3s ease;
  }
  .owl-dot.active,
  .owl-dot:hover{
    background: #0072bc!important;
  }


</style>
