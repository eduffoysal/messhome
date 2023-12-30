<?php
session_start();
require_once 'db.php';
if(isset($_SESSION['user'])){
    $unique_id=$_SESSION['user'];
    $my_mess_id=$_SESSION['my_mess_id'];
    $me=$unique_id;
}



$today = date("Y-m-d");
$u_id='';
$action='';
$na='';
$my_name='User NOt Found!';
$my_phone='Unavailable Phone Number';
$img='';
$sokal=0;
$dupur=0;
$rat=0;
$id='i';
$Myid='';


// echo "<pre>";
// print_r($_GET);
if(isset($_REQUEST['u_id'])){
    // echo $_REQUEST['u_id'].'<br>';
    $u_id = $_REQUEST['u_id'];

    $query1="SELECT * FROM users WHERE qr='$u_id'";
    $result1=mysqli_query($con,$query1);
    if(mysqli_num_rows($result1)==1){
       $rowr=mysqli_fetch_assoc($result1);
       $my_name=$rowr['user_name'];
       $my_phone=$rowr['phone'];
       $img=$rowr['img'];
        $_SESSION['userr']=$rowr['unique_id'];
        $_SESSION['my_mess_id']=$rowr['mess_id'];
       $unique_id=$_SESSION['userr'];
       $my_mess_id=$_SESSION['my_mess_id'];
       $Myid=$unique_id;


       $queryd = mysqli_query($con,"SELECT * FROM my_meals WHERE unique_id='$unique_id' AND date='$today' AND mess_id='$my_mess_id' ");
       $numr=mysqli_num_rows($queryd);
       $qru=mysqli_fetch_assoc($queryd);

       if($numr==1){
        $sokal=$qru['morning'];
        $dupur=$qru['launce'];
        $rat=$qru['dinner'];
        $id=$qru['id'];
       }else{
        $sokal=0;
        $dupur=0;
        $rat=0;
        $id='i';
       }


    }else{
       header('location:../../c/?error=দুঃখিত! আপনার দেয়া রেফারেল কোড সঠিক নয়...');
$u_id='';
$action='';
$na='';
$my_name='User NOt Found!';
$my_phone='Unavailable Phone Number';
$img='';
$sokal=0;
$dupur=0;
$rat=0;
$id='i';

    }

}
if(isset($_REQUEST['action'])){
    // echo $_REQUEST['action'];   
    $action = $_REQUEST['action'];
}
if(isset($_REQUEST['name'])){
    $na = $_REQUEST['name'];   
}


?>

<!DOCTYPE html>
<html lang="">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?=$my_name?> QR</title>

    <script src="https://kit.fontawesome.com/a076d05399.js"></script>

<script src="https://code.jquery.com/jquery-3.4.1.js"></script>


<script src="https://kit.fontawesome.com/a076d05399.js"></script>
<link rel="stylesheet" href="icon/bootstrap-icons.css">

<!-- <script src="ck/ckeditor.js"></script> -->
<!-- <script src="f/admin/ckeditor/ckeditor.js"></script> -->

<script src="//cdn.ckeditor.com/4.16.2/full/ckeditor.js"></script>

<script src="jquery-3.5.1.min.js"></script>

<!-- <link rel="stylesheet" href="css/user.css"> -->

<link rel="stylesheet" href="dist/styles.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

<link rel="stylesheet" href="https://unpkg.com/flowbite@1.5.3/dist/flowbite.min.css" />
<script src="https://unpkg.com/flowbite@1.5.3/dist/flowbite.js"></script>
<script src="./TW-ELEMENTS-PATH/dist/js/index.min.js"></script>
<!-- <script src="https://cdn.jsdelivr.net/npm/tw-elements/dist/js/index.min.js"></script> -->

<link rel="stylesheet" href="node_modules/tw-elements/dist/css/index.min.css" />
<!-- <script src="node_modules/tw-elements/dist/js/index.min.js"></script> -->
<script src="node_modules/flowbite/dist/flowbite.js"></script>


