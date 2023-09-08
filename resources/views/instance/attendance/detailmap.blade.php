@extends('layouts.admin')

@section('main-content')
    <div class="content">
        <div class="row">
            <div class="col-lg-12">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-white">Data Kehadiran</h6>
                    </div>
                    <div class="card-body">
                        <div style="width: auto; height: 500px;" id="map"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAPS_API_KEY') }}&callback=initMap" async defer></script>
    <script>
        function initMap() {
            // Koordinat latitude dan longitude
            var latitude = {{$attendances->latitude}};
            var longitude = {{$attendances->longitude}};

            // Membuat peta
            var map = new google.maps.Map(document.getElementById('map'), {
                center: {lat: latitude, lng: longitude},
                zoom: 12
            });

            // Menambahkan marker
            var marker = new google.maps.Marker({
                position: {lat: latitude, lng: longitude},
                map: map,
                title: 'Lokasi'
            });
        }
    </script>
    
@endsection
