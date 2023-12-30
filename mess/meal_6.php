<?php
include('../db.php');
session_start();

    $today=date("Y-m-d");
    $time= date("h:i:s");

$unique_id=$_SESSION['user'];

$my_mess_id=$_SESSION['my_mess_id'];



if(isset($_GET['action']))
{

  if($_GET['action']=='save_bazar'){


  $name =$_POST['type'];
  $amount =$_POST['amount'];
  $admin_n='0';
  $list_id=$r_id.''.$uni_id;


 for($count = 0; $count < count($name); $count++)
 {

   $b_name   = mysqli_real_escape_string($con, $name[$count]);
   $b_amount  = mysqli_real_escape_string($con, $amount[$count]);

   if($b_name != ''){
    $query = "INSERT INTO bazar_list (list_id, unique_id, mess_id, list_details, amount, date_time, admin_notify) values ('$list_id', '$unique_id', '$my_mess_id', '$b_name', '$b_amount', '$today', '$admin_n')";
   }
   if($query != ''){
        $s =    mysqli_multi_query($con,$query);
    if($s){
      echo "1";
    }else {
      echo "2";
    }

 }else {
   echo "2";
 }

 }
 
 if($s){
     echo 1;
 }else{
     echo 2;
 }

  }

}




if(isset($_POST['future_mealss_d'])){

  $uid=$_POST['u_id'];
  if(isset($_POST['datese'])){
    $datet=$_POST['datese'];
  }else{
    $datet=$today;
  }


  $fu="SELECT * FROM my_meals WHERE unique_id='$uid' AND mess_id='$my_mess_id' AND DATE(date)='$datet' ";
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
                class="inline-block px-6 py-2.5 bg-blue-400 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out meal_update_bb" id="<?=$f['id']?>"
              >:</button>
              <button
                type="button"
                data-mdb-ripple="true"
                data-mdb-ripple-color="light"
                class="inline-block px-6 py-2.5 bg-blue-400 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out meal_dell" id="<?=$f['id']?>"
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


?>