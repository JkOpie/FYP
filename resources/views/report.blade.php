
@extends('layouts.app')

@section('content')
<div class="col-md-10 mx-auto " style="margin-top:6%">
    <div class="card card-cascade narrower">
      <div class="view view-cascade gradient-card-header blue-gradient narrower py-2 mx-4 mb-3 d-flex justify-content-between align-items-center">
   
        <a  class="white-text mx-3"> REPORT</a>
        <div>  
        </div>
      </div>
  
      <div class="px-4">
    
        <div class="table-wrapper">
          <table class="table table-hover mb-0">
            <thead>
              <tr>
                
                <th class="th-lg">
                  <a>DateTime
                    
                  </a>
                </th>
                <th class="th-lg">
                  Evidence
                   
                  
                </th>
                <th class="th-lg">
                    Event Name
                   
                  
                </th>
                <th class="th-lg">
                 Event Description
                    
                 
                </th>
               
                <th class="th-lg">
                    Action
                  
                </th>
              </tr>
            </thead>         
            <tbody>
              @foreach ($reports as $report)
              <tr>
              <td>{{$report->DateTime}}</td>
               
                <td>
                  @foreach ($report->evidence as $re)
                  
                  @endforeach
                  
                </td>
              
            
              <td>{{$report->EventName}}</td>
                <td>{{$report->EventDescription}}</td>
                <td><button type="button" class="btn btn-danger btn-rounded btn-sm m-0" >Delete</button>
                    <button type="button" class="btn btn-primary btn-rounded btn-sm m-0">View</button>
                    <button type="button" class="btn btn-success btn-rounded btn-sm m-0">CSV</button>
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
    </script>

    @endsection
    