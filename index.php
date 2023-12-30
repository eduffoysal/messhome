<?php
include('db.php');
 session_start();

if(isset($_SESSION['user'])){
    $_SESSION['visitor_id']=$_SESSION['user'];
    $_SESSION['unique_id']=$_SESSION['user'];
    $_SESSION['role']='member';
}else{
    header("location:c");
}


if(!isset($_SESSION['user'])){
    header('location:c');
}



    $nn=$_SESSION['user'];
    // echo $nn;
    $sn="SELECT * FROM users WHERE unique_id='$nn'";

    $imgss=mysqli_query($con,$sn);
    $ti=mysqli_fetch_assoc($imgss);

    $nametitle=$ti['user_name'];
    $iiim = $ti['phone'];
      $iimv=$ti['user_name'];

      $my_mess=$ti['mess_id'];

      $_SESSION['my_mess_id'] = $my_mess;

      if($my_mess!=''){

        $snr="SELECT * FROM mess_main WHERE mess_id='$my_mess'";

        $imgssr=mysqli_query($con,$snr);
        $tir=mysqli_fetch_assoc($imgssr);
        $nu=mysqli_num_rows($imgssr);

        if($nu<1){
          $messname='You have to add a valid Mess Id!';
        }else{
          $messname=$tir['mess_name'];
        }


      }else{

        $messname='You are not added on any mess!';

        $my_mess='Not Found';

      }




?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">

    <title><?=$iimv?>--<?=$nametitle?>-EdULearn</title>
    <link rel="shortcut icon" href="image/<?=$iiim?>" type="image/x-icon" />

        <script src="https://kit.fontawesome.com/a076d05399.js"></script>

        <script src="https://code.jquery.com/jquery-3.4.1.js"></script>


    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <link rel="stylesheet" href="icon/bootstrap-icons.css">

    <!-- <script src="ck/ckeditor.js"></script> -->
    <!-- <script src="f/admin/ckeditor/ckeditor.js"></script> -->

    <script src="//cdn.ckeditor.com/4.16.2/full/ckeditor.js"></script>

    <script src="jquery-3.5.1.min.js"></script>

    <link rel="stylesheet" href="css/user.css">

    <link rel="stylesheet" href="dist/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

    <link rel="stylesheet" href="https://unpkg.com/flowbite@1.5.3/dist/flowbite.min.css" />
    <script src="https://unpkg.com/flowbite@1.5.3/dist/flowbite.js"></script>
    <script src="./TW-ELEMENTS-PATH/dist/js/index.min.js"></script>
    <!-- <script src="https://cdn.jsdelivr.net/npm/tw-elements/dist/js/index.min.js"></script> -->

    <link rel="stylesheet" href="node_modules/tw-elements/dist/css/index.min.css" />
    <!-- <script src="node_modules/tw-elements/dist/js/index.min.js"></script> -->
    <script src="node_modules/flowbite/dist/flowbite.js"></script>


<style>



:root {
  --primary-color: rgb(255, 92, 92);
  --primary-variant: #ff2d2d;
  --secondary-color: #1b9999;
  --on-primary: rgb(250, 250, 250);
  --on-background: rgb(66, 66, 66);
  --on-background-alt: rgba(66, 66, 66, 0.7);
  --background: rgb(255, 255, 255);
  --box-shadow: 0 5px 20px 1px rgba(0, 0, 0, 0.5);
}

[data-theme="dark"] {
  --primary-color: rgb(150, 65, 255);
  --primary-variant: #6c63ff;
  --secondary-color: #03dac5;
  --on-primary: #000;
  --on-background: rgba(255, 255, 255, 0.9);
  --on-background-alt: rgba(255, 255, 255, 0.7);
  --background: #121212;
}

html {
  box-sizing: border-box;
  scroll-behavior: smooth;
}

body {
  margin: 0;
  padding-bottom: 70px;
  color: var(--on-background);
  font-family: Comfortaa, sans-serif;
  background-color: var(--background);
  background-image: url("data:image/svg+xml,%3Csvg width='180' height='180' viewBox='0 0 180 180' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M81.28 88H68.413l19.298 19.298L81.28 88zm2.107 0h13.226L90 107.838 83.387 88zm15.334 0h12.866l-19.298 19.298L98.72 88zm-32.927-2.207L73.586 78h32.827l.5.5 7.294 7.293L115.414 87l-24.707 24.707-.707.707L64.586 87l1.207-1.207zm2.62.207L74 80.414 79.586 86H68.414zm16 0L90 80.414 95.586 86H84.414zm16 0L106 80.414 111.586 86h-11.172zm-8-6h11.173L98 85.586 92.414 80zM82 85.586L87.586 80H76.414L82 85.586zM17.414 0L.707 16.707 0 17.414V0h17.414zM4.28 0L0 12.838V0h4.28zm10.306 0L2.288 12.298 6.388 0h8.198zM180 17.414L162.586 0H180v17.414zM165.414 0l12.298 12.298L173.612 0h-8.198zM180 12.838L175.72 0H180v12.838zM0 163h16.413l.5.5 7.294 7.293L25.414 172l-8 8H0v-17zm0 10h6.613l-2.334 7H0v-7zm14.586 7l7-7H8.72l-2.333 7h8.2zM0 165.414L5.586 171H0v-5.586zM10.414 171L16 165.414 21.586 171H10.414zm-8-6h11.172L8 170.586 2.414 165zM180 163h-16.413l-7.794 7.793-1.207 1.207 8 8H180v-17zm-14.586 17l-7-7h12.865l2.333 7h-8.2zM180 173h-6.613l2.334 7H180v-7zm-21.586-2l5.586-5.586 5.586 5.586h-11.172zM180 165.414L174.414 171H180v-5.586zm-8 5.172l5.586-5.586h-11.172l5.586 5.586zM152.933 25.653l1.414 1.414-33.94 33.942-1.416-1.416 33.943-33.94zm1.414 127.28l-1.414 1.414-33.942-33.94 1.416-1.416 33.94 33.943zm-127.28 1.414l-1.414-1.414 33.94-33.942 1.416 1.416-33.943 33.94zm-1.414-127.28l1.414-1.414 33.942 33.94-1.416 1.416-33.94-33.943zM0 85c2.21 0 4 1.79 4 4s-1.79 4-4 4v-8zm180 0c-2.21 0-4 1.79-4 4s1.79 4 4 4v-8zM94 0c0 2.21-1.79 4-4 4s-4-1.79-4-4h8zm0 180c0-2.21-1.79-4-4-4s-4 1.79-4 4h8z' fill='%233ca5bb' fill-opacity='0.29' fill-rule='evenodd'/%3E%3C/svg%3E");
}






.fotter-section nav{

  width: 25px;
  transition: all 0.3s linear;

}
.fotter-section nav div{
  height: 40px;
  position:relative;
}
.fotter-section nav div .a{

  display: block;
  height: 100%;
  width: 100%;
  line-height: 20px;

  transition: all .3s linear;


}
/* .fotter-section nav div:nth-child(1) .a{
  background: #3b5998;
} */
/* .fotter-section nav div:nth-child(2) .a{
  background: #00acee;
}
.fotter-section nav div:nth-child(3) .a{
  background: #cd486b;
}
.fotter-section nav div:nth-child(4) .a{
  background: #0077b5;
}

.fotter-section nav div:nth-child(5) .a{
  background: #ff0000;
} */
.fotter-section nav div .a i{
  position:absolute;
  margin-top: 6px;
  font-size: 25px;

}
.fotter-section  div .a span{
  display: none;
  font-weight: bold;
  font-size:40px;

  letter-spacing: 1px;
  text-transform: uppercase;
}
.fotter-section .a:hover {
  z-index:1;
  width: 500px;
}
.fotter-section  div:hover .a span{
  padding-left: 20%;
  display: block;
}


.tophead{
    font-family:'Poppins', sans-serif;
    margin:0;
    padding:0;
    outline: none;
    border: none;
    text-decoration:none;
    text-transform:capitalize;
    scroll-behavior:smooth;
    top: 3px;
    left:0;
    right:0;
    /* height: 70px; */
    z-index: 1000;

}
.topheader{
  transition: transform 0.3s;
}
.nav-hidden{
  transform: translateY(60px);
  /* transform: translateY(clac(-1 * var(60px))); */
  box-shadow:none;

}
.topheader .topnav{
    display:flex;
    background:cyan;

}
.topheader .topnav a{
    flex:1;
    text-align:center;
    font-size: 14px;
    line-height:50px;
    text-decoration:none;
    color:white;
    text-transform:capitalize;
    font-family:'Poppins', sans-serif;


}
.topheader .topnav a span{
    padding-left:5px;


}
.topheader .topnav a:hover{
    filter:brightness(.7);
    color:black;

}
.topheader .topnav a:nth-child(1){
    background: #e74c3c;
}

.topheader .topnav a:nth-child(2){
    background: #27ae60;
}

.topheader .topnav a:nth-child(3){
    background: #2980b9;
}

.topheader .topnav a:nth-child(4){
    background: #8e44ad;
}

.topheader .topnav a:nth-child(5){
    background: #f39c12;
}

.topcontainer{
    /* display:flex; */

}


#postUser, #postOthers, #signUp, #logIn, #all_class_sections{
  display:none;
}

/* age calculator */

.containerAge
{

    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%,-50%);
    padding: 50px 30px;
}
.containerAge *
{
    outline: none;
    border: none;
}
.containerAge .inputs-wrapper
{
    background-color: #fff;
    padding: 30px 25px;
    box-shadow: 0 15px 25px rgba(0,0,0,0.3);
    border-radius: 8px;
    margin-bottom: 50px;
}
.inputs-wrapper input,
.inputs-wrapper button
{
    background: #0a6cf1;
    border-radius: 5px;
    color: #fff;
    font-weight: 500;
    height: 50px;
}
.inputs-wrapper input
{
    width: 60%;
    padding: 0 20px;
    font-size: 14px;
    color: #fff;
}
.inputs-wrapper button
{
    width: 30%;
    float: right;
    padding: 0 20px;
    cursor: pointer;
}
.output
{
    width: 100%;
    display: flex;
    justify-content: space-between;
}
.output div
{
    width: 100px;
    height: 100px;
    color: #0a6cf1;
    background: #fff;
    box-shadow: 0 15px 25px rgba(0,0,0,0.3);
    display: grid;
    place-items: center;
    border-radius: 50%;
    padding: 20px 0;
}
.output div span
{
    font-size: 30px;
    font-weight: 500;
}
.output div p
{
    font-size: 14px;
    color: #707070;
    font-weight: 400;
}


@media(max-width:400px){
    .topname{
        display: none;
    }
}

/* video */

@import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');
*

.material-icons
{
    user-select: none;
    -webkit-user-select: none;
    cursor: pointer;
}

#section
{
    justify-content: center;
    align-items: center;
    min-height: calc(100vh - 51px);
    width: 100%;
    padding: 1.7%;
}



    #sob{
    /* background-color: red; */
    /* background-color: rgb(255 255 255 / 50%); */

}
#sob:hover{
    /* background-color: #171745; */
}
.grid-container {
  display: grid;
  grid-template-columns: auto auto auto;
  background-color: #250657;
}
.rowwhi{
    margin-right:5px;
}
@media(max-width:768px){

        /* grid-template-columns: 1fr; */
.grid-container {
  display: inline;
  grid-template-columns: auto auto auto;
  background-color: #2E1405;
}

}



/* container content */



.content{
    display: flex;
    /* width: 50%; */
    justify-content: center;
    font-family: "Poppins",sans-serif;
    background: #000;
    text-align: center;
    min-height: 50px;


}
.content{
    position: relative;
    justify-content: center;
    text-align: center;
    box-shadow:0px 8px 8px rgb(0, 0, 0);

}
.content h2{
    font-variant: small-caps;
    font-family: sans-serif;
    font-weight: bold;
    position: absolute;
    font-size: 1.8rem;
    text-transform: capitalize;
    /* margin-left: 1%; */
    /* padding-left: 10%; */


}
.content h2:nth-child(1){
    /* position: relative; */
    color: transparent;
    -webkit-text-stroke: 2px #03a9f4;
}
.content h2:nth-child(2){
    color: #03a9f4;
    animation: anim 4s ease-in-out infinite;
}
@keyframes anim {
    0%,100%{
        clip-path: polygon(0% 45%, 15% 44%, 32% 50%, 54% 60%, 70% 61%, 84% 59%, 100% 52%, 100% 100%, 0% 100%);
    }
    50%{
        clip-path: polygon(0% 60%, 16% 65%, 34% 66%, 51% 62%, 67% 50%, 84% 45%, 100% 46%, 100% 100%, 0% 100%);
    }
}


.msg{

        position: fixed;
        bottom: 12%;

        /* right:50%; */
        left: 45%;
        /* width: 50px; */
        /* height: 50px; */
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;

        color:#1f1f1f;
        opacity:1;
        transition:all 0.5s;
        /* transition:all 10s; */
        animation-name: mff;
        animation-duration: 10s;
        animation-fill-mode: forwards;
        animation-iteration-count: infinite;
        z-index:9999;
    }
    #msg:hover{

        pointer-events:auto;
        color: blue;

        /* transform: rotate(-360deg); */
        opacity: 0.8;

    }
/* nav profile setting */

.msgfar{
        position: fixed;
        top: 8%;
        right:-2px;
        /* width: 100px; */
        height: 25px;
        border: 2px solid white;
        border-radius: 25% 0% 0% 25%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size:25px;
        opacity:1;
        transition:all 0.5s;
        /* transition:all 10s; */
        animation-name: mff;
        animation-duration: 10s;
        animation-fill-mode: forwards;
        animation-iteration-count: infinite;
    }
    #msgfar:hover{

        pointer-events:auto;
        color: yellow;
        /* background-color: blue; */
        /* transform: ; */
        opacity: 0.8;

    }

.menu-main{
  position: relative;
  /* width: 90px; */
  /* height: 90px; */
  display: flex;
  align-items: center;
}
.menu-main .menu-t{
  position: absolute;
  width: 45px;
  height: 45px;
  background: #fff;
  border-radius:50%;
  display: flex;
  justify-content: center;
  align-items:center;
  font-size: 2em;
  curson: pointer;
  transition: 0.5s;

}
.menu-main .menu-t.active{
  /* transform: rotate(-315deg); */
  box-shadow: 0 0 0 40px #fff;
  background: #222237;
  color: #fff;
}
.menu-main li{
  position: absolute;
  right: -2px;
  list-style: none;
  transform: rotate(calc(360deg / 7 * var(--i))) translateX(-5px);
  transform-origin: 60px;
  visibility: hidden;
  opacity: 0;
  transition: 0.5s;
  z-index: 10;
}
.menu-main.active li{
  visibility: visible;
  opacity: 1;
}
.menu-main a{
  text-decoration: none;
  display: flex;
  justify-content: center;
  align-items: center;
  width: 40px;
  height: 40px;
  font-size: 1.7em;
  color: #222327;
  transform: rotate(calc(360deg / -7 * var(--i)));
  border-radius: 50%;


}
.menu-main.active li.active{
  transform: rotate(calc(360deg / 7 * var(--i))) translateX(-20px);
  background: white;
  /* color: white; */
  border-radius: 50%;
  border: 2px solid #222237;
}


.profile_boxx{
  background: #ff574a;
  text-align: center;
  padding: 20px 20px;
  color: #fff;
  position: relative;
  border-radius: 20px;
}
.menu_class{
  width: 25px;
  position: absolute;
  left: 35px;
  top: 20px;
  cursor: pointer;
}
.setting_class{
  width: 25px;
  position: absolute;
  right: 35px;
  top: 20px;
  cursor: pointer;
}
.class_pic_icon{
  width: 150px;
  height: 150px;
  border-radius:50%;
  border: 3px solid ghostwhite;
  background: #ff574f;
  padding: 6px;
  margin: 0 auto;
  text-align: center;
  cursor: pointer;

}
.profile_button_class{
  background: #fff;
  color: #999;
  padding: 20px 0;
  margin-right: -20px;
  margin-left: -20px;
  border-radius: 20px;
  margin-bottom: -20px;

}
.profile_button_icon{
  width: 15px;
  margin-top: 0px;
  cursor: pointer;
}
.profile_boxx button{
  background: #fff;
  color: #ff574a;
  border: none;
  outline: none;
  box-shadow: 0 5px 10px rgba(244, 67, 54, 0.5);
  padding:15px 20px;
  cursor: pointer;
  border-radius: 30px;
  margin-bottom: -20px;
  font-weight: 600;
  font-size: 16px;
  margin-top: -10px;
}
.profile_boxx h3{
  font-size: 22px;
  margin-top: 5px;
  font-weight: 550;
}
.show_matarial.active{
  display: none;
}
.section_show_part.active{
  display: none;
}
.back_button{
  background: #fff;
  color: #ff574a;
  border: none;
  outline: none;
  box-shadow: 0 5px 10px rgba(244, 67, 54, 0.5);
  padding:2px;
  cursor: pointer;
  border-radius: 30px;
  font-weight: 600;
  font-size: 25px;

}


.project_list .category {
    width: 20px;
    height: 30px;
    margin-left: -2px;
    background-color: rebeccapurple;
    border-radius: 0px 10px 10px 0px;
    position: absolute;
    /* left: 0; */
}
.category_color1{
    background-color: tan !important;
}
.category_color2{
    background-color: rebeccapurple !important;
}
.category_color3{
    background-color: sandybrown !important;
}
.category_color4{
    background-color: lightcyan !important;
}




.meal_button_add {
    width: 50px;
    height: 50px;
}
.plus_meal_button_b{
  font-size: 35px;
  /* padding-top: 10px; */

}


.wrapper_user_per{
  display: inline-flex;
  background: #fff;
  height: 100px;
  width: 100%;
  align-items: center;
  justify-content: space-evenly;
  border-radius: 5px;
  padding: 20px 15px;
  box-shadow: 5px 5px 30px rgba(0,0,0,0.2);
}
.wrapper_user_per .optionu{
  background: #fff;
  height: 100%;
  width: 100%;
  display: flex;
  align-items: center;
  justify-content: space-evenly;
  margin: 0 10px;
  border-radius: 5px;
  cursor: pointer;
  padding: 0 10px;
  border: 2px solid lightgrey;
  transition: all 0.3s ease;
}
.wrapper_user_per .optionu .dotu{
  height: 20px;
  width: 20px;
  background: #d9d9d9;
  border-radius: 50%;
  position: relative;
}
.wrapper_user_per .optionu .dotu::before{
  position: absolute;
  content: "";
  top: 4px;
  left: 4px;
  width: 12px;
  height: 12px;
  background: #0069d9;
  border-radius: 50%;
  opacity: 0;
  transform: scale(1.5);
  transition: all 0.3s ease;
}

#optionu-1:checked:checked ~ .optionu-1,
#optionu-2:checked:checked ~ .optionu-2{
  border-color: #0069d9;
  background: #0069d9;
}
#optionu-1:checked:checked ~ .optionu-1 .dotu,
#optionu-2:checked:checked ~ .optionu-2 .dotu{
  background: #fff;
}
#optionu-1:checked:checked ~ .option-1 .dotu::before,
#optionu-2:checked:checked ~ .optionu-2 .dotu::before{
  opacity: 1;
  transform: scale(1);
}
.wrapper_user_per .optionu span{
  font-size: 20px;
  color: #808080;
}
#optionu-1:checked:checked ~ .optionu-1 span,
#optionu-2:checked:checked ~ .optionu-2 span{
  color: #fff;
}



::selection{
  background: #d5bbf7;
}
.card_m{
  max-width: 90%;
  width: 100%;
  margin: 0 auto;
  background: #fff;
  border-radius: 5px;
  padding: 5px;
  box-shadow: 0 5px 10px rgba(0, 0, 0, 0.15);
}
.card_m .title_m{
  font-size: 22px;
  font-weight: 500;
}
.card_m .content_m{
  margin-top: 10px;
}
.card_m  label.box_m{
  background: #ddd;
  margin-top: 8px;
  padding: 8px 10px;
  display: flex;
  border-radius: 5px;
  border: 2px solid transparent;
  cursor: pointer;
  transition: all 0.25s ease;
}
#one_m:checked ~ label.first_m,
#two_m:checked ~ label.second_m,
#three_m:checked ~ label.third_m,
#four_m:checked ~ label.fourth_m{
  border-color: #8E49E8;
  background: #d5bbf7;
}
.card_m  label.box_m:hover{
  background: #d5bbf7;
}
.card_m  label.box_m .circle_m{
  height: 22px;
  width: 22px;
  background: #ccc;
  border: 5px solid transparent;
  display: inline-block;
  margin-right: 15px;
  border-radius: 50%;
  transition: all 0.25s ease;
  box-shadow: inset -4px -4px 10px rgba(0, 0, 0, 0.2);
}
#one_m:checked ~ label.first_m .circle_m,
#two_m:checked ~ label.second_m .circle_m,
#three_m:checked ~ label.third_m .circle_m,
#four_m:checked ~ label.fourth_m .circle_m{
  border-color: #8E49E8;
  background: #fff;

}
.card_m  label.box_m .plan_m{
  display: flex;
  width: 100%;
  align-items: center;
}
.card_m input[type="radio"]{
  display: none;
}




/*for meal board setting*/
.dashboard {
    width: 60%;
    margin: 0 auto;
    text-align: center;
}

.meal-counter {
    margin-bottom: 20px;
}

.counter {
    display: flex;
    align-items: center;
    justify-content: center;
}

.count {
    font-size: 36px;
    margin: 0 10px;
}

.decrement, .increment {
    padding: 10px 20px;
    font-size: 24px;
    border-radius: 5px;
    background-color: #4CAF50;
    color: white;
    border: none;
    cursor: pointer;
}

.decrement:hover, .increment:hover {
    background-color: #3e8e41;
}


#total-count {
  font-weight: bold;
  font-size: 24px;
}

.dashboard {
  width: 80%;
  margin: 10px auto;
  text-align: center;
  font-family: Arial, sans-serif;
}

.meal-counter {
  margin: 10px 0;
  border: 1px solid #ccc;
  padding: 20px;
  border-radius: 10px;
  box-shadow: 2px 2px 10px #ccc;
}

.counter {
  display: flex;
  justify-content: center;
  align-items: center;
}

.count {
  margin: 0 10px;
  font-size: 24px;
  font-weight: bold;
}

.decrement {
  padding: 8px 20px;
  font-size: 18px;
  border: none;
  border-radius: 5px;
  background-color: #f44336;
  color: white;
  cursor: pointer;
}

.increment {
  padding: 8px 20px;
  font-size: 18px;
  border: none;
  border-radius: 5px;
  background-color: #4CAF50;
  color: white;
  cursor: pointer;
}

.dashboard h1 {
    font-size: 36px;
    margin-bottom: 20px;
}

.dashboard h2 {
    font-size: 24px;
    margin-top: 0;
}


.meal-selector {
  display: flex;
  justify-content: center;
}

.meal-button {
  padding: 8px 16px;
  font-size: 18px;
    display: flex;
  justify-content: center;
  align-items: center;
  border: none;
  border-radius: 50%;
  background-color: #ccc;
  color: white;
  cursor: pointer;
  margin: 0 10%;
    text-align: center;
}

.breakfast-button {
  background-color: #FDB813;
}

.lunch-button {
  background-color: #581845;
}

.dinner-button {
  background-color: #008080;
}

.meal-button:active {
  transform: scale(0.95);
}

/* Flex container */
.container-s {
    display: flex;
    justify-content: flex-end; /* align items to the right */
}

/* Close button */
.close-btn {
    background-color: #ff0000; /* red */
    color: #ffffff; /* white */
    padding: 10px 20px;
    border-radius: 5px;
    text-decoration: none;
    margin-right: 10px; /* add some space between the buttons */
}

/* Save button */
.save-btn {
    background-color: #00ff00; /* green */
    color: #ffffff; /* white */
    padding: 10px 20px;
    border-radius: 5px;
    text-decoration: none;
}

.indivisual_meal{
/*    display:none;*/
}
.redb{
   background-color: red; 
}

.b-buttonn, .l-buttonn, .d-buttonn{
    background-color: green;
}


</style>

<!-- <link rel="stylesheet" href="dist/styles.css"> -->
    <link rel="stylesheet" href="bootstrap.min.css">
    <!-- <script src="bootstrap.budle.min.js"></script> -->
    <link href="//cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css" rel="stylesheet">


<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.css">

<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.js"></script>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.6.0/font/bootstrap-icons.css">

<!-- <link rel="stylesheet" href="dist/styles.css"> -->

<link rel="stylesheet" href="css/carousel_and_other.css">

<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">

<link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
<link rel="stylesheet" href="css/select-menu.css">
<!-- <link rel="stylesheet" href="css/color.css"> -->
<!-- <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'> -->


</head>
<body id="sob" class="bg-">
    <input type="hidden" class="namebuttonn" name="">
<?php
  function getProfilePicture($name){
    $name_slice = explode(' ',$name);
    $name_slice = array_filter($name_slice);
    $initials = '';
    $initials .= (isset($name_slice[0][0]))?strtoupper($name_slice[0][0]):'';
    $initials .= (isset($name_slice[count($name_slice)-1][0]))?strtoupper($name_slice[count($name_slice)-1][0]):'';

    return '<div style=" border-radius:50%; margin: 0 auto" class="profile">'.$initials.'</div>';
  }
?>

<div id="usmsg" class="text-center text-light border-light fixed-top">
<div id="msgfar" class="msgfar text-dark " type="button" data-bs-toggle="modal" data-bs-target="#contactmsgfar">


<div class="flex flex-wrap justify-center space-x-2 items-end" data-bs-toggle="modal" data-bs-target="#allsetting">
  <span
    class="rounded-full text-gray-500 bg-gray-200 font-semibold text-sm flex align-center cursor-pointer active:bg-gray-300 transition duration-300 ease w-max">
    <img class="rounded-full w-9 h-9 max-w-none" alt="A"
      src="https://mdbootstrap.com/img/Photos/Avatars/avatar-6.jpg" />
    <span class="flex items-center px-2 py-1">
      
    <span class="position-relative mt-0 " > <?= getProfilePicture($iimv)?> </span>
    <span id="notifications_counterfar" style="width:20px; height:30px; padding-left:1px; padding-top:2px; text-align: center" class="position-absolute top-0 text-center start-100 translate-middle badge rounded-circle bg-trnsparent"><i class="bi bi-person-plus-fil"></i></span>
<span class="visually-hidden">U</span></span>


    </span>
  </span>

</div>



<nav class="nav-drag" id="navi-2">
    <div class="nav-content">
      <div class="toggle-btn">
        <i class='bx bxs-cog'></i>
      </div>
      <span style="--i:1;">
        <a href="#" id="navioffon" class="navioffon" data-bs-toggle="modal" data-bs-target="#user_meal_modal"><i class='bx bxs-home'></i></a>
      </span>
      <span style="--i:2;">
        <a href="#" class="my_qr_ajax_b" data-bs-toggle="modal" data-bs-target="#qr_modal" id=""><i class='bi bi-person-bounding-box'></i></a>
      </span>
      <span style="--i:3;">
        <a href="#" class="" data-bs-toggle="modal" data-bs-target="#user_pay_modal" id=""><i class='bi bi-cash' ></i></a>
      </span>
      <span style="--i:4;">
        <a href="#" class="" data-bs-toggle="modal" data-bs-target="#user_gen_modal" id=""><i class='bi bi-cart4' ></i></a>
      </span>
      <span style="--i:5;">
        <a href="#" data-bs-toggle="modal" data-bs-target="#user_per_modal"><i class='bx bxs-cog' ></i></a>
      </span>
    </div>
</nav>





</div>
</div>


<?php
// $res_message=mysqli_query($con,"select users.name,messages.msg,messages.incoming_msg_id from messages,users where messages.status=0 and messages.outgoing_msg_id='$_SESSION[unique_id]' and users.unique_id=messages.incoming_msg_id");
// $unread_count=mysqli_num_rows($res_message);

// $sql_user="select unique_id,name from users order by name asc";
// $res_user=mysqli_query($con,$sql_user);
?>



