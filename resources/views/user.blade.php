
@extends('layouts.app')

@section('content')

<script src="js/toastr.js"></script>

<div class="col-md-10 mx-auto " style="margin-top:6%">
@if (session()->get('img_success'))
  <script>toastr["success"](" User Image Updated")</script>

@elseif (count($errors) > 0)
   <div class = "alert alert-danger">
      <ul>
         @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
         @endforeach
      </ul>
</div>

@elseif (session()->get('update_success'))
  <script>toastr["success"](" User Date Updated")</script>

  @endif




    
    <section class="section">
   
        <div class="row">
  
          <div class="col-lg-4 mb-4">

            <div class="card card-cascade narrower" style="height:44vh">

              <div class="view view-cascade gradient-card-header blue-gradient mdb-color lighten-3">
                <h5 class="mb-0 font-weight-bold">Edit Photo</h5>
              </div>
    
              <div class="card-body card-body-cascade text-center">
                 
                  <img src="/userImages/{{$user->picture}}" alt="User Photo" class="img-fluid rounded-circle hoverable"  height="200" width="150" id="blah">
                <p class="text-muted"><small>Profile photo will be changed automatically</small></p>
               
                <form class="md-form" action="/user/image" method="post" enctype="multipart/form-data">
                    @csrf
                  
                  
                  <div class="row flex-center">
                    <div class="file-field">
                        <div class="btn btn-rounded purple-gradient btn-sm float-left">
                          <span>Choose file</span>
                          <input type="file" name="image"  id="imgInp">
                        </div>
                        <div class="file-path-wrapper">
                          <input class="file-path validate" type="text" placeholder="Upload your file" name="image_path">
                        </div>

                    </div>
                    <button type="submit" class="btn btn-info btn-rounded btn-sm waves-effect waves-light">Update New Photo</button><br>
                  </div>

                </form>
               
              </div>
            </div>
        </div>
        <div class="col-lg-8 mb-4">

            <div class="card card-cascade narrower" style="height:auto">

              <div class="view view-cascade gradient-card-header blue-gradient mdb-color lighten-3">
                <h5 class="mb-0 font-weight-bold">Edit Account</h5>
              </div>

              <div class="card-body card-body-cascade ">
                <form action="/user/update" method="post">
                    @csrf
                  <div class="row">

                    <div class="col-md-6">
                    <label class="active">UserName</label>
                    <input type="text"  class="form-control mb-4" placeholder="Enter UserName" name="name" value="{{$user->name}}">
                    </div>
                    <div class="col-md-6">
                        <label class="active">Email Address</label>
                       <input type="email"  class="form-control mb-4" placeholder="Enter E-mail Address" name="email" value="{{$user->email}}">
                    </div>
                  </div>
                  <div class="row">

                    <div class="col-md-6">
                        <label class="active">Occupation</label>
                        <input type="text"  class="form-control mb-4" placeholder="Enter Occupation" name="occupation" value="{{$user->occupation}}" >
                      
                    </div>
                    
                    <div class="col-md-6">
                        <label class="active">Tel Number</label>
                        <input type="text"  class="form-control mb-4" placeholder="Enter Tel Number" name="Tel_Number" value="{{$user->phone}}" >
                    </div>

                  </div>


                  <div class="row">

                    <div class="col-md-6">
                        <label class="active">New Password</label>
                        <input type="password" class="form-control mb-4" placeholder="Enter New Password" name="password">
                        
                    </div>

                    <div class="col-md-6">
                        <label class="active">Confirm Password</label>
                        <input type="password"  class="form-control mb-4" placeholder="Enter Confirm Password" name="confirm_password">
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12 text-left">
                        <small class="form-text text-muted text-left">
                            *Your password must be 6-20 characters long, can contain letters and numbers, and must not contain spaces,                        
                            or emoji.
                          </small>
                        <small  class="form-text text-muted text-left">*Please enter all the field below</small>
                    </div>
                  </div>
                  
                  <div class="row">
                    <div class="col-md-12 text-center my-4">
                      <span class="waves-input-wrapper waves-effect waves-light"><input type="submit" value="Update Account" class="btn btn-info btn-rounded"></span>
                    </div>
                  </div>
                </form>
              </div>
            </div>

          </div>
        </div>
      </section>
</div>

    

   <script >
            $('#nav_u').addClass('text-dark');

            function next(){
              window.location.href  = "/report";
            }

            function readURL(input) {

                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    
                    reader.onload = function(e) {
                    $('#blah').attr('src', e.target.result);
                    }
                    
                    reader.readAsDataURL(input.files[0]); // convert to base64 string
                }
            }

            $("#imgInp").change(function() {
            readURL(this);
            });
    </script>

    @endsection
    