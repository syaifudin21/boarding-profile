@extends('template.landing-page')
@section('title', $title)
@section('content')
    <section>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Facility</li>
            </ol>
        </nav>
    </section>

    <section class="mb-5 pt-3">
        <div class="row row-cols-1 row-cols-md-3 mb-3">
            @foreach ($facility as $item)
                <div class="col">
                    <img src="{{ $item->image }}" alt="{{ $item->name }}" width="100%"
                        style="height: 200px; object-fit: cover; margin-bottom: 10px">
                    <span class="fw-bold">{{ $item->name }}</span>
                    <p class="">{{ $item->description }}</p>
                </div>
            @endforeach
        </div>



    </section>
@endsection

@section('script')
@endsection