<!-- This example requires Tailwind CSS v2.0+ -->
<!--
  This example requires updating your template:

  ```
  <html class="h-full bg-gray-100">
  <body class="h-full">
  ```
-->


<div class="modal fade" id="qr_modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">

      <div id="myalert_qr" style="display:none;">
        <div class="container col-md-offset-4">
          <div class="alert alert-info">
            <center><span id="alerttext_qr"></span></center>
          </div>
        </div>
      </div> 

        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
<div class="text-center">
<div class="btn-group" role="group" aria-label="Basic radio toggle button group">
  <input type="radio" class="btn-check" name="btnradio" id="btnradio1" autocomplete="off" checked>
  <label class="btn btn-outline-primary qr_b1" id="qr_b1" for="btnradio1">MY-QR</label>

  <input type="radio" class="btn-check" name="btnradio" id="btnradio2" autocomplete="off">
  <label class="btn btn-outline-primary qr_b2" id="qr_b2" for="btnradio2">Card-QR</label>

  <input type="radio" class="btn-check" name="btnradio" id="btnradio3" autocomplete="off">
  <label class="btn btn-outline-primary qr_b3" id="qr_b3" for="btnradio3">MessID</label>
</div>
</div>

        <!-- <div class="qr_qr text-center" > -->
  
                              <div class="qr_1 text-center" id="qr_1">
                              
                              </div>
                              <div class="qr_2 text-center" id="qr_2">
                              
                              </div>
                              <div class="qr_3 text-center" id="qr_3">
                              
                              </div>

        <!-- </div> -->

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <!-- <button type="button" class="btn btn-primary" id="press_btn_s">Press a Button</button> -->
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="user_gen_modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">

      <div id="myalert_ng" style="display:none;">
        <div class="container col-md-offset-4">
          <div class="alert alert-info">
            <center><span id="alerttext_ng"></span></center>
          </div>
        </div>
      </div> 

        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">


        <div class="text-center user_per_gen" id="user_per_gen">
                              



                                                       
<div class="bazar_l_addd add_bazar_codee hiddenn">
<div class="container-fluidd px-1 pb-1">

<form action="" id="manage-course">
    <input type="hidden" name="id" value="<?php echo isset($unique_id) ? $unique_id : '' ?>">
    <div class="row">
    <div id="bazar_msg" class="form-group"></div>
    
    <div class="col">
        <div class="row">

<div class=" justify-center">
<div>
<div class="form-floating mb-1 md:w-100 xl:w-100">
  <input type="text" class="form-control
  block
  w-full
  px-3
  py-1.5
  text-base
  font-normal
  text-gray-700
  bg-white bg-clip-padding
  border border-solid border-gray-300
  rounded
  transition
  ease-in-out
  m-0
  focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none" id="ft" placeholder="name@example.com">
  <label for="ft" class="text-gray-700">Fee Type</label>
</div>
<div class="form-floating mb-3 xl:w-100">
  <input type="number" class="form-control
  block
  w-full
  px-3
  py-1.5
  text-base
  font-normal
  text-gray-700
  bg-white bg-clip-padding
  border border-solid border-gray-300
  rounded
  transition
  ease-in-out
  m-0
  focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none" step="any" min="0" id="amount" placeholder="Amount">
  <label for="floatingPassword" class="text-gray-700">Amount</label>
</div>
</div>
</div>

             <div class="form-group">

  <button type="button" id="add_fee" class="
  w-full
  px-6
  py-2.5
  bg-blue-600
  text-white
  font-medium
  text-xs
  leading-tight
  uppercase
  rounded
  shadow-md
  hover:bg-blue-700 hover:shadow-lg
  focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0
  active:bg-blue-800 active:shadow-lg
  transition
  duration-150
  ease-in-out">Add to List</button>

                
            </div>

        </div>
        <hr>
        <table class="table table-condensed" id="fee-list">
            <thead>
                <tr>
                    <th width="5%"></th>
                    <th width="50%">Type</th>
                    <th width="45%">Amount</th>
                </tr>
            </thead>
            <tbody>

                    <!-- <tr>
                        <td class="text-center"><button class="btn-sm btn-outline-danger" type="button" onclick="rem_list($(this))" ><i class="fa fa-times"></i></button></td>
                        <td>
                            <input type="hidden" name="fid[]" value="0">
                            <input type="hidden" name="type[]" value="0">
                            <p><small><b class="ftype"><?php  ?></b></small></p>
                        </td>
                        <td>
                            <input type="hidden" name="amount[]" value="0">
                            <p class="text-right"><small><b class="famount"><?php  ?></b></small></p>
                        </td>
                    </tr> -->


            </tbody>
            <tfoot>
                <tr>
                    <th colspan="2" class="text-center">Total</th>
                    <th class="text-right">
                        <input type="hidden" name="total_amount" value="<?php  ?>">
                        <span class="tamount"><?php  ?></span>
                    </th>
                </tr>
            </tfoot>
        </table>
        
  <button type="submit" id="add_bazar" class="
  mt-1
  w-full
  px-6
  py-2.5
  bg-danger
  text-white
  font-medium
  text-xs
  leading-tight
  uppercase
  rounded
  shadow-md
  hover:bg-blue-700 hover:shadow-lg
  focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0
  active:bg-blue-800 active:shadow-lg
  transition
  duration-150
  ease-in-out">Submit Bazar List</button>
    </div>
    </div>
</form>
</div>
<div id="fee_clone" style="display: none">
 <table >
        <tr>
            <td class="text-center"><button class="btn-sm btn-outline-danger" type="button" onclick="rem_list($(this))" ><i class="fa fa-times"></i></button></td>
            <td>
                <input type="hidden" name="fid[]">
                <input type="hidden" name="type[]">
                <p><small><b class="ftype"></b></small></p>
            </td>
            <td>
                <input type="hidden" name="amount[]">
                <p class="text-right"><small><b class="famount"></b></small></p>
            </td>
        </tr>
</table>
</div>
</div>




        </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <!-- <button type="button" class="btn btn-primary" id="press_u_per_btn">Press for Payment</button> -->
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="user_pay_modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">

      <div id="myalert_np" style="display:none;">
        <div class="container col-md-offset-4">
          <div class="alert alert-info">
            <center><span id="alerttext_np"></span></center>
          </div>
        </div>
      </div> 

        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">


        <div class="container text-center user_per_pay" id="user_per_pay">
                              

<div class="p-1 bg-white rounded-lg border border-gray-200 shadow-md dark:bg-gray-800 dark:border-gray-700">
    <form class="space-y-2" id="payment_form_data" action="#">
    <div class="sm:hiddenn" id="my_mess_user_all">

    </div>
        <div>
            <input type="month" name="m_for_p_date" id="m_for_p_date" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="payment type" required="">
        </div>
        <div>
            <input type="number" name="number_phone" id="tk_pay" placeholder="Phone number" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required="">
        </div>
        <div>
            <input type="number" name="number_tk" id="tk_pay" placeholder="Amount at least 10/=" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required="">
        </div>
        <div class="flex items-start">
        <input type="hidden" name="payment_data_hidden">
        </div>
        <button type="button" class="w-full payment_user_f_btn text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" id="payment_user_f_btn">Save this payment</button>
    </form>
</div>


        </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <!-- <button type="button" class="btn btn-primary" id="press_u_per_btn">Press for Payment</button> -->
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="user_b_modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered">
    <div class="modal-content">
<!--       <div class="modal-header">

      </div> -->
      <div class="modal-body">

      <div id="myalert_b" style="display:none;">
        <div class="container col-md-offset-4">
          <div class="alert alert-info">
            <center><span id="alerttext_b"></span></center>
          </div>
        </div>
      </div> 

              <div class="mess_users_dis" id="mess_users_dis">
                              
              </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        <!-- <button type="button" class="btn btn-primary" id="press_u_per_btn">Press a Button</button> -->
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="user_per_modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">

      <div id="myalert_n" style="display:none;">
        <div class="container col-md-offset-4">
          <div class="alert alert-info">
            <center><span id="alerttext_n"></span></center>
          </div>
        </div>
      </div> 

        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">


        <div class="container text-center user_per_sett" id="user_per_sett">
                              


        </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="press_u_per_btn">Press a Button</button>
      </div>
    </div>
  </div>
</div>




<div class="modal fade" id="user_meal_modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl modal-fullscreen modal-dialog-scrollable modal-dialog-centered">
    <div class="modal-content">
<!--       <div class="modal-header">



        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div> -->
      <div class="modal-body">

        <div class="container-fluid row text-center user_meal_sett" id="user_meal_sett">





                  <div class="container border-x-2 border-t-rounded border-gray-300 shadow-lg ">


<div class="row border-x-1 border-x-pink-300 border-2 shadow-lg rounded-lg bg-white-200 border-x-2 rounded-top border-y-gray-500 ">
                      <div class="col-12">

                        <div class="user_coverr ">
                          <div class="justify-center items-end" id="">
                            <span
                              class="rounded-full text-grayy-500 bg-red-200 font-semibold text-sm flex align-center cursor-pointer active:bg-gray-300 transition duration-300 ease w-max">
                              <img class="rounded-full w-9 h-9 max-w-none delete_payment" id="id" alt="A"
                                src="https://mdbootstrap.com/img/Photos/Avatars/avatar-6.jpg" />
                              <span class="flex items-center pl-3 py-2">
                                User name
                              </span>
                              <code class="flex text-sm items-center px-1">time</code>
                              <button class="bg-transparent hover focus:outline-none">
                                <i class="bi bi-check"></i>
                              </button>
                                                      <h3> <span id="total-countt">0</span></h3>
                            </span>

                            <div class="meal-selector">
                              <button class="meal-button" id="breakfast-button">B</button>
                              <button class="meal-button" id="lunch-button">L</button>
                              <button class="meal-button" id="dinner-button">D</button>
                            </div>
                          
                          </div>
                        </div>

                      </div>

                    </div>



                  </div>




        </div>

            <div class="indivisual_meal hidden" id="indivisual_meal">
<!--                     <div class="dashboard">
                      <div class="meal-counter">
                        <h2>Breakfast</h2>
                        <div class="counter">
                          <button class="decrement" id="breakfast-decrement">-</button>
                          <span class="count" id="breakfast-count">0</span>
                          <button class="increment" id="breakfast-increment">+</button>
                        </div>
                      </div>
                      <div class="meal-counter">
                        <h2>Lunch</h2>
                        <div class="counter">
                          <button class="decrement" id="lunch-decrement">-</button>
                          <span class="count" id="lunch-count">0</span>
                          <button class="increment" id="lunch-increment">+</button>
                        </div>
                      </div>
                      <div class="meal-counter">
                        <h2>Dinner</h2>
                        <div class="counter">
                          <button class="decrement" id="dinner-decrement">-</button>
                          <span class="count" id="dinner-count">0</span>
                          <button class="increment" id="dinner-increment">+</button>
                        </div>
                      </div>
                      <div class="total-meals">
                        
                        <div class="container-s">
                            <button class="close-btn"><span id="total-count">0</span> - X</button>
                            <button class="save-btn">Save</button>
                        </div>

                      </div>

                    </div>  -->


            </div> 

      </div>
      <div class="modal-footer">

            <button style="text-align: left;" type="button" class="btn btn-outline-danger float-start float-left" data-bs-dismiss="modal">Close</button>
            <button style="text-align: left;" type="button" class="btn btn-outline-danger float-start float-left" data-bs-dismiss="modal">Close</button>
                        <button style="text-align: left;" type="button" class="btn btn-outline-danger float-start float-left" data-bs-dismiss="modal">Close</button>
                                    <button style="text-align: left;" type="button" class="btn btn-outline-danger float-start float-left" data-bs-dismiss="modal">Close</button>
                                    
      <div id="myalert_meal" style="display:none;">
        <div class="container col-md-offset-4">
          <div class="alert alert-info">
            <center><span id="alerttext_meal"></span></center>
          </div>
        </div>
      </div> 

        <button style="text-align: right;" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

        <!-- <button type="button" class="btn btn-primary" id="press_u_per_btn">Press a Button</button> -->
      </div>
    </div>
  </div>
</div>



<div class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="allsetting" aria-hidden="true" id="allsetting">


<div class="modal-dialog container-fluid bg-darkk p-2 m-auto rounded-lg">
<div class="modal-content">
<div class="modal-body">






<div class="flex flex-wrap justify-center space-x-2 items-end" data-bs-dismiss="modal">
  <span
    class="rounded-full text-gray-500 bg-gray-200 font-semibold text-sm flex align-center cursor-pointer active:bg-gray-300 transition duration-300 ease w-max">
    <img class="rounded-full w-9 h-9 max-w-none" alt="A"
      src="https://mdbootstrap.com/img/Photos/Avatars/avatar-6.jpg" />
    <span class="flex items-center px-3 py-2">
    <?=$iimv?>
    </span>
    <button class="bg-transparent hover focus:outline-none">
      <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="times"
        class="w-3 mr-4" role="img" xmlns="http://www.w3.org/2000/svg"
        viewBox="0 0 352 512">
        <path fill="currentColor"
          d="M242.72 256l100.07-100.07c12.28-12.28 12.28-32.19 0-44.48l-22.24-22.24c-12.28-12.28-32.19-12.28-44.48 0L176 189.28 75.93 89.21c-12.28-12.28-32.19-12.28-44.48 0L9.21 111.45c-12.28 12.28-12.28 32.19 0 44.48L109.28 256 9.21 356.07c-12.28 12.28-12.28 32.19 0 44.48l22.24 22.24c12.28 12.28 32.2 12.28 44.48 0L176 322.72l100.07 100.07c12.28 12.28 32.2 12.28 44.48 0l22.24-22.24c12.28-12.28 12.28-32.19 0-44.48L242.72 256z">
        </path>
      </svg>
    </button>
  </span>

</div>








<div class="menu_hidden">
<div class="modal-content menu_dash1 m-auto"  >

  <div class="">
    <button type="button" class="btn-close text-reset float-end" data-bs-dismiss="modal" aria-label="Close"></button>
  </div>

  <li class="menu_dash1-item" id="profile">
    <a href="#profile" class="btn_dash1">
      <i class="far fa-user"></i>
      Mess Setting
    </a>
    <div class="menu_dash1-item__sub">
      <a href="#" class="hide_men setup_mess_id" id="<?=$nn?>">Mess ID</a>
      <a href="#" class="hide_men create_new_mess" id="<?=$nn?>">Create New Mess</a>
    </div>
  </li>
  <li class="menu_dash1-item" id="messages">
    <a href="#messages" class="btn_dash1 hide_me">
      <i class="far fa-envelope"></i>
      Messages
    </a>
    <div class="menu_dash1-item__sub">
      <a href="#" class="hide_men">New</a>
      <a href="#" class="hide_men">Sent</a>
      <a href="#" class="hide_men">Spam</a>
    </div>
  </li>
  <li class="menu_dash1-item" id="settings">
    <a href="#settings" class="btn_dash1 hide_me">
      <i class="fas fa-cog"></i>
      Settings
    </a>
    <div class="menu_dash1-item__sub">
      <a href="#" class="hide_men">Password</a>
      <a href="#" class="hide_men">Language</a>
    </div>
  </li>
  <li class="menu_dash1-item">
    <a href="out" class="btn_dash1">
      <i class="fas fa-sign-out-alt"></i>
      Logout
    </a>
  </li>
  </div>
</div>


<div class="menu_set_table" id="menu_set_table bg-blue-100">
    <div class="popup-sett_meal hidden">
        <div class="content-sett_meal text-justify border-pink-300 border-2 shadow-lg  rounded-lg bg-white-100 p-2">
                <div class="back"><button type="button" class="meal_sett_back_butn float-end text-3xl font-medium ml-5 text-pink-600"><i class="bi bi-arrow-left-circle-fill"></i></button></div>
                <div class="main_meal_sett_body pt-2">

                  <div class="container dis_code_pass justify-center pt-0" id="display_code_pass">
                      <div class="mess_setup_dis">

                      </div>
                  </div>

                </div>
        </div>      
    </div>            
</div>



                    <!-- <span class="text-muted">Student Part</span> -->

                    <!-- <div class="row">
                    <div class="col-md-3">
                            <?php
                              if(isset($_SESSION['unique_id'])){

                                echo '<a href="user/exam/login.php"><button type="button" class="btn btn-outline-light text-uppercase mt-2 w-100">Quiz</button></a>';
                              }else {

                                echo '<a href="../login.php"><button type="button" class="btn btn-outline-light mt-2 w-100">এই বাটনে আপনার অনুমতি নেই!</button></a>';
                              }
                            ?>  <?php
                              if(isset($_SESSION['unique_id'])){

                                echo '<a href="user/test/adminpanel/admin"><button type="button" class="btn btn-outline-light text-uppercase mt-2 w-100">Exam 2</button></a>';
                                echo '<a href="user/mess/admin"><button type="button" class="btn btn-outline-light text-uppercase mt-2 w-100">Mess</button></a>';
                              }else {

                                echo '<a href="../login.php"><button type="button" class="btn btn-outline-light mt-2 w-100">A/C</button></a>';
                              }
                            ?>
                            <?php
                              if(isset($_SESSION['unique_id'])){

                                echo '<a href="../logout.php"><button type="button" class="btn btn-outline-light mt-2 w-100">Logout!</button></a>';
                              }else {

                                echo '<a href="../login.php"><button type="button" class="btn btn-outline-light mt-2 w-100">Login Please!</button></a>';
                              }
                            ?>


                      </div>


                      <div class="col-md-3">

                          <a href="user/course.php"><button type="button" class="btn btn-outline-info mt-2 w-100">My Course</button></a>
                          <a href="user/tutor.php"><button type="button" class="btn btn-outline-info mt-2 w-100">ALL TuTor</button></a>
                          <a href="user/mentor.php"><button type="button" class="btn btn-outline-info mt-2 w-100">Tutor Post</button></a>
                      </div>
                      <div class="col-md-3">
                        <a href="user/myrequest.php"><button type="button" class="btn btn-outline-warning mt-2 w-100">My Request</button></a>
                        <a href="user/allstudent.php"><button type="button" class="btn btn-outline-warning mt-2 w-100">ALL Student</button></a>
                        <a href="user/studentpost.php"><button type="button" class="btn btn-outline-warning mt-2 w-100">Student Post</button></a>

                      </div>
                      <div class="col-md-3">
                            <a href="user/mentorpost.php"><button type="button" class="btn btn-outline-danger mt-2 w-100">মেন্টর পোষ্ট</button></a>
                            <a href="user/tutoraccept.php"><button type="button" class="btn btn-outline-danger mt-2 w-100">স্টুডেন্ট রিকোয়েস্ট</button></a>
                            <a href="user/my_student.php"><button type="button" class="btn btn-outline-danger mt-2 w-100">ছাত্র-ছাত্রী</button></a>

                      </div>

                    </div> -->

                      <!-- <span class="text-muted">Student & Teacher Part</span> -->
                      </div>
                    </div>
                    </div>
</div>


<div class="min-h-full">
  <nav class="bg-gray-800">


    <!-- Mobile menu, show/hide based on menu state. -->


      <div class="pt-1 pb-0 border-t border-gray-700">
        <div class="flex items-center px-5">
          <div class="flex-shrink-0 dropup-center dropup">
            <img class="h-10 w-10 rounded-full" src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" dropdown-toggle type="button" id="dropupCenterBtn" data-bs-toggle="dropdown" aria-expanded="false" alt="">


            <div style="z-index: 11111111" class="dropdown-menu menu_dash1 mess_profile_dash m-auto" aria-labelledby="dropupCenterBtn" >

            <div class="flex space-x-2 justify-center">
              <div class="namebutton"  data-bs-toggle="modal" data-bs-target="#user_meal_modal">

              <button type="button" class="inline-block px-6 py-2 border-2 border-green-500 text-green-500 font-medium text-xs leading-tight uppercase rounded-full hover:bg-black hover:bg-opacity-5 focus:outline-none focus:ring-0 transition duration-150 ease-in-out"><?=$messname?></button>

              </div>
            </div>

            <div class="container justify-center">
              <div class="all-qr">
                <div class="form-floating mb-1">
                  <input type="text" class="form-control
                  block
                  w-full
                  px-3
                  py-1.5
                  text-base
                  font-normal
                  text-gray-700
                  bg-white bg-clip-padding
                  border border-solid border-gray-300
                  rounded
                  transition
                  ease-in-out
                  m-0
                  focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none" id="floatingPassword" value="<?=$my_mess?>" readonly placeholder="">
                  <label for="floatingPassword" class="text-gray-700"><?=$messname?> Id</label>
                </div>
              </div>

<!--               <div class="mess_users_dis" id="mess_users_dis">
                              
              </div> -->

                <div class="my_qr_code" id="my_qr_code">
                    
                </div>

            </div>

            </div>


          </div>
          <div class="ml-3">
            <div class="text-base font-medium leading-none text-white"><?=$iimv?></div>
            <!-- <div class="text-sm font-medium leading-none text-gray-400">tom@example.com</div> -->
          </div>
          <button type="button" class="ml-auto bg-gray-800 flex-shrink-0 p-1 rounded-full text-gray-400 hover:text-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-800 focus:ring-white" data-bs-toggle="modal" data-bs-target="#allsetting">
            <span class="sr-only">View notifications</span>
            <!-- Heroicon name: outline/bell -->
            <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" aria-hidden="true">
              <path stroke-linecap="round" stroke-linejoin="round" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
            </svg>
          </button>
        </div>
      </div>

  </nav>


  <!-- <main>
    <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">

      <div class="px-4 py-6 sm:px-0">
        <div class="border-4 border-dashed border-gray-200 rounded-lg h-96"></div>
      </div>

    </div>
  </main> -->

</div>





<!--  -->
<div id="navi-1" class="text-center hidden">
<div id="msg" class="msg" type="button" data-bs-toggle="modal" data-bs-target="#contactmsg">
    <div class="menu-main">
      <div class="menu-t"><i class="bi bi-house-fill bihousefill"></i></div>
      <li style="--i:0;" class="menuList0"> <a href="#"> <i id="moon" class="bi bi-moon"></i> </a> </li>
      <li style="--i:1;" class="menuList1"> <a href="#"> <i class="bi bi-calendar-event-fill"></i> </a> </li>
      <li style="--i:2;" class="menuList2" data-bs-toggle="modal" data-bs-target="#user_per_modal"> <a href="#"> <i class="bi bi-pencil-square"></i> </a> </li>
      <li style="--i:3;" class="menuList3"> <a href="#"> <i class="bi bi-person-lines-fill"></i> </a> </li>
      <li style="--i:4;" class="menuList4"> <a href="#"> <i class="bi bi-bag-plus-fill"></i> </a> </li>
      <li style="--i:5;" class="menuList5"> <a href="#"> <i class="bi bi-bag-check-fill"></i> </a> </li>
      <li style="--i:6;" class="menuList6"> <a href="#"> <i class="bi bi-cart4"></i> </a> </li>
    </div>
    <span id="notifications_counter" style="width:20px; height:30px; padding-left:1px; padding-top:2px; text-align: center" class="position-absolute top-0 text-center start-100 translate-middle badge rounded-circle bg-transparent"></span>
<span class="visually-hidden">U</span></span>
                            </div>
</div>

<div class="topheader fixed-bottom">
    <header class="tophead">
        <nav class="topnav">
            <a href="#main" class="btttnu-1"  id="HtmlBtn"><i class="bi bi-house-fill"><span class="topname">HOME</span> <i class="bi bi-share"></i></i></a>
            <a href="#user" class="btttnu-2"><i class="bi bi-activity"><span class="topname" >MESS</span></i></a>
            <a href="#others" class="btttnu-3"><i class="bi bi-three-dots"><span class="topname">ADMIN</span></i></a>
            <a href="#signup" class="btttnu-4"><i class="bi bi-file-earmark-person-fill"><span class="topname">POLL</span></i></a>
            <a href="#login" class="btttnu-5"><i class="bi bi-gear"><span class="topname"><?=$iimv?> </span> <i class="bi bi-person-circle"></i></i></a>

        </nav>
    </header>
</div>




<div class="container text-center">
<!-- <span style="font-size:10px" id="notice" class="text-center text-info">উপরের প্লাস / SignUp বাটনে ক্লিল করে আপনার আইপি লোকেশন দেখুন। ধন্যবাদ!</span> -->
</div>

<div class="container-fluid topcontainer">

<section id="mainHome" class="section msssgu-1">

<div class="container-fluid">

<!-- <div class="count">
      <div class="count-down">
          <div class="box">
            <h3 id="day">000</h3>
            <span>Day</span>
          </div>
          <div class="box">
            <h3 id="hour">00</h3>
            <span>Hour</span>
          </div>
          <div class="box">
            <h3 id="minute">00</h3>
            <span>Minute</span>
          </div>
          <div class="box">
            <h3 id="second">00</h3>
            <span>Second</span>
          </div>
      </div>
    </div> -->

</div>






<!-- update today meal modal start .... -->


<div class="modal fade" id="up_today_meal_modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">

      <div id="myalert_mmmm" style="display:none;">
        <div class="container col-md-offset-4">
          <div class="alert alert-info">
            <center><span id="alerttext_mmmm"></span></center>
          </div>
        </div>
      </div> 

        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">

        <div class="wrapper_up_meal" >
  
                              <div class="carousel carousel-1 carousel_main1 owl-carousel displayCode" id="daily_meal_disp">
                              
                              </div>

        </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="press_btn_s">Press a Button</button>
      </div>
    </div>
  </div>
</div>


<!-- update today meal modal end -->






<!-- add meal modal start .... -->


<div class="modal fade" id="add_new_meal_modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-scrollable modal-dialog-centered">
    <div class="modal-content">
    <div class="modal-header">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body container-fluid">

      <div id="myalert_mmm" style="display:none;">
        <div class="container col-md-offset-4">
          <div class="alert alert-info">
            <center><span id="alerttext_mmm"></span></center>
          </div>
        </div>
      </div>                              

        <div class="popup-add_meal hidden">
          <div class="content-add_meal text-justify border-pink-300 border-2 shadow-lg  rounded-lg bg-white-100 p-2">
                <div class="back"><button type="button" class="meal_add_back_butn float-end text-3xl font-medium ml-5 text-pink-600"><i class="bi bi-arrow-left-circle-fill"></i></button></div>
                <div class="main_meal_add_body pt-2">

                <div class="container justify-center pt-0">
                  <div class="mb-3 xl:w-100">
                    <form action="" role="form" id="specific_meal">
     
                  <?php
          
          
          $list=array();
$month = 12;
$year = 2022;
$today = date("Y-m-d");
$totalDay = date('t');
$curm = date('m', strtotime('-1'));
$cury = date('Y', strtotime('-1'));
$curd = date('d', strtotime('-1'));
          
for($d=1; $d<=$totalDay; $d++)
{
    $time=mktime(12, 0, 0, $curm, $d, $cury);          
    if (date('m', $time)==$curm)       
        $list[]=date('Y-m-d', $time);
   
}     
          ?>
          
          <select class="form-select form-control appearance-none
                      block
                      w-full
                      px-3
                      py-1.5
                      text-base
                      font-normal
                      text-gray-700
                      bg-white bg-clip-padding bg-no-repeat
                      border border-solid border-gray-300
                      rounded
                      transition
                      ease-in-out
                      m-0
                      focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none" aria-label="Default select example" name="todate" id="todate"> 
   <option value="<?php echo $today;?>">Select Date</option>
   <option value="<?php echo $today;?>">For Today</option>
    <?php foreach($list as $key => $value){ ?>
      
       <option value="<?php echo $value;?>"><?php echo $value;?></option>
    <?php } ?>
