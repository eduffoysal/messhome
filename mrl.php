<?php
session_start();
require_once 'db.php';
if(isset($_SESSION['user'])){
    $unique_id=$_SESSION['user'];
    $my_mess_id=$_SESSION['my_mess_id'];
    $me=$unique_id;
}



$today = date("Y-m-d");
$u_id='';
$action='';
$na='';
$my_name='User NOt Found!';
$my_phone='Unavailable Phone Number';
$img='https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80';
$sokal=0;
$dupur=0;
$rat=0;
$id='i';
$Myid='';


// echo "<pre>";
// print_r($_GET);
if(isset($_REQUEST['u_id'])){
    // echo $_REQUEST['u_id'].'<br>';
    $u_id = $_REQUEST['u_id'];

    $query1="SELECT * FROM users WHERE qr='$u_id'";
    $result1=mysqli_query($con,$query1);
    if(mysqli_num_rows($result1)==1){
       $rowr=mysqli_fetch_assoc($result1);
       $my_name=$rowr['user_name'];
       $my_phone=$rowr['phone'];
       $img=$rowr['img'];
        $_SESSION['userr']=$rowr['unique_id'];
        $_SESSION['user']=$rowr['unique_id'];
        $_SESSION['my_mess_id']=$rowr['mess_id'];
       $unique_id=$_SESSION['userr'];
       $my_mess_id=$_SESSION['my_mess_id'];
       $Myid=$unique_id;


       $queryd = mysqli_query($con,"SELECT * FROM my_meals WHERE unique_id='$unique_id' AND date='$today' AND mess_id='$my_mess_id' ");
       $numr=mysqli_num_rows($queryd);
       $qru=mysqli_fetch_assoc($queryd);

       if($numr==1){
        $sokal=$qru['morning'];
        $dupur=$qru['launce'];
        $rat=$qru['dinner'];
        $id=$qru['id'];
       }else{
        $sokal=0;
        $dupur=0;
        $rat=0;
        $id='i';
       }


    }else{
       header('location:../../c/?error=দুঃখিত! আপনার দেয়া রেফারেল কোড সঠিক নয়...');

$u_id='';
$action='';
$na='';
$my_name='User NOt Found!';
$my_phone='Unavailable Phone Number';
$img='https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80';
$sokal=0;
$dupur=0;
$rat=0;
$id='i';

    }

}
if(isset($_REQUEST['action'])){
    // echo $_REQUEST['action'];   
    $action = $_REQUEST['action'];
}
if(isset($_REQUEST['name'])){
    $na = $_REQUEST['name'];   
}



  function getProfilePicture($name){
    $name_slice = explode(' ',$name);
    $name_slice = array_filter($name_slice);
    $initials = '';
    $initials .= (isset($name_slice[0][0]))?strtoupper($name_slice[0][0]):'';
    $initials .= (isset($name_slice[count($name_slice)-1][0]))?strtoupper($name_slice[count($name_slice)-1][0]):'';

    return '<div style=" border-radius:50%; margin: 0 auto" class="hiii text-center m-auto">'.$initials.'</div>';
  }

?>

<!DOCTYPE html>
<html lang="">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?=$my_name?> QR</title>


    <link rel="stylesheet" href="../../bootstrap.min.css">
    <!-- <script src="bootstrap.budle.min.js"></script> -->
    <link href="//cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css" rel="stylesheet">


<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.css">

<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.js"></script>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.6.0/font/bootstrap-icons.css">



<link rel="stylesheet" href="../../css/carousel_and_other.css">

<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">

<link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
<link rel="stylesheet" href="css/select-menu.css">


    <script src="https://kit.fontawesome.com/a076d05399.js"></script>

<script src="https://code.jquery.com/jquery-3.4.1.js"></script>


<script src="https://kit.fontawesome.com/a076d05399.js"></script>
<link rel="stylesheet" href="../../icon/bootstrap-icons.css">

<!-- <script src="ck/ckeditor.js"></script> -->
<!-- <script src="f/admin/ckeditor/ckeditor.js"></script> -->

<script src="//cdn.ckeditor.com/4.16.2/full/ckeditor.js"></script>

<script src="../../jquery-3.5.1.min.js"></script>



    <!-- <link rel="stylesheet" href="css/user.css"> -->


<link rel="stylesheet" href="../../dist/styles.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

<link rel="stylesheet" href="https://unpkg.com/flowbite@1.5.3/dist/flowbite.min.css" />
<script src="https://unpkg.com/flowbite@1.5.3/dist/flowbite.js"></script>
<script src="../../TW-ELEMENTS-PATH/dist/js/index.min.js"></script>
<!-- <script src="https://cdn.jsdelivr.net/npm/tw-elements/dist/js/index.min.js"></script> -->

