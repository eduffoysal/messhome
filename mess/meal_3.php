<?php

include('../db.php');
session_start();

$unique_id=$_SESSION['user'];

$my_mess_id=$_SESSION['my_mess_id'];



if(isset($_POST['ind_bazarr'])){

  $me=$_POST['tthis_id'];
  
  $date=$_POST['ddate'];
  
  $datee = strtotime($date);
  
  $monthh = date('m', $datee);
  $yearr= date('Y', $datee);
  
  if($me==$unique_id){
    $hidden='';
    $bu='t_month_baz';
  }else{
    $bu='';
    $hidden='hidden';
  }
  
  
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
  
  
  ?>
                                                <table class="min-w-full border text-center">
                                                  <thead class="border-b">
                                                    <tr>
                                                      <th scope="col" class="text-sm font-medium text-gray-900 px-1 py-1 border-r">
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
                                                    $baz="SELECT * FROM bazar_list WHERE unique_id='$me' AND mess_id='$my_mess_id' AND MONTH(date_time)='$monthh' AND YEAR(date_time)='$yearr' ";
  
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
  
    <?php
  }


if(isset($_POST['ind_bazar'])){

$me=$_POST['this_id'];

$date=$_POST['date'];

$datee = strtotime($date);

$monthh = date('m', $datee);
$yearr= date('Y', $datee);

if($me==$unique_id){
  $hidden='';
  $bu='t_month_baz';
}else{
  $bu='';
  $hidden='hidden';
}


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


?>
                                              <table class="min-w-full border text-center">
                                                <thead class="border-b">
                                                  <tr>
                                                    <th scope="col" class="text-sm font-medium text-gray-900 px-1 py-1 border-r">
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
                                                  $baz="SELECT * FROM bazar_list WHERE unique_id='$me' AND mess_id='$my_mess_id' AND MONTH(date_time)='$monthh' AND YEAR(date_time)='$yearr' ";

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
                                                      <tr class="border-b text-center">
                                                      <td class="whitespace-nowrap text-sm font-medium text-gray-900 border-r"><?=$i++?></td>
                                                      <td class="text-sm text-gray-900 font-light whitespace-nowrap border-r">
                                                      <?=$b['list_details']?>
                                                      </td>
                                                      <td class="text-sm text-gray-900 font-light whitespace-nowrap border-r">
                                                      <?=$b['amount']?>
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
                                                    <td scope="col" class="text-sm font-medium text-gray-900 px-1 py-1 border-r"><?=number_format($m_meals,2)?>টি</td>
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

  <?php
}




