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
        <div class="card bg-warning">
            <div class="card-body">
                <h3 class="fw-normal text-body-emphasis">Visi</h3>
                {!! $profile->vision !!}
            </div>
        </div>
    </section>
    <section class="mb-5">
        <div class="card bg-success text-white">
            <div class="card-body">
                <h3 class="fw-normal text-white">Misi</h3>
                {!! $profile->mission !!}
            </div>
        </div>
    </section>

    <hr>
    <section class="mb-5 pt-3">
        <h3 class="fw-normal text-body-emphasis mb-4">Gallery</h3>
        <div class="row row-cols-1 row-cols-md-3 mb-3">
            @foreach ($albums as $item)
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
    </section>
@endsection

@section('footer')
    <footer class="pt-4 my-md-5 pt-md-5 border-top">
        <div class="row">
            <div class="col-12 col-md text-center">
                <img class="mb-2" src="{{ $profile->logo }}" alt="{{ $profile->name }}" width="44">
                <small class="d-block mb-3 text-body-secondary">&copy; 2017–2024</small>
            </div>
            <div class="col-6 col-md">
                <h5>Features</h5>
                <ul class="list-unstyled text-small">
                    <li class="mb-1"><a class="link-secondary text-decoration-none" href="#">Cool
                            stuff</a></li>
                    <li class="mb-1"><a class="link-secondary text-decoration-none" href="#">Random
                            feature</a></li>
                    <li class="mb-1"><a class="link-secondary text-decoration-none" href="#">Team
                            feature</a></li>
                    <li class="mb-1"><a class="link-secondary text-decoration-none" href="#">Stuff for
                            developers</a></li>
                    <li class="mb-1"><a class="link-secondary text-decoration-none" href="#">Another
                            one</a></li>
                    <li class="mb-1"><a class="link-secondary text-decoration-none" href="#">Last
                            time</a></li>
                </ul>
            </div>
            <div class="col-6 col-md">
                <h5>Resources</h5>
                <ul class="list-unstyled text-small">
                    <li class="mb-1"><a class="link-secondary text-decoration-none" href="#">Resource</a>
                    </li>
                    <li class="mb-1"><a class="link-secondary text-decoration-none" href="#">Resource
                            name</a></li>
                    <li class="mb-1"><a class="link-secondary text-decoration-none" href="#">Another
                            resource</a></li>
                    <li class="mb-1"><a class="link-secondary text-decoration-none" href="#">Final
                            resource</a></li>
                </ul>
            </div>
            <div class="col-6 col-md">
                <h5>About</h5>
                <ul class="list-unstyled text-small">
                    <li class="mb-1"><a class="link-secondary text-decoration-none" href="#">Team</a>
                    </li>
                    <li class="mb-1"><a class="link-secondary text-decoration-none" href="#">Locations</a></li>
                    <li class="mb-1"><a class="link-secondary text-decoration-none" href="#">Privacy</a>
                    </li>
                    <li class="mb-1"><a class="link-secondary text-decoration-none" href="#">Terms</a>
                    </li>
                </ul>
            </div>
        </div>
    </footer>
@endsection
