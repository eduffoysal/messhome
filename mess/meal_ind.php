<?php
include('../db.php');
session_start();

$unique_id=$_SESSION['user'];
include('../phpqrcode/qrlib.php');
$my_mess_id=$_SESSION['my_mess_id'];
$me=$unique_id;
    date_default_timezone_set("Asia/Dhaka");
    $today=date("Y-m-d");
    $time= date("h:i:s");

if(isset($_POST['payment_data_hidden'])){
    $date_pp=$_POST['m_for_p_date'];
    $date_p=$date_pp.'-01';
    $amount=$_POST['number_tk'];
    $userid=$_POST['sel_u_for_con_nam'];
    $phone_u=$_POST['number_phone'];

    $ran_id = rand(time(), 1000000000);
    $referr = strtoupper(bin2hex(random_bytes(1)));

    $numberr= 'P'.$ran_id.''.$referr;

    $qry = "SELECT * FROM mess_main WHERE mess_id='$my_mess_id'";
    $rslt = mysqli_query($con,$qry);

    $nm=mysqli_num_rows($rslt);

    if($nm<1){
        echo "Mess Not Found! Please Add a mess Code";
    }else{

        $row = mysqli_fetch_array($rslt);

        if($unique_id==$row['mess_admin_id']){

            $con->query("INSERT INTO payment (unique_id, mess_id, phone, amount, admin_id, date_m, time, trx_id) values ('$userid', '$my_mess_id', '$phone_u', '$amount','$unique_id', '$date_p', '$today', '$numberr')");
       
            echo 1;

        }elseif($row['u_perm']==1){
            
            $con->query("INSERT INTO payment (unique_id, mess_id, phone, amount, admin_id, date_m, time, trx_id) values ('$userid', '$my_mess_id', '$phone_u', '$amount','$unique_id', '$date_p', '$today', '$numberr')");
       
            echo 1;

        }else {
            echo 2;
        }
        

    }   
}


if(isset($_POST['user_bazar_save'])){

    if(isset($_POST['date'])){
        if($_POST['date']!=''){
          $todayy=$_POST['date'];
        }else{
          $todayy=$today;
        }
    }else{
        $todayy=$today;
    }

  $name = "Bazar";
  $amount =$_POST['bazarAmount'];
  $admin_n='0';
  $list_id=$r_id.''.$uni_id;

   if($amount != ''){
    $query = "INSERT INTO bazar_list (list_id, unique_id, mess_id, list_details, amount, date_time, admin_notify) values ('$list_id', '$unique_id', '$my_mess_id', '$name', '$amount', '$todayy', '$admin_n')";
   }

        if($query != ''){

            $s=mysqli_query($con,$query);

            if($s){
              echo "1";
            }else {
              echo "2";
            }

         }else {
           echo "3";
         }

}



if(isset($_POST['user_all_my_mess'])){
    ?>
        <label for="sel_u_for_conn" class="sr-only">Select tab</label>
      <select id="sel_u_for_conn" name="sel_u_for_con_nam" class="sel_u_for_con_cla bg-gray-50 border-0 border-b border-gray-200 text-gray-900 sm:text-sm rounded-t-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" data-tabs-toggle="#user_all_contentt" role="tablistt">
      <option id="about-tab" data-tabs-target="#about"   aria-controls="about" aria-selected="false">Select User</option>
      <?php
                    $queryd = mysqli_query($con,"SELECT * FROM users WHERE mess_id='$my_mess_id' ");
                    $numr=mysqli_num_rows($queryd);
                    if($numr<1){
                      ?>
                        <option id="about-tab" data-tabs-target="#about"   aria-controls="about" aria-selected="false">Mess not found!</option>
                      <?php
                    }else{
                      while($rowd=mysqli_fetch_array($queryd)){
                        ?>
                            <option id="<?=$rowd['unique_id'] ?>" value="<?=$rowd['unique_id'] ?>" data-tabs-target="#stats"  aria-controls="stats" aria-selected="true"><?=$rowd['user_name'] ?></option>
                        <?php
                      }
                    }

                ?>

      </select>
    <?php
}

if(isset($_POST['my_qr_code'])){
    $mess="mess";
    $meee= md5($me);
    $urlMain = $urlm.'/'.$mess.'/'.$meee.'/meal_save';

    $queryd = mysqli_query($con,"SELECT * FROM users WHERE unique_id='$unique_id' ");
    $numr=mysqli_num_rows($queryd);
    $qru=mysqli_fetch_assoc($queryd);
    if($numr==1){

    ?>
        <div style="margin: auto" class="bg-white all_qr rounded-lg border border-gray-200 shadow-lg dark:bg-gray-800 dark:border-gray-700" data-bs-toggle="modal" data-bs-target="#user_meal_modal">
            <div class="m-auto">
                <img class="rounded-t-lg" src="https://chart.googleapis.com/chart?chs=150x150&cht=qr&chl=<?=$urlMain?>" style="width:250px;height: 250px; margin: auto" alt="">
            </div>
            <div class="p-1 text-center">
                <a href="#">
        
                </a>
                <p class="mb-2 font-normal text-gray-700 dark:text-gray-400">Scan -<?=$qru['user_name']?>- Qr.</p>
            </div>
        </div>    
    <?php
    }else{
        echo "User not found!";
    }

}

