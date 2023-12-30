<?php

include('../db.php');
session_start();

$unique_id=$_SESSION['user'];

$my_mess_id=$_SESSION['my_mess_id'];


if(isset($_POST['user_f_list'])){


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


$total_o=0;
$total_m=0;



  $sumfm="SELECT SUM(amount) AS total_f FROM mess_fees WHERE mess_id='$my_mess_id'";
  $sumfqm=mysqli_query($con,$sumfm);
  $sumrm=mysqli_fetch_assoc($sumfqm);

  $total_m=$sumrm['total_f'];



$re="SELECT SUM(sum_meal) AS all_meals FROM my_meals WHERE mess_id='$my_mess_id' AND MONTH(date)='$mon' AND YEAR(date)='$yea' ";
$reb="SELECT SUM(amount) AS all_bazar FROM bazar_list WHERE mess_id='$my_mess_id' AND MONTH(date_time)='$mon' AND YEAR(date_time)='$yea' ";
$req=mysqli_query($con,$re);
$rebq=mysqli_query($con,$reb);
$rer=mysqli_num_rows($req);
$rebr=mysqli_num_rows($rebq);
if($rer<1){
    $all_meals=0;
  
  }else{
    $res=mysqli_fetch_assoc($req); 
  
    $all_meals=$res['all_meals'];
  
  }
if($rebr<1){
    $all_bazar=0;
  }else{
    $rebs=mysqli_fetch_assoc($rebq); 
    $all_bazar=$rebs['all_bazar'];
  }

  if($all_bazar==0){

    $meal_rate=0;
  
  }elseif($all_meals==0){
  
    $meal_rate=$all_bazar/1;
  
  }else {
    $meal_rate=$all_bazar/$all_meals;
  }  




// $date=$today;

// $datee = strtotime($date);

// $monthh = date('m', $datee);
// $yearr= date('Y', $datee);


    $m_f="SELECT * FROM users WHERE mess_id='$my_mess_id'";
    $m_q=mysqli_query($con,$m_f);
    $m_n=mysqli_num_rows($m_q);
$i=1;
    if($m_n>0){

      $sumf="SELECT SUM(amount) AS total_f FROM mess_fees WHERE mess_id='$my_mess_id'";
      $sumfq=mysqli_query($con,$sumf);
      $sumr=mysqli_fetch_assoc($sumfq);

      ?>
<div class="container-fluid" id="monthly_all_cont">

    <div class="form-controll">
        <div class="input-group mb-1">
        <input type="month" class="form-control" id="monthly_f_allu_date" placeholder="Select a date" aria-label="Select a date" aria-describedby="<?=$user?>">
        <button class="btn btn-outline-secondary monthly_all_u_f_b" type="button" id="monthly_all_u_f_b" >Check</button>
        </div>
    </div>
    <div class="row">
                                                            <div class="col-6 text-start">
                                                              
                                                            </div>
                                                            <div class="col-6 text-end">
                                                            <input type="button" class="btn btn-info btn-sm monthly_all_contb" value="Print">
                                                            </div>
                                                          </div>

                                                      <?php
                                                        while($mes=mysqli_fetch_assoc($m_q)){

                                                            $das=$mes['bazar_start'];
                                                            $dae=$mes['bazar_end'];
                                                            $dates= date("jS", strtotime($das));
                                                            $datee= date("jS", strtotime($dae));

                                                            $userr = $mes['unique_id'];
$me= $mes['unique_id'];


      $sumf="SELECT SUM(amount) AS total_f FROM others_fee WHERE mess_id='$my_mess_id' AND unique_id='$userr' AND MONTH(date)='$mon' AND YEAR(date)='$yea'";
      $sumfq=mysqli_query($con,$sumf);
      $sumr=mysqli_fetch_assoc($sumfq);

      $total_o=$sumr['total_f'];

$total_fee=$total_o+$total_m;


$rem="SELECT SUM(sum_meal) AS m_meals FROM my_meals WHERE mess_id='$my_mess_id' AND unique_id='$userr' AND MONTH(date)='$mon' AND YEAR(date)='$yea' ";

$remq=mysqli_query($con,$rem);
$remr=mysqli_num_rows($remq);
$rems=mysqli_fetch_assoc($remq); 

if($rems['m_meals']==''){
    $m_meals=0;
  }else{

    $m_meals=$rems['m_meals'];
  }

$meal_tk=$meal_rate*$m_meals;

$total=$meal_tk+$total_fee;

$ba="SELECT SUM(amount) AS m_bazarr FROM bazar_list WHERE mess_id='$my_mess_id' AND unique_id='$userr' AND MONTH(date_time)='$mon' AND YEAR(date_time)='$yea' ";

$rebmq=mysqli_query($con,$ba);
$bfe=mysqli_fetch_assoc($rebmq);
if($bfe['m_bazarr']==''){
  $bazar=0;
}else{
  $bazar=$bfe['m_bazarr'];
}

$bap=$con->query("SELECT SUM(amount) AS amou FROM payment WHERE unique_id='$userr' AND mess_id='$my_mess_id' AND MONTH(date_m)='$mon' AND YEAR(date_m)='$yea'");
$bfep=mysqli_fetch_assoc($bap);
if($bfep['amou']==''){
  $p=0;

}else{
  $p=$bfep['amou'];
}

$pay=$bazar+$p;
$bal=$total-$pay;
if($bal==1){
  $color='danger';
  $adof='addtofee';
}else if($bal>1){
  $color='danger';
  $adof='addtofee';
}else{
  $color='success';
  $adof='paidnextmon';
}
                                                          ?>

                                              <div class="row mb-1 shadow-lg rounded border-x-2 border-rounded border-pink-500">
                                                <div class="col-md-2 border-1 cursor-pointer in_f_di_b" id="<?=$mes['unique_id']?>"><button type="button" class="inline-block px-1 border-2 border-blue-400 text-blue-400 font-medium text-xs leading-tight uppercase  hover:bg-black hover:bg-opacity-5 focus:outline-none focus:ring-0 transition duration-150 ease-in-out"><?=$i++?>#<?=$mes['user_name']?></button></div>
                                                <div class="col-md-2 text-center border-1" id="<?=$mes['unique_id']?>">M:<?=$m_meals?>/R:<?=$meal_rate?></div>
                                                <div class="col-md-2 text-center border-1 cursor-pointerr" id="<?=$mes['unique_id']?>">TK:<?=$meal_tk?>/<?=$mes['phone']?></div>
                                                <div class="col-md-2 user_t_f_b border-1 cursor-pointer" id="<?=$mes['unique_id']?>">Total : <?=number_format($total,2)?></div>
                                                <div class="col-md-2 border-1 cursor-pointer" id="<?=$mes['unique_id']?>">Paid : <?=$pay?>B/<?=$p?>P</div>
                                                <div class="col-md-2 border-1 cursor-pointer <?=$adof?> bg-<?=$color?>" id="<?=$mes['unique_id']?>">Balance : <?=number_format($bal,2)?> <input type="hidden" name="" value="<?=number_format($bal,2)?>" id="ftoa_<?=$mes['unique_id']?>"> </div>
                                              </div>
                                              
                                                          <?php
                                                        }
                                                      ?>

</div>
      
      <?php
      

    }else{
      echo "Mess not found!";
    }

}



