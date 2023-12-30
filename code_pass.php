<?php

include('db.php');
session_start();

    if(isset($_POST['create_new_mess'])){
       $my_id = $_POST['my_id'];

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
       ?>


<div class="block p-6 rounded-lg shadow-lg bg-white max-w-md">
  <form role="form" id="mess_c_form">
    <!-- <div class="grid grid-cols-2 gap-4">
      <div class="form-group mb-6">
        <input type="text" class="form-control
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
          focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none" id="exampleInput123"
          aria-describedby="emailHelp123" placeholder="First name">
      </div>
      <div class="form-group mb-6">
        <input type="text" class="form-control
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
          focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none" id="exampleInput124"
          aria-describedby="emailHelp124" placeholder="Last name">
      </div>
    </div> -->
    <div class="form-group mb-6">
      <input type="text" class="form-control block
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
        focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none" name="mess_name" id="mess_name"
        placeholder="Mess Name">
    </div>
    <div class="form-group mb-6">
      <input type="password" class="form-control block
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
        focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none" name="mess_pass" id="mess_pass"
        placeholder="Mess Password">
    </div>




    <div class="flex justify-center">
  <div>
    <div class="form-floating mb-3 xl:w-96">
      <input type="text" class="form-control
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
      focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none" name="mess_address" id="mess_address" placeholder="name@example.com">
      <label for="floatingInput" class="text-gray-700">Mess address</label>
    </div>
    <div class="form-floating mb-3 xl:w-96">
      <input type="phone" class="form-control
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
      focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none" name="mess_phone" id="mess_phone" placeholder="Password">
      <label for="floatingPassword" class="text-gray-700">Admin Phone</label>
    </div>
  </div>
</div>




    <button type="button" class="
      create_mess_btn
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
      ease-in-out" name="mess_c_btn" id="mess_c_btn">Create Mess</button>
      <input class="form-control" placeholder="Phone/User ID" name="mess_create" id="melogin" type="hidden">
  </form>

    <div id="myalert_m" style="display:none;">
    	<div class="container col-md-offset-4">
    		<div class="alert alert-info">
    			<center><span id="alerttext_m"></span></center>
    		</div>
   	 	</div>
    </div>

</div>






       <?php

    }

    if(isset($_POST['setup_mess'])){
        $my_id = $_POST['my_id'];
 

        ?>

<div class="block p-6 rounded-lg shadow-lg bg-white max-w-md">
  <form role="form" id="mess_u_form">

    <div class="container-fluid justify-center">
  <div>
  <div class="form-floating mb-3 xl:w-96">
      <input type="text" class="form-control
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
      focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none" name="mess_id_set" id="mess_id_set" placeholder="Mess Id">
      <label for="mess_id_set" class="text-gray-700">Mess Id</label>
    </div>
  </div>
</div>

    <button type="button" class="
      set_mess_btn
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
      ease-in-out" name="mess_u_btn" id="mess_u_btn">Set Mess Id</button>
      <input class="form-control" placeholder="" name="mess_update" id="mess_up" type="hidden">
  </form>

    <div id="myalert_mm" style="display:none;">
    	<div class="container col-md-offset-4">
    		<div class="alert alert-info">
    			<center><span id="alerttext_mm"></span></center>
    		</div>
   	 	</div>
    </div>

</div>


        <?php            

        // echo $my_id;
     }


if(isset($_POST['req_mess_meal'])){

      $meal_m=$_POST['meal_id'];

    ?>

              <div class="card card-1 btn re_<?=$meal_m?>" id="0.5">
                 HALF
              </div>
              <div class="card card-2 btn re_<?=$meal_m?>" id="1">
                 1
              </div>
              <div class="card card-3 btn re_<?=$meal_m?>" id="1.5">
                 1.5
              </div>
              <div class="card card-4 btn re_<?=$meal_m?>" id="2">
                 2
              </div>
              <div class="card card-5 btn re_<?=$meal_m?>" id="2.5">
                 2.5
              </div>
              <div class="card card-6 btn re_<?=$meal_m?>" id="3">
                 3
              </div>
              <div class="card card-7 btn re_<?=$meal_m?>" id="3.5">
                 3.5
              </div>
              <div class="card card-8 btn re_<?=$meal_m?>" id="4">
                 4
              </div>
              <div class="card card-9 btn re_<?=$meal_m?>" id="4.5">
                 4.5
              </div>
              <div class="card card-10 btn re_<?=$meal_m?>" id="0">
                 0
              </div>


    <?php


}



?>




