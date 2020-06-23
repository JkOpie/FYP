
@extends('layouts.app')

@section('content')


<div class="col-md-10 mx-auto " style="margin-top:6%">

@if (session()->get('delete'))
  
  <script>toastr["error"]("Evidence Deleted")</script>


@endif
    <div class="card card-cascade narrower">
      <div class="view view-cascade gradient-card-header blue-gradient narrower py-2 mx-4 mb-3 d-flex justify-content-between align-items-center">
        <a  class="white-text mx-3"> Evidence Of
            @foreach ($evis as $evi)
                {{$evi->EventName}}
            @endforeach</a>

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
              @foreach ($evi->evidence as $ev)
              <tr>
              <td>{{$ev->DateTime}}</td>
                <td><img src="/img/{{$ev->Picture}}" width="100" height="50" class=""></td>
                <td><img src="/img/{{$ev->Thermal}}" width="100" height="50" ></td>
                <td>{{$ev->Temperature}}</td>
                <td>{{$ev->Longitude}}</td>
                <td>{{$ev->Latitude}}</td>
              <td>
                <a type="button" class="btn btn-danger btn-rounded btn-sm m-0" href="/report_delete_evidence/{{$ev->id}}"><i class="fas fa-trash-alt fa-lg"></i> Delete</a>
              </td>
              </tr>
              @endforeach
              @endforeach
              @endif
              
            </tbody>
          </table>
        </div>
      </div>
    </div>
    </div>


   <script >
            $('#nav_u').addClass('text-dark');

            function next(){
              window.location.href  = "/report";
            }
function report(){

var data = $('#SearhReport').val();

console.log(data);

$.ajax({
      type: 'GET',
      url: '/report_search',
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
    