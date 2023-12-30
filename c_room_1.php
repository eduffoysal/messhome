<?php

session_start();
require_once 'db.php';


date_default_timezone_set("Asia/Dhaka");
$today=date("Y-m-d");
$time= date("h:i:s");


$list=array();
$month = date("m");
$year = date("Y");
$today = date("Y-m-d");
$totalDay = date('t');
$curm = date('m', strtotime('-1'));
$cury = date('Y', strtotime('-1'));
$curd = date('d', strtotime('-1'));
          
for($d=1; $d<=$totalDay; $d++)
{
    $time=mktime(12, 0, 0, $curm, $d, $cury);          
    if (date('m', $time)==$curm)       
        $list[]=date('Y-m-d', $time);
   
} 

$uni_id = strtoupper(bin2hex(random_bytes(3)));
$r_id = rand(time(), 100000000);





$user_phone=$_SESSION['user_phone'];
$postiid=$_SESSION['user'];

if(isset($_POST['section_id'])){
    echo "Hello Farhad Foysal";
}

if(isset($_POST['class_sections'])){




    $select = "SELECT * FROM payment WHERE mess_id='$my_mess_id'";
    $query = mysqli_query($con, $select);
    
    if(mysqli_num_rows($query) > 0){

        $im="SELECT * FROM all_student WHERE std_id='".$_SESSION["user"]."'";

        $imgs=mysqli_query($con,$im);
        $img=mysqli_fetch_assoc($imgs);

        while($datarow=mysqli_fetch_assoc($query)){

            $imc="SELECT * FROM class_section WHERE class_code='".$datarow["class_code"]."'";

            $imgsc=mysqli_query($con,$imc);
            $imgc=mysqli_fetch_assoc($imgsc);

            if($imgc['active']=='0'){
                $clr='warning';
                $clv=$datarow['class_code'];
            }else{
                $clr='success';
                $clv='Completed!';
            }

            ?>

                <div class="col-md-4">
                <div class="profile_boxx mb-2">
                        <i class="bi bi-pencil-square menu_class" id="sections_exams<?=$datarow['id']?>" data-bs-toggle="modal" data-bs-target="#section_exam<?=$datarow['id']?>"></i>                 
                        <i class="bi bi-rss-fill setting_class"></i>
                        <div class="class_pic_icon mb-1"></div>
                        <h3><?=$imgc['class_name']?></h3>
                        <p class="text-<?=$clr?>"><?=$clv?></p>
                        <button type="button" class="home_class " id=""><i class="bi bi-book-half"> Enter</i></button>
                        <div class="profile_button_class">
                            <p class="mt-2">Attendance <i class="bi bi-percent"></i> </p>
                            <i style="font-size: 25px; color: #ff574a;" class="bi bi-arrow-down-right-circle-fill attendence_classes_btn profile_button_icon" id="<?=$datarow['class_code']?>" onclick="attendence_class('<?=$datarow['class_code']?>')"><input type="date" name="" class="" id="attendence_today_date1<?=$datarow['class_code']?>" value="<?php echo isset($doc) ? date('Y-m-d',strtotime($doc)) :date('Y-m-d') ?>" hidden></i>
                        </div>                 
                </div>
                </div>


<div class="modal fade" id="section_exam<?=$datarow['id']?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
<div class="modal-content bg-light text-dark">
<div class="modal-header">
<!-- <h5 class="modal-title" id="staticBackdropLabel">Contact Page</h5> -->
<!-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> -->
</div>
<div class="modal-body">

<div class="container-fluid" id="exams_for_section<?=$datarow['id']?>">

<div class="container">
<h6 style="margin:0 auto; border: 2px solid; border-radius:6px;" class="text-center border-dotted text-danger" id="status_exam_<?=$datarow['id']?>"></h6>
        
</div>

</div>

</div>
<!-- <div class="modal-footer">
<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
<button type="button" class="btn btn-primary">Understood</button>
</div> -->
</div>
</div>
</div>


            <?php
        }
      

    }
    else{
        

        echo "<tr><td colspan='4'><h1> দুঃখীত! আপনি এখনও কোন ক্লাসে যুক্ত হননি! </h1></td></tr>";


    }

}        






// attendence ........

