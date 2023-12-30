<?php
include('../db.php');
session_start();

$unique_id=$_SESSION['user'];

$my_mess_id=$_SESSION['my_mess_id'];



if(isset($_POST['meal_switch_b'])){

    $o_f=$_POST['s_id'];

    $qry = "SELECT * FROM mess_main WHERE mess_id='$my_mess_id'";
    $rslt = mysqli_query($con,$qry);

    $nm=mysqli_num_rows($rslt);

    if($nm<1){
        echo "Mess Not Found! Please Add a mess Code";
    }else{

        $row = mysqli_fetch_array($rslt);

        if($unique_id==$row['mess_admin_id']){

            $con->query("UPDATE mess_main SET meal_update_status='$o_f' WHERE mess_id='$my_mess_id'");

            echo 1;

        }elseif($row['u_perm']==1){
            
            $con->query("UPDATE mess_main SET meal_update_status='$o_f' WHERE mess_id='$my_mess_id'");

            echo 1;

        }else {
            echo 2;
        }
        

    }

}


if(isset($_POST['user_perm_b'])){

    $o_f=$_POST['o_f_id'];

    $qry = "SELECT * FROM mess_main WHERE mess_id='$my_mess_id'";
    $rslt = mysqli_query($con,$qry);

    $nm=mysqli_num_rows($rslt);

    if($nm<1){
        echo "Mess Not Found! Please Add a mess Code";
    }else{

        $row = mysqli_fetch_array($rslt);

        if($unique_id==$row['mess_admin_id']){

            $con->query("UPDATE mess_main SET u_perm='$o_f' WHERE mess_id='$my_mess_id'");

            echo 1;

        }elseif($row['u_perm']==1){
            
            $con->query("UPDATE mess_main SET u_perm='$o_f' WHERE mess_id='$my_mess_id'");

            echo 1;

        }else {
            echo 2;
        }
        

    }

}



if(isset($_POST['use_bazar_upd'])){
    if($_POST['user_id']!=''){
        $user=$_POST['user_id'];
        $start=$_POST['startd'];
        $end=$_POST['endd'];

        $mebb="SELECT * FROM mess_main WHERE mess_id='$my_mess_id'";
        $mebbb=mysqli_query($con,$mebb);
        $mebnn=mysqli_num_rows($mebbb);

        if($mebnn<1){
            echo 3;
        }else{
            $adm=mysqli_fetch_assoc($mebbb);
            $admin=$adm['mess_admin_id'];
            $perm=$adm['u_perm'];

            if($unique_id==$admin){

                $con->query("UPDATE users SET bazar_start='$start', bazar_end='$end' WHERE unique_id='$user' AND mess_id='$my_mess_id'");
                echo 1;

            }elseif($perm=='1'){

                $con->query("UPDATE users SET bazar_start='$start', bazar_end='$end' WHERE unique_id='$user' AND mess_id='$my_mess_id'");

                echo 1;

            }
            else{
                echo '3';
            }


        }


    }else{
        echo 2;
    }
}

if(isset($_POST['my_meal_delete'])){
    $meal_id=$_POST['meal_id'];
    if($meal_id!=''){

        $con->query("DELETE FROM my_meals WHERE id='$meal_id' AND mess_id='$my_mess_id'");
    
        echo 1;
    }else{
        echo 2;
    }
}

if(isset($_POST['my_meal_upd'])){

    $meal_id=$_POST['meal_id'];
    if($meal_id!=''){
        $sokal=$_POST['sokal'];
        $dupur=$_POST['dupur'];
        $rat=$_POST['rat'];
        $sum=$sokal+$dupur+$rat;
    
        $con->query("UPDATE my_meals SET morning='$sokal', launce='$dupur', dinner='$rat', sum_meal='$sum' WHERE id='$meal_id' AND mess_id='$my_mess_id'");
    
        echo 1;
    }else{
        echo 2;
    }

}


