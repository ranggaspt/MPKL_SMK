@extends('layouts.admin')

@section('main-content')
<div class="content">
    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-white">Data Kehadiran</h6>
                </div>
                {{-- <div class="container">
                    <div id="map" style="widht:100%;height:300px;"></div>
                </div> --}}
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th style="width: 5%">No</th>
                                    <th>Nama Siswa</th>
                                    <th>Kelas</th>
                                    <th>Jurusan</th>
                                    <th>Instansi</th>
                                    <th>Kehadiran</th>
                                    <th>Lokasi</th> 
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($attendance as $attendances)
                                <tr>
                                    <td scope="row">{{ $loop->iteration }}</td>
                                    <td>{{ $attendances->student->name }}</td>
                                    <td>{{ $attendances->student->classroom->name}}</td>
                                    <td>{{ $attendances->student->classroom->study->name }}</td>
                                    <td>Instansi : {{$attendances->instance->instance_name}}</br>Pembimbing :
                                        {{$attendances->instance->name}}
                                    </td>
                                    <td>tanggal : {{$attendances->tanggal}}</br>Masuk :
                                        {{$attendances->masuk}}</br>Pulang : {{$attendances->pulang}}
                                    </td>
                                    {{-- <td> --}}

                                        {{-- <img
                                            src="https://www.openstreetmap.org/export/staticmap?center={{ $attendances->latitude }},{{ $attendances->longitude }}&zoom=15&size=400x400&format=png"
                                            alt="Map"> --}}
                                        {{-- latitude : {{$attendances->latitude}}</br>longitude :
                                        {{$attendances->longitude}} --}}
                                        
                                    <td>Latitude : {{$attendances->latitude}}</br>Longitude :
                                        {{$attendances->longitude}}</td>
                                    {{-- </td> --}}

                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6">Data Tidak Ditemukan</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- <script type="text/javascript"
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAOPXcq5dcHdL6-7fruyMQ1FyrQFg9m-GE"></script>

<script>
    function showMap(lat,long) {
        var coord = {lat:lat,lng:long};

        new google.maps.Map(document.getElementById("map"),{
            zoom:10,
            center: coord,
        });
    }
</script> --}}
<script src="https://maps.googleapis.com/maps/api/js?key={{ config('services.google.maps.api_key') }}">
</script>
<script>
    function initMap() {
        @forelse($attendance as $lokasi)
            var latitude = {{ $lokasi->latitude }};
            var longitude = {{ $lokasi->longitude }};
            
            var myLatLng = {lat: latitude, lng: longitude};

            var map = new google.maps.Map(document.getElementById('map'), {
                zoom: 15,
                center: myLatLng
            });

            var marker = new google.maps.Marker({
                position: myLatLng,
                map: map
            });
        @empty
                // Tidak ada data yang tersedia
        @endforelse
        }
</script>
<script async defer
    src="https://maps.googleapis.com/maps/api/js?key={{ config('services.google.maps.api_key') }}&callback=initMap">
</script>

</body>

@endsection