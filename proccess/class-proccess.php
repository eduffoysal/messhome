<?php
	include('../db.php');
	session_start();

if(isset($_POST['melogin'])){
	if(isset($_POST['username'])){

		$usernamee=$_POST['username'];
        $username = $usernamee;

		$query="SELECT * FROM users WHERE phone_pass='$username' OR user_id='$username' OR phone='$username'";

        $queryr=mysqli_query($con,$query);


		if (mysqli_num_rows($queryr)>0){

			$row=mysqli_fetch_assoc($queryr);
			$_SESSION['user']=$row['unique_id'];
			$_SESSION['user_id']=$row['user_id'];
			$_SESSION['unique_id']=$row['unique_id'];
			$_SESSION['user_phone']=$row['phone'];
            echo 1;
		}
		else{
            echo $username;
			?>
  				<span>Login Failed. User not Found.</span>
  			<?php
		}
	}
}



if(isset($_POST['mesignup'])){


	if(isset($_POST['susername'])){
		$username=$_POST['susername'];
		$phone=$_POST['phone'];
		$classNum=$_POST['classnumber'];
		$mentorId=$_POST['mentorId'];

		if($_POST['mentorId'] == ''){
			$mess_id='';
		}else {
			$mess_id= $_POST['mentorId'];
		}

		    if(isset($_POST['roll'])){
					$roll=$_POST['roll'];
					$class=$_POST['class'];
					$sec=$_POST['sec'];
				}else{
					$roll='';
					$class='';
					$sec='';
				}


		// $phonee=$mentorId.''.$phone;
				$phonee=$phone;
		$query="SELECT * FROM users WHERE phone='$phonee'";

		$queryr=mysqli_query($con,$query);

		if (mysqli_num_rows($queryr)>0){
			?>
  				<span>Username already exist.</span>
  			<?php
		}

		elseif (!preg_match("/^[a-zA-Z0-9_]*$/",$classNum)){
			?>
  				<span style="font-size:11px;">Invalid Password. Space & Special Characters not allowed. Only (4-6) Numbers</span>
  			<?php
		}
		elseif (!preg_match("/^[a-zA-Z0-9_]*$/",$phone)){
			?>
  				<span style="font-size:11px;">Invalid Phone. Space & Special Characters not allowed.</span>
  			<?php
		}
		else{


			$qry = "SELECT user_id FROM users order by user_id desc";
	    $rslt = mysqli_query($con,$qry);
	    $row = mysqli_fetch_array($rslt);

			if(mysqli_num_rows($rslt)<1){
				$lastnumber='';
			}else {
				$lastnumber=$row['user_id'];
			}

	    if(empty($lastnumber)){
	        $number = "U-FF-0000001";
	    }else{
	        $idd = str_replace("U-FF-","",$lastnumber);
					$im= (int)$idd + 1;
	        $id = str_pad($im, 7,0, STR_PAD_LEFT);
	        $number = 'U-FF-' .$id;
	    }



			$ran_id = rand(time(), 100000000);
			$referr = strtoupper(bin2hex(random_bytes(1)));

			$std_id=$mentorId.''.$phone;

			$phoneId=$phone.''.$referr;
			$unique_id= $number.'-'.$phone;
			$user_type="member";

			$con->query("INSERT INTO users (user_name, phone, password, user_id, unique_id, user_type, phone_pass, mess_id) values ('$username', '$phone', '$classNum', '$number', '$unique_id', '$user_type', '$phoneId', '$mess_id')");

			echo $phoneId.' <br> <code>'.$referr.' এই নম্বরটি মনে রাখুন~ধন্যবাদ</code> <br>';
			?>
  				<span> ~ Sign up Successful.</span>
  			<?php
		}
	}


}

?>
