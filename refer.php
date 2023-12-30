<?php
 include('db.php');

 $refervalue='';

 if(isset($_REQUEST['refer']) && $_REQUEST['refer']!=''){
     $coderefer=$_REQUEST['refer'];
     $query1="SELECT * FROM users WHERE referral_code='$coderefer'";
     $result1=mysqli_query($con,$query1);
     if(mysqli_num_rows($result1)==1){
        $refervalue = $_REQUEST['refer'];
     }else{
        header('location:refer.php?error=দুঃখিত! আপনার দেয়া রেফারেল কোড সঠিক নয়...');
     }
 
 }
 
 
 $qry = "SELECT user FROM users order by user desc";
 $rslt = mysqli_query($con,$qry);
 $row = mysqli_fetch_array($rslt);

 $lastnumber = $row['user'];

 if(empty($lastnumber)){
     $number = "User-F-0000001";
 }else{
     $idd = str_replace("User-F-","",$lastnumber);
     $id = str_pad($idd + 1, 7,0, STR_PAD_LEFT);
     $number = 'User-F-' .$id; 
 }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="jquery-3.5.1.min.js"></script>
    <title>User Registration</title>
    <!-- custom css file link  -->
    <link rel="stylesheet" href="css/new.css">
    <link rel="stylesheet" href="bootstrap.min.css">
    <link rel="stylesheet" href="icon/bootstrap-icons.css">

</head>
<body>

<div class="container">
<h3 style="color:red"><?php if(isset($_REQUEST['error'])){
    echo $_REQUEST['error'];
} ?></h3>
    <div class="card-container">
            
        <div class="front">
            <div class="image">
                <img src="image/chip.png" alt="">
                <img src="image/visa.png" alt="EdULearn">
            </div>
            <div class="card-number-box"><span class="bi bi-telephone-fill"></span> ################</div>
            <div class="flexbox">
                <div class="box form-floating">
                    <span><input type="text" name="user_id" class="form-floating w-75" value="<?php echo $number ;?>" readonly></span>
                    <div class="card-holder-name">full name</div>
                </div>
                <div class="box">
                    <span>Address:</span>
                    <div class="expiration">
                        <span class="exp-month">A/C</span>
                        <span class="exp-year">UNIOn</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="back">
            <div class="stripe"></div>
            <div class="box">
                <span>Your 4 Digit Password</span>
                <div class="cvv-box"></div>
                <img src="image/visa.png" alt="">
            </div>
        </div>

    </div>

    <form action="sign.php" method="POST" id="form-data">
        <div class="inputBox">
            <span>Enter Your Phone Number</span>
            <input type="text" maxlength="16" name="phone" placeholder="Type Your Phone Nuber" class="card-number-input">
        </div>
        <div class="inputBox">
            <span>Type Your Full Name</span>
            <input type="text" name="name" placeholder="Type Your Name" class="card-holder-input">
        </div>
        <div class="inputBox">
                <span>New Password</span>
                <input type="password" maxlength="4" name="pass" class="cvv-input">
            </div>
            <div class="inputBox">
                <span>Referral Code</span>
                <input type="text" maxlength="10" name="referral_code" id="refervalue" value="<?=$refervalue;?>" placeholder="Referral Code" class="reffer-input">
            </div>
       
        <div class="inputBox">
            <!-- <span>Type Your Full Name</span> -->
            <input type="hidden" name="user" value="<?php echo $number ;?>" class="">
            <input type="hidden" name="email" value="<?php echo $number ;?>-email update later" class="">
            <input type="hidden" name="village" value="<?php echo $number ;?>-village upade later" class="">
            <!-- <input type="hidden" name="actype" value="<?php echo $number ;?>-AcType upade later" class=""> -->
        </div> 
        <div class="inputBox">
                <span>User A/C Type</span>
                <select  id="" name="actype" class="month-input">
                    <option value="year" selected disabled>A/C Type</option>
                    <option value="student">Student|User</option>
                    <option value="mentor">Mentor</option>
                    <option value="admin">Admin</option>
                </select>
            </div>   
        <div class="flexbox">
        <!-- <div class="inputBox">
                <span>New Password</span>
                <input type="text" maxlength="4" class="cvv-input">
            </div> -->
            <div class="inputBox">
                <span>Division</span>
                <select id="division" name="division" class="division-input">
                    <option value="" selected disabled>Select Your Division</option>
                <?php
                    $queryd = mysqli_query($con,"SELECT * FROM divisions");
                    while($rowd=mysqli_fetch_array($queryd)){
                        ?>
                            <option value="<?php echo $rowd['id'] ?>"><?php echo $rowd['bn_name'] ?></option>
                        <?php
                    }
                ?>
                </select>
            </div>
            <div class="inputBox">
                <span>District</span>
                <select  id="district" name="district" class="district-input">
                    <!-- <option value="year" selected disabled>year</option> -->
                    
                </select>
            </div>
            <div class="inputBox">
                <span>Upazila</span>
                <select  id="upazila" name="upazila" class="upazila-input">
                    <!-- <option value="year" selected disabled>year</option> -->
                    
                </select>
            </div>
            <div class="inputBox">
                <span>Union</span>
                <select  id="union" name="union" class="year-input">
                    <!-- <option value="year" selected disabled>year</option> -->
                    
                </select>
            </div>
            <div class="inputBox">
                <span>Word</span>
                <select  id="word" name="word" class="word-input">
                <option value="">Select Word</option>
                <option value="w-1">Word-1</option>
                <option value="w-2">Word-2</option>
                <option value="w-3">Word-3</option>
                <option value="w-4">Word-4</option>
                <option value="w-5">Word-5</option>
                <option value="w-6">Word-6</option>
                <option value="w-7">Word-7</option>
                <option value="w-8">Word-8</option>
                <option value="w-9">Word-9</option>

                    
                </select>
            </div>
           
            

        </div>
        <input type="submit" name="save" value="submit" class="submit-btn">
    </form>

