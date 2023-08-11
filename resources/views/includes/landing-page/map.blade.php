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
            }
        </script>
    </div>
</section>
