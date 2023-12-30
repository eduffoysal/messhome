<?php



include('../db.php');
session_start();

$unique_id=$_SESSION['user'];

$my_mess_id=$_SESSION['my_mess_id'];









if(isset($_POST['bazar_user'])){

  $me=$_POST['this_id'];

  if($me==$unique_id){
    $hidden='';
    $bu='t_month_baz';
    $dltb='yes';
  }else{
    $bu='';
    $dltb='no';
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

<div class="bazar_section" id="monthly_baz_cont">
    
<div class="flex items-center justify-center">
  <div class="inline-flex" role="group">
    <button
      type="button"
      class="
        this_month_list
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
      <?=date("M")?>
    </button>
    <button
      type="button"
      class="
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
        <?=$bu?>
        <?=$hidden?>
      "
      data-bs-toggle="modal"
      data-bs-target="#user_gen_modal"
    >
      AddBazar
    </button>
    <!-- <button
      type="button"
      class="
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
    >
      Monthly
    </button> -->
  </div>

</div>

    <div class="containerr px-1">
        <div class="input-group m-1">
        <input type="month" class="form-control text-base font-normal text-blue-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none" id="send_month_for_b" placeholder="Select a date" aria-label="Select a date" aria-describedby="button-addon2" >
        <button class="btn btn-outline-secondary send_month_b bg-blue-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out" type="button" id="<?=$me?>">Check</button>
        </div>
    </div>
    <div class="row">
                                                            <div class="col-9 text-start">
                                                              <code><?=$numr['user_name']?></code>
                                                            </div>
                                                            <div class="col-3 text-end">
                                                            <input type="button" class="btn btn-info btn-sm monthly_baz_contb" value="Print">
                                                            </div>
                                                          </div>


                                        <div class="flex flex-col ba_t_month_list">
                                          <div class="overflow-x-auto sm:-mx-1 lg:-mx-2">
                                            <div class="py-2 inline-block min-w-full sm:px-1 lg:px-1">
                                              <div class="overflow-hidden" id="table_bazar_l">
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
                                                        <tr class="border-b text-center">
                                                        <td class="whitespace-nowrap text-sm font-medium text-gray-900 border-r"><?=$i++?><i class="fa fa-times dlt_baz_bton_<?=$dltb?>" id="<?=$b['id']?>"></i></td>
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




if(isset($_POST['my_daily_meal_dis'])){

            
    $qryr = "SELECT * FROM my_meals WHERE mess_id='$my_mess_id' AND unique_id='$unique_id' AND date='$today' ";
    $rsltr = mysqli_query($con,$qryr);
    $ron = mysqli_fetch_array($rsltr);

    $nmm=mysqli_num_rows($rsltr);

    if($nmm<1){

        $mo='00';
        $la='00';
        $di='00';

    }else{
        $mo=$ron['morning'];
        $la=$ron['launce'];
        $di=$ron['dinner'];
    }

    $messa="SELECT * FROM mess_main WHERE mess_id='$my_mess_id'";
    $messad=mysqli_query($con,$messa);
    $myn=mysqli_num_rows($messad);

    if($myn==1){
        $adm=mysqli_fetch_assoc($messad);
        $admin_name=$adm['mess_admin_id'];

        $messaa="SELECT * FROM users WHERE unique_id='$admin_name' OR user_id='$admin_name' ";
        $messadd=mysqli_query($con,$messaa);
        $mynn=mysqli_num_rows($messadd);
        
        $a=mysqli_fetch_assoc($messadd);

        $aName=$a['user_name'];

    }else{
        $aName="Please add a mess code.";
    }


    ?>

    <div class="card border-x-4 shadow-inner rounded-lg border-pink-300">
    <div style="background-color:" class="card-header  bg-pink-100  border-x-2 rounded-top border-pink-500 ">

      <div class="text-rose-600  d-inline meal_disp_bttn"><?php echo date('l, M jS'); ?></div>
      <div class="d-inline"></div>
      <button type="button" class="btn btn-primary all_mess_meals meal_disp_bttn btn-sm float-end border-rounded rounded-lg hover:bg-teal-300" name="button" data-bs-toggle="modal" data-bs-target="#add_new_meal_modal"><i class="bi bi-pencil-square d-inline "></i></button>
    </div>

    <div class="card-body py-1 border-x-4 shadow-inner rounded-lg border-pink-300">
    <div style="padding-left:30px;" class="flex items-center justify-between bg-white rounded shadow-sm position-relative">
      <div style="margin-left: -32px" class="category category_color1 meal_disp_bttn"></div>
        <div>
          <div class="text-sm text-gray-400 meal_disp_bttn">সকালের খাবারঃ</div>
          <div class="flex items-center pt-1 meal_disp_bttn">
            <div class="text-3xl font-medium ml-5 text-gray-600 "><?=$mo?></div>
          </div>
        </div>
        <div class="text-pink-500 daily_meal_r cursor-pointer daily_morn_meal" id="morning_meal" data-bs-toggle="modal" data-bs-target="#up_today_meal_modal">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd"
              d="M10 18a8 8 0 100-16 8 8 0 000 16zm.707-10.293a1 1 0 00-1.414-1.414l-3 3a1 1 0 000 1.414l3 3a1 1 0 001.414-1.414L9.414 11H13a1 1 0 100-2H9.414l1.293-1.293z"
              clip-rule="evenodd" />
          </svg>
        </div>
      </div>

      <div style="padding-left:30px;" class="flex items-center justify-between bg-white rounded shadow-sm position-relative">
      <div style="margin-left: -32px" class="category category_color2 meal_disp_bttn"></div>
        <div>
          <div class="text-sm text-gray-400 meal_disp_bttn">দুপুরের খাবারঃ</div>
          <div class="flex items-center pt-1 meal_disp_bttn">
            <div class="text-3xl font-medium ml-5 text-gray-600 "><?=$la?></div>
          </div>
        </div>
        <div class="text-cyan-500 daily_meal_r cursor-pointer daily_laun_meal" id="launce_meal" data-bs-toggle="modal" data-bs-target="#up_today_meal_modal">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd"
              d="M10 18a8 8 0 100-16 8 8 0 000 16zm.707-10.293a1 1 0 00-1.414-1.414l-3 3a1 1 0 000 1.414l3 3a1 1 0 001.414-1.414L9.414 11H13a1 1 0 100-2H9.414l1.293-1.293z"
              clip-rule="evenodd" />
          </svg>
        </div>
      </div>

      <div style="padding-left:30px;" class="flex items-center justify-between bg-white rounded shadow-sm position-relative">
      <div style="margin-left: -32px" class="category category_color3 meal_disp_bttn"></div>
        <div>
          <div class="text-sm text-gray-400 meal_disp_bttn">রাতের খারবারঃ</div>
          <div class="flex items-center pt-1 meal_disp_bttn">
            <div class="text-3xl font-medium ml-5 text-gray-600 "><?=$di?></div>
          </div>
        </div>
        <div class="text-teal-500 daily_meal_r cursor-pointer daily_dinn_meal" id="dinner_meal" data-bs-toggle="modal" data-bs-target="#up_today_meal_modal">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd"
              d="M10 18a8 8 0 100-16 8 8 0 000 16zm.707-10.293a1 1 0 00-1.414-1.414l-3 3a1 1 0 000 1.414l3 3a1 1 0 001.414-1.414L9.414 11H13a1 1 0 100-2H9.414l1.293-1.293z"
              clip-rule="evenodd" />
          </svg>
        </div>
      </div>
    </div>
    <div class="cord-footer bg-lime-200 text-cyan-600 text-center meal_disp_bttn" data-bs-toggle="modal" data-bs-target="#user_b_modal">
      <span class="text-sm">বাজারঃ <?=$aName?> </span>
    </div>

  </div>

<?php
}



if(isset($_POST['one_mess_meals'])){


    $qrym = "SELECT * FROM my_meals WHERE mess_id='$my_mess_id' AND date='$today' ";
    $rsltm = mysqli_query($con,$qrym);
    
    $i='1';
    $nmn=mysqli_num_rows($rsltm);

    if($nmn<1){
        echo "<td colspan='5'>NO Record Found! Or You are not added by any mess!</td>";
    }else{

        while($rom = mysqli_fetch_array($rsltm)){

                $member=$rom['unique_id'];
                $mems="SELECT * FROM users WHERE unique_id='$member' OR user_id='$member'";
                $mem_q=mysqli_query($con,$mems);
                $mer=mysqli_fetch_assoc($mem_q);

                $name=$mer['user_name'];


            ?>

            <tr class="bg-white">
                <td class="p-3 text-sm text-gray-700 whitespace-nowrap">
                  <a href="#" class="font-bold text-blue-500 hover:underline"><?=$i++?>#<?=$name?></a>
                </td>
                <td class="p-3 text-sm text-gray-700 whitespace-nowrap">
                <span
                  class="p-1.5 text-xs font-medium uppercase tracking-wider text-green-800 bg-green-200 rounded-lg bg-opacity-50"><?=$rom['morning']?></span>
                </td>
                <td class="p-3 text-sm text-gray-700 whitespace-nowrap">
                <span
                  class="p-1.5 text-xs font-medium uppercase tracking-wider text-yellow-800 bg-yellow-200 rounded-lg bg-opacity-50"><?=$rom['launce']?></span>
                </td>
                <td class="p-3 text-sm text-gray-700 whitespace-nowrap">
                <span
                  class="p-1.5 text-xs font-medium uppercase tracking-wider text-rose-800 bg-rose-200 rounded-lg bg-opacity-50"><?=$rom['dinner']?></span>
                </td>
                <td class="p-3 text-sm text-gray-700 whitespace-nowrap"><?=$rom['sum_meal']?></td>
            </tr>

            <?php

        }

    }



}

if(isset($_POST['two_mess_meals'])){


    $qrym = "SELECT * FROM my_meals WHERE mess_id='$my_mess_id' AND date='$today' ";
    $rsltm = mysqli_query($con,$qrym);
    

    $nmn=mysqli_num_rows($rsltm);

    if($nmn<1){
        echo "NO Record Found! Or You are not added by any mess!";
    }else{
        while($romn = mysqli_fetch_array($rsltm)){
            $member=$romn['unique_id'];
            $mems="SELECT * FROM users WHERE unique_id='$member' OR user_id='$member'";
            $mem_q=mysqli_query($con,$mems);
            $mer=mysqli_fetch_assoc($mem_q);

            $name=$mer['user_name'];

            ?>

            <div class="bg-white space-y-3 p-2 rounded-lg shadow">
              <div class="flex  space-x-2 text-sm">
                <div>
                  <a href="#" class="text-blue-500 font-bold hover:underline">#<?=$name?></a>
                </div>
                <div class="text-gray-500 text-sm  float-end"><?=$romn['date']?></div>

              </div>
              <div class="text-sm text-gray-700">
                <div class="mb-2">
                  <span
                    class="p-1.5 text-xs font-medium uppercase tracking-wider text-green-800 bg-green-200 rounded-lg bg-opacity-50">BreakFast : </span>
                    <span class="text-green-800 bg-green-200 rounded-lg"><?=$romn['morning']?></span>
                </div>
                <div class="mb-2">
                  <span
                    class="p-1.5 text-xs font-medium uppercase tracking-wider text-yellow-800 bg-yellow-200 rounded-lg bg-opacity-50">Launch ..... : </span>
                    <span class="text-green-800  bg-yellow-200 rounded-lg"><?=$romn['launce']?></span>
                </div>
                <div>
                  <span
                    class="p-1.5 text-xs font-medium uppercase tracking-wider text-gray-800 bg-gray-200 rounded-lg bg-opacity-50">Dinner ...... : </span>
                    <span class="text-green-800 bg-gray-200 rounded-lg"><?=$romn['dinner']?></span>
                </div>
              </div>
              <div class="text-sm font-medium text-black">
                Today's Meal :  <?=$romn['sum_meal']?>
              </div>
            </div>

            <?php

        }
    }

}


if(isset($_POST['all_meals_di'])){

    $me="SELECT * FROM mess_main WHERE mess_id='$my_mess_id'";

    $mee=mysqli_query($con,$me);

    $mrn=mysqli_num_rows($mee);

    if($mrn<1){

        ?>
<div class="col-4 border-4 m-auto  rounded-lg border-teal-200">

<div style="margin-left:-15px;margin-right: -15px" class="bg-teal-200">BreakFast: </div>
<div class="m-auto">NaN</div>

</div>
<div class="col-4 border-4 m-auto  rounded-lg border-rose-200">

<div style="margin-left:-15px;margin-right: -15px" class="bg-rose-200">Launch: </div>
<div class="m-auto">NaN</div>

</div>
<div class="col-4 border-4 m-auto  rounded-lg border-cyan-300">

<div style="margin-left:-15px;margin-right: -15px" class="bg-cyan-300">Dinner: </div>
<div class="m-auto">NaN</div>

</div>
    <?php

    }else{

        $mess="SELECT SUM(morning) As sokal, SUM(launce) As dupur, SUM(dinner) As rat FROM my_meals WHERE mess_id='$my_mess_id' AND date='$today'";
        $mess_q=mysqli_query($con,$mess);
        $mes=mysqli_fetch_array($mess_q);

        ?>
        <div class="col-4 border-4 m-auto  rounded-lg border-teal-200">
        
        <div style="margin-left:-15px;margin-right: -15px" class="bg-teal-200">BreakFast: </div>
        <div class="m-auto"><?=$mes['sokal']?></div>
        
        </div>
        <div class="col-4 border-4 m-auto  rounded-lg border-rose-200">
        
        <div style="margin-left:-15px;margin-right: -15px" class="bg-rose-200">Launch: </div>
        <div class="m-auto"><?=$mes['dupur']?></div>
        
        </div>
        <div class="col-4 border-4 m-auto  rounded-lg border-cyan-300">
        
        <div style="margin-left:-15px;margin-right: -15px" class="bg-cyan-300">Dinner: </div>
        <div class="m-auto"><?=$mes['rat']?></div>
        
        </div>
        <?php


    }


}



if(isset($_POST['future_meals_d'])){

            $fu="SELECT * FROM my_meals WHERE unique_id='$unique_id' AND mess_id='$my_mess_id' AND DATE(date)>='$today' ";
            $fuu=mysqli_query($con,$fu);
            $fn=mysqli_num_rows($fuu);

            if($fn<1){
                echo "No record found!";
            }else{

                while($f=mysqli_fetch_assoc($fuu)){

                    $da=$f['date'];
                    $date= date("jS M, Y", strtotime($da));


    ?>
                    <div class="accordian-meal border-blue-100 rounded-lg border-2 shadow-lg bg-blue-400">
                    <form action="" role="form" id="up_meal_f_<?=$f['id']?>">
                      <div class="row">
                      <div class="col-8 text-center">
                      <button
                          type="button"
                          data-mdb-ripple="true"
                          data-mdb-ripple-color="light"
                          class="inline-block px-6 py-2.5 bg-blue-400 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out"
                        ><?=$date?> <code> ~ <?=$f['sum_meal']?> </code></button>
                      </div>
                      <div class="col-4 text-center">
                      <div class="flex space-x-2 justify-center">
                        <button
                          type="button"
                          data-mdb-ripple="true"
                          data-mdb-ripple-color="light"
                          class="inline-block px-6 py-2.5 bg-blue-400 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out meal_update_b" id="<?=$f['id']?>"
                        >:</button>
                        <button
                          type="button"
                          data-mdb-ripple="true"
                          data-mdb-ripple-color="light"
                          class="inline-block px-6 py-2.5 bg-blue-400 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out meal_del" id="<?=$f['id']?>"
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
                                      id="morning_<?=$f['id']?>"
                                      placeholder="Breakfast"
                                      value="<?=$f['morning']?>"
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
                                id="launch_<?=$f['id']?>"
                                placeholder="Launch"
                                value="<?=$f['launce']?>"
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
                                id="dinner_<?=$f['id']?>"
                                placeholder="Dinner"
                                value="<?=$f['dinner']?>"
                              /></div>

                              <input type="text" name="upmeal_h" id="upmeal_heal_<?=$f['id']?>" hidden>
    
                        </div>
                      </div>                          
                      </form>
                  </div>
    <?php
    

                }



            }


}


if(isset($_POST['meal_of_on_up'])){

  ?>

        <!-- <select class="form-select form-select-lg mb-3
        meal_o_f_b
          appearance-none
          block
          w-full
          px-4
          py-2
          text-xl
          font-normal
          text-gray-700
          bg-white bg-clip-padding bg-no-repeat
          border border-solid border-gray-300
          rounded
          transition
          ease-in-out
          m-0
          focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none" aria-label=".form-select-lg example">
            <option selected>Meal Switch ~ </option>
            <option class="meal_o_f" id="2" value="2">Breakfast OFF</option>
            <option class="meal_o_f" id="3" value="3">Launch OFF</option>
            <option class="meal_o_f" id="4" value="4">Dinner OFF</option>
            <option class="meal_o_f" id="1" value="1">ALL ON</option>
        </select>  -->


          <div class="wrapper_user_per">
            <input type="radio" name="select_p" value="on" id="optionu-1" checked hidden>
            <input type="radio" name="select_p" value="off" id="optionu-2" hidden>
            <label for="optionu-1" class="optionu perm_button optionu-1" id="1">
              <div class="dotu"></div>
              <span>ON</span>
            </label>
            <label for="optionu-2" class="optionu perm_button optionu-2" id="0">
              <div class="dotu"></div>
              <span>OFF</span>
            </label>
          </div>


          <div class="card_m">
              <div class="title_m">মিল পরিবর্তন সুইচ করুন।</div>
            <div class="content_m">
              <input type="radio" name="rd" id="one_m">
              <input type="radio" name="rd" id="two_m">
              <input type="radio" name="rd" id="three_m">
              <input type="radio" name="rd" id="four_m">

              <label for="one_m" class="box_m first_m" id="2">
                <div class="plan_m">
                <span class="circle_m"></span>
                <span class="yearly_m">Breakfast OFF</span>
              </div>
                  <span class="price_m">02</span>
              </label>

              <label for="two_m" class="box_m second_m" id="3">
                <div class="plan_m">
                <span class="circle_m"></span>
                <span class="yearly_m">Launch OFF</span>
              </div>
                  <span class="price_m">03</span>
              </label>

              <label for="three_m" class="box_m third_m" id="4">
                <div class="plan_m">
                <span class="circle_m"></span>
                  <span class="yearly_m">Dinner OFF</span>
                </div>
                  <span class="price_m">04</span>
              </label>

              <label for="four_m" class="box_m fourth_m" id="1">
                <div class="plan_m">
                <span class="circle_m"></span>
                <span class="yearly_m">ALL ON</span>
              </div>
                  <span class="price_m">01</span>
              </label>
            </div>
          </div>        
  


  <?php

}


?>