if(isset($_POST['all_qr'])){
    $mess="mess";
                    $queryd = mysqli_query($con,"SELECT * FROM users WHERE mess_id='$my_mess_id' ");
                    $numr=mysqli_num_rows($queryd);
                    if($numr<1){
                      ?>
        <div style="margin: auto" class="bg-white rounded-lg border border-gray-200 shadow-lg dark:bg-gray-800 dark:border-gray-700">
            <div class="m-auto">
                <img class="rounded-t-lg" src="https://chart.googleapis.com/chart?chs=150x150&cht=qr&chl=Farhad_foysal" style="width:250px;height: 250px; margin: auto" alt="">
            </div>
            <div class="p-1 text-center">
                <a href="#">
        
                </a>
                <p class="mb-2 font-normal text-gray-700 dark:text-gray-400">Scan your - Qr.</p>
            </div>
        </div> 
                      <?php
                    }else{
                      while($rowd=mysqli_fetch_array($queryd)){
                            $m=$rowd['unique_id'];
                            $meee= md5($m);
                            if($rowd['qr']==''){
                                            $u="u";
                                            $uu="uu";
                                            $mee=$urlm.'/'.$u.'/'.$meee.'/meal_save';
                                            $meem=$urlm.'/'.$uu.'/'.$meee.'/mess_save';
                                        if(!is_dir('../image/')) mkdir('../image/');
                                            $tempDir = '../image/'; 
                                            $tempDirr = '../image/qr/'; 
                                            if(!is_file('../image/'.$m.'.png'))

                                        QRcode::png($mee, $tempDir.''.$m.'.png', QR_ECLEVEL_L, 5);
                                        QRcode::png($meem, $tempDirr.''.$m.'.png', QR_ECLEVEL_L, 5);

                                        $con->query("UPDATE users SET qr='$meee' WHERE unique_id='$m'");
                            }

                            $urlMain = $urlm.'/'.$mess.'/'.$meee.'/meal_save';
                        ?>
        <div style="margin: auto" class="col-md-6 qr_down bg-white rounded-lg border border-gray-200 shadow-lg dark:bg-gray-800 dark:border-gray-700">
            <div class="m-auto">
                <img class="rounded-t-lg" src="https://chart.googleapis.com/chart?chs=320x320&cht=qr&chl=<?=$urlMain?>" style="width:320px;height: 320px; margin: auto" alt="">
            </div>
            <div class="p-1 text-center">
                <a href="#">
        
                </a>
                <p class="mb-2 font-normal text-gray-700 dark:text-gray-400">Scan -<?=$rowd['user_name']?>- Qr.</p>
            </div>
        </div> 
                        <?php
                      }
                    }

}

if(isset($_POST['meal_save'])){

	$userr=$_POST['u_id'];
	$code=$_POST['code'];
	$meal_d=1;

    if(isset($_POST['ind_d'])){
        if($_POST['ind_d']!=''){
          $todayy=$_POST['ind_d'];
        }else{
          $todayy=$today;
        }
    }else{
        $todayy=$today;
    }

    $qry = "SELECT * FROM mess_main WHERE mess_id='$my_mess_id'";
    $rslt = mysqli_query($con,$qry);
    $row = mysqli_fetch_array($rslt);

    $nm=mysqli_num_rows($rslt);

    if($nm<1){
        echo 2;


    }else{


        $per=$row['u_perm'];

        $admin=$row['mess_admin_id'];

        if($admin==$unique_id || $per==1 || $userr==$unique_id){
                            $userfi="SELECT * FROM my_meals WHERE unique_id='$userr' AND mess_id='$my_mess_id' AND date='$todayy' ";
                            $myq=mysqli_query($con,$userfi);

                            if(mysqli_num_rows($myq) > 0){
                           		$myu=mysqli_fetch_assoc($myq);
                           		if($code=='b'){
                           			$query="UPDATE my_meals SET sum_meal=launce+dinner+$meal_d, morning='$meal_d' WHERE mess_id='$my_mess_id' AND unique_id='$userr' AND date='$todayy'";
                           		}else if($code=='l'){
                           			$query="UPDATE my_meals SET sum_meal=morning+dinner+$meal_d, launce='$meal_d' WHERE mess_id='$my_mess_id' AND unique_id='$userr' AND date='$todayy'";
                           		}else{
                           			$query="UPDATE my_meals SET sum_meal=morning+launce+$meal_d, dinner='$meal_d' WHERE mess_id='$my_mess_id' AND unique_id='$userr' AND date='$todayy'";                         		
                           		}                           		

	                        }else{
                           		if($code=='b'){
                           			$query="INSERT INTO my_meals (unique_id, mess_id, morning, date, time, sum_meal) values ('$userr', '$my_mess_id', '$meal_d', '$todayy', '$time', '$meal_d')";
                           		}else if($code=='l'){
                           			$query="INSERT INTO my_meals (unique_id, mess_id, launce, date, time, sum_meal) values ('$userr', '$my_mess_id', '$meal_d', '$todayy', '$time', '$meal_d')";
                           		}else{
                           			$query="INSERT INTO my_meals (unique_id, mess_id, dinner, date, time, sum_meal) values ('$userr', '$my_mess_id', '$meal_d', '$todayy', '$time', '$meal_d')";
                           		}


	                        }
	                        $e=$con->query($query);
	                        if($e){
	                        	echo 1;
	                        }else{
	                        	echo 4;
	                        }
        }else{
        	echo 3;
        }

    }

}

if(isset($_POST['meal_cancel'])){

	$userr=$_POST['u_id'];
	$code=$_POST['code'];
	$meal_d=0;

    if(isset($_POST['ind_d'])){
        if($_POST['ind_d']!=''){
          $todayy=$_POST['ind_d'];
        }else{
          $todayy=$today;
        }
    }else{
        $todayy=$today;
    }

    $qry = "SELECT * FROM mess_main WHERE mess_id='$my_mess_id'";
    $rslt = mysqli_query($con,$qry);
    $row = mysqli_fetch_array($rslt);

    $nm=mysqli_num_rows($rslt);

    if($nm<1){
        echo 2;


    }else{


        $per=$row['u_perm'];

        $admin=$row['mess_admin_id'];

        if($admin==$unique_id || $per==1 || $userr==$unique_id){

                           		if($code=='b'){
                           			$query="UPDATE my_meals SET sum_meal=launce+dinner+$meal_d, morning='$meal_d' WHERE mess_id='$my_mess_id' AND unique_id='$userr' AND date='$todayy'";
                           		}else if($code=='l'){
                           			$query="UPDATE my_meals SET sum_meal=morning+dinner+$meal_d, launce='$meal_d' WHERE mess_id='$my_mess_id' AND unique_id='$userr' AND date='$todayy'";
                           		}else{
                           			$query="UPDATE my_meals SET sum_meal=morning+launce+$meal_d, dinner='$meal_d' WHERE mess_id='$my_mess_id' AND unique_id='$userr' AND date='$todayy'";                         		
                           		}

	                        $e=$con->query($query);
	                        if($e){
	                        	echo 1;
	                        }else{
	                        	echo 4;
	                        }
        }else{
        	echo 3;
        }

    }

}

