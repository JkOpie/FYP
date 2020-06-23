@extends('layouts.app')

@section('content')

@if (session()->get('success'))
  
  <script>toastr["error"]("Evidence Deleted")</script>
@endif


<div class="col-md-10 mx-auto " style="margin-top:6%;height: 80vh">

    <div class="row">
        <div class="col-md-3">
            <div class="card card-cascade narrower">
                <div class="view view-cascade gradient-card-header blue-gradient ">
                    <div class="row">
                        <div class="col-md-12 ">
                            @foreach ($evis as $evi)
                            <h5 class="mt-3">Evidence of {{$evi->EventName}} </h5>
                            @endforeach
                           
                        </div>
                    </div>
                </div>
                <div class="card-body card-body-cascade">
                    <ul class="list-group list-group-flush warning-toaster" style="top:3%">
                        <ul class="list-group">
                            @foreach ($evis as $evi)
                            @foreach ($evi->evidence as $maps)
                            <li class="list-group-item text-center" >
                             <a class="text-white btn-floating red btn-sm" href="/evidence2_delete/{{$maps->id}}">
                                    <i class="fas fa-trash-alt"></i></a>
                                     
                            <a class="text-white btn-floating btn-slack btn-sm" id="fly{{$maps->id}}">
                                <i class="fas fa-arrow-right"></i></a>
                                #Evidence ID {{$maps->id}}
                            </li>

                            
                            @endforeach
                            @endforeach
                        </ul>
                    </ul>



                </div>

            </div>
        </div>

        <div class="col-md-9">
            <div id='map'
                style='width: 100%; height: 80vh;box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19); border-radius: 2em;'>
                <div id="right" class="sidebar flex-center right collapsed">
                    <div class="sidebar-content rounded-rect flex-center">
                        <div class="list-group-flush" style="margin:10px; width: 95%; font-size:18px;">
                            <div class="list-group-item">
                                <h3 id="event_id">Please Select Evidence ID </h3>
                            </div>
                            <div class="list-group-item">
                                <p id="date"> </p>
                            </div>
                            <div class="list-group-item">
                              <div class="view overlay zoom">
                                <img src="/img/icon/noimage.jpg"  alt="zoom" id="picture" width="250px" height="200px">
                                <div class="mask flex-center waves-effect waves-light">
                                  <p class="white-text">Picture</p>
                                </div>
                              </div>
                            </div>
                              <div class="list-group-item">
                                <div class="view overlay zoom">
                                    <img src="/img/icon/noimage.jpg"  alt="zoom" id="thermal" width="250px" height="200px">
                                    <div class="mask flex-center waves-effect waves-light">
                                      <p class="white-text">Thermal</p>
                                    </div>
                                  </div>
                              </div>
                              <div class="list-group-item">
                                <p id="temperature"></p>
                              </div>
                          </div>

                

                      
                   
                        <div class="sidbear-toggle rounded-rect right" onclick="toggleSidebar('right')">
                            &larr;
                        </div>
                      </div>
                    
                </div>
            </div>

        </div>


    </div>

</div>

<script> 
    $('#nav_u').addClass('text-dark');

    mapboxgl.accessToken =
        'pk.eyJ1IjoiZ3JlYXRvcGllIiwiYSI6ImNrOWN2Mzh1YzA3dDIzbXAzOXRha3BhejkifQ.MPVkB-oy4O-xpbggg2NHYw';
    var map = new mapboxgl.Map({
        container: 'map',
        style: 'mapbox://styles/mapbox/streets-v11',
        center:[101.9758, 4.2105],
        zoom: 4
    });

    map.addControl(new mapboxgl.NavigationControl());

    map.on('load', function () {
        map.loadImage(
            'http://127.0.0.1:8000/img/icon/geo.png',
            function (error, image) {
                if (error) throw error;
                map.addImage('cat', image);
                map.addSource('point', 
                {
                    'type': 'geojson',
                    'data': {
                        'type': 'FeatureCollection',
                        'features': [
                            @foreach ($evis as $evi)
                            @foreach ($evi->evidence as $maps)
                          {
                            'type': 'Feature',
                            'properties': {
                                'description': 
                                    '<strong> Evidence ID '+{{$maps->id}}+' </strong> <br> <p> Lat: '+{{$maps->Latitude}} + ' Long : ' + {{$maps->Longitude}} +'</p>',
                                },
                            'geometry': {
                                'type': 'Point',
                                'coordinates':  [ {{$maps->Longitude}}, {{$maps->Latitude}} ]
                            },  
                        },
                        @endforeach
                        @endforeach
                        
                      ]
                    }
                });

                map.addLayer({
                    'id': 'points',
                    'type': 'symbol',
                    'source': 'point',
                    'layout': {
                        'icon-image': 'cat',
                        'icon-size': 0.10
                    }
                });
            }
        );
    
  
   

    // When a click event occurs on a feature in the places layer, open a popup at the
    // location of the feature, with description HTML from its properties.
     map.on('click', 'points', function(e) {
        var coordinates = e.features[0].geometry.coordinates.slice();
        var description = e.features[0].properties.description;
        
        // Ensure that if the map is zoomed out such that multiple
        // copies of the feature are visible, the popup appears
        // over the copy being pointed to.
        while (Math.abs(e.lngLat.lng - coordinates[0]) > 180) {
        coordinates[0] += e.lngLat.lng > coordinates[0] ? 360 : -360;
        }
        
        new mapboxgl.Popup()
        .setLngLat(coordinates)
        .setHTML(description)
        .addTo(map);
    });

    // Change the cursor to a pointer when the mouse is over the places layer.
    map.on('mouseenter', 'points', function () {
        map.getCanvas().style.cursor = 'pointer';
    });

    // Change it back to a pointer when it leaves.
    map.on('mouseleave', 'points', function () {
    map.getCanvas().style.cursor = '';
    });

  }); 
   

    function toggleSidebar(id) {
        var elem = document.getElementById(id);
        var classes = elem.className.split(' ');
        var collapsed = classes.indexOf('collapsed') !== -1;

        var padding = {};

        if (collapsed) {

            classes.splice(classes.indexOf('collapsed'), 1);

            padding[id] = 300;
            map.easeTo({
                padding: padding,
                duration: 1000
            });
        } else {
            padding[id] = 0;

            classes.push('collapsed');

            map.easeTo({
                padding: padding,
                duration: 1000
            });
        }

        elem.className = classes.join(' ');
    }

    map.on('load', function () {
        toggleSidebar('right');
    });


 @foreach ($evis as $evi)
  @foreach ($evi->evidence as $maps)
    document.getElementById('fly{{$maps->id}}').addEventListener('click', function() {

    var date =  "{{ Carbon\Carbon::parse($maps->DateTime)->format('Y,m,d,H,i,s') }}";
    var d = new Date({{ Carbon\Carbon::parse($maps->DateTime)->format('Y,m,d,H,i,s') }});

      map.flyTo({
        center: [ {{$maps->Longitude}}, {{$maps->Latitude}} ],
        zoom: 13,
        essential: true 
      });

      $("#date").text('');
      $("#temperature").text('');

      $('#event_id').text('Event ID : ' + '00' + {{$maps->id}} );
      $('#date').text("Date :  "+ d.getDate()+ "/" + d.getMonth()+ "/"+ d.getFullYear());
      $('#temperature').text('temperature : ' + {{$maps->Temperature}} + "°C");

      $('#picture').attr("src", "/img/{{$maps->Picture}}");
      $('#thermal').attr("src", "/img/{{$maps->Thermal}}");

    });

    @endforeach
@endforeach

</script>

@endsection
