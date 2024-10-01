@extends('template.landing-page')
@section('title', $title)
@section('content')
    <section>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Pengurus</li>
            </ol>
        </nav>
    </section>

    <section class="mb-5 pt-3">
        @if (count($employee) > 0)
            <div class="row row-cols-1 row-cols-md-3 mb-3">
                @foreach ($employee as $item)
                    <div class="col">
                        <div class="card">
                            <div class="card-body">
                                <a href="#" data-bs-toggle="modal" data-bs-target="#exampleModal"
                                    data-bs-image="{{ $item->photo }}" data-bs-name="{{ $item->name }}"
                                    data-bs-position="{{ $item->position }}" data-bs-description="{{ $item->description }}"
                                    style="text-decoration: none; color: inherit;">
                                    <img src="{{ $item->photo }}" alt="{{ $item->name }}" width="100%"
                                        style="height: 200px; object-fit: cover; margin-bottom: 10px">
                                    <h5 class="card-title">{{ $item->name }}</h5>
                                    <h6 class="card-subtitle mb-2 text-body-secondary"><small> {{ $item->position }}</small>
                                    </h6>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">

                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Detail Pengurus</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <img src="" id="modal-image" width="100%">
                                <h5 id="modal-name"></h5>
                                <h6 id="modal-position"></h6>
                                <p id="modal-description"></p>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        @else
            <div class="col-sm-12">
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
                const image = button.getAttribute('data-bs-image')
                const name = button.getAttribute('data-bs-name')
                const position = button.getAttribute('data-bs-position')
                const description = button.getAttribute('data-bs-description')
                // If necessary, you could initiate an Ajax request here
                // and then do the updating in a callback.

                const imgElement = document.getElementById('modal-image');
                imgElement.src = image;

                const nameElement = document.getElementById('modal-name');
                nameElement.textContent = name;

                const positionElement = document.getElementById('modal-position');
                positionElement.textContent = position;

                const descriptionElement = document.getElementById('modal-description');
                descriptionElement.textContent = description;
            })
        }
    </script>
@endsection