if(isset($_POST['my_meal_updd'])){

    $meal_id=$_POST['meal_id'];
    if($meal_id!=''){
        $sokal=$_POST['sokal'];
        $dupur=$_POST['dupur'];
        $rat=$_POST['rat'];
        $sum=$sokal+$dupur+$rat;



        $qry = "SELECT * FROM mess_main WHERE mess_id='$my_mess_id'";
        $rslt = mysqli_query($con,$qry);

        $nm=mysqli_num_rows($rslt);

        if($nm<1){
            echo "Mess Not Found! Please Add a mess Code";
        }else{

            $row = mysqli_fetch_array($rslt);

            if($unique_id==$row['mess_admin_id']){

                $con->query("UPDATE my_meals SET morning='$sokal', launce='$dupur', dinner='$rat', sum_meal='$sum' WHERE id='$meal_id' AND mess_id='$my_mess_id'");
    
                echo 1;

            }elseif($row['u_perm']==1){
                
                $con->query("UPDATE my_meals SET morning='$sokal', launce='$dupur', dinner='$rat', sum_meal='$sum' WHERE id='$meal_id' AND mess_id='$my_mess_id'");

                echo 1;

            }else {
                echo 2;
            }
            

        }        


    }else{
        echo 2;
    }

}
if(isset($_POST['my_meal_deletee'])){
    $meal_id=$_POST['meal_id'];
    if($meal_id!=''){

            $qry = "SELECT * FROM mess_main WHERE mess_id='$my_mess_id'";
            $rslt = mysqli_query($con,$qry);

            $nm=mysqli_num_rows($rslt);

            if($nm<1){
                echo "Mess Not Found! Please Add a mess Code";
            }else{

                $row = mysqli_fetch_array($rslt);

                if($unique_id==$row['mess_admin_id']){


                    $con->query("DELETE FROM my_meals WHERE id='$meal_id' AND mess_id='$my_mess_id'");

                    echo 1;

                }elseif($row['u_perm']==1){
                    

                    $con->query("DELETE FROM my_meals WHERE id='$meal_id' AND mess_id='$my_mess_id'");

                    echo 1;

                }else {
                    echo 2;
                }
                

            }

    
    }else{
        echo 2;
    }
}

if(isset($_POST['user_to_admin'])){

    $uId=$_POST['user_id'];

            $mebb="SELECT * FROM mess_main WHERE mess_id='$my_mess_id'";
            $mebbb=mysqli_query($con,$mebb);
            $mebnn=mysqli_num_rows($mebbb);

        if($mebnn<1){
            echo 3;
        }else{
                $adm=mysqli_fetch_assoc($mebbb);
                $admin=$adm['mess_admin_id'];
                $perm=$adm['u_perm'];

                if($unique_id==$admin){

                    $con->query("UPDATE mess_main SET mess_admin_id='$uId' WHERE mess_id='$my_mess_id'");
                    echo 1;

                }elseif($perm=='1'){

                    $con->query("UPDATE mess_main SET mess_admin_id='$uId' WHERE mess_id='$my_mess_id'");

                    echo 1;

                }
                else{
                    echo '3';
                }


        }

}


if(isset($_POST['bazar_list'])){

    $meb="SELECT * FROM users WHERE mess_id='$my_mess_id' order by bazar_start ASC";
    $mebb=mysqli_query($con,$meb);
    $mebn=mysqli_num_rows($mebb);

    if($mebn<1){
        echo "Mess Not Found!";
    }else{

        while($mr=mysqli_fetch_assoc($mebb)){

                    
            $das=$mr['bazar_start'];
            $dae=$mr['bazar_end'];
            $dates= date("jS M", strtotime($das));
            $datee= date("jS M", strtotime($dae));

                    ?>

                                                        <div class="md:container md:mx-auto cursor-move shadow-lg border-x-2 border-y-2 border-b-rose-200 rounded-lg border-x-rose-400 border-y-gray-200 mb-1">
                                                            <div class="row ">
                                                                <div class="col-md-6">
            
                                                                  <div class="flex flex-wrap justify-center space-x-2 items-end " id="<?=$mr['unique_id']?>">
                                                                    <span
                                                                      class="rounded-full use_upd_btn text-gray-500 bg-gray-200 font-semibold text-sm flex align-center cursor-pointer active:bg-gray-300 transition duration-300 ease w-max" id="<?=$mr['unique_id']?>">
                                                                      <img class="rounded-full w-9 h-9 max-w-none" alt="A"
                                                                        src="https://mdbootstrap.com/img/Photos/Avatars/avatar-6.jpg" />
                                                                      <span class="flex items-center px-3 py-2">
                                                                        <?=$mr['user_name']?>
                                                                      </span>
                                                                      <button class="bg-transparent hover focus:outline-none">
                                                                        <i class="bi bi-bag"></i>
                                                                      </button>
                                                                    </span>
                                                                    <button class="btn btn-info btn-sm bazar_up_btn" id="<?=$mr['unique_id']?>"><i class="bi bi-pen"></i></button>
            
                                                                  </div>

            
                                                                </div>
                                                                <div class="col-md-3">
            
                                                                <select class="form-select form-control appearance-none
                                                                                      block
                                                                                      w-full
                                                                                      px-3
                                                                                      py-1.5
                                                                                      text-base
                                                                                      font-normal
                                                                                      text-gray-700
                                                                                      bg-white bg-clip-padding bg-no-repeat
                                                                                      border border-solid border-gray-300
                                                                                      rounded
                                                                                      transition
                                                                                      ease-in-out
                                                                                      m-0
                                                                                      focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none" aria-label="Default select example" name="fromdate" id="fromdate<?=$mr['unique_id']?>" > 
                                                                  <option value="<?= $das;?>">From <?=$dates?></option>
                                                                  <option value="<?php echo $today;?>">Today</option>
                                                                    <?php foreach($list as $key => $value){ ?>
                                                                      
                                                                      <option value="<?php echo $value;?>"><?php echo $value;?></option>
                                                                    <?php } ?>
                                                                </select>
            
                                                                </div>
                                                                <div class="col-md-3">
            
                                                                <select class="form-select form-control appearance-none
                                                                                      block
                                                                                      w-full
                                                                                      px-3
                                                                                      py-1.5
                                                                                      text-base
                                                                                      font-normal
                                                                                      text-gray-700
                                                                                      bg-white bg-clip-padding bg-no-repeat
                                                                                      border border-solid border-gray-300
                                                                                      rounded
                                                                                      transition
                                                                                      ease-in-out
                                                                                      m-0
                                                                                      focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none" aria-label="Default select example" name="todate" id="todate<?=$mr['unique_id']?>"> 
                                                                  <option value="<?=$dae;?>">End <?=$datee?></option>
                                                                  <option value="<?php echo $today;?>">Today</option>
                                                                    <?php foreach($list as $key => $value){ ?>
                                                                      
                                                                      <option value="<?php echo $value;?>"><?php echo $value;?></option>
                                                                    <?php } ?>
                                                                </select>
            
                                                                </div>
                                                            </div>
                                                        </div>
            
                    <?php

        }

    }


}





