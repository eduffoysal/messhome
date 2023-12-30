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
    $hidden='hidden';
    $dltb='no';
  }




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

<div class="bazar_section" id="monthly_baz_cont3">
    
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
                                                            <div class="col-6 text-start">
                                                              <code>User Name</code>
                                                            </div>
                                                            <div class="col-6 text-end">
                                                            <input type="button" class="btn btn-info btn-sm monthly_baz_contb3" value="Print">
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

if(isset($_POST['user_meal_sec'])){

?>
  <div class="w-full mt-1 bg-white rounded-lg border shadow-md dark:bg-gray-800 dark:border-gray-700">
  <div class="sm:hiddenn">
      <label for="sel_u_for_con" class="sr-only">Select tab</label>
      <select id="sel_u_for_con" name="sel_u_for_con_na" class="sel_u_for_con_cl bg-gray-50 border-0 border-b border-gray-200 text-gray-900 sm:text-sm rounded-t-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" data-tabs-toggle="#user_all_content" role="tablist">
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
  
  <div id="user_all_content" class="user_all_content p-1 text-justify border-t border-gray-200 dark:border-gray-600">

      
  </div>
</div>

<?php
}


?>