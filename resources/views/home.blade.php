@extends('layouts.app')

@section('content')

<div class="col-md-10 mx-auto " style="margin-top:5%">
    <div class="row">

        <div class="col-md-12" style="padding-left: 10px !important">
            <div class="grid-container">
                <div class="grid-item con1">
                    <div class="card card-cascade narrower">
                        <div class="view view-cascade gradient-card-header blue-gradient ">
                            <div class="row">
                                <div class="col-md-12 ">
                                    <h5 class="mt-3">CAMERA VIDEO/AUDIO</h5>
                                </div>
                            </div>
                        </div>
                        <div class="card-body card-body-cascade" id="video">
                        </div>
                    </div>
                </div>
                <div class="grid-item con2">
                    <div class="card card-cascade narrower " style="height:94% !important">
                        <div class="view view-cascade gradient-card-header blue-gradient">
                            <div class="row">
                                <div class="col-md-12 ">
                                    <h5 class="mt-3">THERMAL VIDEO</h5>
                                </div>
                            </div>
                        </div>

                        <div class="card-body card-body-cascade text-center">
                            <video controls width="100%" height="100%"><source src="" type="video/ogg">Your browser does not support the video tag.</video>
                        </div>
                        
                    </div>
                </div>
                <div class="grid-item con3">
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
                                width="100%" height="100%" frameborder="0" style="border:0;"
                                allowfullscreen=""></iframe>
                        </div>

                    </div>
                </div>
            </div>
        </div>

    </div>
    <div class="card-footer unique-color-dark text-center text-white mt-4">
        Hint! : Use W,S,A and D to move to up,down,right and left. <br> To capture both picture and thermal image, press
        ctrl+C;
    </div>


</div>

<script>

function testImage(URL) {
    var tester=new Image();
    tester.onload=imageFound;
    tester.onerror=imageNotFound;
    tester.src=URL;
}

function imageFound() {
    $('#video').append('<img src="http://192.168.43.41:8000" width="100%" height="100%">')
}

function imageNotFound() {
   $('#video').append('<video controls width="100%" height="100%"><source src="" type="video/ogg">Your browser does not support the video tag.</video>')
}



    $(document).ready(function () {
        testImage("http://192.168.43.41:8000");
        $('#nav_u').addClass('text-dark');
     
        $("body").keydown(function (event) {
            switch (event.which) {
                case 87:
                    //console.log("w");
                    ajax_stp();
                    $.ajax({
                        url: "http://192.168.43.41:8000/send_key",
                        method: "POST",
                        data: {
                            "key": "w",
                        },
                        success: function (result) {}
                    });
                    break;
                case 83:
                    //console.log("s");
                    $.ajax({
                        url: "http://192.168.43.41:8000/send_key",
                        method: "POST",
                        data: {
                            "key": "s",
                        },
                        success: function (result) {}
                    });
                    break;
                case 65:
                    $.ajax({
                        url: "http:/192.168.43.41:8000/send_key",
                        method: "POST",
                        data: {
                            "key": "a",
                        },
                        success: function (result) {}
                    });
                    break;
                case 68:
                    $.ajax({
                        url: "http:/192.168.43.41:8000/send_key",
                        method: "POST",
                        data: {
                            "key": "d",
                        },
                        success: function (result) {}
                    });
                    break;
                case 38:
                    $.ajax({
                        url: "http:/192.168.43.41:8000/send_key",
                        method: "POST",
                        data: {
                            "key": "upkey",
                        },
                        success: function (result) {}
                    });
                    break;
                case 37:
                    $.ajax({
                        url: "http:/192.168.43.41:8000/send_key",
                        method: "POST",
                        data: {
                            "key": "leftkey",
                        },
                        success: function (result) {}
                    });
                    break;
                case 39:
                    $.ajax({
                        url: "http:/192.168.43.41:8000/send_key",
                        method: "POST",
                        data: {
                            "key": "rightkey",
                        },
                        success: function (result) {}
                    });
                    break;
                case 40:
                    $.ajax({
                        url: "http:/192.168.43.41:8000/send_key",
                        method: "POST",
                        data: {
                            "key": "downkey",
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
