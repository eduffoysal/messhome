<?php

include('../db.php');
session_start();

$unique_id=$_SESSION['user'];

$my_mess_id=$_SESSION['my_mess_id'];



if(isset($_POST['sel_u_for_m_b'])){
$idUser=$_POST['idUser'];

  ?>
      
<div class="container-fluidd">

<div class="flex items-center justify-center">
<div class="inline-flex" role="group">
  <button
    type="button"
    class="
      meal_sec_btn
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
    id="<?=$idUser?>"
  >
    Meal
  </button>
  <button
    type="button"
    id="<?=$idUser?>"
    class="
      bazar_sec_btn
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
  >
    Bazar
  </button>
  <button
    type="button"
    class="
      others_sec_btn
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
    Others
  </button>
</div>
</div>

                <div class="section_meal" id="section_meal">

                <div class="form-controll">
                    <div class="input-group mt-1 mb-1">
                    <input type="date" class="form-control" id="meal_search_date" placeholder="Select a date" aria-label="Select a date" aria-describedby="<?=$user?>">
                    <button class="btn btn-outline-secondary meal_search_b" type="button" id="<?=$idUser?>" >Check</button>
                    </div>
                </div>



                        <div class="row_meal_board_mainn p-2 border-white-300 border-2 shadow-lg border-white-200 rounded-lg bg-white-200">
                              <div class="meal_myy">

                                <div class="future_mealss" id="future_mealss">
                                
                                </div>

                              </div>
                        </div>



                </div>
                
                <div class="section_bazar hidden" id="section_bazar" >

                  

                </div>

                <div class="section_others hidden" id="section_others">
                  <h5>others</h5>
                </div>

</div>  
  <?php

}



if(isset($_POST['bazar_user'])){

    $me=$_POST['UserId'];
  
    if($me==$unique_id){
      $hidden='';
      $bu='t_month_bazz';
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
  
  <div class="bazar_section mt-3" id="monthly_baz_cont2">
      
  
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
          <input type="month" class="form-control text-base font-normal text-secondary bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none" id="send_month_for_bb" placeholder="Select a date" aria-label="Select a date" aria-describedby="button-addon2" >
          <button class="btn btn-outline-secondary send_month_bb bg-blue-600 text-dark font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out" type="button" id="<?=$me?>">Check</button>
          </div>
      </div>
      <div class="row">
                                                            <div class="col-6 text-start">
                                                              <code><?=$numr['user_name']?></code>
                                                            </div>
                                                            <div class="col-6 text-end">
                                                            <input type="button" class="btn btn-info btn-sm monthly_baz_contb2" value="Print">
                                                            </div>
                                                          </div>
  
  
                                          <div class="flex flex-col ba_t_month_list">
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


?>