</select>
            
                  </div>
                </div>  


                <div class="slider-wrap border-pink-200 border-2 rounded-lg">
                    <div class="slider slider-meal ">
                        <div class="slider-inner slider_in1">
                            <div class="item">
                            <div class="card-morn">
                      
                                <input type="radio" name="select_morni" id="option-0" value="0" checked>
                                <label for="option-0" class="lbl1 option text-light ooption-0">
                                  <div class="dot"></div>
                                  <span>0</span>
                                </label>
                              
                              </div>
                            </div>
                            <div class="item">
                            <div class="card-morn">
                      
                                <input type="radio" name="select_morni" id="option-1" value="1">
                                <label for="option-1" class="lbl1 option text-light ooption-1">
                                  <div class="dot"></div>
                                  <span>1</span>
                                </label>
                              
                              </div>
                            </div>
                            <div class="item">
                            <div class="card-morn">
                      
                      <input type="radio" name="select_morni" id="option-0-5" value="0.5">
                      <label for="option-0-5" class="lbl1 option text-light ooption-0-5">
                        <div class="dot"></div>
                        <span>0.5</span>
                      </label>
                    
                    </div>
                            </div>
                            
                            <div class="item">
                            <div class="card-morn">
                      
                                <input type="radio" name="select_morni" id="option-1-5" value="1.5">
                                <label for="option-1-5" class="lbl1 option text-light ooption-1-5">
                                  <div class="dot"></div>
                                  <span>1.5</span>
                                </label>
                              
                              </div>
                            </div>
                            <div class="item">
                            <div class="card-morn">
                      
                                <input type="radio" name="select_morni" id="option-2" value="2">
                                <label for="option-2" class="lbl1 option text-light ooption-2">
                                  <div class="dot"></div>
                                  <span>2</span>
                                </label>
                              
                              </div>
                            </div>
                            <div class="item">
                            <div class="card-morn">
                      
                                <input type="radio" name="select_morni" id="option-2-5" value="2.5">
                                <label for="option-2-5" class="lbl1 option text-light ooption-2-5">
                                  <div class="dot"></div>
                                  <span>2.5</span>
                                </label>
                              
                              </div>
                            </div>
                            <div class="item">
                            <div class="card-morn">
                      
                                <input type="radio" name="select_morni" id="option-3" value="3">
                                <label for="option-3" class="lbl1 option text-light ooption-3">
                                  <div class="dot"></div>
                                  <span>3</span>
                                </label>
                              
                              </div>
                            </div>
                            <div class="item">
                            <div class="card-morn">
                      
                                <input type="radio" name="select_morni" id="option-4" value="4">
                                <label for="option-4" class="lbl1 option text-light ooption-4">
                                  <div class="dot"></div>
                                  <span>4</span>
                                </label>
                              
                              </div>
                            </div>
                            <div class="item">
                                <!-- <h3>Item Nine</h3> -->
                                <div class="card-morn">
                        
                        <input type="radio" name="select_morni" id="option-5" value='5'>
                        <label for="option-5" class="lbl1 option text-light ooption-5">
                          <div class="dot"></div>
                          <span>5</span>
                        </label>
                       
                      </div>
                            </div>
                            <div class="item">
                                <!-- <h3>Item Ten</h3> -->
                                <div class="card-morn">
                       
                       <input type="radio" name="select_morni" id="option-6" value="6">
                       <label for="option-6" class="lbl1 option text-light ooption-6">
                         <div class="dot"></div>
                         <span>6</span>
                       </label>

                      
                     </div>
                            </div>
                          
                        </div>
                    </div>
                    <div class="progress-bar">
                        <div class="prog-bar-inner prog_bar_in1"></div>
                    </div>
                </div>

                <div class="slider-wrap border-pink-200 border-x-2 rounded-lg">
                    <div class="slider slider-meal">
                        <div class="slider-inner slider_in2">
                            <div class="item">
                            <div class="card-morn">
                      
                                <input type="radio" name="select_morni1" id="option1-0" value="0" checked>
                                <label for="option1-0" class="lbl2 option1 text-light ooption1-0">
                                  <div class="dot"></div>
                                  <span>0</span>
                                </label>
                              
                              </div>
                            </div>
                            
                            <div class="item">
                            <div class="card-morn">
                      
                                <input type="radio" name="select_morni1" id="option1-1" value="1">
                                <label for="option1-1" class="lbl2 option1 text-light ooption1-1">
                                  <div class="dot"></div>
                                  <span>1</span>
                                </label>
                              
                              </div>
                            </div>

                            <div class="item">
                            <div class="card-morn">
                      
                      <input type="radio" name="select_morni1" id="option1-0-5" value="0.5">
                      <label for="option1-0-5" class="lbl2 option1 text-light ooption1-0-5">
                        <div class="dot"></div>
                        <span>0.5</span>
                      </label>
                    
                    </div>
                            </div>

                            <div class="item">
                            <div class="card-morn">
                      
                                <input type="radio" name="select_morni1" id="option1-1-5" value="1.5">
                                <label for="option1-1-5" class="lbl2 option1 text-light ooption1-1-5">
                                  <div class="dot"></div>
                                  <span>1.5</span>
                                </label>
                              
                              </div>
                            </div>
                            <div class="item">
                            <div class="card-morn">
                      
                                <input type="radio" name="select_morni1" id="option1-2" value="2">
                                <label for="option1-2" class="lbl2 option1 text-light ooption1-2">
                                  <div class="dot"></div>
                                  <span>2</span>
                                </label>
                              
                              </div>
                            </div>
                            <div class="item">
                            <div class="card-morn">
                      
                                <input type="radio" name="select_morni1" id="option1-2-5" value="2.5">
                                <label for="option1-2-5" class="lbl2 option1 text-light ooption1-2-5">
                                  <div class="dot"></div>
                                  <span>2.5</span>
                                </label>
                              
                              </div>
                            </div>
                            <div class="item">
                            <div class="card-morn">
                      
                                <input type="radio" name="select_morni1" id="option1-3" value="3">
                                <label for="option1-3" class="lbl2 option1 text-light ooption1-3">
                                  <div class="dot"></div>
                                  <span>3</span>
                                </label>
                              
                              </div>
                            </div>
                            <div class="item">
                            <div class="card-morn">
                      
                                <input type="radio" name="select_morni1" id="option-4" value="4">
                                <label for="option1-4" class="lbl2 option1 text-light ooption1-4">
                                  <div class="dot"></div>
                                  <span>4</span>
                                </label>
                              
                              </div>
                            </div>
                            <div class="item">
                                <!-- <h3>Item Nine</h3> -->
                                <div class="card-morn">
                        
                        <input type="radio" name="select_morni1" id="option1-5" value='5'>
                        <label for="option1-5" class="lbl2 option1 text-light ooption1-5">
                          <div class="dot"></div>
                          <span>5</span>
                        </label>
                       
                      </div>
                            </div>
                            <div class="item">
                                <!-- <h3>Item Ten</h3> -->
                                <div class="card-morn">
                       
                       <input type="radio" name="select_morni1" id="option1-6" value="6">
                       <label for="option1-6" class="lbl2 option1 text-light ooption1-6">
                         <div class="dot"></div>
                         <span>6</span>
                       </label>

                      
                     </div>
                            </div>

                            <div class="item">
                            <div class="card-morn">
                      
                      <input type="radio" name="select_morni1" id="option1-7" value="7">
                      <label for="option1-7" class="lbl2 option1 text-light ooption1-7">
                        <div class="dot"></div>
                        <span>7</span>
                      </label>
                    
                    </div>
                            </div>
                            <div class="item">
                            <div class="card-morn">
                      
                      <input type="radio" name="select_morni1" id="option1-8" value="8">
                      <label for="option1-7" class="lbl2 option1 text-light ooption1-8">
                        <div class="dot"></div>
                        <span>8</span>
                      </label>
                    
                    </div>
                            </div>
                          
                        </div>
                    </div>
                    <div class="progress-bar">
                        <div class="prog-bar-inner prog_bar_in2"></div>
                    </div>
                </div>
                
                <div class="slider-wrap border-pink-200 border-x-2 rounded-lg">
                    <div class="slider slider-meal">
                        <div class="slider-inner slider_in3">
                            <div class="item">
                            <div class="card-morn">
                      
                                <input type="radio" name="select_morni2" id="option2-0" value="0" checked>
                                <label for="option2-0" class="lbl3 option2 text-light ooption2-0">
                                  <div class="dot"></div>
                                  <span>0</span>
                                </label>
                              
                              </div>
                            </div>
                            
                            <div class="item">
                            <div class="card-morn">
                      
                                <input type="radio" name="select_morni2" id="option2-1" value="1">
                                <label for="option2-1" class="lbl3 option2 text-light ooption2-1">
                                  <div class="dot"></div>
                                  <span>1</span>
                                </label>
                              
                              </div>
                            </div>
                            <div class="item">
                            <div class="card-morn">
                      
                                <input type="radio" name="select_morni2" id="option2-1-5" value="1.5">
                                <label for="option2-1-5" class="lbl3 option2 text-light ooption2-1-5">
                                  <div class="dot"></div>
                                  <span>1.5</span>
                                </label>
                              
                              </div>
                            </div>
                            <div class="item">
                            <div class="card-morn">
                      
                                <input type="radio" name="select_morni2" id="option2-2" value="2">
                                <label for="option2-2" class="lbl3 option2 text-light ooption2-2">
                                  <div class="dot"></div>
                                  <span>2</span>
                                </label>
                              
                              </div>
                            </div>
                            <div class="item">
                            <div class="card-morn">
                      
                                <input type="radio" name="select_morni2" id="option2-2-5" value="2.5">
                                <label for="option2-2-5" class="lbl3 option2 text-light ooption2-2-5">
                                  <div class="dot"></div>
                                  <span>2.5</span>
                                </label>
                              
                              </div>
                            </div>
                            <div class="item">
                            <div class="card-morn">
                      
                                <input type="radio" name="select_morni2" id="option2-3" value="3">
                                <label for="option2-3" class="lbl3 option2 text-light ooption2-3">
                                  <div class="dot"></div>
                                  <span>3</span>
                                </label>
                              
                              </div>
                            </div>
                            <div class="item">
                            <div class="card-morn">
                      
                                <input type="radio" name="select_morni2" id="option2-4" value="4">
                                <label for="option2-4" class="lbl3 option2 text-light ooption2-4">
                                  <div class="dot"></div>
                                  <span>4</span>
                                </label>
                              
                              </div>
                            </div>
                            <div class="item">
                                <!-- <h3>Item Nine</h3> -->
                                <div class="card-morn">
                        
                        <input type="radio" name="select_morni2" id="option2-5" value='5'>
                        <label for="option2-5" class="lbl3 option2 text-light ooption2-5">
                          <div class="dot"></div>
                          <span>5</span>
                        </label>
                       
                      </div>
                            </div>
                            <div class="item">
                                <!-- <h3>Item Ten</h3> -->
                                <div class="card-morn">
                       
                       <input type="radio" name="select_morni2" id="option2-6" value="6">
                       <label for="option2-6" class="lbl3 option2 text-light ooption2-6">
                         <div class="dot"></div>
                         <span>6</span>
                       </label>

                      
                     </div>
                            </div>

                            <div class="item">
                            <div class="card-morn">
                      
                      <input type="radio" name="select_morni2" id="option2-7" value="7">
                      <label for="option2-7" class="lbl3 option2 text-light ooption2-7">
                        <div class="dot"></div>
                        <span>7</span>
                      </label>
                    
                    </div>
                            </div>
                            <div class="item">
                            <div class="card-morn">
                      
                      <input type="radio" name="select_morni2" id="option2-8" value="8">
                      <label for="option2-7" class="lbl3 option2 text-light ooption2-8">
                        <div class="dot"></div>
                        <span>8</span>
                      </label>
                    
                    </div>
                            </div>
                          
                        </div>
                    </div>
                    <div class="progress-bar">
                        <div class="prog-bar-inner prog_bar_in3"></div>
                    </div>
                </div>

                <div class="flex space-x-2 justify-center pt-2">
                <input class="form-control" placeholder="Phone/User ID" name="mess_s_meal" id="mess_s_meal" type="hidden">
  <button
    type="button"
    data-mdb-ripple="true"
    data-mdb-ripple-color="light"
    class="inline-block px-3 py-2.5 bg-primary text-white font-medium text-xs leading-tight uppercase rounded shadow-lg hover:bg-blue-700 hover:shadow-md focus:bg-blue-700 focus:shadow-lg focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out s_meal_add_btn" id="s_meal_add_btn"
  >REQUEST MEALS</button>
</div>
                </form>

 




                <!-- <div class="slider slider-meal slider-morn owl-carousel">
                  <div class="card card-meal card-morn">

                    <div class="content content-meal content-morn">


                    </div>
                  </div>
                  <div class="card card-meal card-morn">

                    <div class="content content-meal content-morn">


                    </div>
                  </div>
                  <div class="card card-meal card-morn">

                    <div class="content content-meal content-morn">


                    </div>
                  </div>
                </div> -->

                <script>
                  $(".slider-morn").owlCarousel({
                    loop: true,
                    autoplay: true,
                    autoplayTimeout: 2000, //2000ms = 2s;
                    autoplayHoverPause: true,
                  });
                </script>


                    <!-- <div class="card-morn">
                        
                        <input type="radio" name="select_morni" id="option-3" value='3' checked>
                        <label for="option-3" class="option text-light ooption-3">
                          <div class="dot"></div>
                          <span>3</span>
                        </label>
                       
                      </div> -->
                      <!-- <div class="card-morn">
                      
                      <input type="radio" name="select_morni" id="option-1">
                      <label for="option-1" class="option text-light ooption-1">
                        <div class="dot"></div>
                        <span>1</span>
                      </label>
                     
                    </div> -->
                    <!-- <div class="card-morn">
                       
                       <input type="radio" name="select_morni" id="option-2">
                       <label for="option-2" class="option text-light ooption-2">
                         <div class="dot"></div>
                         <span>half</span>
                       </label>

                      
                     </div> -->


                



                  <!-- <div class="select-menu select-menu-1">
                      <div class="select-btn select-btn">
                          <span class="sBtn-text sBtn-text-1">Select your option</span>
                          <i class="bx bx-chevron-down"></i>
                      </div>

                      <ul class="options options-1">
                          <li class="option option-1">
                              <i class="bx bxl-github" style="color: #171515;"></i>
                              <span class="option-text option-text-1">Github</span>
                          </li>
                      </ul>
                  </div> -->

                </div>
          </div>
        </div>

              <div class="container text-center text-justify">
                                <div style="cursor: pointer" class="view-modal-add_meal border-dashed border-2 shadow-lg border-primary rounded bg-white-100 ">
                                  <div class="meal_button_add pointer m-auto border-dashed border-primary border-2 rounded-circle">
                                    <i class="bi bi-plus text-primary plus_meal_button_b"></i>
                                  </div>
                                </div>
              </div>

              <div class="row text-justify mt-2">

                        <div class="row_meal_board_main p-2 border-white-300 border-2 shadow-lg border-white-200 rounded-lg bg-white-200">
                              <div class="meal_my">

                                <div class="future_meals" id="future_meals">
                                
                                </div>
 


                              <!-- <div class="accordian-meal border-blue-100 rounded-lg border-2 shadow-lg bg-blue-400">
                                  <div class="row">
                                  <div class="col-9 text-center">
                                  <button
                                      type="button"
                                      data-mdb-ripple="true"
                                      data-mdb-ripple-color="light"
                                      class="inline-block px-6 py-2.5 bg-blue-400 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out"
                                    >28th August 2022 <code>3</code> </button>
                                  </div>
                                  <div class="col-3 text-center">
                                  <div class="flex space-x-2 justify-center">
                                    <button
                                      type="button"
                                      data-mdb-ripple="true"
                                      data-mdb-ripple-color="light"
                                      class="inline-block px-6 py-2.5 bg-blue-400 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out"
                                    >:</button>
                                    <button
                                      type="button"
                                      data-mdb-ripple="true"
                                      data-mdb-ripple-color="light"
                                      class="inline-block px-6 py-2.5 bg-blue-400 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out"
                                    >Del</button>
                                  </div>
                                  </div>
                                  </div>
                                  
                                  <div class="row meal_num text-center">
                                    <div class="col-4  m-auto  rounded-lg ">

                                        <div style="margin-left:0;margin-right: 0" class="bg-teal-200 text-sm">সকাল</div>
                                        <div class="m-auto">    <input
                                                  type="tel"
                                                  class="
                                                    text-center
                                                    form-control
                                                    block
                                                    w-full
                                                    px-3
                                                    py-1.5
                                                    text-base
                                                    font-normal
                                                    text-gray-700
                                                    bg-white bg-clip-padding
                                                    border border-solid border-gray-300
                                                    rounded
                                                    transition
                                                    ease-in-out
                                                    m-0
                                                    focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none
                                                  "
                                                  id="exampleTel0"
                                                  placeholder="Breakfast"
                                                /></div>

                                    </div>
                                    <div class="col-4  m-auto  rounded-lg ">

                                        <div style="margin-left:0;margin-right: 0px" class="bg-rose-200 text-sm">দুপুর</div>
                                        <div class="m-auto">    <input
                                            type="tel"
                                            class="
                                              text-center
                                              form-control
                                              block
                                              w-full
                                              px-3
                                              py-1.5
                                              text-base
                                              font-normal
                                              text-gray-700
                                              bg-white bg-clip-padding
                                              border border-solid border-gray-300
                                              rounded
                                              transition
                                              ease-in-out
                                              m-0
                                              focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none
                                            "
                                            id="exampleTel0"
                                            placeholder="Launch"
                                          /></div>

                                    </div>
                                    <div class="col-4  m-auto  rounded-lg ">

                                        <div style="margin-left:0px;margin-right: 0px" class="bg-cyan-300 text-sm">রাত</div>
                                        <div class="m-auto">    <input
                                            type="tel"
                                            class="
                                              text-center
                                              form-control
                                              block
                                              w-full
                                              px-3
                                              py-1.5
                                              text-base
                                              font-normal
                                              text-gray-700
                                              bg-white bg-clip-padding
                                              border border-solid border-gray-300
                                              rounded
                                              transition
                                              ease-in-out
                                              m-0
                                              focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none
                                            "
                                            id="exampleTel0"
                                            placeholder="Dinner"
                                          /></div>

                                    </div>
                                  </div>                          
                        
                              </div>                               -->





                              </div>
                        </div>

              </div>
        

      </div>
      <!-- <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Understood</button>
      </div> -->
    </div>
  </div>
</div>


<!-- add meal modal end -->








<!-- <div class="container content">
  <h2><?=$iimv ?></h2>
  <h2><?=$iimv ?></h2>
</div> -->

<!-- <div class="container-fluid show_matariall active mt-2 " id="">
  <button class="back_buttonn"><i class="bi bi-arrow-left-circle-fill"></i></button>
  <div id="show_matarialss">

  </div>

</div> -->
<div style="margin-top:0px;" class="container notice border-x-4  text-rose-400 rounded-lg border-teal-600 bg-white all_mess_meals meal_disp_bttn monthly_cal_dis all_button">
  <marquee class="mt-2" behavior="continue" direction="">This is Notice Board</marquee>
</div>

<div class="container-fluid section_show_part bg-dar mtt-0 p-1">
  <div class="row" id="class_sections_heree">



                      <div class="project_list">
                        <div class="row text-justify">

                          <div class="col-md-3 bg-whit dark:bg-slte-800 rounded-tl-lg border-sky-300 border-double shadow-inner hover:shadow-lg">


                            <div class="my_meal_display_he" id="my_meal_display_he">

                            </div>


                          </div>

                          <div class="col-md-6 all_mess_meals meal_disp_bttn" >
                            <div class="row meal_board text-center px-1" id="sum_meals_dis">



                            </div>

                          <div class="accordion">
                              <div class="accordion-item">
                                  <h2 style="font-size:15px" class="accordion-button text-sm all_mess_meals" data-bs-target="#childone" data-bs-toggle="collapse">আজকের মিল বোর্ডঃ <?php echo date('l, M jS'); ?></h2>
                                  <div id="childone" class="accordion-collapse collapse show">
                                      <div class="accordion-body p-2 border-x-4 border-green-600 shadow-inner hover:shadow-lg">


                                        <div class="h-screenn bg-gray-100">
                                          <!-- <h1 class="text-xl mb-2">Your orders</h1> -->

                                          <div class="overflow-auto rounded-lg shadow hidden md:block">
                                            <table class="w-full">
                                              <thead class="bg-gray-50 border-b-2 border-gray-200 all_mess_meals">
                                              <tr>
                                                <th class="w-20 p-3 text-sm font-semibold tracking-wide text-left">No./Name</th>
                                                <th class="w-24 p-3 text-sm font-semibold tracking-wide text-left">BreakFast</th>
                                                <th class="w-24 p-3 text-sm font-semibold tracking-wide text-left">Launch</th>
                                                <th class="w-24 p-3 text-sm font-semibold tracking-wide text-left">Dinner</th>
                                                <th class="w-32 p-3 text-sm font-semibold tracking-wide text-left">Total</th>
                                              </tr>
                                              </thead>
                                              <tbody class="divide-y divide-gray-100 all_mess_meals"id="all_o_mess_meals">
                                              
                                              <!-- <div class="all_o_mess_meals" >
                                              
                                              </div> -->

                                              </tbody>
                                            </table>
                                          </div>

                                          <div class="grid grid-cols-1 all_mess_meals sm:grid-cols-2 gap-2 md:hidden">
                                            
                                            <div class="all_t_mess_meals" id="all_t_mess_meals">
                                            
                                            

                                            <!--<div class="bg-white space-y-3 p-2 rounded-lg shadow">-->
                                            <!--  <div class="flex  space-x-2 text-sm">-->
                                            <!--    <div>-->
                                            <!--      <a href="#" class="text-blue-500 font-bold hover:underline">#Farhad Farid Foysal</a>-->
                                            <!--    </div>-->
                                            <!--    <div class="text-gray-500 text-sm  float-end">10/10/2021</div>-->

                                            <!--  </div>-->
                                            <!--  <div class="text-sm text-gray-700">-->
                                            <!--    <div class="mb-2">-->
                                            <!--      <span-->
                                            <!--        class="p-1.5 text-xs font-medium uppercase tracking-wider text-green-800 bg-green-200 rounded-lg bg-opacity-50">BreakFast : </span>-->
                                            <!--        <span class="text-green-800 bg-green-200 rounded-lg">03</span>-->
                                            <!--    </div>-->
                                            <!--    <div class="mb-2">-->
                                            <!--      <span-->
                                            <!--        class="p-1.5 text-xs font-medium uppercase tracking-wider text-yellow-800 bg-yellow-200 rounded-lg bg-opacity-50">Launch ..... : </span>-->
                                            <!--        <span class="text-green-800  bg-yellow-200 rounded-lg">03</span>-->
                                            <!--    </div>-->
                                            <!--    <div>-->
                                            <!--      <span-->
                                            <!--        class="p-1.5 text-xs font-medium uppercase tracking-wider text-gray-800 bg-gray-200 rounded-lg bg-opacity-50">Dinner ...... : </span>-->
                                            <!--        <span class="text-green-800 bg-gray-200 rounded-lg">03</span>-->
                                            <!--    </div>-->
                                            <!--  </div>-->
                                            <!--  <div class="text-sm font-medium text-black">-->
                                            <!--    Today's Meal :  09-->
                                            <!--  </div>-->
                                            <!--</div>-->




                                            <!--<div class="bg-white space-y-3 p-2 rounded-lg shadow">-->
                                            <!--  <div class="flex  space-x-2 text-sm">-->
                                            <!--    <div>-->
                                            <!--      <a href="#" class="text-blue-500 font-bold hover:underline">#Farhad Farid Foysal</a>-->
                                            <!--    </div>-->
                                            <!--    <div class="text-gray-500 text-sm  float-end">10/10/2021</div>-->

                                            <!--  </div>-->
                                            <!--  <div class="text-sm text-gray-700">-->
                                            <!--    <div class="mb-2">-->
                                            <!--      <span-->
                                            <!--        class="p-1.5 text-xs font-medium uppercase tracking-wider text-green-800 bg-green-200 rounded-lg bg-opacity-50">BreakFast : </span>-->
                                            <!--        <span class="text-green-800 bg-green-200 rounded-lg">03</span>-->
                                            <!--    </div>-->
                                            <!--    <div class="mb-2">-->
                                            <!--      <span-->
                                            <!--        class="p-1.5 text-xs font-medium uppercase tracking-wider text-yellow-800 bg-yellow-200 rounded-lg bg-opacity-50">Launch ..... : </span>-->
                                            <!--        <span class="text-green-800  bg-yellow-200 rounded-lg">03</span>-->
                                            <!--    </div>-->
                                            <!--    <div>-->
                                            <!--      <span-->
                                            <!--        class="p-1.5 text-xs font-medium uppercase tracking-wider text-gray-800 bg-gray-200 rounded-lg bg-opacity-50">Dinner ...... : </span>-->
                                            <!--        <span class="text-green-800 bg-gray-200 rounded-lg">03</span>-->
                                            <!--    </div>-->
                                            <!--  </div>-->
                                            <!--  <div class="text-sm font-medium text-black">-->
                                            <!--    Today's Meal :  09-->
                                            <!--  </div>-->
                                            <!--</div>-->
                                            <div class="bg-white space-y-3 p-2 rounded-lg shadow">
                                              <div class="flex  space-x-2 text-sm">
                                                <div>
                                                  <a href="#" class="text-blue-500 font-bold hover:underline">#Farhad Farid Foysal</a>
                                                </div>
                                                <div class="text-gray-500 text-sm  float-end">10/10/2021</div>

                                              </div>
                                              <div class="text-sm text-gray-700">
                                                <div class="mb-2">
                                                  <span
                                                    class="p-1.5 text-xs font-medium uppercase tracking-wider text-green-800 bg-green-200 rounded-lg bg-opacity-50">BreakFast : </span>
                                                    <span class="text-green-800 bg-green-200 rounded-lg">03</span>
                                                </div>
                                                <div class="mb-2">
                                                  <span
                                                    class="p-1.5 text-xs font-medium uppercase tracking-wider text-yellow-800 bg-yellow-200 rounded-lg bg-opacity-50">Launch ..... : </span>
                                                    <span class="text-green-800  bg-yellow-200 rounded-lg">03</span>
                                                </div>
                                                <div>
                                                  <span
                                                    class="p-1.5 text-xs font-medium uppercase tracking-wider text-gray-800 bg-gray-200 rounded-lg bg-opacity-50">Dinner ...... : </span>
                                                    <span class="text-green-800 bg-gray-200 rounded-lg">03</span>
                                                </div>
                                              </div>
                                              <div class="text-sm font-medium text-black">
                                                Today's Meal :  09
                                              </div>
                                            </div>
                                            </div>
                                          </div>
                                        </div>



                                      </div>
                                  </div>
                              </div>


                              <div class="accordion-item ">
                                  <h2 style="font-size:15px" class="accordion-button u_bazar_list_btn" data-bs-target="#childtwo" data-bs-toggle="collapse"><?php echo date('F'); ?> ~ Bazar List:</h2>
                                  <div id="childtwo" class="accordion-collapse collapse">
                                      <div class="accordion-body ">


                                        <div class="bazar_up_list" id="bazar_up_list bg-blue-100">
                                            <div class="popup-set_bazar_up hidden">
                                                <div class="content-set_bazar_up text-justify border-pink-300 border-2 shadow-lg  rounded-lg bg-white-100 ">
                                                        <div class="back"><button type="button" class="bazar_set_u_back_btn float-end text-3xl font-medium ml-5 text-pink-600"><i class="bi bi-arrow-left-circle-fill"></i></button></div>
                                                        <div class="upd_meal_set_body pt-2">

                                                          <div class="dis_bazar_upd justify-center pt-0" id="display_bazar_upd">
                                                              <div class="bazar_up_display" id="bazar_up_display">

                                                              
                                                              <div class="bazar_up_dis px-2" id="bazar_up_dis">

                                                              </div>

<!--                                                        
<div class="bazar_l_add add_bazar_code hiddenn">
<div class="container-fluidd px-1 pb-1">

<form action="" id="manage-course">
    <input type="hidden" name="id" value="<?php echo isset($unique_id) ? $unique_id : '' ?>">
    <div class="row">
    <div id="bazar_msg" class="form-group"></div>
    
    <div class="col">
        <div class="row">

