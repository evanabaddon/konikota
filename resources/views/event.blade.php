@extends('welcome')
@section('home')
<!-- Blog Details Hero Section Begin -->
<section class="blog-hero-section set-bg" data-setbg="{{ $event->media[0]['original_url'] }}">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="bh-text">
                    <h2>{{ $event->name }}</h2>
                    <ul>
                        <li><i class="fa fa-calendar"></i> {{ $event->tgl_mulai . '-' . $event->tgl_selesai }}</li>
                        <li><i class="fa fa-mark"></i> {{ $event->venues[0]['name'] }}</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Blog Details Hero Section End -->

<!-- Blog Details Section Begin -->
<section class="blog-details-section spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 left-blog-pad">
                <div class="bd-text">
                    <div class="bd-pic">
                        <div class="row">
                            <div class="col-md-12">
                                <img src="{{ $event->media[0]['original_url'] }}" alt="">
                            </div>
                            
                        </div>
                    </div>
                    <div class="bd-title">
                        <table class="table table-striped">
                            <tbody>
                                <tr>
                                    <th scope="row">Nama Event</th>
                                    <td>{{ $event->name }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Tanggal Mulai</th>
                                    <td>{{ $event->tgl_mulai }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Tanggal Selesai</th>
                                    <td>{{ $event->tgl_selesai }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Venue</th>
                                    <td>{{ $event->venues[0]['name'] }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Alamat</th>
                                    <td>{{ $event->venues[0]['alamat'] }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Kota</th>
                                    <td>{{ $event->venues[0]['kota'] }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Provinsi</th>
                                    <td>{{ $event->venues[0]['provinsi'] }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Cabor</th>
                                    <td>{{ $event->cabors[0]['name'] }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="blog-sidebar">
                    <div class="bs-recent">
                        <div class="section-title sidebar-title">
                            <h5>Berita Terbaru</h5>
                        </div>
                        @foreach ($recentNews as $item)
                            <div class="news-item">
                                <div class="ni-pic">
                                    <img src="{{ $item['image'] }}" alt="">
                                </div>
                                <div class="ni-text">
                                    <h5><a href="{{ $item['url'] }}">{{ $item['title'] }}</a></h5>
                                    <ul>
                                        <li><i class="fa fa-calendar"></i> {{ $item['published'] }}</li>
                                    </ul>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Blog Details Section End -->
@endsection