<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.css">

<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.js"></script>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.6.0/font/bootstrap-icons.css">

<!-- <link rel="stylesheet" href="dist/styles.css"> -->

<link rel="stylesheet" href="css/carousel_and_other.css">

<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">

<link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
<link rel="stylesheet" href="css/select-menu.css">
<!-- <link rel="stylesheet" href="css/color.css"> -->
<!-- <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'> -->

<style>
/* Google Font Import - Poppins */
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');
*{
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Poppins', sans-serif;
}
body{
    overflow: hidden;
}
section{
    position: relative;
    height: 100vh;
    width: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
}
section .profile{
    display: flex;
    align-items: center;
    flex-direction: column;
    justify-content: center;
}
section.show .profile{
    display: none;
}
section .profile .profile-img{
    height: 100px;
    width: 100px;
    border-radius: 50%;
    background: #4070f4;
    padding: 2px;
    margin-bottom: 10px;
}
.profile .profile-img img{
    height: 100%;
    width: 100%;
    object-fit: cover;
    border-radius: 50%;
    border: 3px solid #fff;
}
.profile .name,
.profile .profession{
    font-size: 18px;
    font-weight: 500;
    color: #333;
}
.profile .profession{
    font-weight: 400;
    margin-top: -6px;
}
.profile .button{
    display: flex;
    align-items: center;
    padding: 12px 20px;
    background: #4070f4;
    margin-top: 15px;
    border-radius: 6px;
    cursor: pointer;
    transition: all 0.3s ease;
}
.profile .button:hover{
    background: #275df1;
}
.profile .button i{
    color: #fff;
    font-size: 18px;
    margin-right: 5px;
}
.profile .button button{
    background: none;
    outline: none;
    border: none;
    font-size: 16px;
    color: #fff;
    pointer-events: none;
}

section .popup-outer{
    position: absolute;
    display: flex;
    align-items: center;
    justify-content: center;
    height: 100%;
    width: 100%;
    background: rgba(0,0,0,0.4);
    opacity: 0;
    pointer-events: none;
    box-shadow: 0 10px 15px rgba(0,0,0,0.1);
    transform: scale(1.2);
    transition: all 0.3s ease-in-out;
}
section.show .popup-outer{
    opacity: 1;
    pointer-events: auto;
    transform: scale(1);
}
section .popup-box{
    position: relative;
    padding: 30px;
    max-width: 380px;
    width: 100%;
    background: #fff;
    border-radius: 12px;
}
.popup-box .close{
    position: absolute;
    top: 16px;
    right: 16px;
    font-size: 24px;
    color: #b4b4b4;
    cursor: pointer;
    transition: all 0.2s ease;
}
.popup-box .close:hover{
    color: #333;
}
section .popup-box .profile-text{
    display: flex;
    align-items: center;
}
section .popup-box img{
    height: 60px;
    width: 60px;
    object-fit: cover;
    border-radius: 50%;
} 
.profile-text .text{
    display: flex;
    flex-direction: column;
    margin-left: 15px;
}
.profile-text .text .name{
    font-size: 14px;
    font-weight: 400;
}
.profile-text .text .profession{
    font-size: 12px;
    font-weight: 500;
}
section .popup-box textarea{
    min-height: 140px;
    width: 100%;
    margin-top: 20px;
    outline: none;
    border: 1px solid #ddd;
    padding: 12px;
    border-radius: 6px;
    resize: none;
    font-size: 14px;
    font-weight: 400;
    background: #f3f3f3;
}
section .popup-box .button{
    display: flex;
    justify-content: flex-end;
    margin-top: 15px;
}
.popup-box .button button{
    outline: none;
    border: none;
    padding: 6px 12px;
    border-radius: 6px;
    background: #6f93f6;
    margin-left: 8px;
    color: #fff;
    font-size: 14px;
    cursor: pointer;
    transition: all 0.3s ease;
}
.button button.cancel{
    background: #f082ac;
}
.button button.cancel:hover{
    background: #ec5f95;
}
.button button.send:hover{
    background: #275df1;
}

