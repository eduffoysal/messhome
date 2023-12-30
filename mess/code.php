<?php
include('../db.php');
session_start();

$unique_id=$_SESSION['user'];

$my_mess_id=$_SESSION['my_mess_id'];

if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on')   
$url = "https://";   
else  
$url = "http://";   
// Append the host(domain name, ip) to the URL.   
$url.= $_SERVER['HTTP_HOST'];   

// Append the requested resource location to the URL   
$url.= $_SERVER['REQUEST_URI'];    

//   echo $url;  
$ran_id = rand(time(), 1000000000);
$referr = strtoupper(bin2hex(random_bytes(3)));
// echo $referr.'-'.$ran_id;


if(isset($_POST['users_of_mess'])){

    $u_m="SELECT * FROM users WHERE mess_id='$my_mess_id'  order by bazar_start ASC";
    $um=mysqli_query($con,$u_m);
    $umm=mysqli_num_rows($um);



    if($umm<1){
        echo 'User Not found';
    }else{

        while($u=mysqli_fetch_assoc($um)){
            $unique_i=$u['unique_id'];

            $das=$u['bazar_start'];
            $dae=$u['bazar_end'];
            $dates= date("jS M", strtotime($das));
            $datee= date("jS M", strtotime($dae));

            $u_mm="SELECT * FROM mess_main WHERE mess_id='$my_mess_id' AND mess_admin_id='$unique_i'";
            $umm=mysqli_query($con,$u_mm);
            $ummm=mysqli_num_rows($umm);

            if($ummm==1){
                $color='green';
                $co='green'; 
                $icon='person-check-fill';
            }else{
                $color='pink';
                $co='gray';
                $icon='person-dash';
            }

            ?>
            <div class="user_cover border-white-300 mb-1 border-2 shadow-lg border-white-200 rounded-lg bg-white-200 border-x-2 rounded-top border-<?=$color?>-500">
            <div class="justify-center space-x-2 items-end user_to_admin_btn" id="<?=$u['unique_id']?>">
              <span
                class="rounded-full text-gray-500 bg-<?=$co?>-200 font-semibold text-sm flex align-center cursor-pointer active:bg-gray-300 transition duration-300 ease w-max">
                <img class="rounded-full w-9 h-9 max-w-none" alt="A"
                  src="https://mdbootstrap.com/img/Photos/Avatars/avatar-6.jpg" />
                <span class="flex items-center px-3 py-2">
                  <?=$u['user_name']?>
                </span>
                <button class="bg-transparent hover focus:outline-none">
                  <i class="bi bi-<?=$icon?>"></i>
                </button>
              </span>
            
              <div class="bajar_d">
                <span>From: <code> <?=$dates?></code>  To: <code><?=$datee?></code></span>
              </div>
            
            </div>
            </div>
            
            
            <?php
        }

    }


}


?>