if(isset($_POST['ind_meal'])){ 


    if(isset($_POST['ind_d'])){
        if($_POST['ind_d']!=''){
          $datef=$_POST['ind_d'];
        }else{
          $datef=$today;
        }
    }else{
        $datef=$today;
    }
      
      
      
      $dateef = strtotime($datef);
      
      $monthh = date('m', $dateef);
      $yearr= date('Y', $dateef);
      
      $mon = date('m', $dateef);
      $yea= date('Y', $dateef);

    $select = "SELECT * FROM mess_main WHERE mess_id='$my_mess_id' ";
    $query = mysqli_query($con, $select);
    
    if(mysqli_num_rows($query) > 0){


?>
    <div class="containerr px-1">
        <div class="input-group m-1">
        <input style="color: blue;" type="date" class="form-control font-normal text-blue-700 bg-clip-padding border border-primary border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none" id="search_meal_date" placeholder="Select a date" aria-label="Select a date" aria-describedby="button-addon2" value="<?=$datef?>">
        <button class="btn btn-outline-secondary search_meal_date_b bg-blue-600 font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out" type="button" id="meal_date_b">Check</button>
        </div>
    </div>

                  <div class="container border-x-2 border-t-rounded border-gray-300 shadow-lg ">


                    <?php
                    	    $selectt = "SELECT * FROM users WHERE mess_id='$my_mess_id' ";
    						$queryy = mysqli_query($con, $selectt);

                        while($pa=mysqli_fetch_array($queryy)){

                            $usert=$pa['unique_id'];
                            $userfi="SELECT * FROM my_meals WHERE unique_id='$usert' AND mess_id='$my_mess_id' AND date='$datef' ";
                            $myq=mysqli_query($con,$userfi);

                            if(mysqli_num_rows($myq) > 0){
                           		$myu=mysqli_fetch_assoc($myq);
                            	$color='old';
                            	$morning=$myu['morning'];
                            	$launch=$myu['launce'];
                            	$dinner=$myu['dinner'];
                            	$sumMeal=$morning+$launch+$dinner;
                            	if($morning==0){
                            		$morningb='redb';
                            		$bbutton='b-button';
                            	}else{
                            		$morningb='green';
                            		$bbutton='b-buttonn';
                            	}
                            	if($launch==0){
                            		$launchb='redb';
                            		$lbutton='l-button';
                            	}else{
                            		$launchb='green';
                            		$lbutton='l-buttonn';
                            	}
                            	if($dinner==0){
                            		$dinnerb='redb';
                            		$dbutton='d-button';
                            	}else{
                            		$dinnerb='green';
                            		$dbutton='d-buttonn';
                            	}
                            }else{
                            	$color='new';
                            	$morningb='';
                            	$launchb='';
                            	$dinnerb='';
                            	$sumMeal=0;
                            	$bbutton='b-button';
                            	$lbutton='l-button';
                            	$dbutton='d-button';


                            }





                            ?>
					<div class="row border-x-1 border-x-pink-300 border-2 shadow-lg rounded-lg bg-white-200 border-x-2 rounded-top border-y-gray-500 mb-1">
                      <div class="col-12">

                        <div class="user_coverr ">
                          <div class="justify-center items-end" id="">
                            <span
                              class="rounded-full meal_count_s text-grayy-500 bg-red-200 font-semibold text-sm flex align-center cursor-pointer active:bg-gray-300 transition duration-300 ease w-max" id="<?=$usert?>">
                              <img class="rounded-full w-9 h-9 max-w-none delete_payment" id="id" alt="A"
                                src="https://mdbootstrap.com/img/Photos/Avatars/avatar-6.jpg" />
                              <span class="flex items-center pl-3 py-2">
                                <?=$pa['user_name']?>
                              </span>
                              <code class="flex text-sm items-center px-1"><?=$datef?></code>
                              <button class="bg-transparent hover focus:outline-none">
                                <i class="bi bi-check"></i>
                              </button>
                                                      <h3> <span id="total-countt_<?=$usert?>"><?=$sumMeal?></span></h3>
                            </span>

                            <div class="meal-selector">
                              <button style="background-color: " class="meal-button <?=$morningb?> breakfast-button b_<?=$usert?> <?=$bbutton?> m_b_<?=$color?>" id="<?=$usert?>">B</button>
                              <button style="background-color: " class="meal-button <?=$launchb?> l_<?=$usert?> lunch-button <?=$lbutton?> m_b_<?=$color?>" id="<?=$usert?>">L</button>
                              <button style="background-color: " class="meal-button <?=$dinnerb?> d_<?=$usert?> dinner-button <?=$dbutton?> m_b_<?=$color?>" id="<?=$usert?>">D</button>
                            </div>
                          
                          </div>
                        </div>

                      </div>

                    </div>
                            <?php
                        }
                    ?>


                  </div>
<?php

    }else{
        echo "Mess not found! Or user not found";
        
    }

?>



<?php

}