<link rel="stylesheet" href="../../node_modules/tw-elements/dist/css/index.min.css" />
<!-- <script src="node_modules/tw-elements/dist/js/index.min.js"></script> -->
<script src="../../node_modules/flowbite/dist/flowbite.js"></script>


<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.css">

<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.js"></script>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.6.0/font/bootstrap-icons.css">

<!-- <link rel="stylesheet" href="dist/styles.css"> -->

<link rel="stylesheet" href="../../css/carousel_and_other.css">

<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">

<link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
<link rel="stylesheet" href="../../css/select-menu.css">
<!-- <link rel="stylesheet" href="css/color.css"> -->
<!-- <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'> -->

<style>
/* Google Font Import - Poppins */
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');
*{
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Poppins', sans-serif;
}

section{
    position: relative;
    height: 100%;
    width: 100%;
/*    display: flex;*/
/*    align-items: center;
    justify-content: center;*/
}
section .profile{
    display: flex;
    align-items: center;
    flex-direction: column;
    justify-content: center;
}
section.show .profile{
    display: none;
}
section .profile .profile-img{
    height: 70px;
    width: 70px;
    border-radius: 50%;
    background: #4070f4;
    padding: 2px;
    margin-bottom: 5px;
}
.profile .profile-img img{
    height: 100%;
    width: 100%;
    object-fit: cover;
    border-radius: 50%;
    border: 3px solid #fff;
}
.profile .name,
.profile .profession{
    font-size: 12px;
    font-weight: 500;
    color: #333;
}
.profile .profession{
    font-weight: 400;
    margin-top: -6px;
}

.profile .button:hover{
    background: #275df1;
}




/* ===========================
Navbar 
==============================*/


  .navbarr {
    background-color: #157293;
    width: 100%;
    margin-right: auto;
    margin-left: auto;
    position: fixed;
    left: 0;
    top: 0;
    z-index: 100;
    box-shadow: 0px 3px 5px rgba(0 0 0 /10%);
}

.pa-fixed-header {
    background-color: #ffffff !important;
    -webkit-transition: background-color 1s ease-out;
    -moz-transition: background-color 1s ease-out;
    -o-transition: background-color 1s ease-out;
    transition: background-color 1s ease-out;
}

.text-black{
    color: #157293 !important;
}



.toggleMM{
    position: fixed;
    bottom: 10%;
}
.menuM{
    display: flex;
    flex-direction: row;
    position: relative;
}
.toggleM{
    background-color:#30BDF2;
    height: 35px;
    width: 35px;
    color:white ;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: 1s;
    cursor: pointer;
}
.itemsM{
    display: flex;
    flex-direction: row;
    transform: scaleX(0);
    transform-origin: left;
    transition: 0.5s;
}
.itemsM>a{
    display: flex;
    background-color: white;
    height: 35px;
    width:35px;
    color:#b2b2b2 ;
    text-decoration: none;
    align-items: center;
    justify-content: center;
}
.toggleM>.material-icons{
    font-size: 35px;
}
a>.material-icons{
    font-size: 30px;
}
a:hover>.material-icons{
    font-size: 30px;
    color:#30BDF2;
}

.tabsM {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
}
.tab-contentM {
  background-color: #ffffff;
}