if(isset($_POST['my_b_updd'])){

    $meal_id=$_POST['b_id'];
    if($meal_id!=''){
        $sokal=$_POST['details'];
        $dupur=$_POST['amount'];

        $qry = "SELECT * FROM mess_main WHERE mess_id='$my_mess_id'";
        $rslt = mysqli_query($con,$qry);

        $nm=mysqli_num_rows($rslt);

        if($nm<1){
            echo "Mess Not Found! Please Add a mess Code";
        }else{

            $row = mysqli_fetch_array($rslt);

            if($unique_id==$row['mess_admin_id']){

                $con->query("UPDATE bazar_list SET list_details='$sokal', amount='$dupur' WHERE id='$meal_id' AND mess_id='$my_mess_id'");
    
                echo 1;

            }elseif($row['u_perm']==1){
                
                $con->query("UPDATE bazar_list SET list_details='$sokal', amount='$dupur' WHERE id='$meal_id' AND mess_id='$my_mess_id'");
    
                echo 1;

            }else {
                echo 2;
            }
            

        }        


    }else{
        echo 2;
    }

}
if(isset($_POST['my_b_deletee'])){
    $meal_id=$_POST['b_id'];
    if($meal_id!=''){

            $qry = "SELECT * FROM mess_main WHERE mess_id='$my_mess_id'";
            $rslt = mysqli_query($con,$qry);

            $nm=mysqli_num_rows($rslt);

            if($nm<1){
                echo "Mess Not Found! Please Add a mess Code";
            }else{

                $row = mysqli_fetch_array($rslt);

                if($unique_id==$row['mess_admin_id']){


                    $con->query("DELETE FROM bazar_list WHERE id='$meal_id' AND mess_id='$my_mess_id'");

                    echo 1;

                }elseif($row['u_perm']==1){
                    

                    $con->query("DELETE FROM bazar_list WHERE id='$meal_id' AND mess_id='$my_mess_id'");

                    echo 1;

                }else {
                    echo 2;
                }
                

            }

    
    }else{
        echo 2;
    }
}
if(isset($_POST['my_b_deleteee'])){
    $meal_id=$_POST['b_id'];
    if($meal_id!=''){

            $qry = "SELECT * FROM bazar_list WHERE mess_id='$my_mess_id' AND id='$meal_id'";
            $rslt = mysqli_query($con,$qry);

            $nm=mysqli_num_rows($rslt);

            if($nm<1){
                echo "Mess Not Found! Please Add a mess Code";
            }else{

                $row = mysqli_fetch_array($rslt);

                if($unique_id==$row['unique_id']){


                    $con->query("DELETE FROM bazar_list WHERE id='$meal_id' AND mess_id='$my_mess_id'");

                    echo 1;

                }else {
                    echo 2;
                }
                

            }

    
    }else{
        echo 2;
    }
}


if(isset($_POST['payMent'])){
    $meal_id=$_POST['pay_id'];
    if($meal_id!=''){

            $qry = "SELECT * FROM mess_main WHERE mess_id='$my_mess_id'";
            $rslt = mysqli_query($con,$qry);

            $nm=mysqli_num_rows($rslt);

            if($nm<1){
                echo "Mess Not Found! Please Add a mess Code";
            }else{

                $row = mysqli_fetch_array($rslt);

                if($unique_id==$row['mess_admin_id']){


                    $con->query("DELETE FROM payment WHERE id='$meal_id' AND mess_id='$my_mess_id'");

                    echo 1;

                }elseif($row['u_perm']==1){
                    

                    $con->query("DELETE FROM payment WHERE id='$meal_id' AND mess_id='$my_mess_id'");

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