if(isset($_POST['MyMeal'])){

    if(isset($_POST['ind_d'])){
        if($_POST['ind_d']!=''){
          $datef=$_POST['ind_d'];
        }else{
          $datef=$today;
        }
    }else{
        $datef=$today;
    }
                            $usert=$unique_id;
                            $userfi="SELECT * FROM my_meals WHERE unique_id='$usert' AND mess_id='$my_mess_id' AND date='$datef' ";
                            $myq=mysqli_query($con,$userfi);

                            if(mysqli_num_rows($myq) > 0){
                                $myu=mysqli_fetch_assoc($myq);
                                $color='old';
                                $morning=$myu['morning'];
                                $launch=$myu['launce'];
                                $dinner=$myu['dinner'];
                                $sumMeal=$morning+$launch+$dinner;
                                if($morning==0){
                                    $morningb='redb';
                                    $bbutton='b-button';
                                }else{
                                    $morningb='green';
                                    $bbutton='b-buttonn';
                                }
                                if($launch==0){
                                    $launchb='redb';
                                    $lbutton='l-button';
                                }else{
                                    $launchb='green';
                                    $lbutton='l-buttonn';
                                }
                                if($dinner==0){
                                    $dinnerb='redb';
                                    $dbutton='d-button';
                                }else{
                                    $dinnerb='green';
                                    $dbutton='d-buttonn';
                                }
                            }else{
                                $color='new';
                                $morningb='';
                                $launchb='';
                                $dinnerb='';
                                $sumMeal=0;
                                $bbutton='b-button';
                                $lbutton='l-button';
                                $dbutton='d-button';


                            }


                            ?>

                            <div class="meal-selector">
                              <button style="background-color: " class="meal-button <?=$morningb?> breakfast-button b_<?=$usert?> <?=$bbutton?> m_b_<?=$color?>" id="<?=$usert?>">B</button>
                              <button style="background-color: " class="meal-button <?=$launchb?> l_<?=$usert?> lunch-button <?=$lbutton?> m_b_<?=$color?>" id="<?=$usert?>">L</button>
                              <button style="background-color: " class="meal-button <?=$dinnerb?> d_<?=$usert?> dinner-button <?=$dbutton?> m_b_<?=$color?>" id="<?=$usert?>">D</button>
                            </div>

                            <?php
}


if(isset($_POST['ind_meall'])){ 


    if(isset($_POST['ind_d'])){
        if($_POST['ind_d']!=''){
          $datef=$_POST['ind_d'];
        }else{
          $datef=$today;
        }
    }else{
        $datef=$today;
    }
      
      
      
      $dateef = strtotime($datef);
      
      $monthh = date('m', $dateef);
      $yearr= date('Y', $dateef);
      
      $mon = date('m', $dateef);
      $yea= date('Y', $dateef);

    $select = "SELECT * FROM mess_main WHERE mess_id='$my_mess_id' ";
    $query = mysqli_query($con, $select);
    
    if(mysqli_num_rows($query) > 0){


?>
    <div class="containerr px-1">
        <div class="input-group m-1">
        <input style="color: blue;" type="date" class="form-control font-normal text-blue-700 bg-clip-padding border border-primary border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none" id="search_meal_date" placeholder="Select a date" aria-label="Select a date" aria-describedby="button-addon2" value="<?=$datef?>">
        <button class="btn btn-outline-secondary search_meal_date_b bg-blue-600 font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out" type="button" id="meal_date_b">Check</button>
        </div>
    </div>

                  <div class="container border-x-2 border-t-rounded border-gray-300 shadow-lg ">


                    <?php
                            $selectt = "SELECT * FROM users WHERE mess_id='$my_mess_id' ";
                            $queryy = mysqli_query($con, $selectt);

                        while($pa=mysqli_fetch_array($queryy)){

                            $usert=$pa['unique_id'];
                            $userfi="SELECT * FROM my_meals WHERE unique_id='$usert' AND mess_id='$my_mess_id' AND date='$datef' ";
                            $myq=mysqli_query($con,$userfi);

                            if(mysqli_num_rows($myq) > 0){
                                $myu=mysqli_fetch_assoc($myq);
                                $color='old';
                                $morning=$myu['morning'];
                                $launch=$myu['launce'];
                                $dinner=$myu['dinner'];
                                $sumMeal=$morning+$launch+$dinner;
                                if($morning==0){
                                    $morningb='redb';
                                    $bbutton='b-button';
                                }else{
                                    $morningb='green';
                                    $bbutton='b-buttonn';
                                }
                                if($launch==0){
                                    $launchb='redb';
                                    $lbutton='l-button';
                                }else{
                                    $launchb='green';
                                    $lbutton='l-buttonn';
                                }
                                if($dinner==0){
                                    $dinnerb='redb';
                                    $dbutton='d-button';
                                }else{
                                    $dinnerb='green';
                                    $dbutton='d-buttonn';
                                }
                            }else{
                                $color='new';
                                $morningb='';
                                $launchb='';
                                $dinnerb='';
                                $sumMeal=0;
                                $bbutton='b-button';
                                $lbutton='l-button';
                                $dbutton='d-button';


                            }





                            ?>
                    <div class="row border-x-1 border-x-pink-300 border-2 shadow-lg rounded-lg bg-white-200 border-x-2 rounded-top border-y-gray-500 mb-1">
                      <div class="col-12">

                        <div class="user_coverr ">
                          <div class="justify-center items-end" id="">
                            <span
                              class="rounded-full meal_count_s text-grayy-500 bg-red-200 font-semibold text-sm flex align-center cursor-pointer active:bg-gray-300 transition duration-300 ease w-max" id="<?=$usert?>">
                              <img class="rounded-full w-9 h-9 max-w-none delete_payment" id="id" alt="A"
                                src="https://mdbootstrap.com/img/Photos/Avatars/avatar-6.jpg" />
                              <span class="flex items-center pl-3 py-2">
                                <?=$pa['user_name']?>
                              </span>
                              <code class="flex text-sm items-center px-1"><?=$datef?></code>
                              <button class="bg-transparent hover focus:outline-none">
                                <i class="bi bi-check"></i>
                              </button>
                                                      <h3> <span id="total-countt_<?=$usert?>"><?=$sumMeal?></span></h3>
                            </span>

                            <div class="meal-selector">
                              <button style="background-color: " class="meal-button <?=$morningb?> breakfast-button b_<?=$usert?> <?=$bbutton?> m_b_<?=$color?>" id="<?=$usert?>">B</button>
                              <button style="background-color: " class="meal-button <?=$launchb?> l_<?=$usert?> lunch-button <?=$lbutton?> m_b_<?=$color?>" id="<?=$usert?>">L</button>
                              <button style="background-color: " class="meal-button <?=$dinnerb?> d_<?=$usert?> dinner-button <?=$dbutton?> m_b_<?=$color?>" id="<?=$usert?>">D</button>
                            </div>
                          
                          </div>
                        </div>

                      </div>

                    </div>
                            <?php
                        }
                    ?>


                  </div>
<?php

    }else{
        echo "Mess not found! Or user not found";
        
    }

?>



<?php

}