.wrapper_in{
  height: 50px;
  min-width: 300px;
  display: flex;
  align-items: center;
  justify-content: center;
  background: #FFF;
  border-radius: 12px;
  box-shadow: 0 5px 10px rgba(0,0,0,0.2);
}
.wrapper_in span{
  width: 100%;
  text-align: center;
  font-size: 35px;
  font-weight: 600;
  cursor: pointer;
  user-select: none;
}
.wrapper_in span.num{
  font-size: 35px;
  border-right: 2px solid rgba(0,0,0,0.2);
  border-left: 2px solid rgba(0,0,0,0.2);
  pointer-events: none;
}

</style>

</head>
<body>
    
<input type="hidden" name="" value="<?$Myid?>" id="MyId">
<section>
        <div class="profile">
            <div class="profile-img">
                <img src="<?=$img?>" alt="">
            </div>
            <span class="name"><?=$my_name?></span>
            <span class="profession">+88<?=$my_phone?></span>
            <div id="hireBtn" class="button">
                <i class="bx bxs-envelope"></i>
                <button>SetUp</button>
            </div>
        </div>

        <!-- popup box start -->
        <div class="popup-outer">
            <div class="popup-box">
                <i id="close" class="bx bx-x close"></i>
                <div class="profile-text">
                    <img src="<?=$img?>" alt=""> 
                    <div class="text">
                        <span class="name"><?=$my_name?></span>
                         <span class="profession">+88<?=$my_phone?></span>
                    </div>
                </div>
                <form action="#">
                <?php


                ?>

                <div class="wrapper_in">
                    <span class="minus minus_1" onclick="minus_update('<?=$id?>')">-</span>
                    <span class="num num_1" id="m_p_loop_<?=$id?>"><?=$sokal?></span>
                    <span class="plus plus_1" onclick="plus_update('<?=$id?>')">+</span>
                </div>
                <div class="wrapper_in mt-1">
                    <span class="minus minus_1" onclick="minus_updatee('<?=$id?>')">-</span>
                    <span class="num num_1" id="m_p_loops_<?=$id?>"><?=$dupur?></span>
                    <span class="plus plus_1" onclick="plus_updatee('<?=$id?>')">+</span>
                </div>
                <div class="wrapper_in mt-1">
                    <span class="minus minus_1" onclick="minus_updateee('<?=$id?>')">-</span>
                    <span class="num num_1" id="m_p_loopss_<?=$id?>"><?=$rat?></span>
                    <span class="plus plus_1" onclick="plus_updateee('<?=$id?>')">+</span>
                </div>
                    <!-- <textarea spellcheck="false" placeholder="Enter your message"></textarea> -->
                    <div class="button">
                        <button id="close" class="cancel">Cancel</button>
                        <button class="send" onclick="closeWindow()">Send</button>
                    </div>
                </form>
            </div>
        </div>
    </section>

<script>
function closeWindoww(){

    // alert("hi");
    // window.open('', '_self', '');
    // open(location, '_self').close();
    // window.location.replace('../../close');
    // var objwin = window.open(location, "_self").close();
        // window.close();

}

</script>

    <script>
        const section = document.querySelector("section"),
      hireBtn = section.querySelector("#hireBtn"),
      closeBtn = section.querySelectorAll("#close"),
      textArea = section.querySelector("textarea");
 
      hireBtn.addEventListener("click" , () =>{
        section.classList.add("show");
      });

      closeBtn.forEach(cBtn => {
        cBtn.addEventListener("click" , ()=>{
            section.classList.remove("show");
            textArea.value = "";
        });
      });
    </script>







