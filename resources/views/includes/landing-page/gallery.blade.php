{{-- <section id="portfolio" class="portfolio" @if ($check) hidden @endif> --}}
<section id="portfolio" class="portfolio">
    <div class="container" data-aos="fade-up">

        <div class="section-title">
            <h2>Galeri Kegiatan SOBAT-PS</h2>
        </div>

        <div class="row portfolio-container" data-aos="fade-up" data-aos-delay="300">
            @foreach ($gallery as $picture)
                <div class="col-lg-4 col-md-6 portfolio-item">
                    <div class="portfolio-wrap">
                        <img src="{{ asset('berkas/' . $picture['documentation']) }}" class="img-fluid" alt="">
                        <div class="portfolio-info">
                            <p>{{ $picture['activity'] }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

    </div>
</section>