<div class=" justify-center">
<div>
<div class="form-floating mb-1 md:w-100 xl:w-100">
  <input type="text" class="form-control
  block
  w-full
  px-3
  py-1.5
  text-base
  font-normal
  text-gray-700
  bg-white bg-clip-padding
  border border-solid border-gray-300
  rounded
  transition
  ease-in-out
  m-0
  focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none" id="ft" placeholder="name@example.com">
  <label for="ft" class="text-gray-700">Fee Type</label>
</div>
<div class="form-floating mb-3 xl:w-100">
  <input type="number" class="form-control
  block
  w-full
  px-3
  py-1.5
  text-base
  font-normal
  text-gray-700
  bg-white bg-clip-padding
  border border-solid border-gray-300
  rounded
  transition
  ease-in-out
  m-0
  focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none" step="any" min="0" id="amount" placeholder="Amount">
  <label for="floatingPassword" class="text-gray-700">Amount</label>
</div>
</div>
</div>

             <div class="form-group">

  <button type="button" id="add_fee" class="
  w-full
  px-6
  py-2.5
  bg-blue-600
  text-white
  font-medium
  text-xs
  leading-tight
  uppercase
  rounded
  shadow-md
  hover:bg-blue-700 hover:shadow-lg
  focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0
  active:bg-blue-800 active:shadow-lg
  transition
  duration-150
  ease-in-out">Add to List</button>

                
            </div>

        </div>
        <hr>
        <table class="table table-condensed" id="fee-list">
            <thead>
                <tr>
                    <th width="5%"></th>
                    <th width="50%">Type</th>
                    <th width="45%">Amount</th>
                </tr>
            </thead>
            <tbody>




            </tbody>
            <tfoot>
                <tr>
                    <th colspan="2" class="text-center">Total</th>
                    <th class="text-right">
                        <input type="hidden" name="total_amount" value="<?php  ?>">
                        <span class="tamount"><?php  ?></span>
                    </th>
                </tr>
            </tfoot>
        </table>
        
  <button type="submit" id="add_bazar" class="
  mt-1
  w-full
  px-6
  py-2.5
  bg-danger
  text-white
  font-medium
  text-xs
  leading-tight
  uppercase
  rounded
  shadow-md
  hover:bg-blue-700 hover:shadow-lg
  focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0
  active:bg-blue-800 active:shadow-lg
  transition
  duration-150
  ease-in-out">Submit Bazar List</button>
    </div>
    </div>
</form>
</div>
<div id="fee_clone" style="display: none">
 <table >
        <tr>
            <td class="text-center"><button class="btn-sm btn-outline-danger" type="button" onclick="rem_list($(this))" ><i class="fa fa-times"></i></button></td>
            <td>
                <input type="hidden" name="fid[]">
                <input type="hidden" name="type[]">
                <p><small><b class="ftype"></b></small></p>
            </td>
            <td>
                <input type="hidden" name="amount[]">
                <p class="text-right"><small><b class="famount"></b></small></p>
            </td>
        </tr>
</table>
</div>
</div> -->


                                                              </div>
                                                          </div>

                                                        </div>
                                                </div>      
                                            </div>            
                                        </div>


                                        <div class="user_bazar_list" id="user_bazar_list">

                                          
                                        

                                        </div>

                                      </div>
                                  </div>
                              </div>
                          </div>


                          <!-- <p class="first-letter:text-4xl first-letter:text-red-600">Lorem!</p> -->
                          </div>
                          <div class="col-md-3">


                          <div class="accordion p-0">
                              <div class="accordion-item">
                                  <h2 style="font-size:15px" class="accordion-button text-sm" data-bs-target="#dataone" data-bs-toggle="collapse">এই মাসের হিসাব</h2>
                                  <div id="dataone" class="accordion-collapse collapse show">
                                      <div class="accordion-body p-0 shadow-inner shadow-lg border-rounded border-x-2 border-sky-200">

                                          <div class="monthly_cal_dis" id="monthly_cal_dis">
                                          
                                          </div>



                                      </div>
                                  </div>
                              </div>


                              <div class="accordion-item">
                                  <h2 style="font-size:15px" class="accordion-button" data-bs-target="#datatwo" data-bs-toggle="collapse">মাসের হিসাবঃ</h2>
                                  <div id="datatwo" class="accordion-collapse collapse">
                                      <div class="accordion-body">
                                          <p>Developed By Farhad Foysal - 2022
                                          </p>
                                      </div>
                                  </div>
                              </div>
                          </div>


                          </div>

                        </div>
                      </div>







    <!-- <div class="col-md-4">
              <div class="profile_boxx mb-2">
                       <i class="bi bi-house-fill menu_class"></i>
                       <i class="bi bi-bell setting_class"></i>
                       <div class="class_pic_icon mb-1"></div>
                       <h3>Farhad Foysal</h3>
                       <p>Lorem ipsum dolor sit amet.</p>
                       <button type="button">Follow</button>
                       <div class="profile_button_class">
                         <p class="mt-2">Lern More</p>
                         <i class="bi bi-box-arrow-in-right profile_button_icon"></i>
                       </div>
              </div>
    </div>
    <div class="col-md-4">
              <div class="profile_boxx mb-2">
                       <i class="bi bi-house-fill menu_class"></i>
                       <i class="bi bi-bell setting_class"></i>
                       <div class="class_pic_icon mb-1"></div>
                       <h3>Farhad Foysal</h3>
                       <p>Lorem ipsum dolor sit amet.</p>
                       <button type="button">Follow</button>
                       <div class="profile_button_class">
                         <p class="mt-2">Lern More</p>
                         <i class="bi bi-box-arrow-in-right profile_button_icon"></i>
                       </div>
              </div>
    </div>
    <div class="col-md-4">
              <div class="profile_boxx mb-2">
                       <i class="bi bi-house-fill menu_class"></i>
                       <i class="bi bi-bell setting_class"></i>
                       <div class="class_pic_icon mb-1"></div>
                       <h3>Farhad Foysal</h3>
                       <p>Lorem ipsum dolor sit amet.</p>
                       <button type="button">Follow</button>
                       <div class="profile_button_class">
                         <p class="mt-2">Lern More</p>
                         <i class="bi bi-box-arrow-in-right profile_button_icon"></i>
                       </div>
              </div>
    </div>
    <div class="col-md-4">
              <div class="profile_boxx mb-2">
                       <i class="bi bi-house-fill menu_class"></i>
                       <i class="bi bi-bell setting_class"></i>
                       <div class="class_pic_icon mb-1"></div>
                       <h3>Farhad Foysal</h3>
                       <p>Lorem ipsum dolor sit amet.</p>
                       <button type="button">Follow</button>
                       <div class="profile_button_class">
                         <p class="mt-2">Lern More</p>
                         <i class="bi bi-box-arrow-in-right profile_button_icon"></i>
                       </div>
              </div>
    </div> -->
  </div>



</div>

</div>





</section>




    <section id="postUser" class="section msssgu-2">
        <p style="margin: 0 auto" class="text-center tex-warning" id="status_std_update"></p>

        <div class="container-fluid show_matarial active mt-2 " id="">
          <button class="back_button"><i class="bi bi-arrow-left-circle-fill"></i></button>
          <div id="show_matarialsf">



          </div>

        </div>

        <div class="container">




<!-- drawer init and toggle -->
<div class="text-center mt-1-">
   <button class="text-dark w-100 bg-secondary hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mb-1 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800" type="button" data-drawer-target="drawer-swipe" data-drawer-show="drawer-swipe" data-drawer-placement="bottom" data-drawer-edge="true" data-drawer-edge-offset="bottom-[80px]" aria-controls="drawer-swipe">
   MY swipeable Settings
   </button>
</div>

<!-- drawer component -->
<div id="drawer-swipe" class="fixed pb-5 z-40 w-full overflow-y-auto bg-white border-t border-gray-200 rounded-t-lg dark:border-gray-700 dark:bg-gray-800 transition-transform bottom-0 left-0 right-0 translate-y-full bottom-[60px]" tabindex="-1" aria-labelledby="drawer-swipe-label" aria-hidden="true">
   <div class="p-4 cursor-pointer hover:bg-gray-50 dark:hover:bg-gray-700" data-drawer-toggle="drawer-swipe">
      <span class="absolute w-8 h-1 -translate-x-1/2 bg-gray-300 rounded-lg top-3 left-1/2 dark:bg-gray-600"></span>
      <h5 id="drawer-swipe-label" class="inline-flex items-center text-base text-gray-500 dark:text-gray-400"><svg class="w-5 h-5 mr-2" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M5 3a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2V5a2 2 0 00-2-2H5zM5 11a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2v-2a2 2 0 00-2-2H5zM11 5a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V5zM14 11a1 1 0 011 1v1h1a1 1 0 110 2h-1v1a1 1 0 11-2 0v-1h-1a1 1 0 110-2h1v-1a1 1 0 011-1z"></path></svg>Add widget</h5>
   </div>
   <div class="grid grid-cols-3 gap-4 p-4 lg:grid-cols-4">
      <div class="p-4 rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100 dark:hover:bg-gray-600 dark:bg-gray-700" data-drawer-toggle="drawer-swipe">
         <div class="flex justify-center items-center p-2 mx-auto mb-2 max-w-[48px] bg-gray-200 dark:bg-gray-500 rounded-full w-18 h-18">
            <svg class="inline w-8 h-8 text-gray-500 dark:text-gray-400" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M2 10a8 8 0 018-8v8h8a8 8 0 11-16 0z"></path><path d="M12 2.252A8.014 8.014 0 0117.748 8H12V2.252z"></path></svg>
         </div>
         <div class="font-medium text-center text-gray-500 dark:text-gray-400">Chart</div>
      </div>
      <div class="p-4 rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100 dark:hover:bg-gray-600 dark:bg-gray-700" data-drawer-toggle="drawer-swipe">
         <div class="flex justify-center items-center p-2 mx-auto mb-2 max-w-[48px] bg-gray-200 dark:bg-gray-500 rounded-full w-18 h-18">
            <svg class="inline w-8 h-8 text-gray-500 dark:text-gray-400" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M5 4a3 3 0 00-3 3v6a3 3 0 003 3h10a3 3 0 003-3V7a3 3 0 00-3-3H5zm-1 9v-1h5v2H5a1 1 0 01-1-1zm7 1h4a1 1 0 001-1v-1h-5v2zm0-4h5V8h-5v2zM9 8H4v2h5V8z" clip-rule="evenodd"></path></svg>
         </div>
         <div class="font-medium text-center text-gray-500 dark:text-gray-400">Table</div>
      </div>
      <div class="hidden p-4 rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100 dark:hover:bg-gray-600 dark:bg-gray-700 lg:block" data-drawer-toggle="drawer-swipe">
         <div class="flex justify-center items-center p-2 mx-auto mb-2 max-w-[48px] bg-gray-200 dark:bg-gray-500 rounded-full w-18 h-18">
            <svg class="inline w-8 h-8 text-gray-500 dark:text-gray-400" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M2 6a2 2 0 012-2h12a2 2 0 012 2v2a2 2 0 100 4v2a2 2 0 01-2 2H4a2 2 0 01-2-2v-2a2 2 0 100-4V6z"></path></svg>
         </div>
         <div class="hidden font-medium text-center text-gray-500 dark:text-gray-400">Ticket</div>
      </div>
      <div class="p-4 rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100 dark:hover:bg-gray-600 dark:bg-gray-700" data-drawer-toggle="drawer-swipe">
         <div class="flex justify-center items-center p-2 mx-auto mb-2 max-w-[48px] bg-gray-200 dark:bg-gray-500 rounded-full w-18 h-18">
            <svg class="inline w-8 h-8 text-gray-500 dark:text-gray-400" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z"></path><path fill-rule="evenodd" d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm3 4a1 1 0 000 2h.01a1 1 0 100-2H7zm3 0a1 1 0 000 2h3a1 1 0 100-2h-3zm-3 4a1 1 0 100 2h.01a1 1 0 100-2H7zm3 0a1 1 0 100 2h3a1 1 0 100-2h-3z" clip-rule="evenodd"></path></svg>
         </div>
         <div class="font-medium text-center text-gray-500 dark:text-gray-400">List</div>
      </div>
      <div class="p-4 rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100 dark:hover:bg-gray-600 dark:bg-gray-700" data-drawer-toggle="drawer-swipe">
         <div class="flex justify-center items-center p-2 mx-auto mb-2 max-w-[48px] bg-gray-200 dark:bg-gray-500 rounded-full w-18 h-18">
            <svg class="inline w-8 h-8 text-gray-500 dark:text-gray-400" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M8.433 7.418c.155-.103.346-.196.567-.267v1.698a2.305 2.305 0 01-.567-.267C8.07 8.34 8 8.114 8 8c0-.114.07-.34.433-.582zM11 12.849v-1.698c.22.071.412.164.567.267.364.243.433.468.433.582 0 .114-.07.34-.433.582a2.305 2.305 0 01-.567.267z"></path><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-13a1 1 0 10-2 0v.092a4.535 4.535 0 00-1.676.662C6.602 6.234 6 7.009 6 8c0 .99.602 1.765 1.324 2.246.48.32 1.054.545 1.676.662v1.941c-.391-.127-.68-.317-.843-.504a1 1 0 10-1.51 1.31c.562.649 1.413 1.076 2.353 1.253V15a1 1 0 102 0v-.092a4.535 4.535 0 001.676-.662C13.398 13.766 14 12.991 14 12c0-.99-.602-1.765-1.324-2.246A4.535 4.535 0 0011 9.092V7.151c.391.127.68.317.843.504a1 1 0 101.511-1.31c-.563-.649-1.413-1.076-2.354-1.253V5z" clip-rule="evenodd"></path></svg>
         </div>
         <div class="font-medium text-center text-gray-500 dark:text-gray-400">Price</div>
      </div>
      <div class="p-4 rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100 dark:hover:bg-gray-600 dark:bg-gray-700" data-drawer-toggle="drawer-swipe">
         <div class="flex justify-center items-center p-2 mx-auto mb-2 max-w-[48px] bg-gray-200 dark:bg-gray-500 rounded-full w-18 h-18">
            <svg class="inline w-8 h-8 text-gray-500 dark:text-gray-400" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z"></path></svg>
         </div>
         <div class="font-medium text-center text-gray-500 dark:text-gray-400">Users</div>
      </div>
      <div class="hidden p-4 rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100 dark:hover:bg-gray-600 dark:bg-gray-700 lg:block">
         <div class="flex justify-center items-center p-2 mx-auto mb-2 max-w-[48px] bg-gray-200 dark:bg-gray-500 rounded-full w-18 h-18">
            <svg class="inline w-8 h-8 text-gray-500 dark:text-gray-400" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"></path></svg>
         </div>
         <div class="font-medium text-center text-gray-500 dark:text-gray-400">Task</div>
      </div>
      <div class="p-4 rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100 dark:hover:bg-gray-600 dark:bg-gray-700" data-drawer-toggle="drawer-swipe">
         <div class="flex justify-center items-center p-2 mx-auto mb-2 max-w-[48px] bg-gray-200 dark:bg-gray-500 rounded-full w-18 h-18">
            <svg class="inline w-8 h-8 text-gray-500 dark:text-gray-400" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M5 4a1 1 0 00-2 0v7.268a2 2 0 000 3.464V16a1 1 0 102 0v-1.268a2 2 0 000-3.464V4zM11 4a1 1 0 10-2 0v1.268a2 2 0 000 3.464V16a1 1 0 102 0V8.732a2 2 0 000-3.464V4zM16 3a1 1 0 011 1v7.268a2 2 0 010 3.464V16a1 1 0 11-2 0v-1.268a2 2 0 010-3.464V4a1 1 0 011-1z"></path></svg>
         </div>
         <div class="font-medium text-center text-gray-500 dark:text-gray-400">Custom</div>
      </div>
   </div>
</div>

        
        </div>
        <div class="container user_meal_sec_dis" id="user_meal_sec_dis">
                  
        </div>

        <div class="container fluid section_show_part bg-dar mt-2 p-1">



<div class="container shadow-lg sm:rounded-lg">
<div class="row items-start">

        <div class="col-3">
          <button type="button" class="inline-block px-2 pt-2.5 pb-2 bg-blue-600 text-white font-medium text-xs leading-normal uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out flex align-center" data-bs-toggle="modal" data-bs-target="#user_pay_modal">
            <i class="bi bi-cash pr-1"></i>
            New+
            <!-- <i class="bi bi-cash-coin pr-1"></i> -->
          </button>
        </div>

        <div class="col-9 text-end text-dark px-1">
          <div class="input-group">
          <input type="month" class="form-control font-normal text-primary border border-solid border-primary rounded transition ease-in-out m-0 focus:text-gray-700 focus:border-blue-600" id="send_month_for_bb" placeholder="Select a date" aria-label="Select a date" aria-describedby="button-addon2" >
          <button class="btn btn-outline-secondary send_month_bb bg-blue-600 text-dark font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out" type="button" id="">Check</button>
          </div>
</div>

    </div>

    
</div>



          <div class="container" id="class_sections_here_pay">





          </div>
        </div>

    </section>



    <section id="postOthers" class="section msssgu-3">

        <div class="container">
                  <div class="container-fluid2">
                    <div class="mess_fee_input_table">

                              <div class="accordion-item">
                                  <h2 style="font-size:15px" class="accordion-button" data-bs-target="#mess_fee_data_s" data-bs-toggle="collapse">Mess Fee Lists</h2>
                                  <div id="mess_fee_data_s" class="accordion-collapse collapse collapse showW">
                                      <div class="accordion-body">

<div class="fee_set_table" id="fee_set_table bg-blue-100">
    <div class="popup-sett_fee text-center hidden">
        <div class="content-sett_fee text-center border-pink-300 border-2 shadow-lg  rounded-lg bg-white-100 p-2">
                <div class="back"><button type="button" class="fee_sett_back_butn float-end text-3xl font-medium ml-5 text-pink-600"><i class="bi bi-arrow-left-circle-fill"></i></button></div>
                <div class="main_fee_sett_body pt-2">

                  <div class="containerr fee_code_pass text-center pt-1" id="fee_code_pass">
                      <div class="fee_setup_dis">




<div class="rounded-lg form-control shadow-lg bg-white">
  <form action='' role="form" id="fee_m_a_form">

<h5 class="text-center" >Add a Mess fee</h5>

  <div class="form-floating ">
      <input type="text" class="form-control
      w-full
      text-base
      font-normal
      text-gray-700
      bg-white bg-clip-padding
      border border-solid border-gray-300
      rounded
      transition
      ease-in-out
      focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none" name="fee_m_a_t" id="fee_m_a_t" placeholder="Fee Type">
      <label for="fee_m_a_t" class="text-gray-700">Fee Type</label>
  </div>
  <div class="form-floating ">
      <input type="number" class="form-control
      w-full
      text-base
      font-normal
      text-gray-700
      bg-white bg-clip-padding
      border border-solid border-gray-300
      rounded
      transition
      ease-in-out
      focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none" name="fee_m_a_a" id="fee_m_a_a" placeholder="Amount">
      <label for="fee_m_a_a" class="text-gray-700">Amount</label>
  </div>


    <button type="button" class="
      fee_m_ad_btn
      w-full
      px-6
      py-2.5
      border-2 
      border-green-500 
      text-green-500
      font-medium
      text-xs
      leading-tight
      uppercase
      rounded
      shadow-md
      hover:bg-blue-700 hover:shadow-lg
      focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0
      active:bg-blue-800 active:shadow-lg
      transition
      duration-150
      ease-in-out" name="fee_m_a_btn" id="fee_m_a_btn">Add Fee</button>
      <input class="form-control" placeholder="" name="fee_m_a" id="fee_m_a" type="hidden">
  </form>

    <div id="myalert_mmfee" style="display:none;">
        <div class="container col-md-offset-4">
            <div class="alert alert-info">
                <center><span id="alerttext_mmfee"></span></center>
            </div>
        </div>
    </div>

</div>




                      </div>
                  </div>

                </div>
        </div>      
    </div>            
</div>                    

                                        <div class="container mess_fees_list_h" id="mess_fees_list_h">
 

                                            <div class="row mb-1">
                                            <button type="button" class="inline-block px-3 py-2 border-2 border-green-500 text-green-500 font-medium text-xs leading-tight uppercase rounded-full hover:bg-black hover:bg-opacity-5 focus:outline-none focus:ring-0 transition duration-150 ease-in-out fee_a_btn">Add Fee & Type <i class="bi bi-pen"></i> </button>
                                            </div>
                                            <div class="row">

                                            <div class="table-responsive mess_fee_list_table" id="mess_fee_list_table">



                                            </div>

                                            </div>

                                        </div>
                                      </div>
                                  </div>
                              </div>


                              <div class="accordion-item">
                                  <h2 style="font-size:15px" class="accordion-button" data-bs-target="#mess_fee_data_s2" data-bs-toggle="collapse">Others fees (Userwise)</h2>
                                    <div class="others_fees_list_hh"></div>
                                  <div id="mess_fee_data_s2" class="accordion-collapse collapse show">
                                      <div class="accordion-body">


<div class="feee_set_table" id="feee_set_table bg-blue-100">
    <div class="popup-sett_feee hidden">
        <div class="content-sett_feee text-center text-justify border-pink-300 border-2 shadow-lg  rounded-lg bg-white-100 p-2">
                <div class="back"><button type="button" class="feee_sett_back_butn float-end text-3xl font-medium ml-5 text-pink-600"><i class="bi bi-arrow-left-circle-fill"></i></button></div>
                <div class="main_feee_sett_body pt-2">

                  <div class="containerr feee_code_pass justify-center pt-0" id="feee_code_pass">

                  </div>

                </div>
        </div>      
    </div>            
</div> 

                                        <div class="others_fees_list_h" id="others_fees_list_h">






                                        </div>

                                      </div>
                                  </div>
                              </div>
                                

                    </div>
                  </div>
        </div>

    </section>
    <section id="signUp" class="section msssgu-4">




    </section>
    <section id="logIn" class="section  msssgu-5">

    <div class="container-fluid">


          <!-- account -->








          <div class="">


<div class="container-fluid"> 
  <div class="profile-header">
    <div class="profile-img" data-bs-toggle="modal" data-bs-target="#drop22">
      <img src="image/Image" width="200" alt="">
    </div>
    <div class="profile-nav-info">
      <h3 class="user-name"><?=$iimv ?></h3>
      <div class="address">
        <p class="state">#Address</p>
        <span class="country">BD</span>
      </div>
    </div>
    <div class="profile-option">
      <div class="notification">
        <i class="bi bi-bell-fill
"></i>
        <span class="alert-message">00</span>
      </div>
    </div>
  </div>
  <div class="main-bd">



    <div class="left-side">
      <div class="profile-side">
        <p class="mobile-number"><i class="bi bi-telephone-plus-fill">
          <?= $ti['phone'] ?>
        </i></p>
        <p class="user-mail"><i class="bi bi-envelope">
        <?= $ti['phone'] ?>
        </i></p>
        <h3 data-bs-toggle="modal" data-bs-target="#dropbio">Bio<div class="spinner-grow text-info" role="status">
  <span class="visually-hidden">Loading...</span>
</div></h3>
        <div id="textintro" class="user-bio bio text-center"> std bio  <br><br></div>
     
     

        <div class="profile-btn">
            <a href="#"><button class="chatbtn"><i class="bi bi-chat-dots-fill">Chat</i></button></a>
            <button class="createbtn"><i class="bi bi-person-plus-fill">+Add</i></button>
          </div>
          <div class="user-rating">4.5
          
          <div class="rate">
            <div class="stars">
            <i class="bi bi-star-fill"></i>
            <i class="bi bi-star-fill"></i>
            <i class="bi bi-star-fill"></i>
            <i class="bi bi-star-fill"></i>
            <i class="bi bi-star-half"></i>

            </div>
            <span class="no-user"><span>refferel point</span>&nbsp;&nbsp;reviews/referral point</span>
          </div>
          </div>

     
      </div>
          
      <div class="container mt-2 bg-light text-dark">
        <div class="row">
          <div class="col-md">

                                     <div class="accordion-item">
                                        <h2 style="" class="accordion-header" id="flush-headingOne">
                                        <button style="color: red" class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                                            Friend List<span>......</span><h6 class="text-center" id="total1" ></h6>
                                        </button>
                                        </h2>
                                        <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">

                                          <div class="accordion-body">

                                             
                                               

                                          </div>
                                        </div>
                                     </div>





          </div>
        </div>
      </div>


    </div>




    <div class="right-side w-100">
      <div class="nav">
        <ul>
          <li onclick="tabs(0)" class="user-post active">POsTs</li>
          <li onclick="tabs(1)" id="u_about" class="user-review">AbOuT</li>

        </ul>
      </div>
      <div class="profile-body bg-secondary text-light">

        <div class="profile-posts tab">



          <div class="container">

          </div>
        
        </div>
        <div class="profile-review tab">
        <header style="width:100%" class="header2">
              <nav class="navbar">
                      <a class="btttnt-1" href="#home" id="getdisplaydata1"><i class="bi bi-house-fill">.<span class="sp1">Home</span></i></a>
                      <a class="btttnt-2" href="#about" id="qutebtn"><i class="bi bi-chat-right-quote-fill">.<span class="sp2">Qute</span></i></a>
                      <a class="btttnt-3" href="#gallery" id="gallerybtn"><i class="bi bi-grid-3x3-gap-fill">.<span class="sp3">Gallery</span></i></a>
                      <a class="btttnt-4" href="#portfolio"><i class="bi bi-play-btn-fill">.<span class="sp4">Videos</span></i></a>
                      <a class="btttnt-5" href="#contact"><i class="bi bi-phone">.<span class="sp5">User</span></i></a>
              </nav>
          </header>

          <div class="container">

          </div>

        </div>  



<script src="text/javascript">
//   const optionMenu = document.querySelector(".select-menu-1"),
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
</script>

<!-- swap -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/5.4.5/js/swiper.min.js"></script>
<script type="text/javascript" src="script.js"></script>
<script type="text/javascript" src="user.js"></script>
<script type="text/javascript" src="mess/meal.js"></script>
<!-- swap -->




    <!-- <script src="jquery-3.4.1.min.js"></script> -->
    <script src="sweetalert.min.js"></script>
        <script src="sweetalert2.all.min.js"></script>

    <!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js" ></script> -->
  <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.min.js" ></script> -->


    </div>

    </section>

</div>




 <section>

 <section>
 <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/platform/1.3.6/platform.min.js"></script> -->



<!-- <script src="jquery-3.5.1.min.js"></script> -->

<script>