if(isset($_POST['user_single_meal'])){
    $user=$_POST['UserId'];

    if(isset($_POST['ind_d'])){
        if($_POST['ind_d']!=''){
          $datef=$_POST['ind_d'];
        }else{
          $datef=$today;
        }
    }else{
        $datef=$today;
    }

?>
    <div class="containerr px-1">
        <div class="input-group m-1">
        <input type="date" class="form-control text-base font-normal text-blue-700 bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none" id="send_meal_s_d" placeholder="Select a date" aria-label="Select a date" aria-describedby="button-addon2" value="<?=$datef?>" >
        <button class="btn btn-outline-secondary send_meal_s_b bg-blue-600 font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out" type="button" id="<?=$user?>">Check</button>
        </div>
    </div>

    <?php
                            $userfi="SELECT * FROM my_meals WHERE unique_id='$user' AND mess_id='$my_mess_id' AND date='$datef' ";
                            $myq=mysqli_query($con,$userfi);

                            if(mysqli_num_rows($myq) > 0){
                                $myu=mysqli_fetch_assoc($myq);
    ?>


                                    <div class="dashboard">
                                      <div class="meal-counter">
                                        <h2>Breakfast</h2>
                                        <div class="counter">
                                          <button class="decrement" id="breakfast-decrement">-</button>
                                          <span class="count sokal_meal_<?=$user?>" id="breakfast-count"><?=$myu['morning']?></span>
                                          <button class="increment" id="breakfast-increment">+</button>
                                        </div>
                                      </div>
                                      <div class="meal-counter">
                                        <h2>Lunch</h2>
                                        <div class="counter">
                                          <button class="decrement" id="launch-decrement">-</button>
                                          <span class="count launch_meal_<?=$user?>" id="launch-count"><?=$myu['launce']?></span>
                                          <button class="increment" id="launch-increment">+</button>
                                        </div>
                                      </div>
                                      <div class="meal-counter">
                                        <h2>Dinner</h2>
                                        <div class="counter">
                                          <button class="decrement" id="dinner-decrement">-</button>
                                          <span class="count dinner_meal_<?=$user?>" id="dinner-count"><?=$myu['dinner']?></span>
                                          <button class="increment" id="dinner-increment">+</button>
                                        </div>
                                      </div>
                                      <div class="total-meals">
                                        
                                        <div class="container-s">
                                            <button class="close-btn close_s_btn"><span id="total-count"><?=$myu['sum_meal']?></span> - <span>Cancel</span> </button>
                                            <input type="hidden" name="" class="date_meal_<?=$user?>" id="date_meal_<?=$user?>" value="<?=$datef?>">
                                            <button class="save-btn save_s_btn" id="<?=$user?>">Save</button>
                                        </div>

                                      </div>

                                    </div>


    <?php
                            }else{
                                ?>
                                    <div class="dashboard">
                                      <div class="meal-counter">
                                        <h2>Breakfast</h2>
                                        <div class="counter">
                                          <button class="decrement" id="breakfast-decrement">-</button>
                                          <span class="count sokal_meal_<?=$user?>" id="breakfast-count">0</span>
                                          <button class="increment" id="breakfast-increment">+</button>
                                        </div>
                                      </div>
                                      <div class="meal-counter">
                                        <h2>Lunch</h2>
                                        <div class="counter">
                                          <button class="decrement" id="launch-decrement">-</button>
                                          <span class="count launch_meal_<?=$user?>" id="launch-count">0</span>
                                          <button class="increment" id="launch-increment">+</button>
                                        </div>
                                      </div>
                                      <div class="meal-counter">
                                        <h2>Dinner</h2>
                                        <div class="counter">
                                          <button class="decrement" id="dinner-decrement">-</button>
                                          <span class="count dinner_meal_<?=$user?>" id="dinner-count">0</span>
                                          <button class="increment" id="dinner-increment">+</button>
                                        </div>
                                      </div>
                                      <div class="total-meals">
                                        
                                        <div class="container-s">
                                            <button class="close-btn close_s_btn"><span id="total-count">0</span> - <span>Cancel</span> </button>
                                            <input type="hidden" name="" class="date_meal_<?=$user?>" id="date_meal_<?=$user?>" value="<?=$datef?>">
                                            <button class="save-btn save_s_btn" id="<?=$user?>">Save</button>
                                        </div>

                                      </div>

                                    </div>                                
                                <?php
                            }



}




if(isset($_POST['save_single_meal'])){
    $user=$_POST['UserId'];

    if(isset($_POST['ind_d'])){
        if($_POST['ind_d']!=''){
          $datef=$_POST['ind_d'];
        }else{
          $datef=$today;
        }
    }else{
        $datef=$today;
    }

    $s=$_POST['s'];
    $l=$_POST['l'];
    $d=$_POST['d'];
    $t=$_POST['t'];



    $qry = "SELECT * FROM mess_main WHERE mess_id='$my_mess_id'";
    $rslt = mysqli_query($con,$qry);
    $row = mysqli_fetch_array($rslt);

    $nm=mysqli_num_rows($rslt);

    if($nm<1){
        echo 2;


    }else{


        $per=$row['u_perm'];

        $admin=$row['mess_admin_id'];

        if($admin==$unique_id || $per==1){
                            $userfi="SELECT * FROM my_meals WHERE unique_id='$user' AND mess_id='$my_mess_id' AND date='$datef' ";
                            $myq=mysqli_query($con,$userfi);

                            if(mysqli_num_rows($myq) > 0){

                                    $query="UPDATE my_meals SET sum_meal='$t', morning='$s', launce='$l', dinner='$d' WHERE mess_id='$my_mess_id' AND unique_id='$user' AND date='$datef'";
                                
                            }else{

                                    $query="INSERT INTO my_meals (unique_id, mess_id, morning, launce, dinner, date, time, sum_meal) values ('$user', '$my_mess_id', '$s', '$l', '$d', '$datef', '$time', '$t')";

                            }
                            $e=$con->query($query);
                            if($e){
                                echo 1;
                            }else{
                                echo 4;
                            }
        }else{
            echo 3;
        }

    }



}


