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
                    <div class="card-header">Circle</div>
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
        const map = L.map('map').setView([-0.4980153298755623, 117.1546523504816], 11);

        const tiles = L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
        }).addTo(map);


        const circle = L.circle([-0.4808498188753092, 117.16769861429506], {
            color: 'red',
            fillColor: '#f03',
            fillOpacity: 0.5,
            radius: 500
        }).addTo(map).bindPopup('circle 1.');

        const circle2 = L.circle([-0.47638677888325537, 117.12890314558652], {
            color: 'green',
            fillColor: 'green',
            fillOpacity: 0.5,
            radius: 1500
        }).addTo(map).bindPopup('circle 2.');
    </script>
@endpush
