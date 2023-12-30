<script src="jquery-3.4.1.min.js"></script>
      <script type="text/javascript">
        // $(document).ready(function(){
        //     $('.hi').click(function(){
        //         $('.pagination').find('.page-link.active').next().addClass('active');
        //         $('.pagination').find('.page-link.active').prev().removeClass('active');
        //     })
        //     $('.hlw').click(function(){
        //         $('.pagination').find('.page-link.active').prev().addClass('active');
        //         $('.pagination').find('.page-link.active').next().removeClass('active');
        //     })
        // })

      </script>


<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SweetAlert</title>
    <link rel="stylesheet" href="bootstrap.min.css">
</head>
<body>
    
    <br><br>
    <br><br>
    <button class="btn btn-warning" onclick='mfarh()'>MF FoYs@L </button>
    <button class="btn btn-warning" onclick='mfarha()'>MF FoYs@L </button>
    <button class="btn btn-warning" onclick='mfarhad()'>MF FoYs@L </button>
    <button class="btn btn-info" onclick='foysal()'>MF FoYs@L Input</button>
    <button class="btn btn-info" onclick='farhad()'>MF FoYs@L</button>
    <button class="btn btn-primary" onclick='mff()'>MF1</button>
    <button class="btn btn-primary" onclick='mf()'>MF</button>
    <button class="btn btn-primary" onclick='show()'>Preview</button>
    <button class="btn btn-primary" onclick='hi()'>click</button>
    <button class="btn btn-primary" onclick='hlw()'>click me</button>
    <button class="btn btn-primary" onclick='swal("Result","You have clicked me!!!","success")'>Preview2</button>
    <button class="btn btn-primary" onclick='swal({
            title: "MF FOYs@L",
            text: "Clicked Successfully",
            icon: "success",
            button: "Allah Hafez",
        });'>Preview3</button>
    <button class="btn btn-primary" onclick='swal("Clicked on either the button or outside the modal.").then((value) => {
            swal(`Success: ${value}`);
        });'>Preview4</button>



<script src="bootstrap.bundle.js"></script>

<script src="sweetalert.min.js"></script>
<!-- <script src="sweetalert2.All.min.js"></script> -->
<script>
    function mfarh() {
        // swal.fire({
        //     imageUrl: 'image/bg.jpg',
        //     imageHeight: '350',
        //     imageAlt: 'A tall image'
        // })
        // swal.fire({
        //     title: '<strong>HTML <u>example</u></strong>',
        //     icon: 'info',
        //     html:'you can use <b>bold text</b>, ' + '<a href="mffoysal.xyz"><links</a> ' + 'and other HTML tags',
        //     showClouseButton: true, 
        //     showCancelButton: true,
        //     focusConfirm: false,
        //     confirmButtonText: '<i class=""></i>Great!',
        //     confirmButtonAriaLabel: 'Thumbs up, great!',
        //     cancelButtonText: '<i class=""></i>',
        //     cancelButtonAriaLabel: 'Thumbs down'
        // });
        // swal.fire({
        //     position: 'top-end',
        //     icon: 'success',
        //     title: 'Your work has been saved!',
        //     showConfirmButton: false,
        //     timer: 1500,
        //     timerProgressBar: true,
        // })

        //     didOpen: () => {
        //         swal.showloading()
        //         timerInterval = setInterval(() => {
        //             const content = Swal.getHtmlContainer()
        //             if (content){
        //                 const b = content.querySelector('b')
        //                 if (b) {
        //                     b.textContent = swal.getTimerLeft()
        //                 }
        //             }
        //         }, 100);
        //     },
        //     willClose: () => {
        //         clearInterval(timerInterval)
        //     }
        // }).then((result) => {
            
        //     if(result.dismiss === swal.DismissReason.timer) {
        //         console.log('I was closed by the timer')
        //     }
        
        // swal.fire({
        //     title: 'Custom aimantion with Animate.css',
        //     ShowClass: {
        //         popup: 'animate__animated animate__fadeINDown'
        //     },
        //     hideClass: {
        //         popup: 'animate__animated animate__fadeOutUP'
        //     }
        // })

    }

    function mfarha(){
        swal.fire(
            {
            icon: "error",
            title: "OOPs!",
            text: "Something went wrong...",
            button: "okay!",
            footer: "<a href='mffoysal.xyz'>Why do I have this issue?</a>"
            }
        )
    }
        
    function mfarhad(){
        swal.fire(
        "Good job", "You cliked the button","question"
    )
    }

    function foysal() {
        swal('Write something:',{
            content: "input",
        })
        .then((value) => {
            swal('HI',`${value}`);
        });
    }
        
    function farhad() {
        swal('what do you want to do?', {
            buttons: {
                cencel: "NO",
                catch: {
                    text: 'Yes',
                    value: 'catch',
                },
                defeat: 'OKay',
            },
        })
        .then((value) => {
            switch (value) {
                case "defeat":
                swal("Defeat!");
                break;
                case "catch":
                swal("Catch");
                break;
                default:
                swal("GO AWAY SAFELY!");
            }
        });             
    }
    function mff() {
        swal("hi","Are you sure you want to do this?", {
            buttons: ['OOH no!', 'Yes'],
        });
    }
    function mf() {
        swal({
            title: "Are you sure?",
            text: "Once deleted, you will not be able to recover this imaginary file!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        }).then((willDelete) => {
            if (willDelete){
            swal("Hi, Your imaginary file has been deleted!", {
                icon: "success",
            });
        } else{
            swal("Your imaginary file is safe!");
        }
       
        });

    }
    function hlw() {
        swal({
            title: "MF FOYs@L",
            text: "Clicked Successfully",
            icon: "success",
            button: "Allah Hafez",
            timer: 1500,
            
            
        });
    }

    function hi() {
        swal("Clicked on either the button or outside the modal.").then((value) => {
            swal(`Success: ${value}`);
        });
    }
    function show(){
        swal("Result","You have clicked me!!!","error");
    }
    
</script>


</body>
</html>