$(document).ready(function(){


$('#my_qr_code').ready(function(){

    $.ajax({
          url:'mess/meal_ind.php',
          type:'post',
          data: {
            my_qr_code: true
          },
          success: function(response){
            $('#my_qr_code').html(response);

          }
        });


});

$(document).on('click','.monthly_all_u_f_b', function(){

var user_id = $(this).attr('id');
var date = $('#monthly_f_allu_date').val();

      $.ajax({
        url:'mess/meal_4.php',
        type:'post',
        data: {
          this_id:user_id,
          month_d:date,
          user_f_list:true,
        },
        success: function(response){
          $('#others_fees_list_h').html(response);
          // my_cal();

        }
      });


});


  $(document).on('click','.monthly_fee_s_b', function(){

var user_id = $(this).attr('id');
var date = $('#monthly_fee_s_date').val();

      $.ajax({
        url:'mess/meal_4.php',
        type:'post',
        data: {
          this_id:user_id,
          month_d:date,
          user_all_fee_t:true,
        },
        success: function(response){
          $('#feee_code_pass').html(response);
          // my_cal();

        }
      });


});

  $(document).on('click','.user_t_f_b', function(){

var user_id = $(this).attr('id');

      $.ajax({
        url:'mess/meal_4.php',
        type:'post',
        data: {
          this_id:user_id,
          user_all_fee_t:true,
        },
        success: function(response){
          $('#feee_code_pass').html(response);
          // my_cal();

        }
      });


});

// user all fee ajax end
  $(document).on('click','.in_f_di_b', function(){

var user_id = $(this).attr('id');

      $.ajax({
        url:'mess/meal_4.php',
        type:'post',
        data: {
          this_id:user_id,
          feee_code_pass:true,
        },
        success: function(response){
          $('#feee_code_pass').html(response);
          // my_cal();

        }
      });


});


// indivisual user fee adding end

$('#others_fees_list_h').ready(function(){

$.ajax({
      url:'mess/meal_4.php',
      type:'post',
      data: {
        user_f_list: true
      },
      success: function(response){
        $('#others_fees_list_h').html(response);

        // my_cal();

      }
    });


});


$(document).on('click','.others_fees_list_hh', function(){

var mess_id = $(this).attr('id');

      $.ajax({
        url:'mess/meal_4.php',
        type:'post',
        data: {
          this_id:mess_id,
          user_f_list:true,
        },
        success: function(response){
          $('#others_fees_list_h').html(response);
          // my_cal();

        }
      });


});

  //others_fees_list_h end 

$('#mess_fee_list_table').ready(function(){

$.ajax({
      url:'mess/meal_3.php',
      type:'post',
      data: {
        mess_f_ta: true
      },
      success: function(response){
        $('#mess_fee_list_table').html(response);

        // my_cal();

      }
    });


});


$(document).on('click','.mess_fee_list_table', function(){

var mess_id = $(this).attr('id');

      $.ajax({
        url:'mess/meal_3.php',
        type:'post',
        data: {
          this_id:mess_id,
          mess_f_ta:true,
        },
        success: function(response){
          $('#mess_fee_list_table').html(response);
          // my_cal();

        }
      });


});

// mess fee list end


$('#monthly_cal_dis').ready(function(){

    $.ajax({
          url:'mess/meal_3.php',
          type:'post',
          data: {
            acc_calcu: true
          },
          success: function(response){
            $('#monthly_cal_dis').html(response);

            my_cal();

          }
        });


});


$(document).on('click','.monthly_cal_dis', function(){

var bazar_id = $(this).attr('id');

      $.ajax({
        url:'mess/meal_3.php',
        type:'post',
        data: {
          this_id:bazar_id,
          acc_calcu:true,
        },
        success: function(response){
          $('#monthly_cal_dis').html(response);
          my_cal();

        }
      });


});




$(document).on('click','.send_month_b', function(){

var bazar_id = $(this).attr('id');


var d_code = $('#send_month_for_b').val();

      $.ajax({
        url:'mess/meal_3.php',
        type:'post',
        data: {
          this_id:bazar_id,
          date : d_code,
          ind_bazar:true,
        },
        success: function(response){
          $('#table_bazar_l').html(response);

        }
      });


});


$(document).on('click','.send_month_bb', function(){

var bazar_id = $(this).attr('id');

var d_code = $('#send_month_for_bb').val();

      $.ajax({
        url:'mess/meal_8.php',
        type:'post',
        data: {
          this_id:bazar_id,
          month_d : d_code,
          class_sections:true,
        },
        success: function(response){
          $('#class_sections_here_pay').html(response);

        }
      });


});

// $(document).on('click','.sendd_month_bb', function(){

// var bazar_id = $(this).attr('id');


// var d_code = $('#sendd_month_for_bb').val();

//       $.ajax({
//         url:'mess/meal_ind.php',
//         type:'post',
//         data: {
//           this_id:bazar_id,
//           month_d : d_code,
//           class_sections:true,
//         },
//         success: function(response){
//           $('#class_sections_here_pay').html(response);

//         }
//       });


// });


});



      $(document).ready(function(){


        $(document).on('click','.user_t_f_b', function(){
          var butn_id = $(this).attr('id');
          $('.popup-sett_feee').removeClass('hidden');
          $('.others_fees_list_h').addClass('hidden');
          // $('.mess_fees_list_h').addClass('hidden');

        });

        $(document).on('click','.in_f_di_b', function(){
          var butn_id = $(this).attr('id');
          $('.popup-sett_feee').removeClass('hidden');
          $('.others_fees_list_h').addClass('hidden');
          // $('.mess_fees_list_h').addClass('hidden');

        });

        $(document).on('click','.feee_sett_back_butn', function(){
          var butn_id = $(this).attr('id');
          $('.popup-sett_feee').addClass('hidden');
          $('.others_fees_list_h').removeClass('hidden');
          // $('.popup-sett_fee').removeClass('hidden');

        });


        $(document).on('click','.fee_a_btn', function(){
          var butn_id = $(this).attr('id');
          $('.popup-sett_fee').removeClass('hidden');
          $('.mess_fees_list_h').addClass('hidden');
          // $('.mess_fees_list_h').addClass('hidden');

        });
        $(document).on('click','.fee_sett_back_butn', function(){
          var butn_id = $(this).attr('id');
          $('.popup-sett_fee').addClass('hidden');
          $('.mess_fees_list_h').removeClass('hidden');
          // $('.popup-sett_fee').removeClass('hidden');

        });


        $(document).on('click','.use_upd_btn', function(){
          var butn_id = $(this).attr('id');
          $('.popup-set_bazar_up').removeClass('hidden');
          $('.user_bazar_list').addClass('hidden');
          // $('.row_meal_board_main').addClass('hidden');

        });
        $(document).on('click','.bazar_set_u_back_btn', function(){
          var butn_id = $(this).attr('id');
          $('.popup-set_bazar_up').addClass('hidden');
          $('.user_bazar_list').removeClass('hidden');
          // $('.row_meal_board_main').removeClass('hidden');

        });



$(document).on('click','.use_upd_btn', function(){

var bazar_id = $(this).attr('id');




      $.ajax({
        url:'mess/meal.php',
        type:'post',
        data: {
          this_id:bazar_id,
          bazar_user:true,
        },
        success: function(response){
          $('#bazar_up_dis').html(response);

          // $('.sub_marks_another'+sub_code).trigger('click');
          // alert(response);

        }
      });


});

        $(document).on('click','.t_month_baz', function(){
          var butn_id = $(this).attr('id');
          $('.ba_t_month_list').addClass('hidden');
          $('.add_bazar_code').removeClass('hidden');
          // $('.row_meal_board_main').removeClass('hidden');

        });
        // $(document).on('click','.tt_month_bazz', function(){
        //   var butn_id = $(this).attr('id');
        //   $('.baa_t_month_list').addClass('hidden');
        //   $('.add_bazar_code').removeClass('hidden');
        //   // $('.row_meall_board_main').removeClass('hidden');

        // });

        $(document).on('click','.this_month_list', function(){
          var butn_id = $(this).attr('id');
          $('.add_bazar_code').addClass('hidden');
          $('.ba_t_month_list').removeClass('hidden');
          // $('.row_meal_board_main').removeClass('hidden');

        });


        $(document).on('click','.view-modal-add_meal', function(){
          var butn_id = $(this).attr('id');
          $('.popup-add_meal').removeClass('hidden');
          $('.view-modal-add_meal').addClass('hidden');
          $('.row_meal_board_main').addClass('hidden');

        });
        $(document).on('click','.meal_add_back_butn', function(){
          var butn_id = $(this).attr('id');
          $('.popup-add_meal').addClass('hidden');
          $('.view-modal-add_meal').removeClass('hidden');
          $('.row_meal_board_main').removeClass('hidden');

        });
        $(document).on('click','.meal_sett_back_butn', function(){
          var butn_id = $(this).attr('id');
          $('.popup-sett_meal').addClass('hidden');
          $('.menu_hidden').removeClass('hidden');
          // $('.row_meal_board_main').removeClass('hidden');

        });
        $(document).on('click','.hide_men', function(){
          // alert("hle");
          var butn_id = $(this).attr('id');
          $('.menu_hidden').addClass('hidden');
          $('.popup-sett_meal').removeClass('hidden');
          // $('.row_meal_board_main').removeClass('hidden');

        });

        $(document).on('click','.qr_b1', function(){
          
          var butn_id = $(this).attr('id');
          $('.qr_2').addClass('hidden');
          $('.qr_3').addClass('hidden');
          $('.qr_1').removeClass('hidden');

        });
        $(document).on('click','.qr_b2', function(){
          
          var butn_id = $(this).attr('id');
          $('.qr_3').addClass('hidden');
          $('.qr_1').addClass('hidden');
          $('.qr_2').removeClass('hidden');

        });
        $(document).on('click','.qr_b3', function(){
          
          var butn_id = $(this).attr('id');
          $('.qr_2').addClass('hidden');
          $('.qr_1').addClass('hidden');
          $('.qr_3').removeClass('hidden');

        });



      $(document).on('click','.home_class', function(){

        var section_id = $(this).attr('id');

        // var sub_code = $('#marks_sub_code_all_'+std_id).val();


        // var cq = $('#written_sub_marks_all_'+std_id).val();
        // var mcq = $('#mcq_sub_marks_all_'+std_id).val();


        $.ajax({
                url:'c_room_1.php',
                type:'post',
                data: {
                  // this_id:std_id,
                  // sub_code:sub_code,
                  // exam_code:exam_code,
                  // student_id:student_id,
                  // cq:cq,
                  // mcq:mcq,
                  section_id:true,
                },
                success: function(response){
                  $('.show_matarial').removeClass('active');
                  $('.section_show_part').addClass('active');
                  $('#show_matarials').html(response);

                  // $('.sub_marks_another'+sub_code).trigger('click');
                  // alert(response);

                }
              });


      });

      $(document).on('click','.back_button', function(){
        $('.show_matarial').addClass('active');
        $('.section_show_part').removeClass('active');
      });

  $(document).on('click','.profile_button_icon', function(){

  var section_id = $(this).attr('id');

  // var sub_code = $('#marks_sub_code_all_'+std_id).val();


  // var cq = $('#written_sub_marks_all_'+std_id).val();
  // var mcq = $('#mcq_sub_marks_all_'+std_id).val();


  $.ajax({
          url:'c_room_1.php',
          type:'post',
          data: {
            // this_id:std_id,
            // sub_code:sub_code,
            // exam_code:exam_code,
            // student_id:student_id,
            // cq:cq,
            // mcq:mcq,
            section_id:true,
          },
          success: function(response){
            $('.show_matarial').removeClass('active');
            $('.section_show_part').addClass('active');
            $('#show_matarials').html(response);

            // $('.sub_marks_another'+sub_code).trigger('click');
            // alert(response);

          }
        });


});
$(document).on('click','.setting_class', function(){

  var section_id = $(this).attr('id');

  // var sub_code = $('#marks_sub_code_all_'+std_id).val();


  // var cq = $('#written_sub_marks_all_'+std_id).val();
  // var mcq = $('#mcq_sub_marks_all_'+std_id).val();


  $.ajax({
          url:'c_room_1.php',
          type:'post',
          data: {
            // this_id:std_id,
            // sub_code:sub_code,
            // exam_code:exam_code,
            // student_id:student_id,
            // cq:cq,
            // mcq:mcq,
            section_id:true,
          },
          success: function(response){
            $('.show_matarial').removeClass('active');
            $('.section_show_part').addClass('active');
            $('#show_matarials').html(response);

            // $('.sub_marks_another'+sub_code).trigger('click');
            // alert(response);

          }
        });


});

    });


  </script>

 <script>
   $(document).ready(function(){

// $('#class_sections_here').load('getexam.php');
$('#class_sections_here_pay').ready(function(){

    $.ajax({
          url:'mess/meal_8.php',
          type:'post',
          data: {
            class_sections: true
          },
          success: function(response){
            $('#class_sections_here_pay').html(response);



          }
        });


});
$('#my_mess_user_all').ready(function(){

$.ajax({
      url:'mess/meal_8.php',
      type:'post',
      data: {
        user_all_my_mess: true
      },
      success: function(response){
        $('#my_mess_user_all').html(response);



      }
    });


});

});
 </script>



<script>
  $(document).ready(function(){
    $(document).on('click','.sub_add_btn1', function(){

      var post_id = $(this).attr('id');

      var msg = $('#subject_name'+post_id).val();
      var marks = $('#marks'+post_id).val();
      var mcq = $('#mcq'+post_id).val();
      var fivel = $('#5l'+post_id).val();
      var fiveh = $('#5h'+post_id).val();
      var fourl = $('#4l'+post_id).val();
      var fourh = $('#4h'+post_id).val();
      var threehalfl = $('#3_5l'+post_id).val();
      var threehalfh = $('#3_5h'+post_id).val();
      var threel = $('#3l'+post_id).val();
      var threeh = $('#3h'+post_id).val();
      var twol = $('#2l'+post_id).val();
      var twoh = $('#2h'+post_id).val();
      var onel = $('#1l'+post_id).val();
      var oneh = $('#1h'+post_id).val();
      var ex_id = $('#ex_id'+post_id).val();
      var ex_code = $('#ex_code'+post_id).val();


      if($.trim(msg).length == 0){
        error_msg = "অনুগ্রহ করে বিষয়ের নাম দিন!";
        $('#status_sub_add'+post_id).text(error_msg);
      }else{
        error_msg = "";
        $('#status_sub_add'+post_id).text(error_msg);
      }
      if(error_msg != ''){
        return false;
      }else{
        $.ajax({
              url:'getexam.php',
              type:'post',
              data: {
                subjectName: msg,
                post_id: post_id,
                marks:marks,
                mcq:mcq,
                fivel:fivel,
                fiveh:fiveh,
                fourl:fourl,
                fourh:fourh,
                threehalfl:threehalfl,
                threehalfh:threehalfh,
                threel:threel,
                threeh:threeh,
                twol:twol,
                twoh:twoh,
                onel:onel,
                oneh:oneh,
                ex_id:ex_id,
                ex_code:ex_code,
                postaexam: true,
              },
              success: function(response){
                $('#status_sub_add'+post_id).html(response);
                // alert(response);

              }
            });
      }

    });
  });
</script>

<!-- subject update -->
<script>
  $(document).ready(function(){
    $(document).on('click','.subject_marks_update_btn', function(){

      var postt_id = $(this).attr('id');


      var marks = $('#marks_'+postt_id).val();
      var mcq = $('#mcq_'+postt_id).val();
      var fivel = $('#5l_'+postt_id).val();
      var fiveh = $('#5h_'+postt_id).val();
      var fourl = $('#4l_'+postt_id).val();
      var fourh = $('#4h_'+postt_id).val();
      var threehalfl = $('#3_5l_'+postt_id).val();
      var threehalfh = $('#3_5h_'+postt_id).val();
      var threel = $('#3l_'+postt_id).val();
      var threeh = $('#3h_'+postt_id).val();
      var twol = $('#2l_'+postt_id).val();
      var twoh = $('#2h_'+postt_id).val();
      var onel = $('#1l_'+postt_id).val();
      var oneh = $('#1h_'+postt_id).val();
      var ex_id = $('#ex_id_'+postt_id).val();
      var ex_code = $('#ex_code_'+postt_id).val();


        $.ajax({
              url:'getexam.php',
              type:'post',
              data: {
                postt_id: postt_id,
                marks:marks,
                mcq:mcq,
                fivel:fivel,
                fiveh:fiveh,
                fourl:fourl,
                fourh:fourh,
                threehalfl:threehalfl,
                threehalfh:threehalfh,
                threel:threel,
                threeh:threeh,
                twol:twol,
                twoh:twoh,
                onel:onel,
                oneh:oneh,
                ex_id:ex_id,
                ex_code:ex_code,
                update_sub: true,
              },
              success: function(response){
                $('#status_sub_update_'+postt_id).html(response);
                // alert(response);

              }
            });


    });
  });
</script>
<!-- subject delete -->



<script>

  $(document).ready(function(){

$(document).on('click','.qr_b3', function(){

var id = $(this).attr('id');

  $.ajax({
        url:'qr_2.php',
        type:'post',
        data: {
          id: id,
          card_qr_ajax: true,
        },
        success: function(response){
          $('#qr_3').html(response);
        }
      });


});

$(document).on('click','.qr_b2', function(){

var id = $(this).attr('id');

  $.ajax({
        url:'qr_1.php',
        type:'post',
        data: {
          id: id,
          mess_qr_ajax: true,
        },
        success: function(response){
          $('#qr_2').html(response);
        }
      });


});

$(document).on('click','.my_qr_ajax_b', function(){

var id = $(this).attr('id');

  $.ajax({
        url:'qr_1.php',
        type:'post',
        data: {
          id: id,
          my_qr_ajax: true,
        },
        success: function(response){
          $('#qr_1').html(response);
        }
      });


});



    $(document).on('click','.subject_marks_delete_btn', function(){

      var posttt_id = $(this).attr('id');

      var ex_id = $('#ex_id_'+posttt_id).val();
      var ex_code = $('#ex_code_'+posttt_id).val();


        $.ajax({
              url:'getexam.php',
              type:'post',
              data: {
                posttt_id: posttt_id,
                ex_id:ex_id,
                ex_code:ex_code,
                delete_sub: true,
              },
              success: function(response){
                $('#status_sub_delete_'+posttt_id).html(response);
                // alert(response);

              }
            });


    });
  });
</script>


<script>
  $(document).ready(function(){
    $(document).on('click','.subject_marksheet_details_btn', function(){

      var sub_id = $(this).attr('id');


        $.ajax({
              url:'get_marks.php',
              type:'post',
              data: {
                sub_id: sub_id,
                marks_sub_details: true,
              },
              success: function(response){
                $('#marksheet_details'+sub_id).html(response);
                // alert(response);

              }
            });


    });
  });
</script>


<script>
  $(document).ready(function(){
    // $('#getdisplaydata1').click(function(){
      getInsertvisitor();
      function getInsertvisitor(){

        var visitor = new FormData($('#form-visito')[0]);

      $.ajax({
        url:'get.php',
        type:'post',
        data: visitor,
        async: false,
        cache: false,
        contentType: false,
        enctype: 'multipart/form-data',
        processData: false,
        success:function(responsedata){
          $('#noticee').html(responsedata);
        }
      });
    }
    // });
  });
</script>


<!-- <script type="text/javascript" src="asset/custom.js"></script>   -->
<script type='text/javascript'>

$(document).ready(function(){

    // $('#load_videos').load('getexam.php');
    $('#load_videos').ready(function(){

        $.ajax({
              url:'getexam.php',
              type:'post',
              data: {
                ex_p: true
              },
              success: function(response){
                $('#load_videos').html(response);



              }
            });


    });

});

$(document).ready(function(){

// $('#load_videos').load('getexam.php');
$('#all_student').ready(function(){

    $.ajax({
          url:'get_std_class.php',
          type:'post',
          data: {
            all_students: true
          },
          success: function(response){
            $('#all_student').html(response);
            $('.all_std_tablee').DataTable(response);
          }
        });


});

});

$(document).ready(function(){
    $(document).on('click','.student_btn_all', function(){

        $.ajax({
              url:'get_std_class.php',
              type:'post',
              data: {
                all_students: true
              },
              success: function(result){
                $('#all_student').html(result);

              }
            });

    });
  });

  $(document).ready(function(){
    $(document).on('click','.section_btn_all', function(){

        $.ajax({
              url:'get_std_class.php',
              type:'post',
              data: {
                all_sections: true
              },
              success: function(response){
                $('#section_classes').html(response);

              }
            });

    });
  });



  function del_std(id){

      jQuery.ajax({
        url:'get_std_class.php',
        type:'post',
        data:'type=delStd&std_id='+id,
        success:function(response){
          alert(response);
          $('#status_std_update').html(response);
          $('#all_student_btn').trigger('click');

        }
      })
    }


function act_std(id){

 jQuery.ajax({
   url:'get_std_class.php',
   type:'post',
   data:'type=upStd&std_id='+id,
   success:function(response){
     alert(response);
     $('#status_std_update').html(response);
     $('#all_student_btn').trigger('click');

   }
 })
}


function add_sub(id){

      jQuery.ajax({
        url:'getexam.php',
        type:'post',
        data:'type=addSub&ex_id='+id,
        success:function(response){
            $('#addsubject1'+id).html(response);

        }
      })
    }




    function std_result_marksheet(id){

      jQuery.ajax({
        url:'get_std_class2.php',
        type:'post',
        data:'typeMarks=subMarks&ex_id='+id,
        success:function(response){
            $('#exam_marksheet_main'+id).html(response);

        }
      })
    }




    function like_updatee(id){

     jQuery.ajax({
       url:'update_love_upost.php',
       type:'post',
       data:'type=like&id='+id,
       success:function(result){
         var cur_count=jQuery('#like_loope_'+id).html();
         cur_count++;
         jQuery('#like_loope_'+id).html(cur_count);
         $('#load_videos').load('getdata7.php');
       }
     })
   }


   function dislike_updatee(id){

     jQuery.ajax({
       url:'update_love_upost.php',
       type:'post',
       data:'type=dislike&id='+id,
       success:function(result){
         var cur_count=jQuery('#dislike_loope_'+id).html();
         cur_count++;
         jQuery('#dislike_loope_'+id).html(cur_count);
         $('#load_videos').load('getdata7.php');
       }
     })
   }





  function love_update_com(id){

      jQuery.ajax({
        url:'update_love_upost2.php',
        type:'post',
        data:'type=love&id='+id,
        success:function(result){
          var cur_count=jQuery('#love_loop_com_'+id).html();
          cur_count++;
          jQuery('#love_loop_com_'+id).html(cur_count);
        }
      })
    }

    function like_update_com(id){

     jQuery.ajax({
       url:'update_love_upost2.php',
       type:'post',
       data:'type=like&id='+id,
       success:function(result){
         var cur_count=jQuery('#like_loop_com_'+id).html();
         cur_count++;
         jQuery('#like_loop_com_'+id).html(cur_count);
       }
     })
   }


   function dislike_update_com(id){

     jQuery.ajax({
       url:'update_love_upost2.php',
       type:'post',
       data:'type=dislike&id='+id,
       success:function(result){
         var cur_count=jQuery('#dislike_loop_com_'+id).html();
         cur_count++;
         jQuery('#dislike_loop_com_'+id).html(cur_count);
       }
     })
   }


</script>

<script type="text/javascript">

    $(document).ready(function(){
        $('.all_student_btn').click(function(){
            $('.classroom_student').css('display','block');
            // $('.msssgu-3').css('display','none');
            // $('.msssgu-4').css('display','none');
            // $('.msssgu-5').css('display','none');
            $('.classroom_section').css('display','none');
        });
    });
</script>

<script type="text/javascript">

    $(document).ready(function(){
        $('.all_class_section_btn').click(function(){
            $('.classroom_student').css('display','none');
            // $('.msssgu-3').css('display','none');
            // $('.msssgu-4').css('display','none');
            // $('.msssgu-5').css('display','none');
            $('.classroom_section').css('display','block');
        });
    });
</script>

<script type="text/javascript">

    $(document).ready(function(){
        $('.btttnu-1').click(function(){
            $('.msssgu-2').css('display','none');
            $('.msssgu-3').css('display','none');
            $('.msssgu-4').css('display','none');
            $('.msssgu-5').css('display','none');
            $('.msssgu-1').css('display','block');
        });
    });
</script>
<script type="text/javascript">
    $(document).ready(function(){
        $('.btttnu-2').click(function(){
            $('.msssgu-1').css('display','none');
            $('.msssgu-3').css('display','none');
            $('.msssgu-4').css('display','none');
            $('.msssgu-5').css('display','none');
            $('.msssgu-2').css('display','block');
        });
    });
</script>
<script type="text/javascript">
    $(document).ready(function(){
        $('.btttnu-3').click(function(){
            $('.msssgu-1').css('display','none');
            $('.msssgu-2').css('display','none');
            $('.msssgu-4').css('display','none');
            $('.msssgu-5').css('display','none');
            $('.msssgu-3').css('display','block');
        });
    });
</script>
<script type="text/javascript">
    $(document).ready(function(){
        $('.btttnu-4').click(function(){
            $('.msssgu-2').css('display','none');
            $('.msssgu-3').css('display','none');
            $('.msssgu-1').css('display','none');
            $('.msssgu-5').css('display','none');
            $('.msssgu-4').css('display','block');
        });
    });
</script>
<script type="text/javascript">
    $(document).ready(function(){
        $('.btttnu-5').click(function(){
            $('.msssgu-1').css('display','none');
            $('.msssgu-2').css('display','none');
            $('.msssgu-3').css('display','none');
            $('.msssgu-4').css('display','none');
            $('.msssgu-5').css('display','block');
        });
    });
</script>



<!-- swap -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/5.4.5/js/swiper.min.js"></script>
<script src="js/validator.min.js"></script>


<script type="text/javascript" src="asset/custom.js"></script>
<!-- <script type="text/javascript" src="user.js"></script> -->
<!-- swap -->
<script>
    //   setInterval(function(){

    //     load_comment();

    // },1000)

    const months = [31,28,31,30,31,30,31,31,30,31,30,31];

function ageCalculate() {
    let today = new Date();
    let inputDate = new Date(document.getElementById('date-input').value);
    let birthYear, birthMonth, birthDay;
    let birthDetails = {
        year: inputDate.getFullYear(),
        month: inputDate.getMonth()+1,
        date: inputDate.getDate(),
    }

    let currentYear = today.getFullYear();
    let currentMonth = today.getMonth()+1;
    let currentDate = today.getDate();

    leapChecker(currentYear);

    if (birthDetails.year > currentYear ||
        (birthDetails.month > currentMonth && birthDetails.year == currentYear) ||
        (birthDetails.date > currentDate && birthDetails.month == currentMonth && birthDetails.year == currentYear))
    {
        alert('Not Born yet');
        displayResult("-","-","-");
        return;
    }

    birthYear = currentYear - birthDetails.year;

    if (currentMonth >= birthDetails.month) {
        birthMonth = currentMonth - birthDetails.month;
    }else{
        birthYear--;
        birthMonth = 12 + currentMonth - birthDetails.month;
    }


    if (currentDate >= birthDetails.date) {
        birthDay = currentDate - birthDetails.date;
    }else{
        birthMonth--;
        let Day = months[currentMonth - 2];
        birthDay = Day + currentDate - birthDetails.date;
        if (birthMonth < 0) {
            birthMonth = 11;
            birthYear--;
        }
    }

    displayResult(birthYear, birthMonth, birthDay);


    function displayResult(bYear, bMonth, bDay) {
        document.getElementById('year').textContent = bYear;
        document.getElementById('month').textContent = bMonth;
        document.getElementById('day').textContent = bDay;
    }

}
function leapChecker(year) {
    if(year % 4 == 0 || (year % 100 == 0 && year % 400 == 0)){
        months[1] = 29;
    }else{
        months[1] = 28;
    }
}




</script>


    <!-- <script src="jquery-3.4.1.min.js"></script> -->
    <script src="sweetalert.min.js"></script>

    <!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js" ></script> -->
  <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.min.js" ></script> -->
  <script src="//cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
  <script>
  $(document).ready( function () {
        // $('.all_std_tablee').DataTable();
  });
  </script>


<script>
  $(document).ready( function () {



  });
  </script>



