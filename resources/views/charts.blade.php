@extends('layouts.app')

@section('content')
<div class="col-md-10 mx-auto " style="margin-top:6%"  >

  <div class="row">
    <div class="col-md-6" sty>
      <div class="card card-cascade narrower" >
        <div  
            class="view view-cascade gradient-card-header blue-gradient narrower py-2 mx-4 mb-3 d-flex justify-content-between align-items-center">
    
            <a class="white-text mx-3"> Evidence & Report Chart</a>
            <div>
            </div>
    
        </div>
    
        <div class="px-4">
    
          <canvas id="myChart" width="400"></canvas>
    
        </div>
    
    </div>
    </div>

    <div class="col-md-6">
        <div class="card card-cascade narrower" >
            <div  
                class="view view-cascade gradient-card-header blue-gradient narrower py-2 mx-4 mb-3 d-flex justify-content-between align-items-center">
        
                <a class="white-text mx-3"> Temperature Chart</a>
                <div>
                </div>
        
            </div>
        
            <div class="px-4">
        
              <canvas id="uchart" ></canvas>
        
            </div>
        
        </div>

    </div>

  </div>

    </div>

<script>
    $('#nav_u').addClass('text-dark');

   

    

</script>

@endsection
