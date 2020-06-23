
@extends('layouts.app')

@section('content')


<div class="col-md-10 mx-auto " style="margin-top:6%">

@if (session()->get('delete'))
  
  <script>toastr["error"]("Evidence Deleted")</script>

@elseif (session()->get('success_report'))

<script>toastr["success"]("Report Created")</script>

@elseif (session()->get('error_report'))

<script>toastr["error"]("Report Not created")</script>

@endif
    <div class="card card-cascade narrower">
      <div class="view view-cascade gradient-card-header blue-gradient narrower py-2 mx-4 mb-3 d-flex justify-content-between align-items-center">
        <a  class="white-text mx-3"> EVIDENCE</a>

        <div class="d-flex justify-content-between">

          <div class="form-inline active-purple-3 active-purple-4">
            <i class="fas fa-search" aria-hidden="true"></i>
            <input id="SearhReport" class="form-control form-control-sm ml-3 w-75" type="text" placeholder="Search"
              aria-label="Search" onkeyup="report()" >
          </div>

          <button  class="btn btn-outline-white  btn-sm px-2" data-toggle="modal" data-target="#centralModalSm">
            Create Report
          </button>

        </div>

          
       
    
      </div> 
      <div class="px-4">
        <div class="table-wrapper">
          <table class="table table-hover mb-0 text-center">
            <thead>
              <tr> 
                <th class="th-lg">
                  #
                </th>
                <th class="th-lg">
                  DateTime
                </th>
                <th class="th-lg">
                  Picture
                </th>
                <th class="th-lg">
                    Thermal  
                </th>
                <th class="th-lg">
                  Temperature  
                </th>
                <th class="th-lg">
                   Longitude
                </th>
                <th class="th-lg">
                  Latitude 
                </th>
                <th class="th-lg">
                    Action
                </th>
              </tr>
            </thead>
            <tbody>
              @if ($count == 0)
              <tr>
                  <td colspan="6" class="text-center">No Data Available. Please Capture Evidence</td>
                </tr>
              @else
              @foreach ($evis as $evi)
              <tr>
                <td>{{$evi->id}}</td>
                <td>{{$evi->DateTime}}</td>
                <td><img src="img/{{$evi->Picture}}" width="100" height="80" class=""></td>
                <td><img src="img/{{$evi->Thermal}}" width="100" height="80" ></td>
                <td>{{$evi->Temperature}}</td>
                <td>{{$evi->Longitude}}</td>
                <td>{{$evi->Latitude}}</td>
              <td>
                <a type="button" class="btn btn-danger btn-rounded btn-sm m-0" href="/evidence/{{$evi->id}}"><i class="fas fa-trash-alt fa-lg"></i> Delete</a>
              </td>
              </tr>
              @endforeach
              @endif
            </tbody>
          </table>
        </div>
      </div>
    </div>
    </div>


    <div class="modal fade" id="centralModalSm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
      aria-hidden="true">

  <div class="modal-dialog cascading-modal" role="document">
    <div class="modal-content">
      <div class="modal-header text-center light-blue darken-3">
        <h4 class="modal-title w-100 text-white" id="myModalLabel">Create Report</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form class="text-center" style="color: #757575;" action="/createreport" method="post">
          @csrf
            <div class="md-form">
              <input type="text" id="materialLoginFormEmail" class="form-control" name="event_name">
              <label for="materialLoginFormEmail">Event Name</label>
            </div>
    
            <div class="md-form">
              <input type="text" id="materialLoginFormPassword" class="form-control" name="event_desc">
              <label for="materialLoginFormPassword">Event Description</label>
            </div>

            <div class="md-form">
                <input  type="text" id="date-picker-example" class="form-control datepicker" name="event_date">
                <label for="date-picker-example">Event Date</label>
              </div>
              <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary btn-sm">Submit</button>
          </form>
      </div>
     
    </div>
  </div>
</div>

   <script >
     $(document).ready(function(){
        $('#nav_u').addClass('text-dark');  

        @foreach ($evis as $evi)
        @if($evi->Temperature >= 20 && $evi->Temperature <= 30 )
      
              toastr.options = {
                "closeButton": true,
                "debug": false,
                "newestOnTop": false,
                "progressBar": true,
                "positionClass": "md-toast-bottom-right",
                "preventDuplicates": false,
                "onclick": null,
                "showDuration": 300,
                "hideDuration": 10000,
                "timeOut": 5*60000,
                "extendedTimeOut": 5*60000,
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut"
                }
              toastr["error"]("Warning : Evidence " + {{$evi->id}} + " the victim body temperature is " + {{$evi->Temperature}}+ "°C . It indicates that the victim is in great danger");

              @endif
          @endforeach
  });

       
  

    function report(){

      var data = $('#SearhReport').val();

      console.log(data);

      $.ajax({
            type: 'GET',
            url: '/evidence_search',
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
    