<script>
    $('#manage-course').on('reset',function(){
        $('#bazar_msg').html('')
        $('input:hidden').val('')
    })
    $('#add_fee').click(function(){
        var ft = $('#ft').val()
        var amount = $('#amount').val()
        if(amount == '' || ft == ''){
            alert_toast("Please fill the Fee Type and Amount field first.",'warning')
            return false;
        }
        var tr = $('#fee_clone tr').clone()
        tr.find('[name="type[]"]').val(ft)
        tr.find('.ftype').text(ft)
        tr.find('[name="amount[]"]').val(amount)
        tr.find('.famount').text(parseFloat(amount).toLocaleString('en-US'))
        $('#fee-list tbody').append(tr)
        $('#ft').val('').focus()
        $('#amount').val('')
        calculate_total()
    })

    function calculate_total(){
        var total = 0;
        $('#fee-list tbody').find('[name="amount[]"]').each(function(){
            total += parseFloat($(this).val())
        })
        $('#fee-list tfoot').find('.tamount').text(parseFloat(total).toLocaleString('en-US'))
        $('#fee-list tfoot').find('[name="total_amount"]').val(total)

    }

    function rem_list(_this){
        _this.closest('tr').remove()
        calculate_total()
    }

    $('#manage-course').submit(function(e){
        e.preventDefault()

        // alert("hiiii");

        $('#bazar_msg').html('')
        if($('#fee-list tbody').find('[name="fid[]"]').length <= 0){
            alert("Please insert atleast 1 row in the fees table",'danger')
            return false;
        }
        $.ajax({
            url:'mess/meal_6.php?action=save_bazar',
            data: new FormData($(this)[0]),
            cache: false,
            contentType: false,
            processData: false,
            method: 'POST',
            type: 'POST',
            success:function(resp){
              // alert(resp);
                if(resp==1){
                    
                    $('#bazar_msg').html('<div class="alert alert-danger mx-2">Successfully saved</div>');

                        Swal.fire({
                          type: 'success',
                          title: "Successfully saved",
                          text: "Your bazar list Updated",
                          icon: "success",
                          button: false,
                          dangerMode: true,
                          timer: 3000,
            
                        })
                          setTimeout(function(){
                                            // location.reload();
                            $('.bazar_set_u_back_btn').trigger('click');
                                        }, 3000);
                    
                }else if(resp==2){
                      $('#bazar_msg').html('<div class="alert alert-danger mx-2">Something went wrong 2! try agina please.</div>')
                }else if(resp==3){
                      $('#bazar_msg').html('<div class="alert alert-danger mx-2">Something went wrong! 3 try agina please.</div>')
                }else if(resp==4){
                      $('#bazar_msg').html('<div class="alert alert-danger mx-2">Something went wrong! 4 try agina please.</div>')
                }
                else{
                    
                         $('#bazar_msg').html('<div class="alert alert-danger mx-2">Successfully saved</div>');

                        Swal.fire({
                          type: 'success',
                          title: "Successfully saved",
                          text: "Your bazar list Updated",
                          icon: "success",
                          button: false,
                          dangerMode: true,
                          timer: 3000,
            
                        })
                          setTimeout(function(){
                                            // location.reload();
                            $('.bazar_set_u_back_btn').trigger('click');
                                        }, 3000);
    
                //   $('#bazar_msg').html('<div class="alert alert-danger mx-2">Something went wrong! else. try agina please.</div>')
                    // alert("Data successfully saved.",'success')
                        // setTimeout(function(){
                        //     location.reload()
                        // },1000)

                }   
            }
        })
    })

    $('.select2').select2({
        placeholder:"Please Select here",
        width:'100%'
    })
</script>


<script>
  $(document).ready(function(){
    $(document).on('click','.add_std_in_class_btn', function(){

      var class_id = $(this).attr('id');

        $.ajax({
              url:'get_std_class2.php',
              type:'post',
              data: {
                class_id: class_id,
                students_for_class: true,
              },
              success: function(response){
                $('#students_all_for_class_'+class_id).html(response);
                $('.all_std_tableee_class_students_'+class_id).DataTable(response);
              }
            });


    });
  });
</script>

<script>
  $(document).ready(function(){
    $(document).on('click','.students_of_classes_btn', function(){

      var class_id = $(this).attr('id');

        $.ajax({
              url:'get_std_class2.php',
              type:'post',
              data: {
                class_id: class_id,
                students_of_class: true,
              },
              success: function(response){
                $('#students_all_of_class_'+class_id).html(response);
                $('.all_std_tableeee_class_students_'+class_id).DataTable(response);
              }
            });


    });
  });
</script>
<script>
  $(document).ready(function(){
    $(document).on('click','.attendence_classes_btn', function(){
      // alert("hi");

      var class_id = $(this).attr('id');
      var today_date1 = $('#attendence_today_date1'+class_id).val();

        $.ajax({
              url:'c_room_1.php',
              type:'post',
              data: {
                C_id: class_id,
                today_date: today_date1,
                students_attendence_class: true,
              },
              success: function(response){
                $('#show_matarials').html(response);
                // alert(response);
              }
            });


    });
  });
</script>


<script>
  $(document).ready(function(){
    $(document).on('click','.btttnu-2', function(){

      // var class_id = $(this).attr('id');
      // var today_date1 = $('#attendence_today_date2'+class_id).val();

        $.ajax({
              url:'mess/meal_5.php',
              type:'post',
              data: {
                user_meal_sec: true,
              },
              success: function(response){
                $('#user_meal_sec_dis').html(response);
              }
            });


    });
  });
</script>


<script>
  $(document).ready(function(){
    $(document).on('click','.filter_attn_btn', function(){
      // alert("hi");

      var id = $(this).attr('id');
      var classCode = $(this).attr('id');
      var sdate = $('#sdate'+id).val();
      var edate = $('#edate'+id).val();
      // var stdName = $('#std_name_att_'+id).val();
      // $(this).css('display','none');

      $.ajax({
              url:'c_room_1.php',
              type:'post',
              data: {
                id: id,
                sdate: sdate,
                classCode: classCode,
                edate: edate,
                filter_attendance: true,
              },
              success: function(response){

                $('#indivisual_sheet'+id).html(response);

                // $('.present_bttn_'+id).css('display','none');
                // $('.absent_bttn_'+id).css('display','none');
                // $('.late2_bttn_'+id).css('display','inline');

              }
            });





    });
    $(document).on('click','.absent_btn', function(){
      // alert("hi");

      var id = $(this).attr('id');

      var today = $('#today_date_id'+id).val();
      var classCode = $('#class_code_att_'+id).val();
      var stdName = $('#std_name_att_'+id).val();

      // $(this).css('display','none');

      $.ajax({
              url:'get_std_class22.php',
              type:'post',
              data: {
                id: id,
                date: today,
                classCode: classCode,
                stdName: stdName,
                students_attendence_a: true,
              },
              success: function(response){
                $('#present_status_std'+id).html(response);

                $('.absent_bttn_'+id).css('display','none');
                $('.present_bttn_'+id).css('display','none');
                $('.late_bttn_'+id).css('display','inline');

              }
            });



    });
    $(document).on('click','.late_btn', function(){
      // alert("hi");

      var id = $(this).attr('id');

      var today = $('#today_date_id'+id).val();
      var classCode = $('#class_code_att_'+id).val();
      var stdName = $('#std_name_att_'+id).val();

      // $(this).css('display','none');

      $.ajax({
              url:'get_std_class22.php',
              type:'post',
              data: {
                id: id,
                date: today,
                classCode: classCode,
                stdName: stdName,
                students_attendence_late: true,
              },
              success: function(response){
                $('#present_status_std'+id).html(response);

                $('.late_bttn_'+id).css('display','none');
                $('.late2_bttn_'+id).css('display','inline');

              }
            });



    });
    $(document).on('click','.late2_btn', function(){
      // alert("hi");

      var id = $(this).attr('id');

      var today = $('#today_date_id'+id).val();
      var classCode = $('#class_code_att_'+id).val();
      var stdName = $('#std_name_att_'+id).val();

      // $(this).css('display','none');

      $.ajax({
              url:'get_std_class22.php',
              type:'post',
              data: {
                id: id,
                date: today,
                classCode: classCode,
                stdName: stdName,
                students_attendence_late2: true,
              },
              success: function(response){
                $('#present_status_std'+id).html(response);

                $('.late2_bttn_'+id).css('display','none');
                $('.late_bttn_'+id).css('display','inline');

              }
            });



    });
    $(document).on('click','.absent_up_btn', function(){
      // alert("hi");

      var id = $(this).attr('id');

      var today = $('#today_date_id'+id).val();
      var classCode = $('#class_code_att_'+id).val();
      var stdName = $('#std_name_att_'+id).val();

      // $(this).css('display','none');

      $.ajax({
              url:'get_std_class22.php',
              type:'post',
              data: {
                id: id,
                date: today,
                classCode: classCode,
                stdName: stdName,
                students_attendence_a_up: true,
              },
              success: function(response){
                $('#present_status_std'+id).html(response);

                $('.absent_up_bttn_'+id).css('display','none');
                $('.a_to_p_up_bttn_'+id).css('display','inline');


              }
            });



    });
    $(document).on('click','.a_to_p_up_btn', function(){
      // alert("hi");

      var id = $(this).attr('id');

      var today = $('#today_date_id'+id).val();
      var classCode = $('#class_code_att_'+id).val();
      var stdName = $('#std_name_att_'+id).val();

      // $(this).css('display','none');

      $.ajax({
              url:'get_std_class22.php',
              type:'post',
              data: {
                id: id,
                date: today,
                classCode: classCode,
                stdName: stdName,
                students_attendence_a_p_up: true,
              },
              success: function(response){
                $('#present_status_std'+id).html(response);

                $('.a_to_p_up_bttn_'+id).css('display','none');
                $('.absent_up_bttn_'+id).css('display','inline');


              }
            });


    });
    $(document).on('click','.present_up_btn', function(){
      // alert("hi");

      var id = $(this).attr('id');

      var today = $('#today_date_id'+id).val();
      var classCode = $('#class_code_att_'+id).val();
      var stdName = $('#std_name_att_'+id).val();

      // $(this).css('display','none');

      $.ajax({
              url:'get_std_class22.php',
              type:'post',
              data: {
                id: id,
                date: today,
                classCode: classCode,
                stdName: stdName,
                students_attendence_p_up: true,
              },
              success: function(response){
                $('#present_status_std'+id).html(response);

                $('.present_up_bttn_'+id).css('display','none');
                $('.p_to_a_up_bttn_'+id).css('display','inline');


              }
            });



    });
    $(document).on('click','.p_to_a_up_btn', function(){
      // alert("hi");

      var id = $(this).attr('id');

      var today = $('#today_date_id'+id).val();
      var classCode = $('#class_code_att_'+id).val();
      var stdName = $('#std_name_att_'+id).val();

      // $(this).css('display','none');

      $.ajax({
              url:'get_std_class22.php',
              type:'post',
              data: {
                id: id,
                date: today,
                classCode: classCode,
                stdName: stdName,
                students_attendence_p_a_up: true,
              },
              success: function(response){
                $('#present_status_std'+id).html(response);

                $('.p_to_a_up_bttn_'+id).css('display','none');
                $('.present_up_bttn_'+id).css('display','inline');


              }
            });



    });
  });
</script>


<script>
  $(document).ready(function(){
    $(document).on('click','.meal_search_b', function(){
      var userId = $(this).attr('id');
      var datese = $('#meal_search_date').val();

        $.ajax({
              url:'mess/meal_6.php',
              type:'post',
              data: {
                u_id: userId,
                datese: datese,
                future_mealss_d: true,
              },
              success: function(response){
                $('#future_mealss').html(response);
              }
            });


    });
    $(document).on('click','.meall_search_b', function(){
      var userId = $(this).attr('id');
      var datese = $('#meall_search_date').val();

        $.ajax({
              url:'mess/meal_6.php',
              type:'post',
              data: {
                u_id: userId,
                datese: datese,
                future_mealss_d: true,
              },
              success: function(response){
                $('#future_meallss').html(response);
              }
            });


    });    
    $(document).on('click','.meals_search_b', function(){
      var userId = $(this).attr('id');
      var datese = $('#meals_search_date').val();

        $.ajax({
              url:'mess/meal_6.php',
              type:'post',
              data: {
                u_id: userId,
                datese: datese,
                future_mealss_d: true,
              },
              success: function(response){
                $('#future_mealsss').html(response);
              }
            });


    });    
  });
</script>


<script>
    $(document).ready(function(){

        // $("#sel_u_for_con").change(function(){
        //     var UserId=$(this).val();
        //     alert(UserId);
        //     $.ajax({
        //         method:"POST",
        //         url:"mess/meal_7.php",
        //         data:{idUser:UserId},
        //         // dataType:"html",
        //         success:function(data){
        //             $("").html(data);
        //         }
        //     });
        // });

    });

    $(document).ready(function(){
    $(document).on('change','#sel_u_for_con', function(){
      var UserId=$(this).val();
        $.ajax({
              url:'mess/meal_7.php',
              type:'post',
              data: {
                idUser : UserId,
                sel_u_for_m_b: true,
              },
              success: function(response){
                $('#user_all_content').html(response);
              }
            });

    });

    $(document).on('click','.bazar_sec_btn', function(){
      var UserId=$(this).attr('id');
            // alert(UserId);
        $.ajax({
              url:'mess/meal_7.php',
              type:'post',
              data: {
                UserId : UserId,
                bazar_user: true,
              },
              success: function(response){
                $('#section_bazar').html(response);
              }
            });

    });
    $(document).on('click','.bazarr_sec_btn', function(){
      var UserId=$(this).attr('id');
            // alert(UserId);
        $.ajax({
              url:'mess/meal_ind.php',
              type:'post',
              data: {
                UserId : UserId,
                bazar_user: true,
              },
              success: function(response){
                $('#section_bazarr').html(response);
              }
            });

    });
  });
</script>

<!-- <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script> -->
</body>

</html>






 <script>
        // const HtmlBtn = document.getElementById('HtmlBtn');
        // const HtmlCode = document.getElementById('HtmlCode');
        // const HtmlNotice = document.getElementById('notice');
        // HtmlBtn.addEventListener('click',()=>{
        //     HtmlCode.select();
        //     document.execCommand('copy');
        //     HtmlNotice.innerHTML = "ধন্যবাদ! আপনি হোম বাটনে ক্লিক করেছেন! লিংক সিলেক্ট হয়েছে! শেয়ার করুন!"
        // });


</script>









<script>
$(document).ready(function(){



    $(document).on('click', '.std_check_box', function(){
        var html = '';
        if(this.checked)
        {
            html = '<td><input type="checkbox" id="'+$(this).attr('id')+'" data-main="'+$(this).data('main')+'" data-idd="'+$(this).data('idd')+'" data-std_name="'+$(this).data('std_name')+'" data-class="'+$(this).data('class')+'" data-roll="'+$(this).data('roll')+'" data-phone="'+$(this).data('phone')+'" class="st_check_box" checked /></td>';
            html += '<td>'+$(this).data("idd")+'</td>';
            html += '<td>S.ID</td>';
            html += '<td><input type="text" name="std_name[]" class="form-control" value="'+$(this).data("std_name")+'" /></td>';
            html += '<td><input type="text" name="class[]" class="form-control" value="'+$(this).data("class")+'" /></td>';
            html += '<td><input type="text" name="sec[]" class="form-control" value="'+$(this).data("sec")+'" /></td>';
            html += '<td><input type="text" name="roll[]" class="form-control" value="'+$(this).data("roll")+'" /></td>';
            html += '<td><input type="text" name="phone[]" class="form-control" value="'+$(this).data("phone")+'" /><input type="hidden" name="hidden_id[]" value="'+$(this).attr('id')+'" /></td>';
            html += '<td class="del_std_data" id="'+$(this).data("main")+'"><button type="button" class="badge btn btn-warning" >Delete</button></td>';
            html += '<td class="up_std_data" id="'+$(this).data("main")+'"><button type="button" class="badge btn btn-warning" >Update</button></td>';

        }
        else
        {
            html = '<td><input type="checkbox" id="'+$(this).attr('id')+'" data-idd="'+$(this).data('idd')+'" data-std_name="'+$(this).data('std_name')+'" data-class="'+$(this).data('class')+'" data-sec="'+$(this).data('sec')+'" data-roll="'+$(this).data('roll')+'" data-phone="'+$(this).data('phone')+'" class="check_box" /></td>';
            html += '<td>'+$(this).data('idd')+'</td>';
            html += '<td>'+$(this).data('std_name')+'</td>';
            html += '<td>'+$(this).data('class')+'</td>';
            html += '<td>'+$(this).data('sec')+'</td>';
            html += '<td>'+$(this).data('roll')+'</td>';
            html += '<td>'+$(this).data('phone')+'</td>';
            html += '<td></td>';
            html += '<td></td>';
        }
        $(this).closest('tr').html(html);
        // $('#gender_'+$(this).attr('id')+'').val($(this).data('gender'));
    });







    $('#update_std_form').on('submit', function(event){
        event.preventDefault();
        // alert('hi');
        if($('.st_check_box:checked').length > 0)
        {
            $.ajax({
                url:"getexam.php",
                method:"POST",
                data:$(this).serialize(),
                success:function(result)
                {
                    alert("UPDATED!!!");
                    $('#status_std_update').html(result);
                    $('#all_student_btn').trigger('click');

                }
            })
        }
    });

});
</script>


<script>

    $(document).ready(function(){
    $(document).on('click','.out_student_from_class', function(){
      // alert('hi');


      var std_id = $(this).attr('id');


      var class_code = $('#class_out_code__'+std_id).val();



        $.ajax({
              url:'get_std_class22.php',
              type:'post',
              data: {
                std_id: std_id,
                class_code:class_code,
                out_student_from_class: true,
              },
              success: function(response){
                $('#out_std_from_class_update_'+class_code).html(response);
                // alert(response);

              }
            });


    });
  });


</script>

<script>

    $(document).ready(function(){
    $(document).on('click','.add_student_in_class', function(){


      var std_id = $(this).attr('id');


      var class_code = $('#class_code_'+std_id).val();



        $.ajax({
              url:'get_std_class22.php',
              type:'post',
              data: {
                std_id: std_id,
                class_code:class_code,
                add_student_in_class: true,
              },
              success: function(response){
                $('#add_std_in_class_update_'+class_code).html(response);
                // alert(response);

              }
            });


    });
  });


</script>


<script>

    $(document).ready(function(){
    $(document).on('click','.exam_class_code_update_btn', function(){
          // alert('hi');

      var class_id = $(this).attr('id');


      var class_code = $('#exam_class_code_updated_'+class_id).val();



        $.ajax({
              url:'get_std_class22.php',
              type:'post',
              data: {
                class_id: class_id,
                class:class_code,
                updated_class_code: true,
              },
              success: function(response){
                $('#status_class_update_'+class_id).html(response);
                // alert(response);

              }
            });


    });
  });


</script>





<script>

    $(document).ready(function(){
    $(document).on('click','.bazar_up_btnmmmmmm', function(){

      var std_id = $(this).attr('id');

      var class_code = $('#exam_class_code_'+std_id).val();
      var student_id = $('#examm_student_id_'+std_id).val();
      var exam_code = $('#examm_code_'+std_id).val();
      var exam_id = $('#exam_ID_'+std_id).val();
      // alert(exam_code);

      $.ajax({
              url:'get_marks.php',
              type:'post',
              data: {
                std_id:std_id,
                class_code:class_code,
                exam_code:exam_code,
                exam_id:exam_id,
                student_id:student_id,
                add_marks:true,
              },
              success: function(response){
                $('#student_status_marksheet_'+exam_code).html(response);
                // alert(response);

              }
            });


    });
  });


</script>



<script>

    $(document).ready(function(){
    $(document).on('click','.student_in_marksheet_btn', function(){

      var std_id = $(this).attr('id');

      var class_code = $('#exam_class_code_'+std_id).val();
      var student_id = $('#examm_student_id_'+std_id).val();
      var exam_code = $('#examm_code_'+std_id).val();
      var exam_id = $('#exam_ID_'+std_id).val();
      // alert(exam_code);

      $.ajax({
              url:'get_marks.php',
              type:'post',
              data: {
                std_id:std_id,
                class_code:class_code,
                exam_code:exam_code,
                exam_id:exam_id,
                student_id:student_id,
                show_marks:true,
              },
              success: function(response){
                $('#marks_subject_'+std_id).html(response);
                // alert(response);

              }
            });


    });
  });


</script>


<script>

    $(document).ready(function(){
    $(document).on('click','.marks_sub_update_btn_', function(){

      var std_id = $(this).attr('id');

      var sub_code = $('#marks_sub_code_'+std_id).val();
      var student_id = $('#marks_std_id_'+std_id).val();
      var exam_code = $('#marks_ex_code_'+std_id).val();
      var cq = $('#written_sub_marks_'+std_id).val();
      var mcq = $('#mcq_sub_marks_'+std_id).val();


      $.ajax({
              url:'get_marks.php',
              type:'post',
              data: {
                this_id:std_id,
                sub_code:sub_code,
                exam_code:exam_code,
                student_id:student_id,
                cq:cq,
                mcq:mcq,
                update_marks_1:true,
              },
              success: function(response){
                $('#status_exam_sub_marks_up_'+exam_code).html(response);
                // alert(response);

              }
            });


    });
  });


</script>



<script>

    $(document).ready(function(){
    $(document).on('click','.marks_details_up_all_btn', function(){

      var std_id = $(this).attr('id');

      var sub_code = $('#marks_sub_code_all_'+std_id).val();
      var student_id = $('#marks_std_id_all_'+std_id).val();
      var exam_code = $('#marks_ex_code_all_'+std_id).val();

      var cq = $('#written_sub_marks_all_'+std_id).val();
      var mcq = $('#mcq_sub_marks_all_'+std_id).val();


      $.ajax({
              url:'get_marks.php',
              type:'post',
              data: {
                this_id:std_id,
                sub_code:sub_code,
                exam_code:exam_code,
                student_id:student_id,
                cq:cq,
                mcq:mcq,
                update_marks_1:true,
              },
              success: function(response){
                $('#status_exam_sub_marks_up_all_'+sub_code).html(response);
                // $('.sub_marks_another'+sub_code).trigger('click');
                // alert(response);

              }
            });


    });
  });


  $(document).ready(function(){

$(document).on('click','.meal_sec_btn', function(){

$('#section_bazar').addClass('hidden');
$('#section_others').addClass('hidden');
$('#section_meal').removeClass('hidden');

});
$(document).on('click','.bazar_sec_btn', function(){

$('#section_meal').addClass('hidden');
$('#section_others').addClass('hidden');
$('#section_bazar').removeClass('hidden');

});
$(document).on('click','.others_sec_btn', function(){

$('#section_bazar').addClass('hidden');
$('#section_meal').addClass('hidden');
$('#section_others').removeClass('hidden');

});

$(document).on('click','.meall_sec_btn', function(){

$('#section_bazarr').addClass('hidden');
$('#section_otherss').addClass('hidden');
$('#section_meall').removeClass('hidden');

});
$(document).on('click','.bazarr_sec_btn', function(){

$('#section_meall').addClass('hidden');
$('#section_otherss').addClass('hidden');
$('#section_bazarr').removeClass('hidden');

});
$(document).on('click','.otherss_sec_btn', function(){

$('#section_bazarr').addClass('hidden');
$('#section_meall').addClass('hidden');
$('#section_otherss').removeClass('hidden');

});



    $(document).on('click','.bihousefill', function(){

      $('.menu-main').addClass('active');
      $('.menu-t').addClass('active');
      $('.bihousefill').addClass('bihousefilll');
      $('.bihousefill').removeClass('bi-house-fill');
      $('.bihousefill').addClass('bi-x-diamond-fill');
      $('.bihousefill').removeClass('bihousefill');

  });
  $(document).on('click','.bihousefilll', function(){


$('.menu-main').removeClass('active');
$('.menu-t').removeClass('active');
$('.bihousefilll').addClass('bihousefill');
$('.bihousefilll').removeClass('bi-x-diamond-fill');
$('.bihousefilll').addClass('bi-house-fill');
$('.bihousefilll').removeClass('bihousefilll');



});

$(document).on('click','.menuList0', function(){

$('.menuList1').removeClass('active');
$('.menuList2').removeClass('active');
$('.menuList3').removeClass('active');
$('.menuList4').removeClass('active');
$('.menuList5').removeClass('active');
$('.menuList6').removeClass('active');
$(this).addClass('active');

});
$(document).on('click','.menuList1', function(){

$('.menuList0').removeClass('active');
$('.menuList2').removeClass('active');
$('.menuList3').removeClass('active');
$('.menuList4').removeClass('active');
$('.menuList5').removeClass('active');
$('.menuList6').removeClass('active');
$(this).addClass('active');

});
$(document).on('click','.menuList2', function(){

$('.menuList1').removeClass('active');
$('.menuList0').removeClass('active');
$('.menuList3').removeClass('active');
$('.menuList4').removeClass('active');
$('.menuList5').removeClass('active');
$('.menuList6').removeClass('active');
$(this).addClass('active');

});
$(document).on('click','.menuList3', function(){

$('.menuList1').removeClass('active');
$('.menuList2').removeClass('active');
$('.menuList0').removeClass('active');
$('.menuList4').removeClass('active');
$('.menuList5').removeClass('active');
$('.menuList6').removeClass('active');
$(this).addClass('active');

});
$(document).on('click','.menuList4', function(){

$('.menuList1').removeClass('active');
$('.menuList2').removeClass('active');
$('.menuList3').removeClass('active');
$('.menuList0').removeClass('active');
$('.menuList5').removeClass('active');
$('.menuList6').removeClass('active');
$(this).addClass('active');

});
$(document).on('click','.menuList5', function(){

$('.menuList1').removeClass('active');
$('.menuList2').removeClass('active');
$('.menuList3').removeClass('active');
$('.menuList4').removeClass('active');
$('.menuList0').removeClass('active');
$('.menuList6').removeClass('active');
$(this).addClass('active');

});
$(document).on('click','.menuList6', function(){

$('.menuList1').removeClass('active');
$('.menuList2').removeClass('active');
$('.menuList3').removeClass('active');
$('.menuList4').removeClass('active');
$('.menuList5').removeClass('active');
$('.menuList0').removeClass('active');
$(this).addClass('active');

});

});