if(isset($_POST['feee_code_pass'])){

    $user=$_POST['this_id'];

    // $date=$_POST['date'];
$date=$today;

$datee = strtotime($date);

$monthh = date('m', $datee);
$yearr= date('Y', $datee);

?>

<div class="feee_setup_dis">



<div class="rounded-lg shadow-lg bg-white">
  <form role="form" id="fee_ind_a_form">

    <div class="form-control">

    <h5 class="text-center" >Add a Mess fee</h5>
  <div>
  <div class="form-floating">
      <input type="text" class="form-control
      block
      w-full
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
      focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none" name="fee_ind_a_t" id="fee_ind_a_t" placeholder="Fee Type">
      <label for="fee_ind_a_t" class="text-gray-700">Fee Type</label>
    </div>
  </div>

  <div>
  <div class="form-floating">
      <input type="text" class="form-control
      block
      w-full
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
      focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none" name="fee_ind_a_a" id="fee_ind_a_a" placeholder="Amount">
      <label for="fee_ind_a_a" class="text-gray-700">Amount</label>
    </div>
  </div>

</div>

    <button type="button" class="
      fee_ind_a_btn
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
      ease-in-out" name="fee_ind_a_btn" id="<?=$user?>">Add Fee</button>
      <input class="form-control" placeholder="" name="fee_ind_a" id="fee_ind_a" value="<?=$user?>" type="hidden">
  </form>

    <div id="myalert_mmfeee" style="display:none;">
    	<div class="container col-md-offset-4">
    		<div class="alert alert-info">
    			<center><span id="alerttext_mmfeee"></span></center>
    		</div>
   	 	</div>
    </div>

</div>


                                            <div class="table-responsive">

<?php

$m_f="SELECT * FROM others_fee WHERE mess_id='$my_mess_id' AND unique_id='$user' AND MONTH(date)='$monthh' AND YEAR(date)='$yearr'";
$m_q=mysqli_query($con,$m_f);
$m_n=mysqli_num_rows($m_q);
$i=1;
if($m_n>0){

  $sumf="SELECT SUM(amount) AS total_f FROM others_fee WHERE mess_id='$my_mess_id' AND unique_id='$user'";
  $sumfq=mysqli_query($con,$sumf);
  $sumr=mysqli_fetch_assoc($sumfq);
  ?>
                                            <table class="table table-responsive text-center m-auto table-light table-hover table-striped table-borderd border-dark">
                                                <thead class="table-primary">
                                                    <tr>
                                                    <th class="border-1">#</th>
                                                    <th class="border-1">FEE TYPE</th>
                                                    <th class="border-1">AMOUNT</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="table-striped indivisual_fee_user" id="indivisual_fee_user">
  <?php
                                                    while($mes=mysqli_fetch_assoc($m_q)){
                                                      ?>
                                                      <tr>
                                                        <td class="border-1 fi_delete_b text-danger" id="<?=$mes['id']?>"> <i class="bi bi-pen"></i> <?=$i++?></td>
                                                        <td class="border-1"><?=$mes['fee_type']?></td>
                                                        <td class="border-1"><?=$mes['amount']?></td>
                                                      </tr>
                                                      <?php
                                                    }
                                                    ?>
                                                </tbody>    

                                                <tfoot class="table-dark">
                                                    <tr>
                                                        <td colspan="2" class="border-1">Total : </td>
                                                        <td class="border-1"><?=$sumr['total_f']?></td>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                                    <?php

}else{
  echo "Fees not found!";
}
?>
                                            </div>


                      </div>

<?php
}


