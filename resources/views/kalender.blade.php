@extends('welcome')
@section('home')
<!-- Breadcrumb Section Begin -->
<section class="breadcrumb-section set-bg" data-setbg="{{ asset('specer') }}/img/breadcrumb-bg.jpg">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="bs-text">
                    <h2>Kalender Event</h2>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Breadcrumb Section End -->

<!-- Schedule Section Begin -->
<section class="schedule-section spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 left-blog-pad">
                <div class="schedule-text">
                    <h4 class="st-title">
                        <form action="{{ route('kalender') }}" method="GET">
                            <select class="col-md-8" name="cabor_id">
                                <option value="">Semua Cabor</option>
                                @foreach ($cabors as $cabor)
                                    <option value="{{ $cabor->id }}" {{ $cabor->id == $selectedCabor ? 'selected' : '' }}>
                                        {{ $cabor->name }}
                                    </option>
                                @endforeach
                            </select>
                            <button type="submit">Filter</button>
                        </form>
                    </h4>
                    <div class="st-table">
                        <table>
                            <tbody>
                                @if (count($events) > 0)
                                @foreach ($events as $item)
                                    <tr>
                                        <td class="left-team">
                                            <img src="{{ $item->media[0]['preview_url'] }}" alt="">
                                            <h4>{{ $item->name }}</h4>
                                        </td>
                                        <td class="st-option">
                                            <div class="so-text">{{ $item->venues[0]['name'] }}, {{ $item->venues[0]['alamat'] }}, {{ $item->venues[0]['kota'] }} </div>
                                            <div class="so-text">{{ $item->tgl_mulai . ' - ' . $item->tgl_selesai}}</div>
                                        </td>
                                        <td class="right-team">
                                            {{-- link detail event --}}
                                            <a href="{{ route('event', 1) }}">
                                                <h4>Detail</h4>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                                @else
                                    <tr>Tidak ada event yang tersedia untuk cabor ini.</tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="schedule-sidebar">
                    <div class="ss-league">
                        <div class="section-title sidebar-title">
                            <h5>Cabang Olah Raga</h5>
                        </div>
                        @foreach ($cabors as $item)
                            <a href="#" class="sl-item">
                                @if ($item->image != null)
                                    <img src="{{ $item->image }}" alt="">
                                @else
                                    <img src="https://konisidoarjo.id/wp-content/uploads/2022/11/Komite-Olahraga-Nasional-Indonesia-KONI-Logo.png" alt="">
                                @endif
                                <span>{{ $item->name }}</span>
                            </a>
                        @endforeach
                    </div>
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
<!-- Schedule Section End -->
@endsection