if(isset($_POST['students_attendence_class'])){

    $class_Id = $_POST['C_id'];
    
  
    $today = $_POST['today_date'];
  
    // $classq="SELECT * FROM class_section WHERE id='$class_Id' AND unique_id='$postiid'";
  
    // $classqr=mysqli_query($con,$classq);
    // $classr=mysqli_fetch_assoc($classqr);
    // $class_Code=$classr['class_code'];
    $class_Code=$class_Id;
  
    $stud_all="SELECT * FROM student_result WHERE class_code='$class_Code'";
    $stud_a=mysqli_query($con,$stud_all);
  
  
    ?>
        <div class="container-fluid text-center">
          <div class="row">
            <div class="col-8">
							<input type="date" name="doc" value="<?php echo isset($doc) ? date('Y-m-d',strtotime($doc)) :date('Y-m-d') ?>" id="attendence_today_date2<?=$class_Code?>" class="form-control">
						</div>
            <div class="col">
              <button class="btn btn-secondary get_attn_sheet_btn" id="<?=$class_Code?>"><i class="bi bi-search"></i></button>
            </div>

            <div class="col">
              <button class="btn btn-info indivisual_attn_sheet_btn" id="<?=$class_Code?>" data-bs-toggle="modal" data-bs-target="#indivisual_attn_sheet<?=$class_Code?>"><i class="bi bi-person"></i></button>
            </div>


 




          </div>
        </div>

          <div class="container-fluid text-center">
            <div class="row">
  
            </div>
  
            <div class="row">
              
          
  <div style="border-radius:6px; border:1px solid black" class="table-responsive bg-light text-dark">
  
  <h6 class="text-center text-warning" id="status_exam_sub_marks_up_all_<?=$class_Id?>" ></h6>
  <table class="table w-100 m-auto table-light table-hover table-stripedd table-borderd border-dark all_std_tableeee_class_students_<?=$class_Id?>" id="students_all_of_class_<?=$class_Id?>">
  
  <thead class="table-dark">
      <tr>
      <th><input type="checkbox" checked></th>
      <th>STD:NAME</th>
      <th class="">ATTENDENCE</th>
      <th class="">STD:ID</th>
      <th>DATE</th>     
      </tr>
  </thead>
  
          
  <tbody class="table-striped" id="all_studenttt">
  <?php
    if(mysqli_num_rows($stud_a) > 0){
  
      while($crow=mysqli_fetch_assoc($stud_a)){
  
            $std_a_id=$crow['std_id'];
            $att="SELECT * FROM std_attendance WHERE class_code='$class_Code' AND std_id='$std_a_id' AND date='$today'";
            $attt=mysqli_query($con,$att);
        ?>
  
  <tr>
  
    <th> <input type="checkbox" name="" class="" id="<?=$crow['std_id']?>"> </th>
    <th><?=$crow['std_name']?></th>
  
  
    <th>
  
    <?php
        if(mysqli_num_rows($attt) > 0){
  
           
          if($at=mysqli_fetch_assoc($attt)){
  
            if($at['attendance'] == 'p'){
                $colorbg='green';
              ?>
  
                <button style="background-color:red" class="badge btn btn-dange absent_up_btn absent_up_bttn_<?=$crow['std_id']?>" id="<?=$crow['std_id']?>">A</button>
                <button style="background-color:green;display:none" class="badge btn btn-dange a_to_p_up_btn a_to_p_up_bttn_<?=$crow['std_id']?>" id="<?=$crow['std_id']?>">P</button>
    
              <?php
  
            }else{ 
                $colorbg='red';
              ?>
  
                <button style="background-color:green" class="badge btn btn-primar present_up_btn present_up_bttn_<?=$crow['std_id']?>" id="<?=$crow['std_id']?>">P</button>
                <button style="background-color:red;display:none" class="badge btn btn-primar p_to_a_up_btn p_to_a_up_bttn_<?=$crow['std_id']?>" id="<?=$crow['std_id']?>">A</button>
  
              <?php
      
            }
          }
  
  
        }else{
            $colorbg='yellow';
          ?>
  
      <button style="background-color:green" class="badge btn btn-primar present_btn present_bttn_<?=$crow['std_id']?>" id="<?=$crow['std_id']?>">P</button>
      <button style="background-color:red" class="badge btn btn-dange absent_btn absent_bttn_<?=$crow['std_id']?>" id="<?=$crow['std_id']?>">A</button>
      <button style="background-color:green; display:none" class="badge btn btn-dange late_btn late_bttn_<?=$crow['std_id']?>" id="<?=$crow['std_id']?>">P</button>
      <button style="background-color:red; display:none" class="badge btn btn-dange late2_btn late2_bttn_<?=$crow['std_id']?>" id="<?=$crow['std_id']?>">A</button>
  
  
          <?php
        }
    ?>
  
    </th>
  
    <th style="background-color:<?=$colorbg?>;"><?=$crow['std_id']?><span class="present_status_std" id="present_status_std<?=$crow['std_id']?>"></span></th>
  
    <th><button class="badge btn btn-primary" id="<?=$crow['std_id']?>"> <?=$today ?></button> <input type="hidden" name="" class="" id="class_code_att_<?=$crow['std_id']?>" value="<?=$class_Code?>"> <input type="hidden" name="" class="" id="std_name_att_<?=$crow['std_id']?>" value="<?=$crow['std_name']?>"> <input type="hidden" name="" class="" id="today_date_id<?=$crow['std_id']?>" value="<?=$today?>"> </th>
  
  </tr>
  
        <?php
      }
  
    }else{
      echo "<tr><td colspan='4'><h3>Sorry! Student Not Found</h3></td></tr>";
    }
  
  ?>
  </tbody>    
        
        
        <tfoot class="table-dark">
          <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
  
          </tr>
        </tfoot>
  </table>
  
  </div>
  
            </div>
  
  
          </div>
  

            
<div class="modal fade" id="indivisual_attn_sheet<?=$class_Code?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
<div class="modal-dialog modal-xl modal-dialog-scrollable">
<div class="modal-content text-dark">
<div class="modal-body" >
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <p5 style="margin-left:5px" id="indivisual_attn_status<?=$class_Code?>" class="text-danger"> </p5>

                <?php
                                $stdntId=$_SESSION['user'];
                                $attt="SELECT * FROM std_attendance WHERE class_code='$class_Code' AND std_id='$stdntId'";
                                $atttt=mysqli_query($con,$attt);
                                $nr=mysqli_num_rows($atttt);
                                
                                $stdntId=$_SESSION['user'];
                                $ataa="SELECT * FROM std_attendance WHERE class_code='$class_Code' AND std_id='$stdntId' AND attendance='p'";
                                $ata=mysqli_query($con,$ataa);
                                $nrr=mysqli_num_rows($ata);
                                $abs=($nr-$nrr);
                                if($nr=='0'){
                                    $all_p=1;
                                }else{
                                    $all_p=$nr;
                                }
                                $per=($nrr*100)/$all_p;
                ?>

                <div class="alert alert-success alert-dismissible fade show" role="alert">
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                <h4 class="alert-heading">Summary Of Attendance!</h4>
                <p>Present Days out of Working Days:&nbsp;<strong><?=$nrr;?>/<?=$nr?> </strong></p>
                <hr>
                <span>Attendance Percentage:<?php?>&nbsp;<strong>&nbsp;<?=$per?>%</strong></span>
                </div>           

                        <!-- <input type="text" id="class_code<?=$sc['class_code']?>" name="classCode" value="<?=$sc['class_code']?>" hidden> -->



<div class="container text-center">
    <div class="row"  data-toggle="validator">
        <div class="col-4" data-provide="datepicker">
        <input type="text" id="<?=$class_Code?>" name="classId" value="<?=$class_Code?>" hidden>
        <!-- <label for="select" class="control-label">From:</label> -->
					<input type="date" name="sdate" class="form-control"  id="sdate<?=$class_Code?>" required>
        </div>
        <div class="col-4" data-provide="datepicker">
        <!-- <label for="select" class="control-label">To:</label> -->
					<input type="date" name="edate" class="form-control" value="<?php echo isset($edate) ? date('Y-m-d',strtotime($edate)) :date('Y-m-d') ?>" id="edate<?=$class_Code?>" required>
        </div>
        <div class="col-4">
        <input type="hidden" name="page" value="reports">
				<button type="button" class="btn btn-danger filter_attn_btn" id="<?=$class_Code?>" name="submit" style='border-radius:0%;'><i class="bi bi-filter"></i> Filter Student</button>
        </div>
    </div>
</div>
                        
            <div class="container-fluid" id="indivisual_sheet<?=$class_Code?>">  
                
            </div>   
            <div class="container-fluid">
                    
                    <div style="border-radius:6px; border:1px solid black" class="table-responsive bg-light text-dark">

                        <table class="table w-100 m-auto table-light table-hover table-striped table-borderd border-dark indivisual_attn_sheet_tbl_class<?=$class_Code?>" id="indivisual_attn_sheet_tbl<?=$class_Code?>">
                        
                        </table>

                    </div>
                    
            </div>               

</div>
</div>
</div>
</div>






    <?php
      
  }
  
  

