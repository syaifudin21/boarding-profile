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
        @if (count($facility) > 0)
            <div class="row row-cols-1 row-cols-md-3 mb-3">
                @foreach ($facility as $item)
                    <div class="col">
                        <div class="card">
                            <div class="card-body">
                                <a href="#" data-bs-toggle="modal" data-bs-target="#exampleModal"
                                    data-bs-image="{{ $item->image }}" style="text-decoration: none; color: inherit;">
                                    <img src="{{ $item->image }}" alt="{{ $item->name }}" width="100%"
                                        style="height: 200px; object-fit: cover; margin-bottom: 10px">
                                    <span class="fw-bold">{{ $item->name }}</span>
                                    <p class="">{{ $item->description }}</p>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-lg">
                        <img src="" id="modal-image" width="100%">
                    </div>
                </div>
            </div>
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
