
@extends('layouts.app')

@section('content')
<div class="col-md-10 mx-auto " style="margin-top:6%">
  <div class="row">
    <div class="col-md-10">

    </div>
    <div class="col-md-2">
      <a href="/maps"> 
     <div class="card card-image waves-light mb-3"
          style="background-image: url(/img/maps.PNG);">
     
         <div class="text-white text-center align-items-center py-5 px-4 " style="background-color: rgba(0,0,0,0.5)"> 
        
          <h3 class="card-title pt-2"><strong>MAPS</strong></h3>
        
      </div>
    </div>
    </a>
    
    </div>
   

  </div>

    <div class="card card-cascade narrower">
      <div class="view view-cascade gradient-card-header blue-gradient narrower py-2 mx-4 mb-3 d-flex justify-content-between align-items-center">
   
        <a  class="white-text mx-3"> REPORT</a>
        <div>  
        </div>

        <div class="d-flex justify-content-between">

          <div class="form-inline active-purple-3 active-purple-4">
            <i class="fas fa-search" aria-hidden="true"></i>
            <input id="SearhReport" class="form-control form-control-sm ml-3 w-75" type="text" placeholder="Search"
              aria-label="Search" onkeyup="report()" >
          </div>

         

        </div>
      </div>
  
      <div class="px-4">
    
        <div class="table-wrapper">
          <table class="table table-hover mb-0">
            <thead>
              <tr>
                
                <th class="th-lg">
                  DateTime  
                </th>
                <th class="th-lg">
                  Total Evidence
                </th>
                <th class="th-lg">
                  Event Name
                </th>
                <th class="th-lg">
                  Event Description
                </th>
               
                <th class="th-lg">
                </th>
              </tr>
            </thead>         
            <tbody>
              @foreach ($reports as $report)
              <tr>
              <td>{{$report->DateTime}}</td>
               
                <td>
                  @php
                      $ttl = 0;
                  @endphp
                  @foreach ($report->evidence as $re)
                  @php
                      $ttl = $ttl +1;
                  @endphp
                  @endforeach
                  {{$ttl}}
                  
                </td>
              <td>{{$report->EventName}}</td>
                <td>{{$report->EventDescription}}</td>
                <td>
                    <a type="button" class="btn btn-danger btn-rounded btn-sm m-0" href="/report_delete/{{$report->id}}"><i class="fas fa-trash-alt fa-lg"></i> Delete</a>
                    <a type="button" class="btn btn-primary btn-rounded btn-sm m-0" href="/maps/{{$report->id}}"><i class="fas fa-eye fa-lg"></i> View</a>
                    <a type="button" class="btn btn-success btn-rounded btn-sm m-0" href="/pdf/{{$report->id}}"><i class="fas fa-file-pdf fa-lg"></i> PDF</a>
                </td>
              </tr>
            
              @endforeach
              
            </tbody>
          </table>
        </div>
    
      </div>
    
    </div>

  
    <!-- Table with panel -->
    
    </div>

    <script >
      $('#nav_u').addClass('text-dark');

      function report(){

      var data = $('#SearhReport').val();

      console.log(data);

      $.ajax({
            type: 'GET',
            url: '/report_search/go',
            data: { value: data },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            dataType: 'json',
            success: function(data) {
              $('tbody').html(data.table_data);
            },
            error: function(data) {
              console.log('error');
            }
        });
      }
    </script>

    @endsection
    