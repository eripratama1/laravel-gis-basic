@extends('layouts.dashboard-volt')

@section('css')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css"
        integrity="sha256-kLaT2GOSpHechhsozzB+flnD+zUyjE2LlfWPgU04xyI=" crossorigin="" />

    <style>
        #map {
            height: 400px;
        }
    </style>
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Leaflet layer Control</div>
                    <div class="card-body">
                        <div id="map"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('javascript')
    <script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js"
        integrity="sha256-WBkoXOwTeyKclOHuWtc+i2uENFpDZ9YPdf5Hf+D7ewM=" crossorigin=""></script>
    <script>
        var osm = L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
        });

        var Stadia_Dark = L.tileLayer(
            'https://tiles.stadiamaps.com/tiles/alidade_smooth_dark/{z}/{x}/{y}{r}.png', {
                maxZoom: 20,
                attribution: '&copy; <a href="https://stadiamaps.com/">Stadia Maps</a>, &copy; <a href="https://openmaptiles.org/">OpenMapTiles</a> &copy; <a href="http://openstreetmap.org">OpenStreetMap</a> contributors'
            });

        var Esri_WorldStreetMap = L.tileLayer(
            'https://server.arcgisonline.com/ArcGIS/rest/services/World_Street_Map/MapServer/tile/{z}/{y}/{x}', {
                attribution: 'Tiles &copy; Esri &mdash; Source: Esri, DeLorme, NAVTEQ, USGS, Intermap, iPC, NRCAN, Esri Japan, METI, Esri China (Hong Kong), Esri (Thailand), TomTom, 2012'
            });

        var map = L.map('map', {
            center: [-5.129541583080711, 113.62957770241515],
            zoom: 5,
            layers: [osm]
        })

        var iconMarker = L.icon({
            iconUrl: '{{ asset('iconMarkers/marker.png') }}',
            iconSize: [50, 50],
        })

        var marker = L.marker([-5.129541583080711, 113.62957770241515], {
                icon: iconMarker,
                draggable: true
            })
            .bindPopup('Tampilan pesan disini 1')
            .addTo(map);

        var latlngpolygon = [
            [
                [-6.188629685100736, 106.76570647993734],
                [-6.231634501876636, 106.82201140797456],
                [-6.268492969253171, 106.87282317230083],
                [-6.2725881940304715, 106.76707977086507],
            ],
            [
                [-6.121726353478342, 106.74991363075284],
                [-6.15040024069699, 106.72588103951745],
                [-6.187947039389207, 106.75884002178313],
                [-6.157227129061388, 106.79179900404883],
            ]
        ]

        var polygon = L.polygon(latlngpolygon).bindPopup('Data Polygon').addTo(map)

        var baseMaps = {
            'Open Street Map': osm,
            'Esri World': Esri_WorldStreetMap,
            'Stadia Dark': Stadia_Dark
        }

        var overlayers = {
            'Marker': marker,
            'Polygon': polygon
        }

        L.control.layers(baseMaps, overlayers).addTo(map)
    </script>
@endpush
