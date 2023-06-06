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
                    <div class="card-header">Polyline</div>
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
        const map = L.map('map').setView([-0.49665182128721524, 117.13682367315869], 11);

        const tiles = L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
        }).addTo(map);

        var latlng = [
            [-0.5008573655990853, 117.1353538226992],
            [-0.5010826625396897, 117.13623358719978],
            [-0.5011684899436042, 117.13678612222151],
            [-0.5011845825817117, 117.13704361427045],
            [-0.5012811384095299, 117.13747813210307],
            [-0.5012704099842775, 117.13748349652073],
        ]
        const polyline = L.polyline(latlng).bindPopup('Contoh polyline').addTo(map)
        map.fitBounds(polyline.getBounds())
    </script>
@endpush
