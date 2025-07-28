@extends('adminlte::page')

   @section('title', 'Mapa Interactivo')

   @section('content_header')
       <h1>Mapa Interactivo</h1>
   @stop

   @section('content')

    <div class="container mt-3 mb-3"> <!-- Añadido mb-3 para espacio con el mapa -->
        <div class="d-flex align-items-center" style="max-width: 550px;">
                <select id="vetSelect" class="form-select me-3" style="flex-grow: 1;">
                    <option value="">Selecciona un veterinario por necesidad</option>
                    @foreach(\App\Models\Veterinario::with('especialidades')->get() as $vet)
                        <option value="{{ $vet->id }}" data-lat="{{ $vet->latitud }}" data-lng="{{ $vet->longitud }}">
                            {{ $vet->nombre }} - Especialidades: {{ $vet->especialidades->pluck('nombre')->implode(', ') }}
                        </option>
                    @endforeach
                </select>
            <button id="confirmRoute" class="btn btn-success" onclick="calculateRoute()">Ir al Veterinario</button>
        </div>
    </div>

    <!DOCTYPE html>
    <html>
    <head>
        <title>Mapa de Veterinarios</title>
        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
    </head>
    <body>
        <div id="map"></div>
        <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
        <script>
            var map = L.map('map').setView([0, 0], 13);
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
            }).addTo(map);

            var routingControl;
            var userMarker;

            if ("geolocation" in navigator) {
                navigator.geolocation.getCurrentPosition(function(position) {
                    var userLat = position.coords.latitude;
                    var userLng = position.coords.longitude;
                    map.setView([userLat, userLng], 13);

                    if (userMarker) map.removeLayer(userMarker);
                    userMarker = L.marker([userLat, userLng]).addTo(map)
                        .bindPopup('Estás aquí').openPopup();

                    // Cargar de veterinarios y marcadores
                    $.getJSON('{{ route('veterinarians.json') }}', function(data) {
                        data.forEach(function(vet) {
                            L.marker([vet.latitud, vet.longitud]).addTo(map)
                                .bindPopup(`<b>${vet.nombre}</b><br>Especialidades: ${vet.especialidades}`)
                                .openPopup();
                        });
                    });

                    // Cargar de veterinarios cercanos
                    $.getJSON('{{ route('nearby.veterinarians') }}', { lat: userLat, lng: userLng }, function(data) {
                        data.forEach(function(vet) {
                            L.marker([vet.latitud, vet.longitud]).addTo(map)
                                .bindPopup(`<b>${vet.nombre}</b><br>Especialidades: ${vet.especialidades}<br>Distancia: ${vet.distance.toFixed(2)} km`)
                                .openPopup();
                        });
                    });
                }, function(error) {
                    console.error("Error al obtener la ubicación: ", error);
                    map.setView([-36.8269, -73.0498], 10); // Fallback en Concepción
                });
            } else {
                map.setView([-36.8269, -73.0498], 10); // Fallback si hay errror en geolocalización
            }

            function calculateRoute() {
                if (routingControl) map.removeControl(routingControl);

                var vetSelect = document.getElementById('vetSelect');
                var vetId = vetSelect.value;
                if (vetId && "geolocation" in navigator) {
                    navigator.geolocation.getCurrentPosition(function(position) {
                        var userLat = position.coords.latitude;
                        var userLng = position.coords.longitude;
                        var vetLat = vetSelect.options[vetSelect.selectedIndex].dataset.lat;
                        var vetLng = vetSelect.options[vetSelect.selectedIndex].dataset.lng;

                        if (routingControl) map.removeControl(routingControl);
                        routingControl = L.Routing.control({
                            waypoints: [
                                L.latLng(userLat, userLng),
                                L.latLng(vetLat, vetLng)
                            ],
                            routeWhileDragging: true,
                            showAlternatives: true,
                            language: 'es',
                            lineOptions: {
                                styles: [{ color: 'red', weight: 4 }]
                            }
                        }).addTo(map);

                        // Ajustar el zoom para mostrar toda la ruta
                        map.fitBounds(routingControl.getBounds());

                        // Deshabilitar el botón después de confirmar
                        document.getElementById('confirmRoute').disabled = true;
                        setTimeout(() => {
                            document.getElementById('confirmRoute').disabled = false;
                        }, 5000); // Rehabilitar después de 5 segundos
                    }, function(error) {
                        console.error("Error al obtener la ubicación para la ruta: ", error);
                        alert("No se pudo calcular la ruta. Verifica tu ubicación.");
                    });
                } else {
                    alert("Por favor, selecciona un veterinario.");
                }
            }
        </script>
    </body>
</html>
@stop

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet-routing-machine/3.2.12/leaflet-routing-machine.css" integrity="sha512-eD3SR/R7bcJ9YJeaUe7KX8u8naADgalpY/oNJ6AHvp1ODHF3iR8V9W4UgU611SD/jI0GsFbijyDBAzSOg+n+iQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        #map { height: 600px; }
        .btn-success {
                background-color: #34a853;
                border-color: #34a853;
                padding: 0.175rem 0.5rem; /* Ajusta el padding para hacerlo más ancho */
                width: 150px; /* Ancho fijo para el botón */
            }
        .btn-success:hover { background-color: #2e8b45; border-color: #2e8b45;  }
    </style>
@stop

@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet-routing-machine/3.2.12/leaflet-routing-machine.js" integrity="sha512-OcKb9Sl9mxicJ0pARTouh6txFaz3dG1DtFhezkSmZ5CD0PfQ+/XRCwvSkw46a7OSL5TgX35iF1L/zFXGC2tdBQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
@endsection