</div>    




<script>

document.querySelector('.card-number-input').oninput = () =>{
    document.querySelector('.card-number-box').innerText = document.querySelector('.card-number-input').value;
}

document.querySelector('.card-holder-input').oninput = () =>{
    document.querySelector('.card-holder-name').innerText = document.querySelector('.card-holder-input').value;
}

document.querySelector('.month-input').oninput = () =>{
    document.querySelector('.exp-month').innerText = document.querySelector('.month-input').value;
}

document.querySelector('.year-input').oninput = () =>{
    document.querySelector('.exp-year').innerText = document.querySelector('.year-input').value;
}

document.querySelector('.cvv-input').onmouseenter = () =>{
    document.querySelector('.front').style.transform = 'perspective(1000px) rotateY(-180deg)';
    document.querySelector('.back').style.transform = 'perspective(1000px) rotateY(0deg)';
}

document.querySelector('.cvv-input').onmouseleave = () =>{
    document.querySelector('.front').style.transform = 'perspective(1000px) rotateY(0deg)';
    document.querySelector('.back').style.transform = 'perspective(1000px) rotateY(180deg)';
}

document.querySelector('.cvv-input').oninput = () =>{
    document.querySelector('.cvv-box').innerText = document.querySelector('.cvv-input').value;
}

</script>






<script>
    $(document).ready(function(){
        $("#division").change(function(){
            var divisionId=$(this).val();
            $.ajax({
                method:"POST",
                url:"action.php",
                data:{idd:divisionId},
                // dataType:"html",
                success:function(data){
                    $("#district").html(data);
                }
            });
        });
        $("#district").change(function(){
            var districtId=$(this).val();
            $.ajax({
                method:"POST",
                url:"action.php",
                data:{iddi:districtId},
                // dataType:"html",
                success:function(data){
                    $("#upazila").html(data);
                }
            });
        });
        $("#upazila").change(function(){
            var upazila=$(this).val();
            $.ajax({
                method:"POST",
                url:"action.php",
                data:{thana:upazila},
                // dataType:"html",
                success:function(data){
                    $("#union").html(data);
                }
            });
        });
    });
</script>
<script src="jquery-3.5.1.min.js"></script>
</body>
</html>