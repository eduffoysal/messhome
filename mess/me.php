<?php
session_start();
// include('../db.php');

    $con = new mysqli("localhost","id19656220_farhad","Mffoysal@369725","id19656220_secondhome") or die(mysqli_error());
    $today=date("Y-m-d");
    $time= date("h:i:s");

$unique_id='farhad foysal';

$my_mess_id=$_SESSION['my_mess_id'];
  $admin_n='0';
//   $list_id=$r_id.''.$uni_id;
$list_id=100;
$b_name= "aluuuuuf";
$b_amount=20;


    $query = "INSERT INTO bazar_list(list_id,unique_id,mess_id,list_details,amount,admin_notify) VALUES('$list_id','$unique_id','$my_mess_id','$b_name','$b_amount','$admin_n')";
    
    if($query){
        echo "Hellow seccessfully saved";
    }
    
    echo "<pre> Debug: $query </pre>\m";
    
    $result = mysqli_query($con,$query);
    
    if(false===$result){
        
        printf("error: %s", mysqli_error($con));
        
    }else{
        echo 'done.';
    }


?>