<?php

session_start();
require_once 'db.php';
$unique_id=$_SESSION['user'];


$my_mess_id=$_SESSION['my_mess_id'];
$me=$unique_id;
// include('bar/barcode.php');

date_default_timezone_set("Asia/Dhaka");
$today=date("Y-m-d");
$time= date("h:i:s");

if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on')   
$url = "https://";   
else  
$url = "http://";   
// Append the host(domain name, ip) to the URL.   
$url.= $_SERVER['HTTP_HOST'];   

// Append the requested resource location to the URL   
$url.= $_SERVER['REQUEST_URI'];    


$ran_id = rand(time(), 1000000000);
$referr = strtoupper(bin2hex(random_bytes(3)));
// echo $referr.'-'.$ran_id;


if(isset($_POST['card_qr_ajax'])){
    // require_once 'bar/barcode.php';
    ?>

    <div style="margin:auto" class="max-w-sm tex-center bg-white rounded-lg border border-gray-200 shadow-md dark:bg-gray-800 dark:border-gray-700">
        <div class="text-center">
            <!-- <img class="" src="image/qr/<?=$me?>.png" style="width:250px;height: 250px; margin: auto" alt=""> -->
<?php
							echo '<img class="barcode rounded-t-lg mt-2" style=" margin: auto" alt="'.$my_mess_id.'" src="bar/barcode.php?text='.$my_mess_id.'&codetype=code128&orientation=horizontal&size=40&print=true"/>';
?>
        </div>
        <div class="p-1">
            <a href="#">
    
            </a>
            <p class="mb-2 font-normal text-gray-700 dark:text-gray-400">This is Mess Reg ID Bar-Code.</p>
        </div>
    </div>
    
    
        <?php
}

?>

