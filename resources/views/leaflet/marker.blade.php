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
                    <div class="card-header">Markers</div>
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
        const map = L.map('map').setView([-5.129541583080711, 113.62957770241515], 4);

        const tiles = L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
        }).addTo(map);

        var iconMarker = L.icon({
            iconUrl:'{{ asset('iconMarkers/marker.png') }}',
            iconSize:[50,50],
        })

        var marker = L.marker([-5.129541583080711, 113.62957770241515],{
            icon:iconMarker,
            draggable:true
        })
        .bindPopup('Tampilan pesan disini 1')
        .addTo(map);

        var marker2 = L.marker([-1.2761076471197752, 116.82459558367206],{
            //icon:iconMarker,
            draggable:true
        })
        .bindPopup('Tampilan pesan disini 2')
        .addTo(map);

        
    </script>
@endpush
