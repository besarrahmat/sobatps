<section class="map" id="peta">
    <div class="container" data-aos="fade-up">

        <div class="section-title">
            <h2>Peta Sebaran Perhutanan Sosial Kalimantan Utara</h2>
        </div>

        <div id="map"></div>

        <script>
            function initMap() {
                const map = new google.maps.Map(document.getElementById("map"), {
                    zoom: 8.75,
                    center: {
                        lat: 3.7308847,
                        lng: 116.7806015
                    }
                });

                let locations = [
                    ['KAB. BULUNGAN', {
                        lat: 2.994404,
                        lng: 116.997728
                    }, 'assets/img/marker/bulungan.png'],
                    ['KAB. MALINAU', {
                        lat: 3.591934,
                        lng: 116.643527
                    }, 'assets/img/marker/malinau.png'],
                    ['KAB. NUNUKAN', {
                        lat: 4.278254,
                        lng: 116.577553
                    }, 'assets/img/marker/nunukan.png'],
                    ['KAB. TANA TIDUNG', {
                        lat: 3.599049,
                        lng: 117.077759
                    }, 'assets/img/marker/tanatidung.png'],
                    ['KOTA TARAKAN', {
                        lat: 3.334228,
                        lng: 117.578914
                    }, 'assets/img/marker/tarakan.png'],
                ];

                let lembaga = {{ json_encode($map_lembaga) }};

                for (let index = 0; index < lembaga.length; index++) {
                    locations[index].push(lembaga[index]);
                }

                const infoWindow = new google.maps.InfoWindow();

                locations.forEach(([title, position, image, lembaga], i) => {
                    const marker = new google.maps.Marker({
                        position,
                        map,
                        icon: image,
                        title: `${title}`,
                    });

                    marker.content = '<div class="text-center">' +
                        '<img class="logo" src=' + image + '>' +
                        '<h5 class="mt-3">' + `${title}` + '</h5>' +
                        '<table class="table"><tbody>' +
                        '<tr><th>Jumlah Lembaga PS</th>' +
                        '<th>Jumlah Lembaga KUPS</th>' +
                        '<th>Jumlah Program</th></tr>' +
                        '<tr><td>' + lembaga[0] + '</td>' +
                        '<td>' + lembaga[1] + '</td>' +
                        '<td>' + lembaga[2] + '</td></tr>' +
                        '</tbody></table></div>'

                    marker.addListener('click', () => {
                        infoWindow.close();
                        infoWindow.setContent(marker.content);
                        infoWindow.open(marker.getMap(), marker);
                    });
                });
            }
        </script>
    </div>
</section>
