<?php
session_start();
include('../db.php');
$unique_id=$_SESSION['user'];

    date_default_timezone_set("Asia/Dhaka");
    $today=date("Y-m-d");
    $time= date("h:i:s");

$my_mess_id=$_SESSION['my_mess_id'];

if(isset($_POST['mess_create'])){

    $messName = $_POST['mess_name'];
    $messPass = $_POST['mess_pass'];
    $messAddress = $_POST['mess_address'];
    $messPhone = $_POST['mess_phone'];

    $qry = "SELECT m_id FROM mess_main order by id desc";
    $rslt = mysqli_query($con,$qry);
    $row = mysqli_fetch_array($rslt);

        if(mysqli_num_rows($rslt)!=0){
            $lastnumber='';
        }else {
            $lastnumber=$row['m_id'];
        }
// $lastnumber=$row['m_id'];

    if(empty($lastnumber)){
        $number = "MFF-0000001";
    }else{
        $idd = str_replace("U-FF-","",$lastnumber);
                $im= (int)$idd + 1;
        $id = str_pad($im, 7,0, STR_PAD_LEFT);
        $number = 'MFF-' .$id;
    }

    $number=time();

    $ran_id = rand(time(), 1000000000);
    $referr = strtoupper(bin2hex(random_bytes(1)));

    $numberr= $ran_id.''.$referr;

    $con->query("INSERT INTO mess_main (m_id, mess_id, mess_name, mess_address, mess_pass, mess_admin_id, admin_phone) values ('$number', '$numberr', '$messName', '$messAddress', '$messPass', '$unique_id', '$messPhone')");

    $con->query("UPDATE users SET mess_id='$numberr' WHERE unique_id='$unique_id' or user_id='$unique_id'");


    echo 1;

}


if(isset($_POST['mess_update'])){

    $messId = $_POST['mess_id_set'];
    

    $con->query("UPDATE users SET mess_id='$messId' WHERE unique_id='$unique_id' or user_id='$unique_id'");


    echo 1;

}




if(isset($_POST['morning_meal'])){
    $meal_d=$_POST['meal_id'];

    $qry = "SELECT * FROM mess_main WHERE mess_id='$my_mess_id'";
    $rslt = mysqli_query($con,$qry);
    $row = mysqli_fetch_array($rslt);

    $nm=mysqli_num_rows($rslt);

    if($nm<1){
        echo "Mess Not Found! Please Add a mess Code";
    }else{



        $per=$row['u_perm'];

        $admin=$row['mess_admin_id'];


            $meal_up=$row['meal_update_status'];
            if($meal_up=='1'){
    
                $qryy = "SELECT * FROM my_meals WHERE mess_id='$my_mess_id' AND unique_id='$unique_id' AND date='$today'";
                $rslty = mysqli_query($con,$qryy);
                $rowy = mysqli_fetch_array($rslty);
            
                $nmy=mysqli_num_rows($rslty);
        
                if($nmy<1){
        
                    $con->query("INSERT INTO my_meals(unique_id,mess_id,morning,date,time,sum_meal) values('$unique_id','$my_mess_id','$meal_d','$today','$time','$meal_d')");
        
                    echo 1;
                }else{
        
                    $con->query("UPDATE my_meals SET sum_meal=dinner+launce+$meal_d,morning='$meal_d' WHERE mess_id='$my_mess_id' AND unique_id='$unique_id' AND date='$today'");
        
                    echo 2;
                }
    
            }else{
                echo '5';
            }



    }

}

if(isset($_POST['launce_meal'])){
    $meal_d=$_POST['meal_id'];

    $qry = "SELECT * FROM mess_main WHERE mess_id='$my_mess_id'";
    $rslt = mysqli_query($con,$qry);
    $row = mysqli_fetch_array($rslt);

    $nm=mysqli_num_rows($rslt);

    if($nm<1){
        echo "Mess Not Found! Please Add a mess Code";
    }else{


        $per=$row['u_perm'];

        $admin=$row['mess_admin_id'];

            $meal_up=$row['meal_update_status'];
            if($meal_up=='1' || $meal_up=='2'){
    
                $qryy = "SELECT * FROM my_meals WHERE mess_id='$my_mess_id' AND unique_id='$unique_id' AND date='$today'";
                $rslty = mysqli_query($con,$qryy);
                $rowy = mysqli_fetch_array($rslty);
            
                $nmy=mysqli_num_rows($rslty);
        
                if($nmy<1){
        
                    $con->query("INSERT INTO my_meals (unique_id, mess_id, launce, date, time, sum_meal) values ('$unique_id', '$my_mess_id', '$meal_d', '$today', '$time','$meal_d')");
        
                    echo 1;
                }else{
        
                    $con->query("UPDATE my_meals SET sum_meal=morning+dinner+$meal_d, launce='$meal_d' WHERE mess_id='$my_mess_id' AND unique_id='$unique_id' AND date='$today'");
        
                    echo 1;
                }
    
            }else{
                echo '';
            }




    }

}

