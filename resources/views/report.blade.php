@extends('layouts.app')

@section('content')
<div class="col-md-10 mx-auto " style="margin-top:6%"  >

  <div class="row">
    <div class="col-md-4 mb-lg-5">
      
    </div>
    <div class="col-md-4 mb-lg-5">
      <div class="card card-cascade narrower" >
        <div  
            class="view view-cascade gradient-card-header blue-gradient narrower py-2 mx-4 mb-3 d-flex justify-content-between align-items-center">
    
            <a class="white-text mx-3"> Evidence & Report Chart</a>
            <div>
            </div>
    
        </div>
    
        <div class="px-4">
    
          <canvas id="myChart" ></canvas>
    
        </div>
    
    </div>
    </div>
    <div class="col-md-4 mb-lg-5">
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


 

    <div class="card card-cascade narrower mb-lg-5">
        <div
            class="view view-cascade gradient-card-header blue-gradient narrower py-2 mx-4 mb-3 d-flex justify-content-between align-items-center">

            <a class="white-text mx-3"> REPORT</a>
            <div>
            </div>

            <div class="d-flex justify-content-between">

                <div class="form-inline active-purple-3 active-purple-4">
                    <i class="fas fa-search" aria-hidden="true"></i>
                    <input id="SearhReport" class="form-control form-control-sm ml-3 w-75" type="text"
                        placeholder="Search" aria-label="Search" onkeyup="report()">
                </div>
            </div>
        </div>

        <div class="px-4">

            <div class="table-wrapper text-center">
                <table class="table table-hover mb-0">
                    <thead>
                        <tr>
                            <th class="th-lg">
                                Report ID
                            </th>
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
                                Action
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($reports as $report)
                        <tr>

                            <td>{{$report->id}}</td>



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
                                <a type="button" class="btn btn-danger btn-rounded btn-sm m-0"
                                    href="/report_delete/{{$report->id}}"><i class="fas fa-trash-alt fa-lg"></i>
                                    Delete</a>
                                <a type="button" class="btn btn-primary btn-rounded btn-sm m-0"
                                    href="/maps/{{$report->id}}"><i class="fas fa-eye fa-lg"></i> View</a>
                                <a type="button" class="btn btn-success btn-rounded btn-sm m-0"
                                    href="/pdf/{{$report->id}}"><i class="fas fa-file-pdf fa-lg"></i> PDF</a>
                            </td>
                        </tr>

                        @endforeach

                    </tbody>
                </table>
                <hr>
                <div class="text-right justify-content-end align-items-center">{{ $reports->links() }}</div>  
            </div>

        </div>

    </div>


    <!-- Table with panel -->

</div>

<script>
    $('#nav_u').addClass('text-dark');

    function report() {

        var data = $('#SearhReport').val();

        console.log(data);

        $.ajax({
            type: 'GET',
            url: '/report_search/go',
            data: {
                value: data
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            dataType: 'json',
            success: function (data) {
                $('tbody').html(data.table_data);
            },
            error: function (data) {
                console.log('error');
            }
        });
    }

    var ctx = document.getElementById("myChart").getContext('2d');
    var dtx = document.getElementById("uchart").getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'line',
        data: {
            datasets: [{
                label: 'Total of Evidence',
                fill: false,
                backgroundColor: "rgba(75,192,192,0.3)",
                borderColor: "rgba(75,192,192,1)",
                borderCapStyle: "butt",
                pointBorderColor: "rgba(75,192,192,1)",
                 pointBackgroundColor: "rgba(75,192,192,0.5)",
                pointHoverBackgroundColor: "rgba(75,192,192,1)",
                pointHoverBorderColor: "rgba(220,220,220,1)",
                
                data: [
                    @for ($i = 1; $i < 13; $i++)
                        @foreach ($data as $datas)
                            @if($i  == $datas->month )
                            {{$datas->data}},
                            @else
                            0,
                            @endif

                        @endforeach
                    @endfor

                ],
                order: 1
            }, {
                label: 'Total of Report',
                fill: false,
                data: [
                    @for ($i = 1; $i < 13; $i++)
                        @foreach ($data2 as $datas)
                            @if($i  == $datas->month )
                            {{$datas->data}},
                            @else
                            0,
                            @endif

                        @endforeach
                    @endfor
                ],
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
                ],
                type: 'line',
                // this dataset is drawn on top
                order: 2
            }], 

            labels: [  "January","Febuary","March","April","May", "June", "July", "August","September","October","November","December"],

            },
       
        options: {
            scales: {
                ticks: {
                    beginAtZero: true,
                      min: 0, // suggestedMin: 0,
                      max: 50, //suggestedMax: 50
                      stepSize: 10,
                },
                animation: {
                  duration: 2000,
                  easing: "easeOutElastic"
                },
                responsive: true
                
            }
        }
    });

    var myPieChart = new Chart(dtx, {
        type: 'bar',
        data: {
        labels: ['0-10° C','11-20 C', '21-30° C', '31-40° C', '41-50° C'],
        datasets: [{
            label: 'Total',
            backgroundColor: ['rgba(71, 183,132,.5)','rgba(54, 162, 235, 0.5)','rgba(255, 206, 86, 0.5)', 'rgba(75, 192, 192, 0.5)',  'rgba(153, 102, 255, 0.5)'],
            borderColor: ['rgba(71, 183,132,.5)','rgba(54, 162, 235, 0.5)','rgba(255, 206, 86, 0.5)', 'rgba(75, 192, 192, 0.5)',  'rgba(153, 102, 255, 0.5)'],
            data: [ 
                @foreach($temp as $tep)
                    {{$tep}},
                @endforeach
            ],
        }]
    }
});

    

</script>

@endsection