if(isset($_POST['filter_attendance'])){
    // echo "Hi Farhad Foysal";
    // echo $_POST['sdate'];
    // echo $_POST['edate'];
?>

    
<div class="container-fluid">
<div class="row">
  <div class="">
  
    <p>&nbsp;</p>
    <div class="report-data">
    
    
    <?php

      
      $t=time();
    

      if(isset($_POST['sdate']) && !empty($_POST['sdate']) && !empty($_POST['edate']) && ($_POST['edate'] > $_POST['sdate']) && ($_POST['sdate']<$t) && ($_POST['edate']<$t))
      {
        $sdat = $_POST['sdate'];
        $edat= $_POST['edate'];

        $classCode=$_POST['id'];
        
        $sdate = strtotime($sdat);
        
        $edate = strtotime($edat);
        
      
      if(($sdate<$t) && ($edate<=$t) && ($edate >= $sdate))
      {

      ?>
          
                 <table class="table tabele-striped table-hover reports-table">
                   <thead>
                     <tr>
                       <th class="text-center">S.N</th>
                       <th class="text-center">Name</th>
                       <th class="text-center">ToTal</th>
                       <th class="text-center">Percentage</th>
                       <th class="text-center">ID</th>
                       <?php
                        					for($k=$sdate;$k<=$edate;$k=$k+86400)
                                  {
                                      $thisDate=date('Y-m-d',$k);
                                      echo "<th style='font-size:14px' class='text-center'>".$thisDate."</th>";
                                    
                                  }
                       ?>
                     </tr>
                   </thead>
                   <tbody>
                     
                     <?php
                             $query_student = "SELECT * From student_result WHERE class_code='$classCode'  ORDER BY id";
                             $stu=mysqli_query($con,$query_student);
                     
                                  $si=1;
                                  while($rstu=mysqli_fetch_assoc($stu)){
                                    $dsid=$rstu['std_id'];


                                    $stdnId=$dsid;
                                    $attt="SELECT * FROM std_attendance WHERE class_code='$classCode' AND std_id='$stdnId' AND date(`date`) BETWEEN '$sdat' AND '$edat'";
                                    $atttt=mysqli_query($con,$attt);
                                    $nrs=mysqli_num_rows($atttt);
                                    
                                    $stdntId=$dsid;
                                    $ataa="SELECT * FROM std_attendance WHERE class_code='$classCode' AND std_id='$stdnId' AND attendance='p' AND date(`date`) BETWEEN '$sdat' AND '$edat'";
                                    $ata=mysqli_query($con,$ataa);
                                    $nrrs=mysqli_num_rows($ata);
                                    $abs=($nrs-$nrrs);
                                    if($nrs=='0'){
                                        $all_p=1;
                                    }else{
                                        $all_p=$nrs;
                                    }
                                    $pers=($nrrs*100)/$all_p;


                                    ?>
                                      <tr>
                                          <td class="text-center"><h6><?=$si++?></h6></td>
                                          <td class="text-center"><?=$rstu['std_name']?></td>
                                          <td class="text-center"><strong><?=$nrrs?>/<?=$nrs?></strong></td>
                                          <td class="text-center"><strong><?=$pers?> %</strong></td>
                                          <td style="font-size:10px" class="text-center"><?=$rstu['std_id']?></td>
                                        <?php
                                          for($j=$sdate;$j<=$edate;$j=$j+86400)
                                          {
                                            //$thisDate = date( 'Y-m-d', $j );
                                            //echo "$j"."=".$thisDate."<br>";
                                      
                                              
                                            $dd=date('Y-m-d',$j);


                                              $sql = "SELECT * FROM std_attendance WHERE std_id='$dsid' AND
                                              class_code='$classCode' AND date='$dd' " ;
                                              $stmt = mysqli_query($con,$sql); 
                                              
                                              $result = mysqli_fetch_assoc($stmt);
                                              $numre=mysqli_num_rows($stmt); 
                                              // echo $dd;
                                              if($numre>0){
                                              //print_r($result);
                                                
                                                if($result['attendance']=='p')
                                                {
                                                  
                                                  echo"<td class='bg-light text-center'><span class='text-success'><i class='bi bi-check2-all'> </i> <i class='bi bi-pencil'></i></i></span></td>";
                                                }
                                                else
                                                {
                                                  echo"<td class='bg-warning text-center'><span class='text-danger'><i class='bi bi-x-lg'></i>/span></td>";
                                                  
                                                }
                                              }else
                                              {
                                                // echo "<td>farhad</td>";
                                                echo "<td class='text-secondary text-center'> <i class='bi bi-exclamation-lg'>  </td>";
                                              }
                                            
                                          }
                                          ?>

                                      </tr>
                                    <?php
                                  }
                      
                     ?>
                    <tr>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                    </tr>
                   </tbody>
                 </table>  

<?php


				}else
				{
					print '<div class="alert alert-dismissible alert-danger">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>Sorry!</strong>Please enter correct date range.
              </div>';
				}


				}else{
         echo"<h3>Please enter detail</h3>";
      }



    ?>
    </div>
  </div>
</div>
</div>

<?php

}

?>