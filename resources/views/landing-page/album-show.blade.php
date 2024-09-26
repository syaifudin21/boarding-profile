@extends('template.landing-page')
@section('title', $title)
@section('content')
    <section>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Album</li>
            </ol>
        </nav>
    </section>

    <section class="mb-5 pt-3">
        <h3>{{ $album->album }}</h3>
        <p>{{ $album->description }}</p>
        <div class="row row-cols-1 row-cols-md-3 mb-3">
            @foreach ($album->photos as $item)
                <div class="col">
                    <a href="#" data-bs-toggle="modal" data-bs-target="#exampleModal"
                        data-bs-image="{{ $item->photo }}">
                        <img src="{{ $item->photo }}" width="100%"
                            style="height: 200px; object-fit: cover; margin-bottom: 10px">
                    </a>
                </div>
            @endforeach
        </div>


        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <img src="" id="modal-image" width="100%">
            </div>
        </div>


    </section>
@endsection

@section('script')
    <script>
        const exampleModal = document.getElementById('exampleModal')
        if (exampleModal) {
            exampleModal.addEventListener('show.bs.modal', event => {

                console.log(event);
                // Button that triggered the modal
                const button = event.relatedTarget
                // Extract info from data-bs-* attributes
                const recipient = button.getAttribute('data-bs-image')
                // If necessary, you could initiate an Ajax request here
                // and then do the updating in a callback.

                const imgElement = document.getElementById('modal-image');
                imgElement.src = recipient;
            })
        }
    </script>
@endsection
