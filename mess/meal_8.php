<?php

include('../db.php');
session_start();

$unique_id=$_SESSION['user'];

$my_mess_id=$_SESSION['my_mess_id'];

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

if(isset($_POST['class_sections'])){


    if(isset($_POST['month_d'])){
        if($_POST['month_d']!=''){
          $datef=$_POST['month_d'];
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

    $select = "SELECT * FROM payment WHERE mess_id='$my_mess_id' AND MONTH(date_m)='$mon' AND YEAR(date_m)='$yea' ";
    $query = mysqli_query($con, $select);
    
    if(mysqli_num_rows($query) > 0){

?>
                  <div class="container border-x-2 border-t-rounded border-gray-300 shadow-lg ">
                    <div class="row text-dark text-bold text-center">
                      <div class="col-9">
                        <span>Details</span>
                      </div>
                      <div class="col-3">
                        <span>Amount</span>
                      </div>
                    </div>

                    <?php
                        while($paym=mysqli_fetch_array($query)){

                            $usert=$paym['unique_id'];
                            $userfi="SELECT * FROM users WHERE unique_id='$usert'";
                            $myq=mysqli_query($con,$userfi);
                            $myu=mysqli_fetch_assoc($myq);

                            if($paym['phone']==''){
                                $phone_us=$myu['phone'];
                            }else{
                                $phone_us=$paym['phone'];
                            }
                            ?>
<div class="row border-x-1 border-x-pink-300 border-2 shadow-lg rounded-lg bg-white-200 border-x-2 rounded-top border-y-gray-500 ">
                      <div class="col-12">

                        <div class="user_coverr ">
                          <div class="justify-center items-end" id="">
                            <span
                              class="rounded-full text-grayy-500 bg-red-200 font-semibold text-sm flex align-center cursor-pointer active:bg-gray-300 transition duration-300 ease w-max">
                              <img class="rounded-full w-9 h-9 max-w-none delete_payment" id="<?=$paym['id']?>" alt="A"
                                src="https://mdbootstrap.com/img/Photos/Avatars/avatar-6.jpg" />
                              <span class="flex items-center pl-3 py-2">
                                <?=$myu['user_name']?>
                              </span>
                              <code class="flex text-sm items-center px-1"><?=$paym['time']?></code>
                              <button class="bg-transparent hover focus:outline-none">
                                <i class="bi bi-check"></i>
                              </button>
                            </span>
                          
                            <div class="date_of_pay">
                              <span><code><?=$phone_us?></code>-<code><?=$paym['trx_id']?></code></span><span> ~<?=$paym['amount']?>/=</span>
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
        echo "Mess not found!";
        
    }

?>



<?php

}

?>