<script type="text/javascript">
    function minus_update(id){
      
      jQuery.ajax({
        url:'../../m_p.php',
        type:'post',
        data:'type=minus&id='+id,
        success:function(result){
          var cur_count=jQuery('#m_p_loop_'+id).html();
          cur_count--;
          jQuery('#m_p_loop_'+id).html(cur_count);
        //   $('#load_videos').load('getdata7.php');
        if(result==1){

        }else if(result=2){
                setTimeout(function(){
                    location.reload()
                },1000)
        }else{

        }

        }
      })
    }
    function plus_update(id){
      
      jQuery.ajax({
        url:'../../m_p.php',
        type:'post',
        data:'type=plus&id='+id,
        success:function(result){
          var cur_count=jQuery('#m_p_loop_'+id).html();
          cur_count++;
          jQuery('#m_p_loop_'+id).html(cur_count);
        //   $('#load_videos').load('getdata7.php');
        if(result==1){

}else if(result=2){
        setTimeout(function(){
            location.reload()
        },1000)
        // alert(result);
}else{

}
        }
      })
    }
    function minus_updatee(id){
      
      jQuery.ajax({
        url:'../../m_p.php',
        type:'post',
        data:'type=minuss&id='+id,
        success:function(result){
          var cur_count=jQuery('#m_p_loops_'+id).html();
          cur_count--;
          jQuery('#m_p_loops_'+id).html(cur_count);
        //   $('#load_videos').load('getdata7.php');
        if(result==1){

}else if(result=2){
        setTimeout(function(){
            location.reload()
        },1000)
}else{

}

        }
      })
    }
    function plus_updatee(id){
      
      jQuery.ajax({
        url:'../../m_p.php',
        type:'post',
        data:'type=pluss&id='+id,
        success:function(result){
          var cur_count=jQuery('#m_p_loops_'+id).html();
          cur_count++;
          jQuery('#m_p_loops_'+id).html(cur_count);
        //   $('#load_videos').load('getdata7.php');
        if(result==1){

}else if(result=2){
        setTimeout(function(){
            location.reload()
        },1000)
}else{

}
        }
      })
    }
    function minus_updateee(id){
      
      jQuery.ajax({
        url:'../../m_p.php',
        type:'post',
        data:'type=minusss&id='+id,
        success:function(result){
          var cur_count=jQuery('#m_p_loopss_'+id).html();
          cur_count--;
          jQuery('#m_p_loopss_'+id).html(cur_count);
        //   $('#load_videos').load('getdata7.php');
        if(result==1){

}else if(result=2){
        setTimeout(function(){
            location.reload()
        },1000)
}else{

}
        }
      })
    }
    function plus_updateee(id){
      
      jQuery.ajax({
        url:'../../m_p.php',
        type:'post',
        data:'type=plusss&id='+id,
        success:function(result){
          var cur_count=jQuery('#m_p_loopss_'+id).html();
          cur_count++;
          jQuery('#m_p_loopss_'+id).html(cur_count);
        //   $('#load_videos').load('getdata7.php');
        if(result==1){

}else if(result=2){
        setTimeout(function(){
            location.reload()
        },1000)
}else{

}
        }
      })
    }
</script>
<script type="text/javascript">