.tab-contentM .div {
  display: none;
}
.tab-contentM .active {
  display: block;
}
.tabsM .active {
  background-color: #ffffff;
  color: #4d5bf9;
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
  padding: 4px 12px;
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
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
      rel="stylesheet">
</head>
<body id="sob">



        <div class="navbarr">
            <div class=""> 

<!-- <div class="flex flex-wrap justify-center space-x-2 items-end" data-bs-dismiss="modal">
  <span
    class="rounded-full text-gray-500 bg-gray-200 font-semibold text-sm flex align-center cursor-pointer active:bg-gray-300 transition duration-300 ease w-max">
    <img class="rounded-full w-9 h-9 max-w-none" alt="A"
      src="https://mdbootstrap.com/img/Photos/Avatars/avatar-6.jpg" />
    <span class="flex items-center px-3 py-2">
    Username
    </span>
    <marquee class="mt-2" behavior="continue" direction="">This is Notice Board</marquee>
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

</div> -->


<div class="min-h-full">
  <nav class="bg-gray-800" id="navBarM">

      <div class="pt-1 pb-0 border-t border-gray-700">
        <div class="flex items-center px-2">
          <div class="flex-shrink-0 dropup-center dropup">
            <img class="h-10 w-10 rounded-full" src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" dropdown-toggle type="button" id="dropupCenterBtn" data-bs-toggle="dropdown" aria-expanded="false" alt="">


          </div>
          <div style="width: 100%" class="ml-3 w-100"> 
            <div style="font-size: 12px;" class="text-base font-medium leading-none text-white aa">EDUMess - <?=$my_name?></div>
            <marquee class="text-sm text-primary aa" behavior="continue" direction="">ডানে সুয়াইপ করে বাজার খরচ যোগ করুন, বামে সুয়াইপ করে রিফ্রেস করুন।</marquee>
          </div>
          <!-- <marquee class="mt-2" behavior="continue" direction="">This is Notice Board</marquee> -->
          <button type="button" class="ml-autoo bg-gray-800 flex-shrink-0 p-1 rounded-full text-gray-400 hover:text-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-800 focus:ring-white" data-bs-toggle="modal" data-bs-target="#allsetting">
            <span class="sr-only">View</span>
            <!-- Heroicon name: outline/bell -->
            <svg class="h-6 w-6 aa" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" aria-hidden="true">
              <path stroke-linecap="round" stroke-linejoin="round" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
            </svg>
          </button>
        </div>
      </div>

  </nav>

</div>


            </div>
        </div>



<div class="container-fluid mt-12">
    
    <div class="row">
        <div class="col-md-3 py-2 border-white-500 border-2 shadow-lg  rounded-lg">
            
<input type="hidden" name="" value="<?$Myid?>" id="MyId" data-bs-toggle="modal" data-bs-target="#user_bazarModal">
<section>
        <div class="profile">
            <div class="profile-img">
                <?php
                    if($img!=''){
                        ?>
                        <img src="<?=$img?>" alt="<?=$my_name?>">
                        <!-- <div style=" border-radius:50%; margin: 0 auto" class="hiii text-center m-auto">'.$initials.'</div> -->
                        <?php
                    }else{
                        getProfilePicture($my_name);
                        ?>
                        <!-- <div style=" border-radius:50%; margin: 0 auto" class="hiii text-center m-auto"></div> -->
                        <img src="https://mdbootstrap.com/img/Photos/Avatars/avatar-6.jpg" alt="<?=$my_name?>">
                        <?php
                       
                    }
                ?>

            </div>
            <span class="name"><?=$my_name?></span>
            <span class="profession">+88<?=$my_phone?></span>
            <div id="MyMealSelector" class="button">

                            <div class="meal-selector">
                              <button style="background-color: " class="meal-button breakfast-button b_  m_b_" id="">B</button>
                              <button style="background-color: " class="meal-button  l_ lunch-button  m_b_" id="">L</button>
                              <button style="background-color: " class="meal-button  d_ dinner-button  m_b_" id="">D</button>
                            </div>

            </div>
        </div>

</section>

        </div>
        <div class="col-md-6 pt-2 border-gray-500 border-2 shadow-lg  rounded-lg">
      <div class="tabsM text-center">
        <h3 class="active" id="b_meal">-মিল-</h3>
        <h3 id="b_bazarMeal">-বাজার-</h3>
        <h3 id="b_account">-হিসাব-</h3>
      </div>
      <div class="tab-contentM p-1">
        <div class="active div">

            <div class="text-center"> 
                <code style="font-size:10px" class="text-pinkk-800 text-sm">একের অধিক মিলের ক্ষেত্রে নামের উপর ক্লিক করুন</code>
            </div>
            <div class="all_user_meals" id="all_user_meals">
                
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

        <div class="div" id="">


            <div class="text-center" id="">
                <code style="font-size:10px" class="text-sm">ইউজার সিলেক্ট করে ডিটেইলস দেখুন</code>
            </div>
            <div class="user_bazar_meal_with_select" id="user_bazarMeal">
                
            </div>
            <div class="only_my_all_meal_this_month" id="user_allMeal">
                
            </div>




        </div>

        <div class="div" id="">


            <div class="three_button" id="three_button">

<div class="flex items-center justify-center">
<div class="inline-flex" role="group">
  <button
    type="button"
    class="
      ac_b
      rounded-r
      px-6
      py-2
      border-2 border-blue-600
      text-blue-600
      font-medium
      text-xs
      leading-tight
      uppercase
      hover:bg-black hover:bg-opacity-5
      focus:outline-none focus:ring-0
      transition
      duration-150
      ease-in-out
    "
    id="my_account"
  >
    ACCOUNT
  </button>    
  <button
    type="button"
    class="
      pa_b
      px-6
      py-2
      border-t-2 border-b-2 border-blue-600
      text-blue-600
      font-medium
      text-xs
      leading-tight
      uppercase
      hover:bg-black hover:bg-opacity-5
      focus:outline-none focus:ring-0
      transition
      duration-150
      ease-in-out      
    "
    id="my_payment"
  >
    PAY
  </button>
  <button
    type="button"
    id="my_mess_fee"
    class="
      mf_b
      rounded-l
      px-6
      py-2
      border-2 border-blue-600
      text-blue-600
      font-medium
      text-xs
      leading-tight
      uppercase
      hover:bg-black hover:bg-opacity-5
      focus:outline-none focus:ring-0
      transition
      duration-150
      ease-in-out
    "
  >
    MessFee
  </button>

</div>
</div>                
            </div>
            <div class="user_account" id="user_account">

                    <div class="monthly_cal_dis" id="monthly_cal_dis">
                                          
                    </div>
                
            </div>
            <div class="payment_for_admin hidden" id="payment_for_admin">
                <div class="otp1" id="otp1">
                    
                </div>
                <div class="payment_main" id="payment_main">
 
                   <!-- payment code start -->

      <div id="myalert_np" style="display:none;">
        <div class="container col-md-offset-4">
          <div class="alert alert-info">
            <center><span id="alerttext_np"></span></center>
          </div>
        </div>
      </div> 

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
                   <!-- payment code end -->

                </div>

            </div>
            <div class="add_messfee_admin hidden" id="add_messfee_admin">
                <div class="otp2" id="otp2">
                    
                </div>
                <div class="add_messfee_main" id="add_messfee_main">
                    
                    <!-- mess fee list table start  -->

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
                    <!-- mess fee list table end -->

                </div>  

            </div>


        </div>
      </div>
        </div>
        <div class="col-md-3 pt-2 border-pink-300 border-2 shadow-lg  rounded-lg" id="">
            
            <div class="user_details_monthly" id="user_details_monthly">
                

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






<div class="toggleMM">
    <div class="menuM" >
        <div class="toggleM" id="toggleM" onclick="expand()">
            <i class="material-icons" id="toggle1">
                add
            </i>
        </div>
        <div class="itemsM" id="itemsM">
        <a href="#" id="item1">
            <i class="material-icons">
                person
            </i>
        </a>
        <a href="#" id="item2">
            <i class="material-icons">
                message
            </i>
        </a>
        <a href="#" id="item3" data-bs-toggle="modal" data-bs-target="#user_gen_modal">
            <i class="material-icons">
                shopping_cart
            </i>
        </a>
        <a href="#" id="item4" data-bs-toggle="modal" data-bs-target="#user_bazarModal">
            <i class="material-icons">
                notifications
            </i>
        </a>
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

<div class="modal fade" id="user_bazarModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
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

              <div class="User_b" id="User_b">

<!-- code start -->


<div class=" justify-center">
<div>
<div class="form-floating mb-1 md:w-100 xl:w-100">
  <input type="date" class="form-control
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
  focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none" id="date_bazarMonth" value="<?=$today?>" placeholder="name@example.com">
  <label for="date_bazarMonth" class="text-gray-700">Select Date & Month</label>
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
  focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none" step="any" min="0" id="bazar_amount" placeholder="Amount">
  <label for="bazar_amount" class="text-gray-700">Amount</label>
</div>
</div>
</div>

             <div class="form-group">

  <button type="button" id="saveBazar" class="
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
  ease-in-out">Save</button>

                
            </div>

<!-- code end -->
                              
              </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline-danger bazarModal_close" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        <!-- <button type="button" class="btn btn-primary" id="press_u_per_btn">Press a Button</button> -->
      </div>
    </div>
  </div>
</div>

<script>
function closeWindoww(){

    // alert("hi");
    // window.open('', '_self', '');
    // open(location, '_self').close();
    // window.location.replace('../../close');
    // var objwin = window.open(location, "_self").close();
        // window.close();

}

</script>

    <script>
var state=false;
function expand(){
    if(state==false){
        document.getElementById('itemsM').style.transform='scaleX(1)';
        document.getElementById('toggle1').style.transform='rotate(45deg)';

        state=true;
    }
    else{
        document.getElementById('itemsM').style.transform='scaleX(0)';
        document.getElementById('toggle1').style.transform='rotate(0deg)';
        state=false;
    }
}


let tabs = document.querySelectorAll(".tabsM h3");
let tabContents = document.querySelectorAll(".tab-contentM .div");

tabs.forEach((tab, index) => {
  tab.addEventListener("click", () => {
    tabContents.forEach((content) => {
      content.classList.remove("active");
    });
    tabs.forEach((tab) => {
      tab.classList.remove("active");
    });
    tabContents[index].classList.add("active");
    tabs[index].classList.add("active");
  });
});

    </script>






<!-- 
<script type="text/javascript">
    function minus_update(id){
      
      jQuery.ajax({
        url:'../../m_p.php',
        type:'post',
        data:'type=minus&id='+id,
        success:function(result){
          var cur_count=jQuery('#m_p_loop_'+id).html();
          cur_count--;
          jQuery('#m_p_loop_'+id).html(cur_count);
        //   $('#load_videos').load('getdata7.php');
        if(result==1){

        }else if(result=2){
                setTimeout(function(){
                    location.reload()
                },1000)
        }else{

        }

        }
      })
    }
    function plus_update(id){
      
      jQuery.ajax({
        url:'../../m_p.php',
        type:'post',
        data:'type=plus&id='+id,
        success:function(result){
          var cur_count=jQuery('#m_p_loop_'+id).html();
          cur_count++;
          jQuery('#m_p_loop_'+id).html(cur_count);
        //   $('#load_videos').load('getdata7.php');
        if(result==1){

}else if(result=2){
        setTimeout(function(){
            location.reload()
        },1000)
}else{

}
        }
      })
    }
    function minus_updatee(id){
      
      jQuery.ajax({
        url:'../../m_p.php',
        type:'post',
        data:'type=minuss&id='+id,
        success:function(result){
          var cur_count=jQuery('#m_p_loops_'+id).html();
          cur_count--;
          jQuery('#m_p_loops_'+id).html(cur_count);
        //   $('#load_videos').load('getdata7.php');
        if(result==1){

}else if(result=2){
        setTimeout(function(){
            location.reload()
        },1000)
}else{

}

        }
      })
    }
    function plus_updatee(id){
      
      jQuery.ajax({
        url:'../../m_p.php',
        type:'post',
        data:'type=pluss&id='+id,
        success:function(result){
          var cur_count=jQuery('#m_p_loops_'+id).html();
          cur_count++;
          jQuery('#m_p_loops_'+id).html(cur_count);
        //   $('#load_videos').load('getdata7.php');
        if(result==1){

}else if(result=2){
        setTimeout(function(){
            location.reload()
        },1000)
}else{

}
        }
      })
    }
    function minus_updateee(id){
      
      jQuery.ajax({
        url:'../../m_p.php',
        type:'post',
        data:'type=minusss&id='+id,
        success:function(result){
          var cur_count=jQuery('#m_p_loopss_'+id).html();
          cur_count--;
          jQuery('#m_p_loopss_'+id).html(cur_count);
        //   $('#load_videos').load('getdata7.php');
        if(result==1){

}else if(result=2){
        setTimeout(function(){
            location.reload()
        },1000)
}else{

}
        }
      })
    }
    function plus_updateee(id){
      
      jQuery.ajax({
        url:'../../m_p.php',
        type:'post',
        data:'type=plusss&id='+id,
        success:function(result){
          var cur_count=jQuery('#m_p_loopss_'+id).html();
          cur_count++;
          jQuery('#m_p_loopss_'+id).html(cur_count);
        //   $('#load_videos').load('getdata7.php');
        if(result==1){

}else if(result=2){
        setTimeout(function(){
            location.reload()
        },1000)
}else{

}
        }
      })
    }
</script> -->

<script type="text/javascript">



$(document).ready(function(){

    $('#MyMealSelector').ready(function(){

    $.ajax({
        url:'../../mess/meal_ind.php',
        type:'post',
        data: {
          MyMeal:true,
        },
        success: function(response){
          $('#MyMealSelector').html(response);
          // alert(response);

        }
      });

    });

    $('#MyId').ready(function(){
        var user_id = $(this).val();
    $.ajax({
        url:'../../mess/meal_ind.php',
        type:'post',
        data: {
          ind_meall:true,
        },
        success: function(response){
          $('#all_user_meals').html(response);
          // alert(response);

        }
      });

    });

    $(document).on('click','.bazarr_sec_btn', function(){
      var UserId=$(this).attr('id');
            // alert(UserId);
        $.ajax({
              url:'../../mess/meal_ind.php',
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

    $(document).on('click','.meall_search_b', function(){
      var userId = $(this).attr('id');
      var datese = $('#meall_search_date').val();

        $.ajax({
              url:'../../mess/meal_6.php',
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


$(document).on('click','.sendd_month_bb', function(){

var bazar_id = $(this).attr('id');

var d_code = $('#sendd_month_for_bb').val();

      $.ajax({
        url:'../../mess/meal_3.php',
        type:'post',
        data: {
          this_id:bazar_id,
          date : d_code,
          ind_bazar:true,
        },
        success: function(response){
          $('#table_bazar_ll').html(response);

        }
      });


});


$('#others_fees_list_h').ready(function(){

$.ajax({
      url:'../../mess/meal_4.php',
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
        url:'../../mess/meal_4.php',
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



$(document).on('click','.monthly_all_u_f_b', function(){

var user_id = $(this).attr('id');
var date = $('#monthly_f_allu_date').val();

      $.ajax({
        url:'../../mess/meal_4.php',
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
        url:'../../mess/meal_4.php',
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
        url:'../../mess/meal_4.php',
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
        url:'../../mess/meal_4.php',
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




$('#mess_fee_list_table').ready(function(){

$.ajax({
      url:'../../mess/meal_3.php',
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
        url:'../../mess/meal_3.php',
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
          url:'../../mess/meal_3.php',
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
        url:'../../mess/meal_3.php',
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
        url:'../../mess/meal_ind.php',
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



$(document).on('click','.ac_b', function(){

$('#add_messfee_admin').addClass('hidden');
$('#payment_for_admin').addClass('hidden');
$('#user_account').removeClass('hidden');

});
$(document).on('click','.pa_b', function(){

$('#user_account').addClass('hidden');
$('#add_messfee_admin').addClass('hidden');
$('#payment_for_admin').removeClass('hidden');

});
$(document).on('click','.mf_b', function(){

$('#user_account').addClass('hidden');
$('#payment_for_admin').addClass('hidden');
$('#add_messfee_admin').removeClass('hidden');

});




    
    // $('#MyId').ready(function(){

    //   var user_id  = $(this).val();
    //   Swal.fire({
    //     title: 'Are you sure!?',
    //     text: 'আপনার একটি মিল লিখতে, নিচের হ্যা বাটনে ক্লিক করুন',
    //     type: 'warning',
    //     icon: "warning",
    //     showCancelButton: true,
    //     confirmButtonColor: '#3085d6',
    //     cancelButtonColor: '#d33',
    //     confirmButtonText: 'হ্যা!',

    //   }).then((resultm) => {

    //       if(resultm.value){
    //         $.ajax({
    //           url:'../../m_p.php',
    //           type:'post',
    //           data: {
    //             user_id: user_id,
    //             UserMeal: true,
    //           },
    //           success: function(response){

    //             if(response==1){

    //               Swal.fire({
    //                 type: 'success',
    //                 title: "ধন্যবাদ",
    //                 text: "আপনার সকালের মিল লিখা হয়েছে!",
    //                 icon: "success",
    //                 button: false,
    //                 dangerMode: true,
    //                 timer: 3000,
    //               })
    //               // $(".all_button").trigger("click");

    //             }else if(response==8){

    //                 Swal.fire({
    //                 type: 'success',
    //                 title: "ধন্যবাদ!",
    //                 text: "আপনার সব মিল লিখা হয়েছে! ",
    //                 icon: "success",
    //                 button: false,
    //                 dangerMode: true,
    //                 timer: 3000,
    //                 })
    //                 // $(".all_button").trigger("click");
    //                 // setTimeout(function(){
    //                 //     location.reload();
                                    
    //                 // }, 3000);

    //             }
    //             else if(response==2){

    //             Swal.fire({
    //                 type: 'success',
    //                 title: "ধন্যবাদ!",
    //                 text: "আপনার দুপুরের মিল লিখা হয়েছে!",
    //                 icon: "success",
    //                 button: false,
    //                 dangerMode: true,
    //                 timer: 3000,
    //               })


    //             }else if(response==3){

    //             Swal.fire({
    //             type: 'info',
    //             title: "Sorry! Maintain meal Time!",
    //             text: "দুঃখিত! সময়মত! যথাসময়ে মিল দিন !",
    //             icon: "info",
    //             button: false,
    //             dangerMode: true,
    //             timer: 3000,

    //             })


    //             }else if(response==5){

    //             Swal.fire({
    //             type: 'info',
    //             title: "Sorry! Maintain your Launch meal Time",
    //             text: "দুঃখিত! দুপুর ১১টা ৫৯ মি এর আগে দুপুরের মিল দিন",
    //             icon: "info",
    //             button: false,
    //             dangerMode: true,
    //             timer: 3000,

    //             })


    //             }
    //             else if(response==4){

    //                 Swal.fire({
    //                 type: 'info',
    //                 title: "Sorry! Maintain your dinner meal Time",
    //                 text: "দুঃখিত! সন্ধ্যা ৬টা ৫৯ মি এর আগে রাতের মিল দিন",
    //                 icon: "info",
    //                 button: false,
    //                 dangerMode: true,
    //                 timer: 3000,
    //                 })
    //                 // $(".all_button").trigger("click");


    //             }else if(response==6){


    //             Swal.fire({
    //                 type: 'success',
    //                 title: "ধন্যবাদ!",
    //                 text: "আপনার রাতের মিল লিখা হয়েছে!",
    //                 icon: "success",
    //                 button: false,
    //                 dangerMode: true,
    //                 timer: 3000,
    //             })


    //             }else if(response==7){


    //                 Swal.fire({
    //                 type: 'info',
    //                 title: "Sorry! Maintain Launch meal Time",
    //                 text: "দুঃখিত! সকাল ৬টা ৫৯ মি এর আগে সকালের মিল দিন",
    //                 icon: "info",
    //                 button: false,
    //                 dangerMode: true,
    //                 timer: 3000,
    //             })


    //             }else if(response==9){


    //             Swal.fire({
    //                 type: 'success',
    //                 title: "ধন্যবাদ!",
    //                 text: "আপনার সব মিল আগেই লিখা হয়েছে!",
    //                 icon: "success",
    //                 button: false,
    //                 dangerMode: true,
    //                 timer: 3000,
    //             })


    //             }else{
    //               Swal.fire({
    //                 type: 'info',
    //                 title: "Try again!",
    //                 text: "Something went wrong!",
    //                 icon: "info",
    //                 button: false,
    //                 dangerMode: true,
    //                 timer: 3000,

    //               })


    //             }

    //           }
    //         });
              
    //       }else{
    //         Swal.fire({
    //           type: 'info',
    //           title: "Try again!",
    //           text: "Something went wrongg!",
    //           icon: "info",
    //           button: false,
    //           dangerMode: true,
    //           timer: 3000,

    //         })

    //         // closeWindoww();
    //             // setTimeout(function(){
    //             //       let new_w =  open(location, '_self');
    //             //         new_w.close();

    //             //     },1000)

    //                 // let new_w =  open(location, '_self');
    //                 //     new_w.close();

    //       }

    //   })




    // });






$(document).on('click','.use_upd_btn', function(){

var bazar_id = $(this).attr('id');




      $.ajax({
        url:'../../mess/meal.php',
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
                url:'../../c_room_1.php',
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
          url:'../../c_room_1.php',
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
          url:'../../c_room_1.php',
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








  $(document).on('click', '.payment_user_f_btn', function(){
        if($('#m_for_p_date').val()!=''){
            $('#payment_user_f_btn').text('Requesting in...');
            $('#myalert_np').slideUp();
            var messform = $('#payment_form_data').serialize();
            setTimeout(function(){
                $.ajax({
                    method: 'POST',
                    url: '../../mess/meal_8.php',
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
                    url: '../../mess/mess_create.php',
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
                    url: '../../mess/mess_create.php',
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


$('#class_sections_here_pay').ready(function(){

    $.ajax({
          url:'../../mess/meal_8.php',
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
      url:'../../mess/meal_8.php',
      type:'post',
      data: {
        user_all_my_mess: true
      },
      success: function(response){
        $('#my_mess_user_all').html(response);



      }
    });


});





  $(document).on('click', '#saveBazar', function(){
        if($('#bazar_amount').val()!=''){
            $('#saveBazar').text('Requesting in...');
            $('#myalert_np').slideUp();
            var bazar = $('#bazar_amount').val();
            var date = $('#date_bazarMonth').val();
            setTimeout(function(){
                $.ajax({
                      url:'../../mess/meal_ind.php',
                      type:'post',
                      data: {
                        bazarAmount:bazar,
                        date:date,
                        user_bazar_save: true
                      },
                    success:function(data){
                        if(data==1){
                            $('#myalert_b').slideDown();
                            $('#alerttext_b').text('আপনার বাজার লিস্ট যোগ হয়েছে।.');
                            $('#saveBazar').text('Saved! Thank You!');
                            $('#bazar_amount').reset();

              Swal.fire({
              type: 'success',
              title: "Successfully added!",
              text: "আপনি বাজার লিস্ট যোগ করেছেন!",
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
                $('#myalert_b').slideUp();
              }, 3000);
                        }
                        else{
                            $('#myalert_b').slideDown();
                            $('#alerttext_b').html(data);
                            $('#saveBazar').text('Try Again!');
                            $('#bazar_amount').reset();

              Swal.fire({
              type: 'info',
              title: "U are an user!",
              text: "YOu need permission to add Bazar Amount",
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
            alert('এমাউন্ট ঘরে টাকার পরিমাণ লিখুন');
        }
    });




 

  });



</script>
<script>
    

// Toggle the .pa-fixed-header class when the user 
// scroll 100px 

window.onscroll = () => {scrollNavbar()};

scrollNavbar = () => {
    // Target elements
    const navBar = document.getElementById("navBar ");
    const links = document.querySelectorAll("#navBar aa");

  if (document.documentElement.scrollTop > 50) {
    navBar.classList.add("pa-fixed-header");

    // Change the color of links on scroll
    for (let i = 0; i < links.length; i++) {
        const element = links[i];
        element.classList.add('text-black');
    }

  } else {
    navBar.classList.remove("pa-fixed-header");
    
    // Change the color of links back to default
    for (let i = 0; i < links.length; i++) {
        const element = links[i];
        element.classList.remove('text-black');
    }
  }
}


</script>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/5.4.5/js/swiper.min.js"></script>
<script type="text/javascript" src="../../script.js"></script>
<script type="text/javascript" src="../../user.js"></script>
<script type="text/javascript" src="../../mess/meal.js"></script>

<script src="../../sweetalert.min.js"></script>
<script src="../../sweetalert2.all.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/5.4.5/js/swiper.min.js"></script>
<script src="../../js/validator.min.js"></script>
<!-- <script src="sweetalert.min.js"></script> -->

<!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js" ></script> -->
<!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.min.js" ></script> -->
<script src="//cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
<!-- <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script> -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js" integrity="sha384-eMNCOe7tC1doHpGoWe/6oMVemdAVTMs2xqW4mwXrXsW0L84Iytr2wi5v2QjrP/xp" crossorigin="anonymous"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>
</html>


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

    $(document).on('click','#b_bazarMeal', function(){

      // var class_id = $(this).attr('id');
      // var today_date1 = $('#attendence_today_date2'+class_id).val();

        $.ajax({
              url:'../../mess/meal_ind.php',
              type:'post',
              data: {
                user_meal_sec: true,
              },
              success: function(response){
                $('#user_bazarMeal').html(response);
              }
            });


    });
    $(document).on('click','#b_bazarMeal', function(){

      // var class_id = $(this).attr('id');
      // var today_date1 = $('#attendence_today_date2'+class_id).val();

        $.ajax({
              url:'../../mess/meal_ind.php',
              type:'post',
              data: {
                user_all_meal: true,
              },
              success: function(response){
                $('#user_allMeal').html(response);
              }
            });


    });   

    $(document).on('click','.send_month_m', function(){

      var user = $(this).attr('id');
      var date = $('#send_month_for_m').val();

        $.ajax({
              url:'../../mess/meal_ind.php',
              type:'post',
              data: {
                user:user,
                month_d:date,
                user_all_meal: true,
              },
              success: function(response){
                // $('#monthly_meal_details').html(response);
                $('#user_allMeal').html(response);
              }
            });


    });     

    $(document).on('change','#sel_u_for_conn', function(){
      var UserId=$(this).val();
            $.ajax({
              url:'../../mess/meal_ind.php',
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
              url:'../../mess/meal_ind.php',
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
        url:'../../mess/meal_ind.php',
        type:'post',
        data: {
          ind_d:date,  
          ind_meal:true,
        },
        success: function(response){
          $('#all_user_meals').html(response);

        }
      });


});

$(document).on('click','#navioffon', function(){


      $.ajax({
        url:'../../mess/meal_ind.php',
        type:'post',
        data: {
          ind_meal:true,
        },
        success: function(response){
          $('#all_user_meals').html(response);

        }
      });


});
$(document).on('click','.namebutton', function(){


      $.ajax({
        url:'../../mess/meal_ind.php',
        type:'post',
        data: {
          ind_meal:true,
        },
        success: function(response){
          $('#all_user_meals').html(response);

        }
      });


});

$(document).on('click','.namebuttonn', function(){


      $.ajax({
        url:'../../mess/meal_ind.php',
        type:'post',
        data: {
          ind_meal:true,
        },
        success: function(response){
          $('#all_user_meals').html(response);

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
              url:'../../mess/meal_ind.php',
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
                    // alert("no");
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
              url:'../../mess/meal_ind.php',
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
              url:'../../mess/meal_ind.php',
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
              url:'../../mess/meal_ind.php',
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
              url:'../../mess/meal_ind.php',
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
              url:'../../mess/meal_ind.php',
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
                    $('.all_user_meals').addClass('hidden');
                    // $('.indivisual_meal').css("display: active");


              }
        });
    });
    $(document).on('click','.close_s_btn', function(){
            $('.all_user_meals').removeClass('hidden');
            $('.indivisual_meal').addClass('hidden');

    });
    $(document).on('click','.d-buttonn', function(){


      var u_id = $(this).attr('id');
      var date = $('#search_meal_date').val();

      var class_code = $('#total-countt_'+u_id).html();

      var code = 'd';

        $.ajax({
              url:'../../mess/meal_ind.php',
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
              url:'../../mess/meal_ind.php',
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
                    $('.all_user_meals').addClass('hidden');
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
              url:'../../mess/meal_ind.php',
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
            url:'../../mess/meal_6.php?action=save_bazar',
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

<script type="text/javascript" src="../../js/jquery.touchSwipe.min.js"></script>
            <script id='code_1'>
                $(function() {          
                    $("#sob").swipe( {
                      swipeLeft:function(event, direction, distance, duration, fingerCount, fingerData) {
                        // alert("You swiped " + direction + " with " + fingerCount + " fingers");
                            
                            location.reload();
                            // alert("yes");
                      },
                      swipeRight:function(event, direction, distance, duration, fingerCount, fingerData) {
                        // alert("You swiped " + direction + " with " + fingerCount + " fingers");
                            $('#MyId').trigger('click');
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

                      $("#sobb").swipe( {
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
                            // alert("hi");
                          // $("#textText").html("You swiped " + swipeCount + " times");
                        },
                        excludedElements:"",
                        threshold:50
                      });



                });
            </script>