if(isset($_POST['dinner_meal'])){
    $meal_d=$_POST['meal_id'];

    $qry = "SELECT * FROM mess_main WHERE mess_id='$my_mess_id'";
    $rslt = mysqli_query($con,$qry);
    $row = mysqli_fetch_array($rslt);

    $nm=mysqli_num_rows($rslt);

    if($nm<1){
        echo "Mess Not Found! Please Add a mess Code";
    }else{

        $per=$row['u_perm'];

        $admin=$row['mess_admin_id'];

            $meal_up=$row['meal_update_status'];
            if($meal_up=='1' || $meal_up=='2' || $meal_up=='3'){
    
                $qryy = "SELECT * FROM my_meals WHERE mess_id='$my_mess_id' AND unique_id='$unique_id' AND date='$today'";
                $rslty = mysqli_query($con,$qryy);
                $rowy = mysqli_fetch_array($rslty);
            
                $nmy=mysqli_num_rows($rslty);
        
                if($nmy<1){
        
                    $con->query("INSERT INTO my_meals (unique_id, mess_id, dinner, date, time, sum_meal) values ('$unique_id', '$my_mess_id', '$meal_d', '$today', '$time', '$meal_d')");
                    echo 1;
        
                }else{
        
                    $con->query("UPDATE my_meals SET sum_meal=morning+launce+$meal_d, dinner='$meal_d' WHERE mess_id='$my_mess_id' AND unique_id='$unique_id' AND date='$today'");
                    echo 1;
        
                }
    
            }else{
                echo '';
            }




    }

}




if(isset($_POST['mess_s_meal'])){


    if($_POST['select_morni'] !='' && $_POST['select_morni1'] !='' && $_POST['select_morni2'] !=''){
        

        $dateSp=$_POST['todate'];
        $morningSp=$_POST['select_morni'];
        $launceSp=$_POST['select_morni1'];
        $dinnerSp=$_POST['select_morni2'];

        $sumMeal=$morningSp+$launceSp+$dinnerSp;

        $queryd = mysqli_query($con,"SELECT * FROM my_meals WHERE mess_id='$my_mess_id' AND unique_id='$unique_id' AND date='$dateSp'");
        $numr=mysqli_num_rows($queryd);
        if($numr>0||$numr==1){
            echo 3;
        }else{
            
                $con->query("INSERT INTO my_meals (unique_id, mess_id, date, time, morning, launce, dinner, sum_meal) VALUES ('$unique_id', '$my_mess_id', '$dateSp', '$time', '$morningSp', '$launceSp', '$dinnerSp', '$sumMeal')");
            
                            // $con->query("INSERT INTO my_meals (unique_id, mess_id, morning, launce, dinner, date, time, sum_meal) values ('$unique_id', '$my_mess_id', '$morningSp','$launceSp', '$dinnerSp', '$dateSp', '$time')");
                            
                // $con->query("INSERT INTO `my_meals`(`unique_id`, `mess_id`, `date`, `time`, `morning`, `launce`, `dinner`, `meal_update`, `sum_meal`, `meal_reset`) VALUES ('$unique_id', '$my_mess_id', '$morningSp', '$launceSp', '$dinnerSp', '$dateSp', '$time', '$sumMeal')");            

                echo 1;

        }


    }else{
        echo 2;
    }


}

if(isset($_POST['fee_m_a'])){
    if($_POST['fee_m_a_t']!=''){

        $type=$_POST['fee_m_a_t'];
        $am=$_POST['fee_m_a_a'];
        $sta=1;


        $qry = "SELECT * FROM mess_main WHERE mess_id='$my_mess_id'";
        $rslt = mysqli_query($con,$qry);
        $row = mysqli_fetch_array($rslt);
    
        $nm=mysqli_num_rows($rslt);
    
        if($nm<1){
            echo "Mess Not Found! Please Add a mess Code";
        }else{
            $admin=$row['mess_admin_id'];
            if($admin==$unique_id){
                $con->query("INSERT INTO mess_fees (mess_id, fee_type, amount, admin_id, date, status) values ('$my_mess_id', '$type', '$am','$unique_id', '$today', '$sta')");
       
                echo 1;
            }else{
                echo 3;
            }


        }


    }else{
        echo 2;
    }
}


if(isset($_POST['fee_ind_a'])){
    if($_POST['fee_ind_a_t']!=''){

        $type=$_POST['fee_ind_a_t'];
        $am=$_POST['fee_ind_a_a'];
        $user=$_POST['fee_ind_a'];
        $sta=1;


        $qry = "SELECT * FROM mess_main WHERE mess_id='$my_mess_id'";
        $rslt = mysqli_query($con,$qry);
        $row = mysqli_fetch_array($rslt);
    
        $nm=mysqli_num_rows($rslt);
    
        if($nm<1){
            echo "Mess Not Found! Please Add a mess Code";
        }else{
            $admin=$row['mess_admin_id'];
            if($admin==$unique_id){
                $con->query("INSERT INTO others_fee (unique_id, mess_id, fee_type, amount, admin_id, date, status) values ('$user', '$my_mess_id', '$type', '$am','$unique_id', '$today', '$sta')");
       
                echo 1;
            }else{
                echo 3;
            }


        }


    }else{
        echo 2;
    }
}

?>