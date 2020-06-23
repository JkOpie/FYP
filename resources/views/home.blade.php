@extends('layouts.app')

@section('content')

<div class="col-md-10 mx-auto " style="margin-top:5%">
    <div class="row">
        <div class="col-md-2" style="padding-right: 10px !important;height: 79vh;">
            <div class="card card-cascade narrower">
                <div class="view view-cascade gradient-card-header blue-gradient ">
                    <div class="row">
                        <div class="col-md-12 ">
                            <h5 class="mt-3">SENSOR STATUS</h5>
                        </div>
                    </div>  
                </div>
                <div class="card-body card-body-cascade">

                    
                    <ul class="list-group list-group-flush warning-toaster" style="top:3%">
                        <ul class="list-group">
                        <li class="list-group-item">
                            <a class="text-white btn-floating btn-sm" id="keyboard_a"><i class="fas fa-keyboard"></i></a>  KEYBOARD
                        </li>
                        <li class="list-group-item">
                            <a class="text-white btn-floating  btn-sm" id="mouse_a"><i class="fas fa-mouse"></i></a>MOUSE
                        </li>
                        <li class="list-group-item">
                            <a class="text-white btn-floating  btn-sm" id="camera_a"><i class="fas fa-camera"></i></a>CAMERA
                        </li>
                        <li class="list-group-item">
                            <a class="text-white btn-floating  btn-sm" id="thermal_a"><i class="fas fa-fire"></i></a>THERMAL
                        </li>
                        <li class="list-group-item">
                            <a class="text-white btn-floating  btn-sm" id="gps_a"><i class="fas fa-map-marked"></i></a>GPS
                        </li>
                        <li class="list-group-item">
                            <a class="text-white btn-floating  btn-sm" id="battery_a"><i class="fas fa-battery-three-quarters"></i></a>BATTERY
                        </li>
                        </ul>
                    </ul>

                    <div class="card-footer text-center text-white unique-color-dark" style="margin-top:4em; " >
                        Hint! : <br> The <a class="text-white btn-floating btn-yt" style="margin:0 !important;width: 1.6em;height: 1.6em"></a> color =  on <br> 
                        The <a class="text-white btn-floating grey" style="margin:0 !important;width:1.6em;height: 1.6em"></a> color = off
                    </div>

                    
                   
                    </div>
                   
                </div>
    
            </div>
        
        <div class="col-md-10" style="padding-left: 10px !important">
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
                        <div class="card-body card-body-cascade">
                            <video controls width="100%" height="100%" >
                               
                                <source src="https://www.youtube.com/embed/lSNjKzvsxb8" type="video/ogg">
                                Your browser does not support the video tag.
                            </video>
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
                            <video controls width="100%" height="100%" >
                               
                                <source src="https://www.youtube.com/embed/lSNjKzvsxb8" type="video/ogg">
                                Your browser does not support the video tag.
                            </video>
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
                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d8149837.481632142!2d105.12235203708242!3d4.138917011901269!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3034d3975f6730af%3A0x745969328211cd8!2sMalaysia!5e0!3m2!1sen!2ssg!4v1583769592445!5m2!1sen!2ssg" 
                            width="100%" height="100%" frameborder="0" style="border:0;" allowfullscreen=""></iframe>
                        </div>
                    </div>
                </div> 
              </div>
        </div>

    </div>
        <div class="card-footer unique-color-dark text-center text-white mt-4">
            Hint! : Use W,S,A and D to move to up,down,right and left. <br> To capture both picture and thermal image, press ctrl+C;
        </div>
    
     
    </div>

    <script >
          $(document).ready(function(){

            $('#nav_u').addClass('text-dark');

            setInterval(function(){
            $.ajax({
             url:'/home',
             type:'GET',
             dataType:'json',
             success:function(response){
                if(response.status.length>0){
                    
                    var keyboard_status = response.status[0].keyboard;
                    var mouse_status = response.status[0].mouse;
                    var camera_status = response.status[0].camera;
                    var thermal_status = response.status[0].thermal;
                    var gps_status = response.status[0].GPS;
                    var battery_status = response.status[0].Battery;

                    if(keyboard_status == "on"){
                        $('#keyboard_a').addClass('btn-yt');
                    }else{
                        $('#keyboard_a').removeClass('btn-yt');
                        $('#keyboard_a').addClass('grey');
                    }
                    
                    if(mouse_status == "on"){
                        $('#mouse_a').addClass('btn-yt');
                    }else{
                        $('#mouse_a').removeClass('btn-yt');
                        $('#mouse_a').addClass('grey');
                    }

                    if(camera_status == "on"){
                        $('#camera_a').addClass('btn-yt');
                    }else{
                        $('#camera_a').removeClass('btn-yt');
                        $('#camera_a').addClass('grey');
                    }

                    if(thermal_status == "on"){
                        $('#thermal_a').addClass('btn-yt');
                    }else{
                        $('#thermal_a').removeClass('btn-yt');
                        $('#thermal_a').addClass('grey');
                    }

                    if(gps_status == "on"){
                        $('#gps_a').addClass('btn-yt');
                    }else{
                        $('#gps_a').removeClass('btn-yt');
                        $('#gps_a').addClass('grey');
                    }

                    if(battery_status == "on"){
                        $('#battery_a').addClass('btn-yt');
                    }else{
                        $('#battery_a').removeClass('btn-yt');
                        $('#battery_a').addClass('grey');
                    }

                }
             },error:function(err){
                console.log('error');
             }
          })
       }, 1200);

        });

           

          

       
    </script>

    

   
    
@endsection