if(isset($_POST['user_all_meal'])){
    if(isset($_POST['month_d'])){
        $check="CHECK";
        if($_POST['month_d']!=''){
          $datef=$_POST['month_d'];
        }else{
          $datef=$today;
          $datef=date('Y-m-d', strtotime($datef. '-1 months'));   
        }
          $dateef = strtotime($datef);
          
          $monthh = date('m', $dateef);
          $yearr= date('Y', $dateef);
          
          $mon = date('m', $dateef);
          $yea= date('Y', $dateef); 
          $d=$datef;
    }else{
        $check="PREV";
        $datef=$today;

          $dateef = strtotime($datef);
          
          $monthh = date('m', $dateef);
          $yearr= date('Y', $dateef);
          
          $mon = date('m', $dateef);
          $yea= date('Y', $dateef); 
          $d="";       

    }
      

    if(isset($_POST['user'])){
        $user=$_POST['user'];
    }else{
        $user=$unique_id;
    }

    $select = "SELECT * FROM my_meals WHERE mess_id='$my_mess_id' AND unique_id='$user' AND MONTH(date)='$mon' AND YEAR(date)='$yea' ";
    $query = mysqli_query($con, $select);
    
    if(mysqli_num_rows($query) > 0){


?>
    <div class="containerr px-1">
        <div class="input-group m-1">
        <input type="month" class="form-control text-base font-normal text-blue-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none" id="send_month_for_m" placeholder="Select a date" aria-label="Select a date" value="<?=$d?>" aria-describedby="button-addon2" >
        <button class="btn btn-outline-secondary send_month_m bg-blue-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out" type="button" id="<?=$user?>"><?=$check?></button>
        </div>
    </div>
    <div class="text-center">
        <code class="text-sm"><?=date("F", $dateef)?></code>
    </div>

                                                  <table class="table table-responsive text-center m-auto table-light table-hover table-striped table-borderd border-dark">
                                                      <thead class="table-primary">
                                                          <tr>
                                                          <th class="border-1">Date</th>
                                                          <th class="border-1">B</th>
                                                          <th class="border-1">L</th>
                                                          <th class="border-1">D</th>
                                                          <th class="border-1">Total</th>
                                                          </tr>
                                                      </thead>
                                                      <tbody class="table-striped">

                    <?php
                        while($p=mysqli_fetch_array($query)){
                            $datep=$p['date'];
                            $dat = strtotime($datep);
      
                            $day = date('d', $dat);

                            ?>

                                                          <tr>
                                                            <td class="border-1 f_delete_b text-danger" id="<?=$p['id']?>"> <i class="bi bi-pen"></i> <?=$day?></td>
                                                            <td class="border-1"><?=$p['morning']?></td>
                                                            <td class="border-1"><?=$p['launce']?></td>
                                                            <td class="border-1"><?=$p['dinner']?></td>
                                                            <td class="border-1"><?=$p['sum_meal']?></td>
                                                          </tr>
                            <?php
                        }
                    ?>

                                                      </tbody>    
      
                                                      <tfoot class="table-dark">
                                                          <tr>
                                                              <td colspan="4" class="border-1">Total : </td>
                                                              <td class="border-1">...</td>
                                                          </tr>
                                                      </tfoot>
                                                  </table>
<?php

    }else{
        echo "Meal not found!";
        
    }    



}


if(isset($_POST['user_meal_sec'])){

?>
  <div class="w-full mt-1 bg-white rounded-lg border shadow-md dark:bg-gray-800 dark:border-gray-700">
  <div class="sm:hiddenn">
      <label for="sel_u_for_conn" class="sr-only">Select tab</label>
      <select id="sel_u_for_conn" name="sel_u_for_conn_na" class="sel_u_for_conn_cl bg-gray-50 border-0 border-b border-gray-200 text-gray-900 sm:text-sm rounded-t-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" data-tabs-toggle="#user_all_contentm" role="tablist">
      <option id="about-tab" data-tabs-target="#about"   aria-controls="about" aria-selected="false">Select User</option>
      <?php
                    $queryd = mysqli_query($con,"SELECT * FROM users WHERE mess_id='$my_mess_id' ");
                    $numr=mysqli_num_rows($queryd);
                    if($numr<1){
                      ?>
                        <option id="about-tab" data-tabs-target="#about"   aria-controls="about" aria-selected="false">Mess not found!</option>
                      <?php
                    }else{
                      while($rowd=mysqli_fetch_array($queryd)){
                        ?>
                            <option id="<?=$rowd['unique_id'] ?>" value="<?=$rowd['unique_id'] ?>" data-tabs-target="#stats"  aria-controls="stats" aria-selected="true"><?=$rowd['user_name'] ?></option>
                        <?php
                      }
                    }

                ?>

      </select>
  </div>
  
  <div id="user_all_contentm" class="user_all_contentm p-1 text-justify border-t border-gray-200 dark:border-gray-600">

      
  </div>
  <div class="monthly_meal_details" id="monthly_meal_details">
      

<!--                                                   <table class="table table-responsive text-center m-auto table-light table-hover table-striped table-borderd border-dark">
                                                      <thead class="table-primary">
                                                          <tr>
                                                          <th class="border-1">Date</th>
                                                          <th class="border-1">B</th>
                                                          <th class="border-1">L</th>
                                                          <th class="border-1">D</th>
                                                          <th class="border-1">Total</th>
                                                          </tr>
                                                      </thead>
                                                      <tbody class="table-striped">
                                                      <?php

                                                          ?>
                                                          <tr>
                                                            <td class="border-1 f_delete_b text-danger" id="<?php?>"> <i class="bi bi-pen"></i> <?php?></td>
                                                            <td class="border-1"><?php?></td>
                                                            <td class="border-1"><?php?></td>
                                                          </tr>
                                                          <?php

                                                      ?>

                                                      </tbody>    
      
                                                      <tfoot class="table-dark">
                                                          <tr>
                                                              <td colspan="2" class="border-1">Total : </td>
                                                              <td class="border-1">total num</td>
                                                          </tr>
                                                      </tfoot>
                                                  </table> -->
      
  </div>
</div>

<?php
}