$(document).ready(function(){
    $(document).on('click','.create_new_mess', function(){
      // alert("success");
      var my_id = $(this).attr('id');
        $.ajax({
              url:'code_pass.php',
              type:'post',
              data: {
                my_id:my_id,
                create_new_mess: true,
              },
              success: function(response){
                $('#display_code_pass').html(response);
                // alert("success");
              }
            });

    });
  });

  $(document).ready(function(){

    $(document).on('click','.setup_mess_id', function(){

      var my_id = $(this).attr('id');
        $.ajax({
              url:'code_pass.php',
              type:'post',
              data: {
                my_id:my_id,
                setup_mess: true,
              },
              success: function(response){
                $('#display_code_pass').html(response);

              }
            });

    });



    $(document).on('click', '.create_mess_btn', function(){
        if($('#mess_name').val()!=''){
            $('#mess_c_btn').text('Creating in...');
            $('#myalert_m').slideUp();
            var messform = $('#mess_c_form').serialize();
            setTimeout(function(){
                $.ajax({
                    method: 'POST',
                    url: 'mess/mess_create.php',
                    data: messform,
                    success:function(data){
                        if(data==1){
                            $('#myalert_m').slideDown();
                            $('#alerttext_m').text('Created Successful. Mess Verified!');
                            $('#mess_c_btn').text('Created! Thank You!');
                            $('#mess_c_form')[0].reset();

              // back button clilcked

                            setTimeout(function(){
                                // location.reload();
                $(".meal_sett_back_butn").trigger("click");
                                                location.reload();
                            }, 2000);
                        }
                        else{
                            $('#myalert_m').slideDown();
                            $('#alerttext_m').html(data);
                            $('#mess_c_btn').text('Try Again!');
                            $('#mess_c_form')[0].reset();
                        }
                    }
                });
            }, 2000);
        }
        else{
            alert('Please input Phone fields to Create');
        }
    });


  $(document).on('click', '.set_mess_btn', function(){
        if($('#mess_id_set').val()!=''){
            $('#mess_u_btn').text('Creating in...');
            $('#myalert_mm').slideUp();
            var messform = $('#mess_u_form').serialize();
            setTimeout(function(){
                $.ajax({
                    method: 'POST',
                    url: 'mess/mess_create.php',
                    data: messform,
                    success:function(data){
                        if(data==1){
                            $('#myalert_mm').slideDown();
                            $('#alerttext_mm').text('Updated Successful. Mess Verified!');
                            $('#mess_u_btn').text('Updated! Thank You!');
                            $('#mess_u_form')[0].reset();

              // back button clilcked

                            setTimeout(function(){
                                // location.reload();
                $(".meal_sett_back_butn").trigger("click");
                                                location.reload();
                            }, 2000);
                        }
                        else{
                            $('#myalert_mm').slideDown();
                            $('#alerttext_mm').html(data);
                            $('#mess_u_btn').text('Try Again!');
                            $('#mess_u_form')[0].reset();
                        }
                    }
                });
            }, 2000);
        }
        else{
            alert('Please input Phone fields to Create');
        }
    });


    $(document).on('click','.daily_meal_r', function(){

      var meal_id = $(this).attr('id');
        $.ajax({
              url:'code_pass.php',
              type:'post',
              data: {
                meal_id:meal_id,
                req_mess_meal: true,
              },
              success: function(response){
                $('#daily_meal_disp').html(response);
                  // alert("hi");
              }
            });

    });

    $(document).on('click','.re_morning_meal', function(){

      $('#press_btn_s').text('Requesting in...');
            $('#myalert_mmmm').slideUp();
      var meal_id = $(this).attr('id');

      Swal.fire({
        title: 'Are you sure!?',
        text: 'Meal will be Updated!',
        type: 'warning',
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes! Meal !',

      }).then((resultm) => {

          if(resultm.value){

            $.ajax({
            url:'mess/mess_create.php',
            type:'post',
            data: {
              meal_id:meal_id,
              morning_meal: true,
            },
            success: function(response){

              if(response==1){
                $('#daily_meal_alert').html(response);
                  // alert(meal_id);

                $('#myalert_mmmm').slideDown();
                $('#alerttext_mmmm').text('Updated Successful. Meal Verified!');
                $('#press_btn_s').text('Updated! Thank You!');
                setTimeout(() => {
                  $('#myalert_mmmm').slideUp();
                }, 3000);
              }else{
                $('#daily_meal_alert').html(response);
                // alert(meal_id);

                $('#myalert_mmmm').slideDown();
                $('#alerttext_mmmm').text('Sorry! Try again. Meal not Verified!');
                $('#press_btn_s').text('Try Again!');
                setTimeout(() => {
                  $('#myalert_mmmm').slideUp();
                }, 3000);
              }

              // $('#daily_meal_alert').html(response);
              //   $('#myalert_mmmm').slideDown();
                            // $('#alerttext_mmmm').text('Updated Successful. Meal Verified!');
                            // $('#press_btn_s').text('Updated! Thank You!');
              // setTimeout(() => {
              //   $('#myalert_mmmm').slideUp();
              // }, 3000);

            }
            });
              
          }else{
            Swal.fire({
              type: 'info',
              title: "Try again!",
              text: "Something went wrong!",
              icon: "info",
              button: false,
              dangerMode: true,
              timer: 3000,

            })
          }

      })




    });



    $(document).on('click','.re_launce_meal', function(){

      $('#press_btn_s').text('Requesting in...');
            $('#myalert_mmmm').slideUp();
      var meal_id = $(this).attr('id');



      Swal.fire({
        title: 'Are you sure!?',
        text: 'Meal will be Updated!',
        type: 'warning',
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes! Meal !',

      }).then((resultm) => {

          if(resultm.value){

            $.ajax({
            url:'mess/mess_create.php',
            type:'post',
            data: {
              meal_id:meal_id,
              launce_meal: true,
            },
            success: function(response){
              if(response==1){
                $('#daily_meal_alert').html(response);
                  // alert(meal_id);

                $('#myalert_mmmm').slideDown();
                $('#alerttext_mmmm').text('Updated Successful. Meal Verified!');
                $('#press_btn_s').text('Updated! Thank You!');
                setTimeout(() => {
                  $('#myalert_mmmm').slideUp();
                }, 3000);
              }else{
                $('#daily_meal_alert').html(response);
                // alert(meal_id);

                $('#myalert_mmmm').slideDown();
                $('#alerttext_mmmm').text('Sorry! Try again. Meal not Verified!');
                $('#press_btn_s').text('Try Again!');
                setTimeout(() => {
                  $('#myalert_mmmm').slideUp();
                }, 3000);
              }


            }
            });
              
          }else{
            Swal.fire({
              type: 'info',
              title: "Try again!",
              text: "Something went wrong!",
              icon: "info",
              button: false,
              dangerMode: true,
              timer: 3000,

            })
          }

      })



    });

    $(document).on('click','.re_dinner_meal', function(){

      $('#press_btn_s').text('Requesting in...');
            $('#myalert_mmmm').slideUp();
      var meal_id = $(this).attr('id');


      Swal.fire({
        title: 'Are you sure!?',
        text: 'Meal will be Updated!',
        type: 'warning',
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes! Meal !',

      }).then((resultm) => {

          if(resultm.value){

            $.ajax({
            url:'mess/mess_create.php',
            type:'post',
            data: {
              meal_id:meal_id,
              dinner_meal: true,
            },
            success: function(response){
              if(response==1){
                $('#daily_meal_alert').html(response);
                  // alert(meal_id);

                $('#myalert_mmmm').slideDown();
                $('#alerttext_mmmm').text('Updated Successful. Meal Verified!');
                $('#press_btn_s').text('Updated! Thank You!');
                setTimeout(() => {
                  $('#myalert_mmmm').slideUp();
                }, 3000);
              }else{
                $('#daily_meal_alert').html(response);
                // alert(meal_id);

                $('#myalert_mmmm').slideDown();
                $('#alerttext_mmmm').text('Sorry! Try again. Meal not Verified!');
                $('#press_btn_s').text('Try Again!');
                setTimeout(() => {
                  $('#myalert_mmmm').slideUp();
                }, 3000);
              }


            }
            });
              
          }else{
            Swal.fire({
              type: 'info',
              title: "Try again!",
              text: "Something went wrong!",
              icon: "info",
              button: false,
              dangerMode: true,
              timer: 3000,

            })
          }

      })


    });




    $(document).on('click', '.s_meal_add_btn', function(){
        if($('#todate').val()!=''){
            $('#s_meal_add_btn').text('Requesting in...');
            $('#myalert_mmm').slideUp();
            var messform = $('#specific_meal').serialize();
            setTimeout(function(){
                $.ajax({
                    method: 'POST',
                    url: 'mess/mess_create.php',
                    data: messform,
                    success:function(data){
                        if(data==1){
                            $('#myalert_mmm').slideDown();
                            $('#alerttext_mmm').text('Updated Successful. Meal Verified!');
                            $('#s_meal_add_btn').text('Updated! Thank You!');
                            $('#specific_meal')[0].reset();

              // back button clilcked

                            setTimeout(function(){
                                // location.reload();
                $(".meal_add_back_butn").trigger("click");
                                                // location.reload();
                            }, 2000);
              setTimeout(() => {
                $('#myalert_mmm').slideUp();
              }, 3000);
                        }
                        else{
                            $('#myalert_mmm').slideDown();
                            $('#alerttext_mmm').html(data);
                            $('#s_meal_add_btn').text('Try Again!');
                            $('#specific_meal')[0].reset();
                        }
                    }
                });
            }, 2000);
        }
        else{
            alert('Please input Phone fields to Create');
        }
    });



  $(document).on('click', '.payment_user_f_btn', function(){
        if($('#m_for_p_date').val()!=''){
            $('#payment_user_f_btn').text('Requesting in...');
            $('#myalert_np').slideUp();
            var messform = $('#payment_form_data').serialize();
            setTimeout(function(){
                $.ajax({
                    method: 'POST',
                    url: 'mess/meal_8.php',
                    data: messform,
                    success:function(data){
                        if(data==1){
                            $('#myalert_np').slideDown();
                            $('#alerttext_np').text('Payment saved Successful.');
                            $('#payment_user_f_btn').text('Saved! Thank You!');
                            $('#payment_form_data')[0].reset();

              Swal.fire({
              type: 'success',
              title: "Successfully added!",
              text: "THank you admin saheb!",
              icon: "success",
              button: false,
              dangerMode: true,
              timer: 3000,

              })
              // back button clilcked

                            setTimeout(function(){
                                // location.reload();
                // $(".meal_add_back_butn").trigger("click");
                                                // location.reload();
                            }, 2000);
              setTimeout(() => {
                $('#myalert_np').slideUp();
              }, 3000);
                        }
                        else{
                            $('#myalert_np').slideDown();
                            $('#alerttext_np').html(data);
                            $('#payment_user_f_btn').text('Try Again!');
                            $('#payment_form_data')[0].reset();

              Swal.fire({
              type: 'info',
              title: "U are an user!",
              text: "YOu need permission to add payment",
              icon: "info",
              button: false,
              dangerMode: true,
              timer: 3000,

            })

                        }
                    }
                });
            }, 2000);
        }
        else{
            alert('Please input Phone fields to Create');
        }
    });


// user fee adding ajax


$(document).on('click', '.fee_ind_a_btn', function(){
  // alert('hiii');
        if($('#fee_ind_a_a').val()!=''){
            $('.fee_ind_a_btn').text('Requesting in...');
            $('#myalert_mmfeee').slideUp();
            var messform_f = $('#fee_ind_a_form').serialize();
            setTimeout(function(){
                $.ajax({
                    method: 'POST',
                    url: 'mess/mess_create.php',
                    data: messform_f,
                    success:function(data){
                        if(data==1){
                            $('#myalert_mmfeee').slideDown();
                            $('#alerttext_mmfeee').text('Added Successful. Fee Verified!');
                            $('.fee_ind_a_btn').text('Added! Thank You!');
                            $('#fee_ind_a_form')[0].reset();

              Swal.fire({
              type: 'success',
              title: "Successfully added!",
              text: "THank you admin saheb!",
              icon: "success",
              button: false,
              dangerMode: true,
              timer: 3000,

            })
              // back button clilcked

                            setTimeout(function(){
                                // location.reload();
                $(".indivisual_fee_user").trigger("click");
                                                // location.reload();
                            }, 2000);
              setTimeout(function(){
                                // location.reload();
                $('.fee_ind_a_btn').text('Add one more!');
                                                // location.reload();
                            }, 3000);
              setTimeout(() => {
                $('#myalert_mmfeee').slideUp();
              }, 3000);
                        }else if(data==3){
                            $('#myalert_mmfeee').slideDown();
                            $('#alerttext_mmfeee').html("You are not an admin");
                            $('.fee_ind_a_btn').text('You have no permission!');
                            $('#fee_ind_a_form')[0].reset();
              Swal.fire({
              type: 'info',
              title: "U are an user!",
              text: "YOu need permission to add mess fee!",
              icon: "info",
              button: false,
              dangerMode: true,
              timer: 3000,

            })
            }
                        else{
                            $('#myalert_mmfeee').slideDown();
                            $('#alerttext_mmfeee').html(data);
                            $('.fee_ind_a_btn').text('Try Again!');
                            $('#fee_ind_a_form')[0].reset();
                        }
                    }
                });
            }, 2000);
        }
        else{
            alert('Please input Amount field to add');
        }
    });

// mess_fee_list_table add ajax


$(document).on('click', '.fee_m_ad_btn', function(){
  // alert('hiii');
        if($('#fee_m_a_a').val()!=''){
            $('#fee_m_a_btn').text('Requesting in...');
            $('#myalert_mmfee').slideUp();
            var messform_f = $('#fee_m_a_form').serialize();
            setTimeout(function(){
                $.ajax({
                    method: 'POST',
                    url: 'mess/mess_create.php',
                    data: messform_f,
                    success:function(data){
                        if(data==1){
                            $('#myalert_mmfee').slideDown();
                            $('#alerttext_mmfee').text('Added Successful. Fee Verified!');
                            $('#fee_m_a_btn').text('Added! Thank You!');
                            $('#fee_m_a_form')[0].reset();

              // back button clilcked

                            setTimeout(function(){
                                // location.reload();
                $(".mess_fee_list_table").trigger("click");
                                                // location.reload();
                            }, 2000);
              setTimeout(function(){
                                // location.reload();
                $('#fee_m_a_btn').text('Add one more!');
                                                // location.reload();
                            }, 3000);
              setTimeout(() => {
                $('#myalert_mmfee').slideUp();
              }, 3000);
                        }else if(data==3){
                            $('#myalert_mmfee').slideDown();
                            $('#alerttext_mmfee').html("You are not an admin");
                            $('#fee_m_a_btn').text('You have no permission!');
                            $('#fee_m_a_form')[0].reset();
              Swal.fire({
              type: 'info',
              title: "U are an user!",
              text: "YOu need permission to add mess fee!",
              icon: "info",
              button: false,
              dangerMode: true,
              timer: 3000,

            })
            }
                        else{
                            $('#myalert_mmfee').slideDown();
                            $('#alerttext_mmfee').html(data);
                            $('#fee_m_a_btn').text('Try Again!');
                            $('#fee_m_a_form')[0].reset();
                        }
                    }
                });
            }, 2000);
        }
        else{
            alert('Please input Amount field to add');
        }
    });



  });



$(document).ready(function(){


// $('#my_meal_display_he').load('getexam.php');

$('#user_per_sett').ready(function(){

    $.ajax({
          url:'mess/meal.php',
          type:'post',
          data: {
            meal_of_on_up: true
          },
          success: function(response){

            $('#user_per_sett').html(response);

          }
        });


});


$('#my_meal_display_he').ready(function(){

$.ajax({
      url:'mess/meal.php',
      type:'post',
      data: {
        my_daily_meal_dis: true
      },
      success: function(response){

        $('#my_meal_display_he').html(response);

      }
    });


});


$(document).on('click','.meal_disp_bttn', function(){

// var meal_id = $(this).attr('id');
        
        $.ajax({
          url:'mess/meal.php',
          type:'post',
          data: {
            my_daily_meal_dis: true
          },
          success: function(response){

            $('#my_meal_display_he').html(response);

          }
        });

});




$(document).on('click','.u_bazar_list_btn', function(){

        // alert("hi");
        $.ajax({
          url:'mess/meal_2.php',
          type:'post',
          data: {
            bazar_list: true
          },
          success: function(response){

            $('#user_bazar_list').html(response);

          }
        });

});




$('#all_o_mess_meals').ready(function(){

$.ajax({
      url:'mess/meal.php',
      type:'post',
      data: {
        one_mess_meals: true
      },
      success: function(response){

        $('#all_o_mess_meals').html(response);

      }
    });


});

$('#all_t_mess_meals').ready(function(){

$.ajax({
      url:'mess/meal.php',
      type:'post',
      data: {
        two_mess_meals: true
      },
      success: function(response){

        $('#all_t_mess_meals').html(response);

      }
    });


});

$('#sum_meals_dis').ready(function(){

  $.ajax({
      url:'mess/meal.php',
      type:'post',
      data: {
        all_meals_di: true
      },
      success: function(response){

        $('#sum_meals_dis').html(response);

      }
    });


});

$('#future_meals').ready(function(){

$.ajax({
    url:'mess/meal.php',
    type:'post',
    data: {
      future_meals_d: true
    },
    success: function(response){

      $('#future_meals').html(response);

    }
  });


});


$('#mess_users_dis').ready(function(){

$.ajax({
    url:'mess/code.php',
    type:'post',
    data: {
      users_of_mess: true
    },
    success: function(response){

      $('#mess_users_dis').html(response);

    }
  });


});


$(document).on('click','.all_mess_meals', function(){

// var meal_id = $(this).attr('id');
    
    $.ajax({
      url:'mess/meal.php',
      type:'post',
      data: {
        one_mess_meals: true
      },
      success: function(response){

        $('#all_o_mess_meals').html(response);

      }
    });


    $.ajax({
      url:'mess/meal.php',
      type:'post',
      data: {
        two_mess_meals: true
      },
      success: function(response){

        $('#all_t_mess_meals').html(response);

      }
    });

    $.ajax({
      url:'mess/meal.php',
      type:'post',
      data: {
        all_meals_di: true
      },
      success: function(response){

        $('#sum_meals_dis').html(response);

      }
    });

    $.ajax({
    url:'mess/meal.php',
    type:'post',
    data: {
      future_meals_d: true
    },
    success: function(response){

      $('#future_meals').html(response);

    }
    });

});



});

</script>

<script type="text/javascript">
$(document).ready(function(){
// $('.meal_o_f_b').click(function(){
//             if($(this).prop("selected")!=''){

//             }
//         });
      });
</script>

<script>



$(document).ready(function(){


    $(document).on('click','.box_m', function(){

      var user_id = $(this).attr('id');
      // var user_id = $(this).prop("selected");

      Swal.fire({
        title: 'Are you sure!?',
        text: 'বর্তমান এডমিন থাকাকালীন সদস্যদের দ্বারা মিল পরিবর্তনের সুযোগ দিন!',
        type: 'warning',
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, Procced !',

      }).then((resultm) => {

          if(resultm.value){
            $.ajax({
              url:'mess/meal_2.php',
              type:'post',
              data: {
                s_id: user_id,
                meal_switch_b: true,
              },
              success: function(response){

                if(response==1){

                  Swal.fire({
                    type: 'success',
                    title: "User To Admin!!!",
                    text: "সদস্যদের সুযোগ বাড়ানো হয়েছে",
                    icon: "success",
                    button: false,
                    dangerMode: true,
                    timer: 3000,
                  })
                  // $(".all_button").trigger("click");
                  setTimeout(function(){
                    // location.reload();
                                    // location.reload();
                  }, 3000);

                }else{
                  Swal.fire({
                    type: 'info',
                    title: "Try again!",
                    text: "Something went wrong!",
                    icon: "info",
                    button: false,
                    dangerMode: true,
                    timer: 3000,

                  })
                }

              }
            });
              
          }else{
            Swal.fire({
              type: 'info',
              title: "Try again!",
              text: "Something went wrong!",
              icon: "info",
              button: false,
              dangerMode: true,
              timer: 3000,

            })
          }

      })




    });



 

  });


$(document).ready(function(){
    $(document).on('click','.perm_button', function(){

      var user_id = $(this).attr('id');

      Swal.fire({
        title: 'Are you sure!?',
        text: 'আপনি মিলের গ্রহনযোগ্যতা পরিবর্তন করতে চাচ্ছেন!',
        type: 'warning',
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, Procced !',

      }).then((resultm) => {

          if(resultm.value){
            $.ajax({
              url:'mess/meal_2.php',
              type:'post',
              data: {
                o_f_id: user_id,
                user_perm_b: true,
              },
              success: function(response){

                if(response==1){

                  Swal.fire({
                    type: 'success',
                    title: "পরিবর্তন হয়েছে!",
                    text: "মিলের গ্রহনযোগ্যতা পরিবর্তন হয়েছে!",
                    icon: "success",
                    button: false,
                    dangerMode: true,
                    timer: 3000,
                  })
                  // $(".all_button").trigger("click");
                  setTimeout(function(){
                    location.reload();
                                    // location.reload();
                  }, 3000);

                }else{
                  Swal.fire({
                    type: 'info',
                    title: "Try again!",
                    text: "Something went wrong!",
                    icon: "info",
                    button: false,
                    dangerMode: true,
                    timer: 3000,

                  })
                }

              }
            });
              
          }else{
            Swal.fire({
              type: 'info',
              title: "Try again!",
              text: "Something went wrong!",
              icon: "info",
              button: false,
              dangerMode: true,
              timer: 3000,

            })
          }

      })




    });



 

  });




$(document).ready(function(){
    $(document).on('click','.user_to_admin_btn', function(){

      var user_id = $(this).attr('id');

      Swal.fire({
        title: 'Are you sure!?',
        text: 'User will be updated to Admin !',
        type: 'warning',
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, Procced !',

      }).then((resultm) => {

          if(resultm.value){
            $.ajax({
              url:'mess/meal_2.php',
              type:'post',
              data: {
                user_id: user_id,
                user_to_admin: true,
              },
              success: function(response){

                if(response==1){

                  Swal.fire({
                    type: 'success',
                    title: "Admin successfully updated!!",
                    text: "Admin successfully updated!",
                    icon: "success",
                    button: false,
                    dangerMode: true,
                    timer: 3000,
                  })
                  // $(".all_button").trigger("click");
                  setTimeout(function(){
                    location.reload();
                                    // location.reload();
                  }, 3000);

                }else{
                  Swal.fire({
                    type: 'info',
                    title: "Try again!",
                    text: "Something went wrong!",
                    icon: "info",
                    button: false,
                    dangerMode: true,
                    timer: 3000,

                  })
                }

              }
            });
              
          }else{
            Swal.fire({
              type: 'info',
              title: "Try again!",
              text: "Something went wrong!",
              icon: "info",
              button: false,
              dangerMode: true,
              timer: 3000,

            })
          }

      })




    });



 

  });






  $(document).ready(function(){
    $(document).on('click','.meal_del', function(){

      var meal_id = $(this).attr('id');

      Swal.fire({
        title: 'Are you sure!?',
        text: 'Meal will be deleted!',
        type: 'warning',
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Delete Meal !',

      }).then((resultm) => {

          if(resultm.value){
            $.ajax({
              url:'mess/meal_2.php',
              type:'post',
              data: {
                meal_id: meal_id,
                my_meal_delete: true,
              },
              success: function(response){

                if(response==1){

                  Swal.fire({
                    type: 'success',
                    title: "Delete Item!!!",
                    text: "Your Product delete from cart!",
                    icon: "success",
                    button: false,
                    dangerMode: true,
                    timer: 3000,
                  })
                  $(".all_button").trigger("click");

                }else{
                  Swal.fire({
                    type: 'info',
                    title: "Try again!",
                    text: "Something went wrong!",
                    icon: "info",
                    button: false,
                    dangerMode: true,
                    timer: 3000,

                  })
                }

              }
            });
              
          }else{
            Swal.fire({
              type: 'info',
              title: "Try again!",
              text: "Something went wrong!",
              icon: "info",
              button: false,
              dangerMode: true,
              timer: 3000,

            })
          }

      })




    });



 

  });


$(document).ready(function(){
  $(document).on('click','.meal_update_b', function(){

var meal_id = $(this).attr('id');
// alert(meal_id);

// var mealform = $('#up_meal_f_'+meal_id).serialize();
Swal.fire({
  title: 'Are you sure!?',
  text: 'Meal will be Updated!',
  type: 'warning',
  icon: "warning",
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Update Meal !',

}).then((result) => {

  if(result.value){

      var sokal = $('#morning_'+meal_id).val();
      var dupur = $('#launch_'+meal_id).val();
      var rat = $('#dinner_'+meal_id).val();
      // alert(sokal);
            $.ajax({
              url:'mess/meal_2.php',
              type:'post',
              data: {
                meal_id: meal_id,
                sokal : sokal,
                dupur : dupur,
                rat : rat,
                // mealform : mealform,
                my_meal_upd: true,
              },
              success: function(response){

                if(response==1){

                  Swal.fire({
                    type: 'success',
                    title: "Updated Item!!!",
                    text: "Your meal Updated from cart!",
                    icon: "success",
                    button: false,
                    dangerMode: true,
                    timer: 2000,
                  })

                  $(".all_button").trigger("click");

                }else{
                  Swal.fire({
                    type: 'info',
                    title: "Try again!",
                    text: "Something went wrong!",
                    icon: "info",
                    button: false,
                    dangerMode: true,
                    timer: 3000,

                  })
                }

              }
            });
              
          }else{
            Swal.fire({
              type: 'info',
              title: "Try again!",
              text: "Something went wrong!",
              icon: "info",
              button: false,
              dangerMode: true,
              timer: 3000,

            })
          }

})




});


});


$(document).ready(function(){
  $(document).on('click','.meal_update_bb', function(){

var meal_id = $(this).attr('id');
// alert(meal_id);

// var mealform = $('#up_meal_f_'+meal_id).serialize();
Swal.fire({
  title: 'Are you sure!?',
  text: 'Meal will be Updated!',
  type: 'warning',
  icon: "warning",
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Update Meal !',

}).then((result) => {

  if(result.value){

      var sokal = $('#morning_'+meal_id).val();
      var dupur = $('#launch_'+meal_id).val();
      var rat = $('#dinner_'+meal_id).val();
      // alert(sokal);
            $.ajax({
              url:'mess/meal_2.php',
              type:'post',
              data: {
                meal_id: meal_id,
                sokal : sokal,
                dupur : dupur,
                rat : rat,
                // mealform : mealform,
                my_meal_updd: true,
              },
              success: function(response){

                if(response==1){

                  Swal.fire({
                    type: 'success',
                    title: "Updated Item!!!",
                    text: "Your meal Updated from cart!",
                    icon: "success",
                    button: false,
                    dangerMode: true,
                    timer: 2000,
                  })

                  // $(this).trigger("click");

                }else{
                  Swal.fire({
                    type: 'info',
                    title: "Try again!",
                    text: "Something went wrong!",
                    icon: "info",
                    button: false,
                    dangerMode: true,
                    timer: 3000,

                  })
                }

              }
            });
              
          }else{
            Swal.fire({
              type: 'info',
              title: "Try again!",
              text: "Something went wrong!",
              icon: "info",
              button: false,
              dangerMode: true,
              timer: 3000,

            })
          }

})




});


});


$(document).ready(function(){
    $(document).on('click','.meal_dell', function(){

      var meal_id = $(this).attr('id');

      Swal.fire({
        title: 'Are you sure!?',
        text: 'Meal will be deleted!',
        type: 'warning',
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Delete Meal !',

      }).then((resultm) => {

          if(resultm.value){
            $.ajax({
              url:'mess/meal_2.php',
              type:'post',
              data: {
                meal_id: meal_id,
                my_meal_deletee: true,
              },
              success: function(response){

                if(response==1){

                  Swal.fire({
                    type: 'success',
                    title: "Delete Item!!!",
                    text: "Your Product delete from cart!",
                    icon: "success",
                    button: false,
                    dangerMode: true,
                    timer: 3000,
                  })
                  // $(this).trigger("click");

                }else{
                  Swal.fire({
                    type: 'info',
                    title: "Try again!",
                    text: "Something went wrong!",
                    icon: "info",
                    button: false,
                    dangerMode: true,
                    timer: 3000,

                  })
                }

              }
            });
              
          }else{
            Swal.fire({
              type: 'info',
              title: "Try again!",
              text: "Something went wrong!",
              icon: "info",
              button: false,
              dangerMode: true,
              timer: 3000,

            })
          }

      })




    });



 

  });


  $(document).ready(function(){
  $(document).on('click','.edit_baz_bton', function(){

var meal_id = $(this).attr('id');
// alert(meal_id);

// var mealform = $('#up_meal_f_'+meal_id).serialize();
Swal.fire({
  title: 'Are you sure!?',
  text: 'Meal will be Updated!',
  type: 'warning',
  icon: "warning",
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Update Meal !',

}).then((result) => {

  if(result.value){

      var sokal = $('#detai_'+meal_id).val();
      var dupur = $('#amoun_'+meal_id).val();

      // alert(sokal);
            $.ajax({
              url:'mess/meal_2.php',
              type:'post',
              data: {
                b_id: meal_id,
                details : sokal,
                amount : dupur,
                // mealform : mealform,
                my_b_updd: true,
              },
              success: function(response){

                if(response==1){

                  Swal.fire({
                    type: 'success',
                    title: "Updated Item!!!",
                    text: "Bazar Updated from cart!",
                    icon: "success",
                    button: false,
                    dangerMode: true,
                    timer: 2000,
                  })

                  $(".bazar_sec_btn").trigger("click");

                }else{
                  Swal.fire({
                    type: 'info',
                    title: "Try again!",
                    text: "Something went wrong!",
                    icon: "info",
                    button: false,
                    dangerMode: true,
                    timer: 3000,

                  })
                }

              }
            });
              
          }else{
            Swal.fire({
              type: 'info',
              title: "Try again!",
              text: "Something went wrong!",
              icon: "info",
              button: false,
              dangerMode: true,
              timer: 3000,

            })
          }

})




});


});