$(document).ready(function(){
    
    $('#MyId').ready(function(){

      var user_id  = $(this).val();
      Swal.fire({
        title: 'Are you sure!?',
        text: 'আপনার একটি মিল লিখতে, নিচের হ্যা বাটনে ক্লিক করুন',
        type: 'warning',
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'হ্যা!',

      }).then((resultm) => {

          if(resultm.value){
            $.ajax({
              url:'../../m_p.php',
              type:'post',
              data: {
                user_id: user_id,
                UserMeal: true,
              },
              success: function(response){

                if(response==1){

                  Swal.fire({
                    type: 'success',
                    title: "ধন্যবাদ",
                    text: "আপনার সকালের মিল লিখা হয়েছে!",
                    icon: "success",
                    button: false,
                    dangerMode: true,
                    timer: 3000,
                  })
                  // $(".all_button").trigger("click");

                }else if(response==8){

                    Swal.fire({
                    type: 'success',
                    title: "ধন্যবাদ!",
                    text: "আপনার সব মিল লিখা হয়েছে! ",
                    icon: "success",
                    button: false,
                    dangerMode: true,
                    timer: 3000,
                    })
                    // $(".all_button").trigger("click");
                    // setTimeout(function(){
                    //     location.reload();
                                    
                    // }, 3000);

                }
                else if(response==2){

                Swal.fire({
                    type: 'success',
                    title: "ধন্যবাদ!",
                    text: "আপনার দুপুরের মিল লিখা হয়েছে!",
                    icon: "success",
                    button: false,
                    dangerMode: true,
                    timer: 3000,
                  })


                }else if(response==3){

                Swal.fire({
                type: 'info',
                title: "Sorry! Maintain meal Time!",
                text: "দুঃখিত! সময়মত! যথাসময়ে মিল দিন !",
                icon: "info",
                button: false,
                dangerMode: true,
                timer: 3000,

                })


                }else if(response==5){

                Swal.fire({
                type: 'info',
                title: "Sorry! Maintain your Launch meal Time",
                text: "দুঃখিত! দুপুর ১১টা ৫৯ মি এর আগে দুপুরের মিল দিন",
                icon: "info",
                button: false,
                dangerMode: true,
                timer: 3000,

                })


                }
                else if(response==4){

                    Swal.fire({
                    type: 'info',
                    title: "Sorry! Maintain your dinner meal Time",
                    text: "দুঃখিত! সন্ধ্যা ৬টা ৫৯ মি এর আগে রাতের মিল দিন",
                    icon: "info",
                    button: false,
                    dangerMode: true,
                    timer: 3000,
                    })
                    // $(".all_button").trigger("click");


                }else if(response==6){


                Swal.fire({
                    type: 'success',
                    title: "ধন্যবাদ!",
                    text: "আপনার রাতের মিল লিখা হয়েছে!",
                    icon: "success",
                    button: false,
                    dangerMode: true,
                    timer: 3000,
                })


                }else if(response==7){


                    Swal.fire({
                    type: 'info',
                    title: "Sorry! Maintain Launch meal Time",
                    text: "দুঃখিত! সকাল ৬টা ৫৯ মি এর আগে সকালের মিল দিন",
                    icon: "info",
                    button: false,
                    dangerMode: true,
                    timer: 3000,
                })


                }else if(response==9){


                Swal.fire({
                    type: 'success',
                    title: "ধন্যবাদ!",
                    text: "আপনার সব মিল আগেই লিখা হয়েছে!",
                    icon: "success",
                    button: false,
                    dangerMode: true,
                    timer: 3000,
                })


                }else{
                  Swal.fire({
                    type: 'info',
                    title: "Try again!",
                    text: "Something went wrong!",
                    icon: "info",
                    button: false,
                    dangerMode: true,
                    timer: 3000,

                  })


                }

              }
            });
              
          }else{
            Swal.fire({
              type: 'info',
              title: "Try again!",
              text: "Something went wrongg!",
              icon: "info",
              button: false,
              dangerMode: true,
              timer: 3000,

            })

            // closeWindoww();
                // setTimeout(function(){
                //       let new_w =  open(location, '_self');
                //         new_w.close();

                //     },1000)

                    // let new_w =  open(location, '_self');
                    //     new_w.close();

          }

      })




    });



 

  });



</script>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/5.4.5/js/swiper.min.js"></script>
<script type="text/javascript" src="script.js"></script>
<script type="text/javascript" src="user.js"></script>
<script type="text/javascript" src="mess/meal.js"></script>

<script src="../../sweetalert.min.js"></script>
<script src="../../sweetalert2.all.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/5.4.5/js/swiper.min.js"></script>
<script src="js/validator.min.js"></script>
<!-- <script src="sweetalert.min.js"></script> -->

<!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js" ></script> -->
<!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.min.js" ></script> -->
<script src="//cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
<!-- <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script> -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js" integrity="sha384-eMNCOe7tC1doHpGoWe/6oMVemdAVTMs2xqW4mwXrXsW0L84Iytr2wi5v2QjrP/xp" crossorigin="anonymous"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>
</html>