if(isset($_POST['sel_u_for_m_bb'])){
$idUser=$_POST['idUser'];

  ?>
      
<div class="container-fluidd">

<div class="flex items-center justify-center">
<div class="inline-flex" role="group">
  <button
    type="button"
    class="
      otherss_sec_btn
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
    id="<?=$idUser?>"
  >
    Monthly
  </button>    
  <button
    type="button"
    class="
      meall_sec_btn
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
    id="<?=$idUser?>"
  >
    Meal
  </button>
  <button
    type="button"
    id="<?=$idUser?>"
    class="
      bazarr_sec_btn
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
    Bazar
  </button>

</div>
</div>

                <div class="section_otherss" id="section_otherss">
                  


                </div>
                <div class="section_meall hidden" id="section_meall">

                <div class="form-controll">
                    <div class="input-group mt-1 mb-1">
                    <input type="date" class="form-control" id="meall_search_date" placeholder="Select a date" aria-label="Select a date" aria-describedby="<?=$user?>">
                    <button class="btn btn-outline-secondary meall_search_b" type="button" id="<?=$idUser?>" >Check</button>
                    </div>
                </div>



                        <div class="row_meall_board_mainn p-2 border-white-300 border-2 shadow-lg border-white-200 rounded-lg bg-white-200">
                              <div class="meall_myy">

                                <div class="future_meallss" id="future_meallss">
                                
                                </div>

                              </div>
                        </div>



                </div>
                
                <div class="section_bazarr hidden" id="section_bazarr" >


                </div>


</div>  
  <?php

}










