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
                    <div class="card-header">Leaflet Geojson</div>
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

        const hospital = {
            "type": "FeatureCollection",
            "features": [{
                    "type": "Feature",
                    "properties": {
                        "popupContent": "RSUD Korpri"
                    },
                    "geometry": {
                        "type": "Point",
                        "coordinates": [
                            117.150415,
                            -0.492775
                        ]
                    }
                },
                {
                    "type": "Feature",
                    "properties": {
                        "popupContent": "RSUD Korpri"
                    },
                    "geometry": {
                        "type": "Polygon",
                        "coordinates": [
                            [
                                [
                                    117.14864,
                                    -0.494338
                                ],
                                [
                                    117.149238,
                                    -0.494658
                                ],
                                [
                                    117.149109,
                                    -0.494797
                                ],
                                [
                                    117.149037,
                                    -0.494934
                                ],
                                [
                                    117.148892,
                                    -0.495223
                                ],
                                [
                                    117.148326,
                                    -0.494886
                                ],
                                [
                                    117.148457,
                                    -0.494666
                                ],
                                [
                                    117.14864,
                                    -0.494338
                                ]
                            ]
                        ]
                    }
                },
                {
                    "type": "Feature",
                    "properties": {
                        "name": ""
                    },
                    "geometry": {
                        "type": "Point",
                        "coordinates": [
                            117.147151,
                            -0.495932
                        ]
                    }
                }
            ]
        }

        const campus = {
            "type": "FeatureCollection",
            "features": [{
                    "type": "Feature",
                    "properties": {
                        "popupContent": "Unmul"
                    },
                    "geometry": {
                        "type": "Polygon",
                        "coordinates": [
                            [
                                [
                                    117.153944,
                                    -0.470454
                                ],
                                [
                                    117.153944,
                                    -0.468158
                                ],
                                [
                                    117.156733,
                                    -0.468158
                                ],
                                [
                                    117.156733,
                                    -0.470454
                                ],
                                [
                                    117.153944,
                                    -0.470454
                                ]
                            ]
                        ]
                    }
                },
                {
                    "type": "Feature",
                    "properties": {
                        "popupContent": "STMIK WIDYA CIPTA DHARMA"
                    },
                    "geometry": {
                        "type": "LineString",
                        "coordinates": [
                            [
                                117.149043,
                                -0.463352
                            ],
                            [
                                117.149485,
                                -0.46336
                            ],
                            [
                                117.149493,
                                -0.463314
                            ],
                            [
                                117.150024,
                                -0.463448
                            ],
                            [
                                117.149924,
                                -0.463615
                            ],
                            [
                                117.149764,
                                -0.463545
                            ],
                            [
                                117.149742,
                                -0.463575
                            ],
                            [
                                117.1499,
                                -0.463663
                            ],
                            [
                                117.149833,
                                -0.463803
                            ],
                            [
                                117.149077,
                                -0.463631
                            ],
                            [
                                117.148996,
                                -0.463526
                            ],
                            [
                                117.149041,
                                -0.463379
                            ],
                            [
                                117.149039,
                                -0.463376
                            ]
                        ]
                    }
                }
            ]
        }

        var map = L.map('map', {
            center: [-0.49483971374300323, 117.1440951762494],
            zoom: 12,
            layers: [osm]
        })

        const baseLayers = {
            'Openstreetmap': osm,
            'StadiaDark': Stadia_Dark,
            'Esri': Esri_WorldStreetMap
        }

        function onEachFeature(feature, layer) {
            let popupContent = `Data Geojson  ${feature.geometry.type}  `

            if (feature.properties && feature.properties.popupContent) {
                popupContent += feature.properties.popupContent
            }

            layer.bindPopup(popupContent);
        }

        const geoJson = L.geoJSON([hospital,campus], {
            style(feature) {
                return feature.properties && feature.properties.style
            },
            onEachFeature,
        }).addTo(map)

        const layerControl = L.control.layers(baseLayers).addTo(map)
    </script>
@endpush