$(document).ready(function(){
    $(document).on('click','.dlt_baz_bton', function(){

      var meal_id = $(this).attr('id');

      Swal.fire({
        title: 'Are you sure!?',
        text: 'Bazar List Item will be deleted!',
        type: 'warning',
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Delete Meal !',

      }).then((resultm) => {

          if(resultm.value){
            $.ajax({
              url:'mess/meal_2.php',
              type:'post',
              data: {
                b_id: meal_id,
                my_b_deletee: true,
              },
              success: function(response){

                if(response==1){

                  Swal.fire({
                    type: 'success',
                    title: "Delete Item!!!",
                    text: "Your Product delete from cart!",
                    icon: "success",
                    button: false,
                    dangerMode: true,
                    timer: 3000,
                  })
                  $(".bazar_sec_btn").trigger("click");

                }else{
                  Swal.fire({
                    type: 'info',
                    title: "Try again!",
                    text: "Something went wrong!",
                    icon: "info",
                    button: false,
                    dangerMode: true,
                    timer: 3000,

                  })
                }

              }
            });
              
          }else{
            Swal.fire({
              type: 'info',
              title: "Try again!",
              text: "Something went wrong!",
              icon: "info",
              button: false,
              dangerMode: true,
              timer: 3000,

            })
          }

      })




    });



    $(document).on('click','.delete_payment', function(){

var pay_id = $(this).attr('id');

Swal.fire({
  title: 'Are you sure!?',
  text: 'Payment will be deleted!',
  type: 'warning',
  icon: "warning",
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Yes !',

}).then((resultm) => {

    if(resultm.value){
      $.ajax({
        url:'mess/meal_2.php',
        type:'post',
        data: {
          pay_id: pay_id,
          payMent: true,
        },
        success: function(response){

          if(response==1){

            Swal.fire({
              type: 'success',
              title: "Delete Item!!!",
              text: "Payment Deleted!",
              icon: "success",
              button: false,
              dangerMode: true,
              timer: 3000,
            })
            $(".send_month_bb").trigger("click");

          }else{
            Swal.fire({
              type: 'info',
              title: "Try again!",
              text: "Something went wrong!",
              icon: "info",
              button: false,
              dangerMode: true,
              timer: 3000,

            })
          }

        }
      });
        
    }else{
      Swal.fire({
        type: 'info',
        title: "Try again!",
        text: "Something went wrong!",
        icon: "info",
        button: false,
        dangerMode: true,
        timer: 3000,

      })
    }

})




});





// mess fee delete function


$(document).on('click','.f_delete_b', function(){

var fee_id = $(this).attr('id');

Swal.fire({
  title: 'Are you sure!?',
  text: 'Fee List will be deleted!',
  type: 'warning',
  icon: "warning",
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Delete fee!',

}).then((resultm) => {

    if(resultm.value){
      $.ajax({
        url:'mess/meal_ind.php',
        type:'post',
        data: {
          f_id: fee_id,
          mess_fee_delete: true,
        },
        success: function(response){

          if(response==1){

            Swal.fire({
              type: 'success',
              title: "Delete from List!!!",
              text: "One list deleted successfully.",
              icon: "success",
              button: false,
              dangerMode: true,
              timer: 3000,
            })
            $(".mess_fee_list_table").trigger("click");

          }else{
            Swal.fire({
              type: 'info',
              title: "Try again!",
              text: "Something went wrong!",
              icon: "info",
              button: false,
              dangerMode: true,
              timer: 3000,

            })
          }

        }
      });
        
    }else{
      Swal.fire({
        type: 'info',
        title: "Try again!",
        text: "Something went wrong!",
        icon: "info",
        button: false,
        dangerMode: true,
        timer: 3000,

      })
    }

})




});    






    $(document).on('click','.dlt_baz_bton_yes', function(){

var meal_id = $(this).attr('id');

Swal.fire({
  title: 'Are you sure!?',
  text: 'Bazar List Item will be deleted!',
  type: 'warning',
  icon: "warning",
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Delete Meal !',

}).then((resultm) => {

    if(resultm.value){
      $.ajax({
        url:'mess/meal_2.php',
        type:'post',
        data: {
          b_id: meal_id,
          my_b_deleteee: true,
        },
        success: function(response){

          if(response==1){

            Swal.fire({
              type: 'success',
              title: "Delete Item!!!",
              text: "Your Product delete from cart!",
              icon: "success",
              button: false,
              dangerMode: true,
              timer: 3000,
            })
            $(".bazar_sec_btn").trigger("click");

          }else{
            Swal.fire({
              type: 'info',
              title: "Try again!",
              text: "Something went wrong!",
              icon: "info",
              button: false,
              dangerMode: true,
              timer: 3000,

            })
          }

        }
      });
        
    }else{
      Swal.fire({
        type: 'info',
        title: "Try again!",
        text: "Something went wrong!",
        icon: "info",
        button: false,
        dangerMode: true,
        timer: 3000,

      })
    }

})




});
 

  });



// bazar update btn

$(document).ready(function(){
  $(document).on('click','.bazar_up_btn', function(){

var user_id = $(this).attr('id');
// alert(meal_id);

// var userform = $('#up_bazar_btn_'+user_id).serialize();
Swal.fire({
  title: 'Are you sure!?',
  text: 'Bazar Date will be Updated!',
  type: 'warning',
  icon: "warning",
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Update date !',

}).then((result) => {

  if(result.value){

      var start = $('#fromdate'+user_id).val();
      var end = $('#todate'+user_id).val();

      // alert(sokal);
            $.ajax({
              url:'mess/meal_2.php',
              type:'post',
              data: {
                user_id: user_id,
                startd : start,
                endd : end,
                use_bazar_upd: true,
              },
              success: function(response){

                if(response==1){

                  Swal.fire({
                    type: 'success',
                    title: "Updated Item!!!",
                    text: "Your Bazar Date Updated!",
                    icon: "success",
                    button: false,
                    dangerMode: true,
                    timer: 2000,
                  })

                  $(".farhad_foysal").trigger("click");

                }else{
                  Swal.fire({
                    type: 'info',
                    title: "Try again!",
                    text: response,
                    icon: "info",
                    button: false,
                    dangerMode: true,
                    timer: 3000,

                  })
                }

              }
            });
              
          }else{
            Swal.fire({
              type: 'info',
              title: "Try again!",
              text: "Something went wrong!",
              icon: "info",
              button: false,
              dangerMode: true,
              timer: 3000,

            })
          }

})




});


});
</script>



<!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"
  integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
  crossorigin="anonymous"></script> -->

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js" integrity="sha384-eMNCOe7tC1doHpGoWe/6oMVemdAVTMs2xqW4mwXrXsW0L84Iytr2wi5v2QjrP/xp" crossorigin="anonymous"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

<script>
  const nav = document.querySelector(".topheader");
  let lastScrollY = window.scrollY;

  window.addEventListener("scroll", () => {

    if(lastScrollY < window.scrollY){
      nav.classList.add("nav-hidden");
      // console.log("we are going down");

    }else{
      nav.classList.remove("nav-hidden");
      // console.log("we are going up");
    }

    lastScrollY = window.scrollY;
  });


</script>
<script>
  const moon = document.querySelector("#moon")
  const body = document.querySelector("body")
  moon.addEventListener("click", ()=>{
    body.classList.toggle("bg-dark")
    body.classList.toggle("text-light")
  })

  const navitwo = document.querySelector("#navioffon")
  const navione = document.querySelector("#navi-1")
  navitwo.addEventListener("click", ()=>{
    navione.classList.toggle("hiddenn")
    // body.classList.toggle("text-light")
  })
</script>
<!-- carousel_and_other js start-->
<script>
   $(".carousel_main1").owlCarousel({
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
<script>
   $(".carousel_morning").owlCarousel({
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

<script>
$(document).ready(function(){
    $(document).on('click', '.option', function(){
        var click_id = $('input[name="select_morni"]:checked').attr('id');
        // alert(click_id);
        // $('.o'+click_id).css('background','blue');

      });                        

});
</script>

<script>
    // const viewBtn = document.querySelector(".view-modal-add_meal"),
    // popup = document.querySelector(".popup-add_meal"),
    // close = popup.querySelector(".close-add_meal"),
    
    // field = popup.querySelector(".field"),
    // input = field.querySelector("input"),
    // copy = field.querySelector("button");

    // viewBtn.onclick = ()=>{
    //   popup.classList.toggle("show");
    // }
    // close.onclick = ()=>{
    //   viewBtn.click();
    // }




    // copy.onclick = ()=>{
    //   input.select(); //select input value
    //   if(document.execCommand("copy")){ //if the selected text copy
    //     field.classList.add("active");
    //     copy.innerText = "Copied";
    //     setTimeout(()=>{
    //       window.getSelection().removeAllRanges(); //remove selection from document
    //       field.classList.remove("active");
    //       copy.innerText = "Copy";
    //     }, 3000);
    //   }
    // }
  </script>


<script>
</script>
<script src="./js-file/select-menu.js"></script>
<script>


// Get references to the elements we need to update
const breakfastCount = document.getElementById("breakfast-count");
const lunchCount = document.getElementById("launch-count");
const dinnerCount = document.getElementById("dinner-count");
const totalCount = document.getElementById("total-count");

// Get references to the increment and decrement buttons
const breakfastIncrement = document.getElementById("breakfast-increment");
const breakfastDecrement = document.getElementById("breakfast-decrement");
const lunchIncrement = document.getElementById("launch-increment");
const lunchDecrement = document.getElementById("launch-decrement");
const dinnerIncrement = document.getElementById("dinner-increment");
const dinnerDecrement = document.getElementById("dinner-decrement");

// Add event listeners to the increment and decrement buttons
breakfastIncrement.addEventListener("click", function() {
  incrementCount(breakfastCount);
  updateTotalCount();
});
breakfastDecrement.addEventListener("click", function() {
    alert('hi');
  decrementCount(breakfastCount);
  updateTotalCount();
});

lunchIncrement.addEventListener("click", function() {
  incrementCount(lunchCount);
  updateTotalCount();
});
lunchDecrement.addEventListener("click", function() {
  decrementCount(lunchCount);
  updateTotalCount();
});

dinnerIncrement.addEventListener("click", function() {
  incrementCount(dinnerCount);
  updateTotalCount();
});
dinnerDecrement.addEventListener("click", function() {
  decrementCount(dinnerCount);
  updateTotalCount();
});

// Helper function to increment the count
function incrementCount(countElement) {
  countElement.innerHTML = parseFloat(countElement.innerHTML) + 0.5;
}

// Helper function to decrement the count
function decrementCount(countElement) {
  if (countElement.innerHTML > 0) {
    countElement.innerHTML = parseFloat(countElement.innerHTML) - 0.5;
  }
}

// Helper function to update the total count
function updateTotalCount() {
  totalCount.innerHTML = parseFloat(breakfastCount.innerHTML) + parseFloat(lunchCount.innerHTML) + parseFloat(dinnerCount.innerHTML);
}



// let breakfastCount = 0;
// let lunchCount = 0;
// let dinnerCount = 0;
// let totalCount = 0;

// document.getElementById("breakfast-increment").addEventListener("click", function(){
//     breakfastCount++;
//     document.getElementById("breakfast-count").innerHTML = breakfastCount;
//     updateTotal();
// });

// document.getElementById("breakfast-decrement").addEventListener("click", function(){
//     if(breakfastCount>0){
//         breakfastCount--;
//         document.getElementById("breakfast-count").innerHTML = breakfastCount;
//         updateTotal();
//     }
// });

// document.getElementById("lunch-increment").addEventListener("click", function(){
//     lunchCount++;
//     document.getElementById("lunch-count").innerHTML = lunchCount;
//     updateTotal();
// });

// document.getElementById("lunch-decrement").addEventListener("click", function(){
//     if(lunchCount>0){
//         lunchCount--;
//         document.getElementById("lunch-count").innerHTML = lunchCount;
//         updateTotal();
//     }
// });

// document.getElementById("dinner-increment").addEventListener("click", function(){
//     dinnerCount++;
//     document.getElementById("dinner-count").innerHTML = dinnerCount;
//     updateTotal();
// });

// document.getElementById("dinner-decrement").addEventListener("click", function(){
//     if(dinnerCount>0){
//         dinnerCount--;
//         document.getElementById("dinner-count").innerHTML = dinnerCount;
//         updateTotal();
//     }
// });


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
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.8.0/html2pdf.bundle.min.js"></script>
<script>
 
 $(document).ready(function(){
    $(document).on('click', '.monthly_all_contb', function(){

      var d = new Date();
      var time = d.getTime();

      var element = document.getElementById('monthly_all_cont');
      html2pdf(element, {
        margin:       10,
        filename:     'secondhome'+time+'.pdf',
        image:        { type: 'jpeg', quality: 0.98 },
        html2canvas:  { scale: 2, logging: true, dpi: 192, letterRendering: true },
        jsPDF:        { unit: 'mm', format: 'a4', orientation: 'portrait' }
      });


    });  
    $(document).on('click', '.monthly_baz_contb', function(){

var d = new Date();
var time = d.getTime();

var element = document.getElementById('monthly_baz_cont');
html2pdf(element, {
  margin:       10,
  filename:     'secondhome'+time+'.pdf',
  image:        { type: 'jpeg', quality: 0.98 },
  html2canvas:  { scale: 2, logging: true, dpi: 192, letterRendering: true },
  jsPDF:        { unit: 'mm', format: 'a4', orientation: 'portrait' }
});


}); 
$(document).on('click', '.monthly_baz_contb2', function(){

var d = new Date();
var time = d.getTime();

var element = document.getElementById('monthly_baz_cont2');
html2pdf(element, {
  margin:       10,
  filename:     'secondhome'+time+'.pdf',
  image:        { type: 'jpeg', quality: 0.98 },
  html2canvas:  { scale: 2, logging: true, dpi: 192, letterRendering: true },
  jsPDF:        { unit: 'mm', format: 'a4', orientation: 'portrait' }
});


});
$(document).on('click', '.monthly_bazz_contb2', function(){

var d = new Date();
var time = d.getTime();

var element = document.getElementById('monthly_bazz_cont2');
html2pdf(element, {
  margin:       10,
  filename:     'secondhome'+time+'.pdf',
  image:        { type: 'jpeg', quality: 0.98 },
  html2canvas:  { scale: 2, logging: true, dpi: 192, letterRendering: true },
  jsPDF:        { unit: 'mm', format: 'a4', orientation: 'portrait' }
});


}); 
$(document).on('click', '.monthly_baz_contb3', function(){

var d = new Date();
var time = d.getTime();

var element = document.getElementById('monthly_baz_cont3');
html2pdf(element, {
  margin:       10,
  filename:     'secondhome'+time+'.pdf',
  image:        { type: 'jpeg', quality: 0.98 },
  html2canvas:  { scale: 2, logging: true, dpi: 192, letterRendering: true },
  jsPDF:        { unit: 'mm', format: 'a4', orientation: 'portrait' }
});


});
$(document).on('click', '.qr_down', function(){

var d = new Date();
var time = d.getTime();

var element = document.getElementById('user_meal_sett');
html2pdf(element, {
  margin:       10,
  filename:     'secondhome'+time+'.pdf',
  image:        { type: 'jpeg', quality: 0.98 },
  html2canvas:  { scale: 2, logging: true, dpi: 192, letterRendering: true },
  jsPDF:        { unit: 'mm', format: 'a4', orientation: 'portrait' }
});


});  

    $(document).on('click','#monthly_all_meal', function(){

      // var class_id = $(this).attr('id');
      // var today_date1 = $('#attendence_today_date2'+class_id).val();

        $.ajax({
              url:'mess/meal_ind.php',
              type:'post',
              data: {
                user_meal_sec: true,
              },
              success: function(response){
                $('#user_meal_sett').html(response);
              }
            });


    });
    $(document).on('click','#monthly_all_meal', function(){

      // var class_id = $(this).attr('id');
      // var today_date1 = $('#attendence_today_date2'+class_id).val();

        $.ajax({
              url:'mess/meal_ind.php',
              type:'post',
              data: {
                user_all_meal: true,
              },
              success: function(response){
                $('#monthly_meal_details').html(response);
              }
            });


    });

    $(document).on('click','.send_month_m', function(){

      var user = $(this).attr('id');
      var date = $('#send_month_for_m').val();

        $.ajax({
              url:'mess/meal_ind.php',
              type:'post',
              data: {
                user:user,
                month_d:date,
                user_all_meal: true,
              },
              success: function(response){
                // $('#monthly_meal_details').html(response);
                $('#monthly_meal_details').html(response);
              }
            });


    });        

    $(document).on('change','#sel_u_for_conn', function(){
      var UserId=$(this).val();
            $.ajax({
              url:'mess/meal_ind.php',
              type:'post',
              data: {
                idUser : UserId,
                sel_u_for_m_bb: true,
              },
              success: function(response){
                $('#user_all_contentm').html(response);
              }
            });

            $.ajax({
              url:'mess/meal_ind.php',
              type:'post',
              data: {
                user : UserId,
                user_all_meal: true,
              },
              success: function(response){
                $('#monthly_meal_details').html(response);
              }
            });

    });    

$(document).on('click','#meal_date_b', function(){

      var date = $('#search_meal_date').val();
      $.ajax({
        url:'mess/meal_ind.php',
        type:'post',
        data: {
          ind_d:date,  
          ind_meal:true,
        },
        success: function(response){
          $('#user_meal_sett').html(response);

        }
      });


});

$(document).on('click','#navioffon', function(){


      $.ajax({
        url:'mess/meal_ind.php',
        type:'post',
        data: {
          ind_meal:true,
        },
        success: function(response){
          $('#user_meal_sett').html(response);

        }
      });


});
$(document).on('click','.namebutton', function(){


      $.ajax({
        url:'mess/meal_ind.php',
        type:'post',
        data: {
          ind_meal:true,
        },
        success: function(response){
          $('#user_meal_sett').html(response);

        }
      });


});

$(document).on('click','.namebuttonn', function(){


      $.ajax({
        url:'mess/meal_ind.php',
        type:'post',
        data: {
          ind_meal:true,
        },
        success: function(response){
          $('#user_meal_sett').html(response);

        }
      });


});
$(document).on('click','.all_qr', function(){


      $.ajax({
        url:'mess/meal_ind.php',
        type:'post',
        data: {
          all_qr:true,
        },
        success: function(response){
          $('#user_meal_sett').html(response);

        }
      });


});

    $(document).on('click','.b-button', function(){


      var u_id = $(this).attr('id');
      var date = $('#search_meal_date').val();

    //   alert('hih');
      // $(this).removeClass('b-button');
      var class_code = $('#total-countt_'+u_id).html();

      var code = 'b';

        $.ajax({
              url:'mess/meal_ind.php',
              type:'post',
              data: {
                u_id: u_id,
                code:code,
                ind_d:date,
                meal_save: true,
              },
              success: function(response){
                                    // alert(response);
                if(response==1){
                    $('.b_'+u_id).removeClass('b-button');
                    $('#total-countt_'+u_id).html(parseFloat(class_code)+1);
                    $('.b_'+u_id).addClass('b-buttonn');


                }else{

                }

                // alert(response);

              }
            });


    });
    $(document).on('click','.l-button', function(){


      var u_id = $(this).attr('id');
      var date = $('#search_meal_date').val();

      var class_code = $('#total-countt_'+u_id).html();

      var code = 'l';

        $.ajax({
              url:'mess/meal_ind.php',
              type:'post',
              data: {
                u_id: u_id,
                code:code,
                ind_d:date,
                meal_save: true,
              },
              success: function(response){
                if(response==1){
                    $('#total-countt_'+u_id).html(parseFloat(class_code)+1);
                    $('.l_'+u_id).addClass('l-buttonn');
                    $('.l_'+u_id).removeClass('l-button');

                }else{

                }
              }
            });


    });
    $(document).on('click','.d-button', function(){


      var u_id = $(this).attr('id');
      var date = $('#search_meal_date').val();

      var class_code = $('#total-countt_'+u_id).html();

      var code = 'd';

        $.ajax({
              url:'mess/meal_ind.php',
              type:'post',
              data: {
                u_id: u_id,
                code:code,
                ind_d:date,
                meal_save: true,
              },
              success: function(response){
                if(response==1){
                    $('#total-countt_'+u_id).html(parseFloat(class_code)+1);
                    $('.d_'+u_id).addClass('d-buttonn');
                    $('.d_'+u_id).removeClass('d-button');
                }else{

                }

              }
            });


    });



    $(document).on('click','.b-buttonn', function(){


      var u_id = $(this).attr('id');
      var date = $('#search_meal_date').val();
      // alert('hi');
      var class_code = $('#total-countt_'+u_id).html();

      var code = 'b';

        $.ajax({
              url:'mess/meal_ind.php',
              type:'post',
              data: {
                u_id: u_id,
                code:code,
                ind_d:date,
                meal_cancel: true,
              },
              success: function(response){
                if(response==1){
                    $('#total-countt_'+u_id).html(parseFloat(class_code)-1);
                    $('.b_'+u_id).removeClass('b-buttonn');
                    $('.b_'+u_id).removeClass('redb');
                    $('.b_'+u_id).addClass('b-button');
                    $('.b_'+u_id).css("background-color: green");
                    

                }else{

                }

                // alert(response);

              }
            });


    });
    $(document).on('click','.l-buttonn', function(){


      var u_id = $(this).attr('id');
      var date = $('#search_meal_date').val();

      var class_code = $('#total-countt_'+u_id).html();

      var code = 'l';

        $.ajax({
              url:'mess/meal_ind.php',
              type:'post',
              data: {
                u_id: u_id,
                code:code,
                ind_d:date,
                meal_cancel: true,
              },
              success: function(response){
                if(response==1){
                    $('#total-countt_'+u_id).html(parseFloat(class_code)-1);
                    $('.l_'+u_id).removeClass('l-buttonn');
                    $('.l_'+u_id).removeClass('redb');
                    $('.l_'+u_id).addClass('l-button');
                    $('.l_'+u_id).css("background-color: green");
                    

                }else{

                }
              }
            });


    });
    $(document).on('click','.meal_count_s',function(){
      var u_id = $(this).attr('id');
      var date = $('#search_meal_date').val();
      // var class_code = $('#total-countt_'+u_id).html();

        $.ajax({
              url:'mess/meal_ind.php',
              type:'post',
              data: {
                ind_d:date,
                UserId: u_id,
                user_single_meal: true,
              },
              success: function(response){

                    $('#indivisual_meal').html(response);
                    // $('#total-countt_'+u_id).html(parseFloat(class_code)-1);
                    $('.indivisual_meal').removeClass('hidden');
                    // $('.d_'+u_id).removeClass('redb');
                    $('.user_meal_sett').addClass('hidden');
                    // $('.indivisual_meal').css("display: active");


              }
        });
    });
    $(document).on('click','.close_s_btn', function(){
            $('.user_meal_sett').removeClass('hidden');
            $('.indivisual_meal').addClass('hidden');

    });
    $(document).on('click','.d-buttonn', function(){


      var u_id = $(this).attr('id');
      var date = $('#search_meal_date').val();

      var class_code = $('#total-countt_'+u_id).html();

      var code = 'd';

        $.ajax({
              url:'mess/meal_ind.php',
              type:'post',
              data: {
                u_id: u_id,
                code:code,
                ind_d:date,
                meal_cancel: true,
              },
              success: function(response){
                if(response==1){
                    $('#total-countt_'+u_id).html(parseFloat(class_code)-1);
                    $('.d_'+u_id).removeClass('d-buttonn');
                    $('.d_'+u_id).removeClass('redb');
                    $('.d_'+u_id).addClass('d-button');
                    $('.d_'+u_id).css("background-color: green");

                }else{

                }

              }
            });


    });

    $(document).on('click','#breakfast-increment', function(){
         var meal = $('#breakfast-count').html();
         var totalCount = $('#total-count').html();
         $('#breakfast-count').html(parseFloat(meal)+0.5);
         $('#total-count').html(parseFloat(totalCount)+0.5);
    });
    $(document).on('click','#launch-increment', function(){
         var meal= $('#launch-count').html();
         var totalCount = $('#total-count').html();
         $('#launch-count').html(parseFloat(meal)+0.5);
         $('#total-count').html(parseFloat(totalCount)+0.5);
    });
    $(document).on('click','#dinner-increment', function(){
         var meal= $('#dinner-count').html();
         var totalCount = $('#total-count').html();
         $('#dinner-count').html(parseFloat(meal)+0.5);
         $('#total-count').html(parseFloat(totalCount)+0.5);
    });
    $(document).on('click','#breakfast-decrement', function(){
         var meal= $('#breakfast-count').html();
         var totalCount = $('#total-count').html();
         mealf = parseFloat(meal);
         if(mealf>0){
         $('#breakfast-count').html(parseFloat(meal)-0.5);
         $('#total-count').html(parseFloat(totalCount)-0.5);
         }
    });
    $(document).on('click','#launch-decrement', function(){
         var meal= $('#launch-count').html();
         var totalCount = $('#total-count').html();
         mealf = parseFloat(meal);
         if(mealf>0){
         $('#launch-count').html(parseFloat(meal)-0.5);
         $('#total-count').html(parseFloat(totalCount)-0.5);
         }
    });
    $(document).on('click','#dinner-decrement', function(){
         var meal= $('#dinner-count').html();
         var totalCount = $('#total-count').html();
         mealf = parseFloat(meal);
         if(mealf>0){
         $('#dinner-count').html(parseFloat(meal)-0.5);
         $('#total-count').html(parseFloat(totalCount)-0.5);
         }
    });
    $(document).on('click','.send_meal_s_b', function() {
        

        var u_id = $(this).attr('id');

        var date = $('#send_meal_s_d').val();

        $.ajax({
              url:'mess/meal_ind.php',
              type:'post',
              data: {
                UserId: u_id,
                ind_d:date,
                user_single_meal: true,
              },
              success: function(response){

                    $('#indivisual_meal').html(response);
                    // $('#total-countt_'+u_id).html(parseFloat(class_code)-1);
                    $('.indivisual_meal').removeClass('hidden');
                    // $('.d_'+u_id).removeClass('redb');
                    $('.user_meal_sett').addClass('hidden');
                    // $('.indivisual_meal').css("display: active");


              }
        });

    });
    $(document).on('click','.save_s_btn', function() {
        
        var id = $(this).attr('id');

        var date = $('#date_meal_'+id).val();
        var sokal = $('#breakfast-count').html();
        var launch = $('#launch-count').html();
        var dinner = $('#dinner-count').html();
        var total = $('#total-count').html();
        sokal = parseFloat(sokal);
        launch = parseFloat(launch);
        dinner = parseFloat(dinner);

        $.ajax({
              url:'mess/meal_ind.php',
              type:'post',
              data: {
                UserId: id,
                ind_d:date,
                s:sokal,
                l:launch,
                d:dinner,
                t:total,
                save_single_meal: true,
              },
              success: function(response){

                if(response==1){

                  Swal.fire({
                    type: 'success',
                    title: "Saved!",
                    text: "Meals added!",
                    icon: "success",
                    button: false,
                    dangerMode: true,
                    timer: 3000,
                  })
                  $(".close_s_btn").trigger("click");
                  $("#meal_date_b").trigger("click");

                }else if(response==3){
                  Swal.fire({
                    type: 'info',
                    title: "Sorry!",
                    text: "You have no permission!",
                    icon: "info",
                    button: false,
                    dangerMode: true,
                    timer: 2000,

                  })
                }else{
                  Swal.fire({
                    type: 'info',
                    title: "Try again!",
                    text: "Something went wrong!",
                    icon: "info",
                    button: false,
                    dangerMode: true,
                    timer: 2000,

                  })
                }

              }
        });

    });




});



</script>


<!-- <script type="text/javascript" src="js/jquery.touchSwipe.min.js"></script> -->
            <script id='code_1'>
                $(function() {          
                    $("#sob").swipe( {
                      swipeLeft:function(event, direction, distance, duration, fingerCount, fingerData) {
                        // alert("You swiped " + direction + " with " + fingerCount + " fingers");
                            $('.namebutton').trigger('click');
                            // alert("yes");
                      },
                      swipeRight:function(event, direction, distance, duration, fingerCount, fingerData) {
                        // alert("You swiped " + direction + " with " + fingerCount + " fingers");
                            $('.namebutton').trigger('click');
                            // alert("yes");
                      },
                      threshold:120,
                      // cancelThreshold:10
                      fingers:'all',
                      allowPageScroll:"auto",

                      // allowPageScroll:"vertical",
                      // allowPageScroll:"horizontal",
                      // pinchStatus:pinch,

                      // maxTimeThreshold:1000,
                      // triggerOnTouchEnd:false
                    });

                      $(".all_mess_meal5s").swipe( {
                        tap:function(event, target) {
                            alert("tap");
                          msg(target);
                        },
                        doubleTap:function(event, target) {
                            alert("doubletap");
                          msg(target);
                          return true;
                        },
                        longTap:function(event, target) {
                            alert("longtap");
                          msg(target);
                        },
                        swipe:function() {

                          // $("#textText").html("You swiped " + swipeCount + " times");
                        },
                        excludedElements:"",
                        threshold:50
                      });



                });
            </script>