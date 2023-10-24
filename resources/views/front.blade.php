@extends('welcome')
@section('home')
<!-- Hero Section Begin -->
<section class="hero-section set-bg" data-setbg="{{ asset('specer') }}/img/hero/hero-1.jpg">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="hs-item">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="hs-text">
                                    <h4>Kelender Event</h4>
                                    <img style="width: 100px" src="https://konisidoarjo.id/wp-content/uploads/2022/11/Komite-Olahraga-Nasional-Indonesia-KONI-Logo.png" alt="">
                                    <h2>Kota Malang</h2>
                                    <a href="#" class="primary-btn">More Details</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Hero Section End -->

<!-- Soccer Section Begin -->
<section class="soccer-section mt-10">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 p-0">
                <div class="section-title">
                    <h3>Event <span>Terkini</span></h3>
                </div>
            </div>
        </div>
        <div class="row">
            @foreach ($events as $event)
                <div class="col-lg-3 col-sm-6 p-0">
                    <div class="soccer-item set-bg" data-setbg="{{ $event->media[0]['preview_url'] }}">
                        @foreach ($event->cabors as $cabor)
                            <div class="si-tag">{{ $cabor->name }}</div>
                        @endforeach
                        <div class="si-text">
                            <h5><a href="{{ route('event', $event->id) }}">{{ $event->name }}</a></h5>
                            <ul>
                                <li><i class="fa fa-calendar"></i> {{ $event->tgl_mulai }}</li>
                                <li><i class="fa fa-map"></i> {{ $event->venues[0]['name'] . '-' . $event->venues[0]['kota'] }}</li>
                            </ul>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
<!-- Soccer Section End -->

<!-- Latest Section Begin -->
<section class="latest-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="section-title latest-title">
                    <h3>Berita <span>Terbaru</span></h3>
                    <ul>
                        @foreach ($cabors as $cabor)
                            <li>{{ $cabor->name }}</li>
                        @endforeach
                    </ul>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        @foreach ($fourlatestNews as $item)
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
                    <div class="col-md-6">
                        @foreach ($fourlatestNews2 as $item)
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
            <div class="col-lg-4">
                <div class="section-title">
                    <h3>Cabang <span>Olah Raga</span></h3>
                </div>
                <div class="points-table">
                    <table>
                        <thead>
                            <tr>
                                <th class="th-o" style="width: 50px">No</th>
                                <th >Cabang Olah Raga</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $no = 1;
                            @endphp
                            @foreach ($cabors as $item)
                            <tr>
                                <td class="th-o">{{ $no++ }}</td>
                                <td class="team-name">
                                    @if ($item->image != null)
                                        <img src="{{ $item->image }}" alt="" style="width: 30px; height: 30px; border-radius: 50%; margin-right: 10px">
                                    @endif
                                    <span>{{ $item->name }}</span>
                                </td>
                            </tr>
                            @endforeach
                            
                        </tbody>
                    </table>
                    <a href="#" class="p-all">Lihat Semua</a>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Latest Section End -->
@endsection