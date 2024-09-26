@extends('template.landing-page')
@section('title', $title)
@section('content')
    <section class="mb-5">
        <div id="myCarousel" class="carousel slide mb-6" data-bs-ride="carousel">
            <div class="carousel-indicators">
                @for ($i = 0; $i < count($banner); $i++)
                    <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="{{ $i }}"
                        class="{{ $i == 0 ? 'active' : '' }}" aria-current="{{ $i == 0 ? 'true' : '' }}"
                        aria-label="Slide {{ $i + 1 }}"></button>
                @endfor
            </div>
            <div class="carousel-inner">
                @foreach ($banner as $no => $item)
                    <div class="carousel-item {{ $no == 0 ? 'active' : '' }}"
                        style="background: url('{{ $item->image }}') no-repeat center center; height: 500px; background-size: cover;">
                        <div class="container">
                            <div class="carousel-caption text-start">
                                <h1>{{ $item->title }}</h1>
                                <p class="opacity-75">
                                    {!! $item->description !!}
                                </p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#myCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#myCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </section>

    <section class="mb-5">
        <div class="row">
            <div class="col-sm-5">
                <img src="{{ $profile->logo }}" alt="{{ $profile->name }}" width="100%">
            </div>
            <div class="col-sm-7">
                <h3 class="fw-normal text-body-emphasis">About</h3>
                <p class="fs-5 text-body-secondary">{!! $profile->about !!}</p>
            </div>
        </div>
    </section>

    <section class="mb-5">
        <div class="row">
            @foreach ($employee as $item)
                <div class="col-sm-4">
                    <div class="card">
                        <img src="{{ $item->photo }}" class="card-img-top" alt="..."
                            style="height: 300px; object-fit: cover; padding: 15px">
                        <div class="card-body">
                            <h5 class="card-title">{{ $item->name }}</h5>
                            <h6 class="card-subtitle mb-2 text-body-secondary"><small> {{ $item->position }}</small></h6>
                            {{-- <p class="card-text">{{ $item->description }}</p> --}}
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>

    <section class="mb-5">
        <h3 class="fw-normal text-body-emphasis">Visi</h3>
        {!! $profile->vision !!}
    </section>
    <section class="mb-5">
        <h3 class="fw-normal text-body-emphasis">Misi</h3>
        {!! $profile->mission !!}
    </section>

    <hr>
    <section class="mb-5 pt-3">
        <div class="row">
            <div class="row row-cols-1 row-cols-md-3 mb-3">
                @foreach ($almbums as $item)
                    <div class="col">
                        <a href="{{ route('album.show', $item->uuid) }}" class="text-decoration-none"
                            style="text-decoration: none; color: inherit;">
                            <img src="{{ $item->photo }}" alt="{{ $item->album }}" width="100%"
                                style="height: 200px; object-fit: cover; margin-bottom: 10px">
                            <span class="fw-bold">{{ $item->album }}</span>
                            <p class="">{{ $item->description }}</p>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