if(isset($_POST['acc_calcu'])){


  $bap=$con->query("SELECT SUM(amount) AS amou FROM payment WHERE unique_id='$unique_id' AND mess_id='$my_mess_id' AND MONTH(date_m)='$month' AND YEAR(date_m)='$year'");
  $bfep=mysqli_fetch_assoc($bap);
  if($bfep['amou']==''){
    $p=0;

  }else{
    $p=$bfep['amou'];
  }



    $re="SELECT SUM(sum_meal) AS all_meals FROM my_meals WHERE mess_id='$my_mess_id' AND MONTH(date)='$month' AND YEAR(date)='$year' ";
    $rem="SELECT SUM(sum_meal) AS m_meals FROM my_meals WHERE mess_id='$my_mess_id' AND unique_id='$unique_id' AND MONTH(date)='$month' AND YEAR(date)='$year' ";

    $reb="SELECT SUM(amount) AS all_bazar FROM bazar_list WHERE mess_id='$my_mess_id' AND MONTH(date_time)='$month' AND YEAR(date_time)='$year' ";
    $rebm="SELECT SUM(amount) AS m_bazar FROM bazar_list WHERE mess_id='$my_mess_id' AND unique_id='$unique_id' AND MONTH(date_time)='$month' AND YEAR(date_time)='$year' ";

    $req=mysqli_query($con,$re);
    $remq=mysqli_query($con,$rem);
    $rebq=mysqli_query($con,$reb);
    $rebmq=mysqli_query($con,$rebm);

    $rer=mysqli_num_rows($req);
    $remr=mysqli_num_rows($remq);
    $rebr=mysqli_num_rows($rebq);
    $rebmr=mysqli_num_rows($rebmq);

    $rems=mysqli_fetch_assoc($remq); 
    $rebms=mysqli_fetch_assoc($rebmq); 


    if($rer<1){
      $all_meals=0;

    }else{
      $res=mysqli_fetch_assoc($req); 

      $all_meals=$res['all_meals'];

    }

    if($rems['m_meals']==''){
      $m_meals=0;
    }else{
      $m_meals=$rems['m_meals'];
    }

    if($rebr<1){
      $all_bazar=0;
    }else{
      $rebs=mysqli_fetch_assoc($rebq); 
      $all_bazar=$rebs['all_bazar'];
    }

    if($rebms['m_bazar']==''){
      $m_bazar=0;
    }else{
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

    $sumf="SELECT SUM(amount) AS total_f FROM others_fee WHERE mess_id='$my_mess_id' AND unique_id='$unique_id' AND MONTH(date)='$month' AND YEAR(date)='$year'";
    $sumfq=mysqli_query($con,$sumf);
    $fo=mysqli_num_rows($sumfq);

    if($fo>0){
      $sumr=mysqli_fetch_assoc($sumfq);
      $to_ot=$sumr['total_f'];
    }else{
      $to_ot=0;
    }
    $sumfm="SELECT SUM(amount) AS total_f FROM mess_fees WHERE mess_id='$my_mess_id'";
    $sumfqm=mysqli_query($con,$sumfm);

    $fom=mysqli_num_rows($sumfqm);

    if($fom>0){
      $sumrm=mysqli_fetch_assoc($sumfqm);
      $to_mo=$sumrm['total_f'];
    }else{
      $to_mo=0;
    }

$onno=$to_ot+$to_mo;






?>

                                        <table class="table table-warningg table-striped text-center rounded-lg border-rounded table-bordered">
                                          <thead class="bg-gray-50 border-b-2 text-center table-light border-gray-200">
                                          <tr>
                                            <th class="w-24 p-3 text-sm  font-semibold tracking-wide text-left">ধরণঃ</th>
                                            <th class="w-32 p-3 text-sm font-semibold tracking-wide text-left">টাকাঃ</th>
                                          </tr>
                                          </thead>
                                          <tbody class="divide-y table-infoe divide-gray-100">
                                          <tr class="bg-white" id="monthly_all_meal">
                                            <td class=" text-sm text-gray-700 table-success whitespace-nowrap" data-bs-toggle="modal" data-bs-target="#user_meal_modal">
                                              <a href="#" class="font-bold text-blue-500 hover:underline">#মোট মিলঃ</a>
                                            </td>

                                            <td class=" text-sm text-gray-700 whitespace-nowrap" data-bs-toggle="modal" data-bs-target="#user_meal_modal"><span
                                              class="p-1.5 text-xs font-medium uppercase tracking-wider text-green-800 bg-green-200 rounded-lg bg-opacity-50"><?=$m_meals?> <input type="hidden" class="" id="my_meal_num" value=""> </span></td>
                                          </tr>
                                          <tr class="bg-white">
                                            <td class=" text-sm text-gray-700 whitespace-nowrap">
                                              <a href="#" class="font-bold text-blue-500 hover:underline">#মিল রেইটঃ</a>
                                            </td>
                                            <td class=" text-sm text-gray-700 whitespace-nowrap"><span
                                              class="p-1.5 text-xs font-medium uppercase tracking-wider text-green-800 bg-yellow-500 rounded-lg bg-opacity-50"><?= number_format($meal_rate,2)?> <input type="hidden" class="" id="mess_meal_rate" value=""> </span></td>
                                          </tr>
                                          <tr class="bg-white border-warning">
                                            <td class=" text-sm text-gray-700 whitespace-nowrap">
                                              <a href="#" class="font-bold text-blue-500 hover:underline">#মিল টাকাঃ</a>
                                            </td>
                                            <td class=" text-sm text-gray-700 whitespace-nowrap"><span
                                              class="p-1.5 text-xs font-medium uppercase tracking-wider text-green-800 bg-green-200 rounded-lg bg-opacity-50"><?= number_format($meal_tk,2)?> <input type="hidden" class="" id="my_meals_tk" value="<?=$meal_tk?>"> </span></td>
                                          </tr>
                                          <tr class="bg-white">
                                            <td class=" text-sm text-gray-700 whitespace-nowrap">
                                              <button type="button" class="btn btn-info btn-sm focus:ouline-none border-rounded" name="button"><a href="#" class="font-bold text-blue-500 hover:underline">#অন্যন্যঃ</a></button>
                                            </td>
                                            <td class=" text-sm text-gray-700 whitespace-nowrap"><span
                                              class="p-1.5 text-xs font-medium uppercase tracking-wider text-green-800 bg-green-200 rounded-lg bg-opacity-50" id="my_other_html"><?=$onno?> </span> <input type="hidden" class="" id="my_others_tk" value="<?=$onno?>"></td>
                                          </tr>

                                          <tr class="bg-green border-danger">
                                            <td class=" text-sm text-gray-700 whitespace-nowrap">
                                              <a href="#" class="font-bold text-blue-500 hover:underline">মোট টাকাঃ</a>
                                            </td>
                                            <td style="" class=" text-sm table-success  whitespace-nowrap"><span
                                              class="p-1.5 text-xs font-medium uppercase tracking-wider text-danger text-rose-800 bg-rose-200 rounded-lg bg-opacity-50" id="all_my_g_html"> </span> <input type="hidden" class="" id="all_my_g_tk" value=""> </td>
                                          </tr>
                                          <tr class="bg-white">
                                            <td class=" text-sm text-gray-700 whitespace-nowrap">
                                              <a href="#" class="font-bold text-blue-500 hover:underline">#বাজার খরচঃ</a>
                                            </td>
                                            <td class=" text-sm text-gray-700 whitespace-nowrap"><span
                                              class="p-1.5 text-xs font-medium uppercase tracking-wider text-green-800 bg-green-200 rounded-lg bg-opacity-50"><?=$m_bazar?>  </span><input type="hidden" class="" id="my_bazar_tk" value="<?=$m_bazar?>"></td>
                                          </tr>
                                          <tr class="bg-white">
                                            <td class=" text-sm text-gray-700 whitespace-nowrap">
                                              <a href="#" class="font-bold text-blue-500 hover:underline">#পেইডঃ</a>
                                            </td>
                                            <td class=" text-sm text-gray-700 whitespace-nowrap"><span
                                              class="p-1.5 text-xs font-medium uppercase tracking-wider text-green-800 bg-green-200 rounded-lg bg-opacity-50" id="ex_tk_paind_html"><?=$p?> </span><input type="hidden" class="" id="my_paid_tk" value="<?=$p?>"></td>
                                          </tr>
                                          <tr class="bg-teal border-success">
                                            <td class=" text-sm text-gray-700 whitespace-nowrap">
                                              <a href="#" class="font-bold text-blue-500 hover:underline" id="get_give_show">দিবেন/পাবেনঃ</a>
                                            </td>
                                            <td style="" class=" text-sm bg-purple-200 whitespace-nowrap"><span
                                              class="p-1.5 text-xs font-medium uppercase tracking-wider text-danger text-rose-800 bg-pink-400 rounded-lg bg-opacity-50" id="tk_g_g_html">00 </span> <input type="hidden" class="" id="tk_g_g" value="0"></td>
                                          </tr>



                                          </tbody>
                                        </table>
<?php

}


if(isset($_POST['mess_f_ta'])){

    $m_f="SELECT * FROM mess_fees WHERE mess_id='$my_mess_id'";
    $m_q=mysqli_query($con,$m_f);
    $m_n=mysqli_num_rows($m_q);
$i=1;
    if($m_n>0){

      $sumf="SELECT SUM(amount) AS total_f FROM mess_fees WHERE mess_id='$my_mess_id'";
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
                                                      <tbody class="table-striped">
                                                      <?php
                                                        while($mes=mysqli_fetch_assoc($m_q)){
                                                          ?>
                                                          <tr>
                                                            <td class="border-1 f_delete_b text-danger" id="<?=$mes['id']?>"> <i class="bi bi-penn"></i> <?=$i++?><i class="fa fa-times"></i></td>
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
      echo "Mess not found!";
    }

}


?>                                        



