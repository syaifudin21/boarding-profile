@extends('template.landing-page')
@section('title', $title)
@section('content')
    <section>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Blog</li>
            </ol>
        </nav>
    </section>

    <section class="mb-5 pt-3">

        @if (count($blog) > 0)
            @foreach ($blog as $item)
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex">
                            <div class="flex-shrink-0">
                                <img src="{{ $item->image }}" alt="..." width="100">
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h5>{{ $item->title }}</h5>
                                <p>{{ $item->category }} - {{ $item->created_at }}</p>
                                <a href="{{ route('blog.show', [$item->slug, $item->uuid]) }}"
                                    class="btn btn-sm btn-link">Read
                                    More</a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <div class="col">
                <div class="alert alert-warning">
                    Data Tidak Ada
                </div>
            </div>
        @endif


    </section>
@endsection

@section('script')
@endsection
