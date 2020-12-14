@extends('layouts.app')

@section('content')

<div class="container-fluid custom-padding">
    <div class="row" style="height: 77vh !important">
        <div class="col-md-8 h-100" >
            <div class="card card-cascade narrower" >
                <div class="view view-cascade gradient-card-header blue-gradient ">
                    <div class="row">
                        <div class="col-md-12 ">
                            <h5 class="mt-3">CAMERA VIDEO/AUDIO</h5>
                        </div>
                    </div>
                </div>
                <div class="card-body card-body-cascade" id="video">
                    <!--<img src="http://192.168.137.202:8000/stream.mjpg " width="100%" height="100%">-->
                </div>
            </div>
        </div>
        <div class="col-md-4 h-100" style="padding-left: 10px !important">
            <div>
                <div class="card card-cascade narrower " >
                    <div class="view view-cascade gradient-card-header blue-gradient">
                        <div class="row">
                            <div class="col-md-12 ">
                                <h5 class="mt-3">THERMAL VIDEO</h5>
                            </div>
                        </div>
                    </div>
    
                    <div class="card-body card-body-cascade text-center" style="height: 24rem">
                        <video controls width="100%" height="100%">
                            <source src="" type="video/ogg">Your browser does not support the video tag.
                        </video>
                    </div>
    
                </div>
            </div>
            <div  class="pt-4">
                <div class="card card-cascade narrower">
                    <div class="view view-cascade gradient-card-header blue-gradient">
                        <div class="row">
                            <div class="col-md-12 ">
                                <h5 class="mt-3">MAPS</h5>
                            </div>
                        </div>
                    </div>
                    <div class="card-body card-body-cascade text-center">
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d8149837.481632142!2d105.12235203708242!3d4.138917011901269!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3034d3975f6730af%3A0x745969328211cd8!2sMalaysia!5e0!3m2!1sen!2ssg!4v1583769592445!5m2!1sen!2ssg"
                            width="100%" height="100%" frameborder="0" style="border:0;" allowfullscreen=""></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12 pt-3">
            <div class="card-footer unique-color-dark text-center text-white mt-4">
                Hint! : Use W,S,A and D to move to up,down,right and left. <br> To capture both picture and thermal image,
                press
                ctrl+C;
            </div>
        </div>
    </div>
</div>


<script>
    function testImage(URL) {
        var tester = new Image();
        tester.onload = imageFound;
        tester.onerror = imageNotFound;
        tester.src = URL;
    }

    function imageFound() {
        console.log("found");
        $('#video').append('<img src="http://192.168.137.202:8000/stream.mjpg" style="object-fit:cover;" width="100%" height="100%">')
    }

    function imageNotFound() {
        console.log("notfound");
        $('#video').append(
            '<video controls width="100%" height="100%"><source src="" type="video/ogg">Your browser does not support the video tag.</video>'
            )
    }

    $(document).ready(function () {
        testImage("http://192.168.137.202:8000/stream.mjpg");
        $('#nav_u').addClass('text-dark');

        var servo1 = 6;
        var servo2 = 6;

        $("body").keydown(function (event) {
            switch (event.which) {
                case 87:
                    console.log("w");
                     ajax_stp();
                    $.ajax({
                        url: "/send_key",
                        method: "POST",
                        data: {
                            "key": "w",
                        },
                        success: function (result) {}
                    });
                    break;
                case 83:
                    console.log("s");
                     ajax_stp();
                    $.ajax({
                        url: "/send_key",
                        method: "POST",
                        data: {
                            "key": "s",
                        },
                        success: function (result) {}
                    });
                    break;
                case 65:
                    ajax_stp();
                    $.ajax({
                        url: "/send_key",
                        method: "POST",
                        data: {
                            "key": "a",
                        },
                        success: function (result) {}
                    });
                    break;
                case 68:
                   ajax_stp();
                    $.ajax({
                        url: "/send_key",
                        method: "POST",
                        data: {
                            "key": "d",
                        },
                        success: function (result) {}
                    });
                    break;
                case 73: //i
                //console.log(servo2);
                if(servo2 == 0){
                    servo2++;
                }
                else if( servo2 <= 12){
                    servo2--;
                }

                console.log(servo2);

                    ajax_stp();
                    $.ajax({
                        url: "/send_key",
                        method: "POST",
                        data: {
                            "key": "upkey",
                            "data" : servo2
                        },
                        success: function (result) {}
                    });
                    break;
                case 74: //j
                //console.log(servo1);
                if(servo1 == 0){
                    servo1++;
                }
                else if( servo1 <= 12){
                    servo1--;
                }
                console.log(servo1);
                    ajax_stp();
                    $.ajax({
                        url: "/send_key",
                        method: "POST",
                        data: {
                            "key": "leftkey",
                            "data" : servo1
                        },
                        success: function (result) {}
                    });
                    break;
                case 76: //l
                if(servo1 == 13){
                    servo1--;
                   
                }else if(servo1 < 12) {
                    servo1++;  
                }
                console.log(servo1);
                    ajax_stp();
                    $.ajax({
                        url: "/send_key",
                        method: "POST",
                        data: {
                            "key": "rightkey",
                            "data" : servo1
                        },
                        success: function (result) {}
                    });
                    break;
                case 75: //k
                if(servo2 == 13){
                    servo2--;
                   
                }else if(servo2 < 12) {
                    servo2++;  
                }
                console.log(servo2);
                    ajax_stp();
                    $.ajax({
                        url: "/send_key",
                        method: "POST",
                        data: {
                            "key": "downkey",
                            "data" : servo2
                        },
                        success: function (result) {}
                    }); 
                    break;
            }
        });

        function ajax_stp() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        }

    });

</script>








@endsection
