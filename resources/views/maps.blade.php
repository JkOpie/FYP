@extends('layouts.app')

@section('content')


<div class="col-md-10 mx-auto " style="margin-top:6%;height: 80vh">

    <div class="row">
        <div class="col-md-3">
            <div class="card card-cascade narrower">
                <div class="view view-cascade gradient-card-header blue-gradient ">
                    <div class="row">
                        <div class="col-md-12 ">
                            <h5 class="mt-3">Evidence</h5>
                        </div>
                    </div>
                </div>
                <div class="card-body card-body-cascade">
                    <ul class="list-group list-group-flush warning-toaster" style="top:3%">
                        <ul class="list-group">
                            @foreach ($evis as $evi)
                            @foreach ($evi->evidence as $maps)
                            <li class="list-group-item text-center" >

                                @if ( $maps->id < 10 ) #Evidence ID 00{{$maps->id}}
                                <a class="text-white btn-floating red btn-sm" href="/fly/{{$maps->id}}">
                                <i class="fas fa-arrow-alt-circle-right"></i></a>
                                @elseif( $maps->id < 11 && $maps->id >100)
                                        #Evidence ID 0{{$maps->id}}
                                <a class="text-white btn-floating red btn-sm" href="/fly/{{$maps->id}}">
                                  <i class="fas fa-arrow-alt-circle-right"></i></a>
                                 @endif

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
                      <div style="font-size:18px;">
                        Date: <br>
                        Picture: <br>
                        Thermal:<br>
                        Temperature:<br>
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
        center:[101.513329, 3.039040],
        zoom: 9
    });

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
                          {
                            'type': 'Feature',
                            'properties': {
                                'description':
                                '<strong> Long: '+101.513329+' Lat: '+3.039040+' </p>',
                                },
                            'geometry': {
                                'type': 'Point',
                                'coordinates':  [101.513329, 3.039040]
                            },
                            
                             
                        },
                        {
                            'type': 'Feature',
                            'properties': {
                                'description':
                                '<strong> Long: '+101.6533+' Lat: '+101.6533+' </p>',
                                },
                            'geometry': {
                                'type': 'Point',
                                'coordinates':  [101.6533, 3.2535]
                            },
                            
                             
                        }
                      ]
                    }
                });

                map.addLayer({
                    'id': 'points',
                    'type': 'symbol',
                    'source': 'point',
                    'layout': {
                        'icon-image': 'cat',
                        'icon-size': 0.08
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

    document.getElementById('fly').addEventListener('click', function() {
      map.flyTo({
        center: [101.513329, 3.039040],
        zoom: 11,
        essential: true 
        
      });
    });

</script>

@endsection
