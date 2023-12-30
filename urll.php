<?php
session_start();
require_once 'db.php';
if(isset($_SESSION['userr'])){
    $unique_id=$_SESSION['userr'];
    $my_mess_id=$_SESSION['my_mess_id'];
    $me=$unique_id;
}
if(isset($_SESSION['user'])){
    $unique_id=$_SESSION['user'];
    $my_mess_id=$_SESSION['my_mess_id'];
    $me=$unique_id;
}
date_default_timezone_set("Asia/Dhaka");
$today=date("Y-m-d");
$time= date("h:i:s");
$ti= date("h");
$tii= date("i");
$tiii= date("A");


$u_id='';
$action='';
$na='';

if(isset($_REQUEST['u_id'])){
    // echo $_REQUEST['u_id'].'<br>';
    $u_id = $_REQUEST['u_id'];
}
if(isset($_REQUEST['action'])){
    // echo $_REQUEST['action'];   
    $action = $_REQUEST['action'];
}
if(isset($_REQUEST['name'])){
    $na = $_REQUEST['name'];   
}

?>


<!DOCTYPE html>
<html lang="">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Name QR</title>

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
<body>
    











<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/5.4.5/js/swiper.min.js"></script>
<script type="text/javascript" src="script.js"></script>
<script type="text/javascript" src="user.js"></script>
<script type="text/javascript" src="mess/meal.js"></script>

<script src="sweetalert.min.js"></script>
<script src="sweetalert2.all.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/5.4.5/js/swiper.min.js"></script>
<script src="js/validator.min.js"></script>
<!-- <script src="sweetalert.min.js"></script> -->

<!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js" ></script> -->
<!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.min.js" ></script> -->
<script src="//cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
<!-- <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script> -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js" integrity="sha384-eMNCOe7tC1doHpGoWe/6oMVemdAVTMs2xqW4mwXrXsW0L84Iytr2wi5v2QjrP/xp" crossorigin="anonymous"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>
</html>