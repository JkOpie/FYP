@extends('layouts.app')

@section('content')

<div class="container-fluid custom-padding">
    <div class="row" style="height: 70vh !important">
        <div class="col-md-6 h-100">
            <div class="card card-cascade narrower">
                <div class="view view-cascade gradient-card-header blue-gradient ">
                    <div class="row">
                        <div class="col-md-12 ">
                            <h5 class="mt-3">CAMERA VIDEO</h5>
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
                <div class="card card-cascade narrower ">
                    <div class="view view-cascade gradient-card-header blue-gradient">
                        <div class="row">
                            <div class="col-md-12 ">
                                <h5 class="mt-3">THERMAL VIDEO</h5>
                            </div>
                        </div>
                    </div>

                    <div class="card-body card-body-cascade text-center" style="height: 32rem">
                        <canvas id="thermal-canvas" width="500" height="500"></canvas>
                    </div>

                </div>
            </div>
            <div class="pt-4">
                <div class="card card-cascade narrower">
                    <div class="view view-cascade gradient-card-header blue-gradient">
                        <div class="row">
                            <div class="col-md-12 ">
                                <h5 class="mt-3">TEMPERATURE</h5>
                            </div>
                        </div>
                    </div>
                    <div class="card-body card-body-cascade text-center">
                        <div class="">
                            <h1 id="temp_data"></h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-2">
            <div class="row">
                <div class="col-md-12">
                    <div class="card-footer unique-color-dark text-center text-white mt-4">
                        Hint! : Use W,S,A and D to move the robot to up,down,right and left.
                        <br> To capture both picture and
                        thermal image, press ENTER;
                    </div>
                </div>

                <div class="">

                </div>
            </div>
        </div>
    </div>

    <canvas id="camera_normal"></canvas>


</div>

<script src="https://cdn.socket.io/socket.io-3.0.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.min.js"></script>

<script>
    const socket = io.connect('http://192.168.0.131:3000');

   
    var canvas = document.getElementById('thermal-canvas');
    var ctx = canvas.getContext("2d");
    var temp = $('#temp_data');
    var maxW = 500;
    var maxH = 500;
    var currentLatitude;
    var currentLongitude;

   


    socket.on('image', function (image) {
        //console.log(image);
        var img = new Image();
        img.src = 'data:image/jpeg;base64,' + image.buffer;
        ctx.drawImage(img, 0, 0, img.width, img.height, 0, 0, 500, 450);

    })

    socket.on("temperature", (data) => {
        temp.text(data)
    })

    function testImage(URL) {
        var tester = new Image();
        tester.onload = imageFound;
        tester.onerror = imageNotFound;
        tester.src = URL;
    }

    function imageFound() {
        console.log("found");
        $('#video').append(
            '<img src="http://192.168.0.131:8000/stream.mjpg" style="object-fit:cover;" width="100%" height="100%" id="video_camera" crossorigin="anonymous">'
        )
    }

    function imageNotFound() {
        console.log("notfound");
        $('#video').append(
            '<video controls width="100%" height="100%"><source src="" type="video/ogg">Your browser does not support the video tag.</video>'
        )
    }

    function getBase64Image(img) {
        var canvas = document.createElement("canvas");
        canvas.width = img.width;
        canvas.height = img.height;
        var ctx = canvas.getContext("2d");
        ctx.drawImage(img, 0, 0);
        var dataURL = canvas.toDataURL("image/png");
        return dataURL.replace(/^data:image\/(png|jpg);base64,/, "");
    }

    $(document).ready(function () {
        testImage("http://192.168.0.131:8000/stream.mjpg");
        $('#nav_u').addClass('text-dark');


        const Toast = Swal.mixin({
            toast: true,
            position: 'bottom-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        })

      
    
        
        var servo1 = 6;
        var servo2 = 6;

        $("body").keydown(function (event) {
            switch (event.which) {
                case 13:

                console.log(currentLatitude, currentLatitude);

                //console.log($('#temp_data').text());

                    var camera = getBase64Image(document.getElementById("video_camera"));

                    $.getJSON("http://api.ipstack.com/202.185.135.255?access_key=db03a76038cea1f83fdc1538406086be", function (data) {
                        ajax_stp();
                        $.ajax({
                            url: "/create_evidence",
                            method: "POST",
                            data: {
                                "thermal_picture": canvas.toDataURL(),
                                "camera_picture": camera,
                                "lat": data.latitude,
                                "long": data.longitude,
                                "temperature": $('#temp_data').text(),
                            },
                            success: function (result) {
                                Toast.fire({
                                    icon: 'success',
                                    title: 'Evidence created'
                                })
                            }
                        });
                    });

                    

                    break;
                case 87:
                    console.log("w");
                    ajax_stp();
                    $.ajax({
                        url: "/send_key",
                        method: "POST",
                        data: {
                            "key": "w",
                            "data": "w",
                        },
                        success: function (result) {}
                    });
                    break;
                case 65:
                    console.log("a");
                    ajax_stp();
                    $.ajax({
                        url: "/send_key",
                        method: "POST",
                        data: {
                            "key": "a",
                            "data": "a",
                        },
                        success: function (result) {}
                    });
                    break;
                case 68:
                    console.log("d");
                    ajax_stp();
                    $.ajax({
                        url: "/send_key",
                        method: "POST",
                        data: {
                            "key": "d",
                            "data": "d",
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
                            "data": "s",
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
                            "data": "a",
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
                            "data": "d",
                        },
                        success: function (result) {}
                    });
                    break;
                case 73: //i
                    //console.log(servo2);
                    if (servo2 == 0) {
                        servo2++;
                    } else if (servo2 <= 12) {
                        servo2--;
                    }

                    console.log(servo2);

                    ajax_stp();
                    $.ajax({
                        url: "/send_key",
                        method: "POST",
                        data: {
                            "key": "upkey",
                            "data": servo2
                        },
                        success: function (result) {}
                    });
                    break;
                case 74: //j
                    //console.log(servo1);
                    if (servo1 == 0) {
                        servo1++;
                    } else if (servo1 <= 12) {
                        servo1--;
                    }
                    console.log(servo1);
                    ajax_stp();
                    $.ajax({
                        url: "/send_key",
                        method: "POST",
                        data: {
                            "key": "leftkey",
                            "data": servo1
                        },
                        success: function (result) {}
                    });
                    break;
                case 76: //l
                    if (servo1 == 13) {
                        servo1--;

                    } else if (servo1 < 12) {
                        servo1++;
                    }
                    console.log(servo1);
                    ajax_stp();
                    $.ajax({
                        url: "/send_key",
                        method: "POST",
                        data: {
                            "key": "rightkey",
                            "data": servo1
                        },
                        success: function (result) {}
                    });
                    break;
                case 75: //k
                    if (servo2 == 13) {
                        servo2--;

                    } else if (servo2 < 12) {
                        servo2++;
                    }
                    console.log(servo2);
                    ajax_stp();
                    $.ajax({
                        url: "/send_key",
                        method: "POST",
                        data: {
                            "key": "downkey",
                            "data": servo2
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
