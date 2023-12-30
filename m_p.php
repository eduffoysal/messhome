<?php
session_start();
require_once 'db.php';
if(isset($_SESSION['userr'])){
    $unique_id=$_SESSION['userr'];
    $my_mess_id=$_SESSION['my_mess_id'];
    $me=$unique_id;
}
if(isset($_SESSION['user'])){
    $unique_id=$_SESSION['user'];
    $my_mess_id=$_SESSION['my_mess_id'];
    $me=$unique_id;
}
date_default_timezone_set("Asia/Dhaka");
$today=date("Y-m-d");
$time= date("h:i:s");
$ti= date("h");
$tii= date("i");
$tiii= date("A");

$sokal=1;
$dupur=1;
$rat=1;

// echo $ti.'-'.$tii;

if(isset($_POST['type'])){
    $id=$_POST['id'];
    if($id=='i'){
        $meal_d=1;
        $meal_s=1;
        if($_POST['type']=='plus'){
            $con->query("INSERT INTO my_meals (unique_id, mess_id, morning, date, time, sum_meal) values ('$unique_id', '$my_mess_id', '$meal_d', '$today', '$time','$meal_s')");
            echo 2;

        }elseif($_POST['type']=='pluss'){
            $con->query("INSERT INTO my_meals (unique_id, mess_id, launce, date, time, sum_meal) values ('$unique_id', '$my_mess_id', '$meal_d', '$today', '$time','$meal_s')");
            echo 2;
        }
        elseif($_POST['type']=='plusss'){
            $con->query("INSERT INTO my_meals (unique_id, mess_id, dinner, date, time, sum_meal) values ('$unique_id', '$my_mess_id', '$meal_d', '$today', '$time','$meal_s')");
            echo 2;
        }elseif($_POST['type']=='minus'){
            $con->query("INSERT INTO my_meals (unique_id, mess_id, morning, date, time, sum_meal) values ('$unique_id', '$my_mess_id', '$meal_d', '$today', '$time','$meal_s')");
            echo 2;
        }elseif($_POST['type']=='minuss'){
            $con->query("INSERT INTO my_meals (unique_id, mess_id, launce, date, time, sum_meal) values ('$unique_id', '$my_mess_id', '$meal_d', '$today', '$time','$meal_s')");
            echo 2;
        }else {
            $con->query("INSERT INTO my_meals (unique_id, mess_id, dinner, date, time, sum_meal) values ('$unique_id', '$my_mess_id', '$meal_d', '$today', '$time','$meal_s')");
            echo 2;
        }

    }else{

        if($_POST['type']=='plus'){
            $sql="UPDATE my_meals SET morning=morning+1, sum_meal=sum_meal+1 WHERE id=$id ";
            $rowt=mysqli_query($con,$sql);
            echo 1;
        }elseif($_POST['type']=='pluss'){
            $sql="UPDATE my_meals SET launce=launce+1, sum_meal=sum_meal+1 WHERE id=$id ";
            $rowt=mysqli_query($con,$sql);
            echo 1;
        }
        elseif($_POST['type']=='plusss'){
            $sql="UPDATE my_meals SET dinner=dinner+1, sum_meal=sum_meal+1 WHERE id=$id ";
            $rowt=mysqli_query($con,$sql);
            echo 1;
        }elseif($_POST['type']=='minus'){
            $sql="UPDATE my_meals SET morning=morning-1, sum_meal=sum_meal-1 WHERE id=$id ";
            $rowt=mysqli_query($con,$sql);
            echo 1;
        }elseif($_POST['type']=='minuss'){
            $sql="UPDATE my_meals SET launce=launce-1, sum_meal=sum_meal-1 WHERE id=$id ";
            $rowt=mysqli_query($con,$sql);
            echo 1;
        }else {
            $sql="UPDATE my_meals SET dinner=dinner-1, sum_meal=sum_meal-1 WHERE id=$id ";
            $rowt=mysqli_query($con,$sql);
            echo 1;
        }


    }


}

if(isset($_POST['UserMeal'])){
    $myId=$unique_id;

    $queryd = mysqli_query($con,"SELECT * FROM my_meals WHERE unique_id='$unique_id' AND date='$today' AND mess_id='$my_mess_id' ");
    $numr=mysqli_num_rows($queryd);
    $qru=mysqli_fetch_assoc($queryd);

    if($numr==1){

        $meals=$qru['morning'];
        $meald=$qru['launce'];
        $mealr=$qru['dinner'];
        $mId=$qru['id'];
        if($meals==0){

            if($ti<=7 && $tiii=='AM'){
                $con->query("UPDATE my_meals SET morning=1, sum_meal=sum_meal+1 WHERE id='$mId' ");
                echo 1;
            }elseif($meald==0){

                if($ti<=11 && $tiii=='AM'){
                    $con->query("UPDATE my_meals SET launce=1, sum_meal=sum_meal+1 WHERE id='$mId' ");
                    echo 2;
                }elseif($mealr==0){

                    if($ti<=7 && $tiii=='PM'){
                        $con->query("UPDATE my_meals SET dinner=1, sum_meal=sum_meal+1 WHERE id='$mId' ");
                        echo 6;
                    }else{

                        echo 4;

                    }
            
                }else{

                    echo 5;

                }

            }elseif($mealr==0){

                if($ti<=7 && $tiii=='PM'){
                    $con->query("UPDATE my_meals SET dinner=1, sum_meal=sum_meal+1 WHERE id='$mId' ");
                    echo 6;
                }else{

                    echo 4;

                }

            }else{

                echo 7;

            }

        }elseif($meald==0){

            if($ti<=11 && $tiii=='AM'){
                $con->query("UPDATE my_meals SET launce=1, sum_meal=sum_meal+1 WHERE id='$mId' ");
                echo 2;
            }elseif($mealr==0){

                if($ti<=7 && $tiii=='PM'){
                    $con->query("UPDATE my_meals SET dinner=1, sum_meal=sum_meal+1 WHERE id='$mId' ");
                    echo 6;
                }else{

                    echo 4;

                }
        
            }else{

                echo 5;

            }

        }else if($mealr==0){

            if($ti<=7 && $tiii=='PM'){
                $con->query("UPDATE my_meals SET dinner=1, sum_meal=sum_meal+1 WHERE id='$mId' ");
                echo 6;
            }else{

                echo 4;

            }

        }
        else{

            echo 9;

        }



    }else{

        if($ti<=7 && $tiii=='AM'){
            $con->query("INSERT INTO my_meals (unique_id, mess_id, morning, date, time, sum_meal) values ('$myId', '$my_mess_id', '$sokal', '$today', '$time','1')");
            echo 1;
        }elseif($ti<=11 && $tiii=='AM'){
            $con->query("INSERT INTO my_meals (unique_id, mess_id, launce, date, time, sum_meal) values ('$myId', '$my_mess_id', '$dupur', '$today', '$time','1')");
            echo 2;
        }elseif($ti<=7 && $tiii=='PM'){
            $con->query("INSERT INTO my_meals (unique_id, mess_id, dinner, date, time, sum_meal) values ('$myId', '$my_mess_id', '$rat', '$today', '$time','1')");
            echo 6;
        }else{
            $con->query("INSERT INTO my_meals (unique_id, mess_id, launce, dinner, date, time, sum_meal) values ('$myId', '$my_mess_id', '$dupur', '$rat', '$today', '$time','2')");
            echo 8;
        }


        
    }
}
?>