if(isset($_POST['user_all_fee_t'])){



    $user=$_POST['this_id'];
    $total_o=0;
    $total_m=0;


    $me=$_POST['this_id'];

    if(isset($_POST['month_d'])){
        $date=$_POST['month_d'];
    }else{
        $date=$today;
    }

// $date=$_POST['date'];


$datee = strtotime($date);

$monthh = date('m', $datee);
$yearr= date('Y', $datee);


    ?>

    <div class="container form-control">
        <div class="input-group mb-1">
        <input type="month" class="form-control" id="monthly_fee_s_date" placeholder="Select a date" aria-label="Select a date" aria-describedby="<?=$user?>">
        <button class="btn btn-outline-secondary monthly_fee_s_b" type="button" id="<?=$user?>" >Check</button>
        </div>
    </div>

    <table class="table table-responsive text-center m-auto table-light table-hover table-striped table-borderd border-dark">
                                                    <thead class="table-primary">
                                                        <tr>
                                                        <th class="border-1">#</th>
                                                        <th class="border-1">FEE TYPE</th>
                                                        <th class="border-1">AMOUNT</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="table-striped">
                                                    <?php

    $m_f="SELECT * FROM others_fee WHERE mess_id='$my_mess_id' AND unique_id='$user' AND MONTH(date)='$monthh' AND YEAR(date)='$yearr'";
    $m_q=mysqli_query($con,$m_f);
    $m_n=mysqli_num_rows($m_q);
    $i=1;
    if($m_n>0){
    
      $sumf="SELECT SUM(amount) AS total_f FROM others_fee WHERE mess_id='$my_mess_id' AND unique_id='$user' AND MONTH(date)='$monthh' AND YEAR(date)='$yearr'";
      $sumfq=mysqli_query($con,$sumf);
      $sumr=mysqli_fetch_assoc($sumfq);

      $total_o=$sumr['total_f'];

                                                        while($mes=mysqli_fetch_assoc($m_q)){
                                                          ?>
                                                          <tr>
                                                            <td class="border-1 f_delete_b text-danger" id="<?=$mes['id']?>"> <i class="bi bi-pen"></i> <?=$i++?></td>
                                                            <td class="border-1"><?=$mes['fee_type']?></td>
                                                            <td class="border-1"><?=$mes['amount']?></td>
                                                          </tr>
                                                          <?php
                                                        }


    }else{
      echo "<td colspan='3'>Others fee not found!</td>";
    }



    $m_fm="SELECT * FROM mess_fees WHERE mess_id='$my_mess_id' ";
    $m_qm=mysqli_query($con,$m_fm);
    $m_nm=mysqli_num_rows($m_qm);

    if($m_nm>0){

      $sumfm="SELECT SUM(amount) AS total_f FROM mess_fees WHERE mess_id='$my_mess_id'";
      $sumfqm=mysqli_query($con,$sumfm);
      $sumrm=mysqli_fetch_assoc($sumfqm);

      $total_m=$sumrm['total_f'];


                                                        while($mesm=mysqli_fetch_assoc($m_qm)){
                                                          ?>
                                                          <tr>
                                                            <td class="border-1 f_delete_b text-danger" id="<?=$mesm['id']?>"> <i class="bi bi-pen"></i> <?=$i++?></td>
                                                            <td class="border-1"><?=$mesm['fee_type']?></td>
                                                            <td class="border-1"><?=$mesm['amount']?></td>
                                                          </tr>
                                                          <?php
                                                        }

    }else{
        echo "<td colspan='3'>Mess fee not found!</td>";
    }   



$total_fee=$total_o+$total_m;


$re="SELECT SUM(sum_meal) AS all_meals FROM my_meals WHERE mess_id='$my_mess_id' AND MONTH(date)='$monthh' AND YEAR(date)='$yearr' ";
$rem="SELECT SUM(sum_meal) AS m_meals FROM my_meals WHERE mess_id='$my_mess_id' AND unique_id='$me' AND MONTH(date)='$monthh' AND YEAR(date)='$yearr' ";

$reb="SELECT SUM(amount) AS all_bazar FROM bazar_list WHERE mess_id='$my_mess_id' AND MONTH(date_time)='$monthh' AND YEAR(date_time)='$yearr' ";
$rebm="SELECT SUM(amount) AS m_bazar FROM bazar_list WHERE mess_id='$my_mess_id' AND unique_id='$me' AND MONTH(date_time)='$monthh' AND YEAR(date_time)='$yearr' ";

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


$total=$meal_tk+$total_fee;
    ?>

    </tbody>    

    <tfoot class="table-dark">
        <tr>
            <td colspan="2" class="border-1">Total : </td>
            <td class="border-1"><?=$total_fee?>/=</td>
        </tr>
        <tr>
            <td colspan="2" class="border-1">Meal : <?=number_format((float)$m_meals,2)?>টি, <?=number_format($meal_rate,2)?>/=</td>
            <td class="border-1"><?=number_format($meal_tk,2)?>/=</td>
        </tr>
        <tr>
            <td colspan="2" class="border-1">Sub Total : </td>
            <td class="border-1"><?=number_format($total,2)?>/=</td>
        </tr>
    </tfoot>
</table>

<?php

}


?>



