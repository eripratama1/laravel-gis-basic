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
                    <div class="card-header">Polygon</div>
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
        const map = L.map('map').setView([-6.2132042962663965, 106.83917754457129], 11);

        const tiles = L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
        }).addTo(map);


        const polygon = L.polygon([
            [-6.188629685100736, 106.76570647993734],
            [-6.231634501876636, 106.82201140797456],
            [-6.268492969253171, 106.87282317230083],
            [-6.2725881940304715, 106.76707977086507],
        ]).addTo(map).bindPopup('contoh polygon.');

        const polygon2 = L.polygon([
            [-6.121726353478342, 106.74991363075284],
            [-6.15040024069699, 106.72588103951745],
            [-6.187947039389207, 106.75884002178313],
            [-6.157227129061388, 106.79179900404883],
        ]).addTo(map).bindPopup('contoh polygon.');
    </script>
@endpush