if(isset($_POST['bazar_user'])){

    $me=$_POST['UserId'];
  
    if($me==$unique_id){
      $hidden='';
      $bu='tt_month_bazz';
    }else{
      $bu='';
      $hidden='hidden';
    }
  
  
    $queryd = mysqli_query($con,"SELECT * FROM users WHERE unique_id='$me'");
  $numr=mysqli_fetch_assoc($queryd);
  
    $re="SELECT SUM(sum_meal) AS all_meals FROM my_meals WHERE mess_id='$my_mess_id' AND MONTH(date)='$month' AND YEAR(date)='$year' ";
    $rem="SELECT SUM(sum_meal) AS m_meals FROM my_meals WHERE mess_id='$my_mess_id' AND unique_id='$me' AND MONTH(date)='$month' AND YEAR(date)='$year' ";
  
    $reb="SELECT SUM(amount) AS all_bazar FROM bazar_list WHERE mess_id='$my_mess_id' AND MONTH(date_time)='$month' AND YEAR(date_time)='$year' ";
    $rebm="SELECT SUM(amount) AS m_bazar FROM bazar_list WHERE mess_id='$my_mess_id' AND unique_id='$me' AND MONTH(date_time)='$month' AND YEAR(date_time)='$year' ";
  
    $req=mysqli_query($con,$re);
    $remq=mysqli_query($con,$rem);
    $rebq=mysqli_query($con,$reb);
    $rebmq=mysqli_query($con,$rebm);
  
    $rer=mysqli_num_rows($req);
    $remr=mysqli_num_rows($remq);
    $rebr=mysqli_num_rows($rebq);
    $rebmr=mysqli_num_rows($rebmq);
  
  
  
    if($rer<1){
      $all_meals=0;
  
    }else{
      $res=mysqli_fetch_assoc($req); 
  
      $all_meals=$res['all_meals'];
  
    }
  
    if($remr<1){
      $m_meals=0;
    }else{
      $rems=mysqli_fetch_assoc($remq); 
      $m_meals=$rems['m_meals'];
    }
  
    if($rebr<1){
      $all_bazar=0;
    }else{
      $rebs=mysqli_fetch_assoc($rebq); 
      $all_bazar=$rebs['all_bazar'];
    }
  
    if($rebmr<1){
      $m_bazar=0;
    }else{
      $rebms=mysqli_fetch_assoc($rebmq); 
      $m_bazar=$rebms['m_bazar'];
    }
  
    if($all_bazar==0){
  
      $meal_rate=0;
  
    }elseif($all_meals==0){
  
      $meal_rate=$all_bazar/1;
  
    }else {
      $meal_rate=$all_bazar/$all_meals;
    }
  
    $meal_tk=$meal_rate*$m_meals;
  
  
  
  
    ?>
  
  <div class="bazarr_section mt-3" id="monthly_bazz_cont2">
      
  
<div class="row">
<div class="col-6 text-start">
  <button type="button" class="this_month_listt inline-block px-2 py-2 border-2 border-gray-800 text-info bg-dark font-medium text-xs leading-tight uppercase rounded hover:bg-black hover:bg-opacity-5 focus:outline-none focus:ring-0 transition duration-150 ease-in-out"><?=date("M")?></button>
  </div>
  
  <div class="col-6 text-end">
  <button type="button" class="<?=$hidden?> <?=$bu?> inline-block px-2 py-2 border-2 border-gray-800 text-dark font-medium text-xs leading-tight uppercase rounded hover:bg-black hover:bg-opacity-5 focus:outline-none focus:ring-0 transition duration-150 ease-in-out" data-bs-toggle="modal" data-bs-target="#user_gen_modal">AddBazar</button>
  </div>
</div>
  
      <div class="containerr text-dark px-1">
          <div class="input-group m-1">
          <input type="month" class="form-control text-base font-normal text-secondary bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none" id="sendd_month_for_bb" placeholder="Select a date" aria-label="Select a date" aria-describedby="button-addon2" >
          <button class="btn btn-outline-secondary sendd_month_bb bg-blue-600 text-dark font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out" type="button" id="<?=$me?>">Check</button>
          </div>
      </div>
      <div class="row">
                                                            <div class="col-6 text-start">
                                                              <code><?=$numr['user_name']?></code>
                                                            </div>
                                                            <div class="col-6 text-end">
                                                            <input type="button" class="btn btn-info btn-sm monthly_bazz_contb2" value="Print">
                                                            </div>
                                                          </div>
  
  
                                          <div class="flex flex-col baa_t_month_list">
                                            <div class="overflow-x-auto sm:-mx-1 lg:-mx-2">
                                              <div class="py-2 inline-block min-w-full sm:px-1 lg:px-1">
                                                <div class="overflow-hidden" id="table_bazar_ll">
                                                  <table class="min-w-full border text-center">
                                                    <thead class="border-b">
                                                      <tr>
                                                        <th scope="col" class="text-sm font-medium text-gray-900 px-2 py-1 border-r">
                                                          #
                                                        </th>
                                                        <th scope="col" class="text-sm font-medium text-gray-900 px-1 py-1 border-r">
                                                          Bazar
                                                        </th>
                                                        <th scope="col" class="text-sm font-medium text-gray-900 px-1 py-1 border-r">
                                                          Amount
                                                        </th>
                                                      </tr>
                                                    </thead>
                                                    <tbody>
  
                                                    <?php
                                                      $baz="SELECT * FROM bazar_list WHERE unique_id='$me' AND mess_id='$my_mess_id' AND MONTH(date_time)='$month' AND YEAR(date_time)='$year' ";
  
                                                      $baza=mysqli_query($con,$baz);
                                                      $bazrn=mysqli_num_rows($baza);
  
                                                      $i=1;
                                                      $totala=0;
  
                                                      if($bazrn<1){
                                                        $e = 'No record found!';
                                                      }else{
                                                        $e='1';
                                                        
                                                        while($b=mysqli_fetch_assoc($baza)){
                                                          $totala=$totala+$b['amount'];
                                                          ?>
                                                          <tr class="dropdown border-b text-center">
                                                          <td class="whitespace-nowrap text-sm font-medium px-2 text-gray-900 border-r" ><?=$i++?>#<i class="bi bi-checkk dropdown-toggle " id="dr<?=$b['id']?>" data-bs-toggle="dropdown" aria-expanded="false"></i>

  <ul class="dropdown-menu" aria-labelledby="dr<?=$b['id']?>">
    <li class="mb-1 edit_baz_bton" id="<?=$b['id']?>"><a class="dropdown-item" href="#">Edit</a></li>
    <li class="mb-1 dlt_baz_bton" id="<?=$b['id']?>"><a class="dropdown-item" href="#">Delete</a></li>
    <li class="mb-1 offon_baz_bton" id="<?=$b['id']?>"><a class="dropdown-item" href="#">Off/on</a></li>
  </ul>
</td>
                                                          <td class="text-sm text-center text-gray-900 font-light whitespace-nowrap border-r">
                                                         
        <input
        type="text"
        class="
          text-center
          form-control
          blockk
          w-full
          text-sm
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
        id="detai_<?=$b['id']?>"
        value="<?=$b['list_details']?>"
        placeholder="<?=$b['list_details']?>"
      />

                                                          </td>
                                                          <td class="text-sm text-center text-gray-900 font-light whitespace-nowrap border-r">                                                                                                             
        <input
        type="number"
        class="
          text-center
          form-control
          blockk
          w-full
          text-sm
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
        id="amoun_<?=$b['id']?>"
        value="<?=$b['amount']?>"
        placeholder="<?=$b['amount']?>"
      />
                                                          
                                                          </td>
                                                        </tr>
                                                        <?php
                                                        } 
                                                      }
  
                                                    ?>
  
                                                      <?php
                                                          if($totala<$meal_tk){
                                                            $give_get=$meal_tk-$totala;
                                                            $g='Given';
                                                          }else {
                                                            $give_get=$totala-$meal_tk;
                                                            $g='Get';
                                                          }
  
                                                      ?>
                                                      
                                                    </tbody>
                                                    <tfoot class="border-b">
                                                      <tr>
                                                        <!-- <td></td> -->
                                                        <td colspan="2" scope="col" class="text-sm text-start font-medium text-gray-900 px-1 py-1 border-r">:</td>
                                                        <td scope="col" class="text-sm font-medium text-gray-900 px-1 py-1 border-r"><?=number_format($totala,2)?>/=</td>
                                                      </tr>
                                                      <tr>
                                                        <td colspan="2" scope="col" class="text-sm text-start font-medium text-gray-900 px-1 py-1 border-r">Meals:</td>
                                                        <td scope="col" class="text-sm font-medium text-gray-900 px-1 py-1 border-r"><?=number_format((float)$m_meals,2)?>টি</td>
                                                      </tr>
                                                      <tr>
                                                        <td colspan="2" scope="col" class="text-sm text-start font-medium text-gray-900 px-1 py-1 border-r">Meal Rate:</td>
                                                        <td scope="col" class="text-sm font-medium text-gray-900 px-1 py-1 border-r"><?=number_format($meal_rate,2)?>/=</td>
                                                      </tr>
                                                      <tr>
                                                        <td colspan="2" scope="col" class="text-sm text-start font-medium text-gray-900 px-1 py-1 border-r">Meals Tk:</td>
                                                        <td scope="col" class="text-sm font-medium text-gray-900 px-1 py-1 border-r"><?=number_format($meal_tk,2)?>/=</td>
                                                      </tr>
                                                      <tr>
                                                        <td colspan="2" scope="col" class="text-sm text-start font-medium text-gray-900 px-1 py-1 border-r"><?=$g?>:</td>
                                                        <td scope="col" class="text-sm font-medium text-gray-900 px-1 py-1 border-r"><?=number_format($give_get,2)?>/=</td>
                                                      </tr>
                                                    </tfoot>
                                                  </table>
  
                                                </div>
                                              </div>
                                            </div>
                                          </div>
  
  
  
  </div>
    <?php
  }




if(isset($_POST['mess_fee_delete'])){
    $f_id=$_POST['f_id'];
    if($f_id!=''){

            $qry = "SELECT * FROM mess_fees WHERE mess_id='$my_mess_id' AND id='$f_id'";
            $rslt = mysqli_query($con,$qry);

            $nm=mysqli_num_rows($rslt);

            if($nm<1){
                echo "Mess Not Found! Please Add a mess Code";
            }else{

                $row = mysqli_fetch_array($rslt);

                if($unique_id==$row['admin_id']){


                    $con->query("DELETE FROM mess_fees WHERE id='$f_id' AND mess_id='$my_mess_id'");

                    echo 1;

                }else {
                    echo 2;
                }
                

            }

    
    }else{
        echo 2;
    }
}




?>
