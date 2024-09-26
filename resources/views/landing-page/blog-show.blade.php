@extends('template.landing-page')
@section('title', $title)
@section('content')
    <section>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('blog') }}">Blog</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ $blog->title }}</li>
            </ol>
        </nav>
    </section>

    <section class="mb-5 pt-3">


        <div style="height: 500px; overflow: hidden">
            <img src="{{ $blog->image }}" width="100%">
        </div>

        <div class="mt-3">
            <h3>{{ $blog->title }}</h3>
            <p class="text-muted">Oleh : {{ $blog->owner }} - Kategori : {{ $blog->category }} - Dibuat :
                {{ $blog->created_at }}</p>
            <p>{!! $blog->content !!}</p>
        </div>

    </section>
@endsection

@section('script')
@endsection
