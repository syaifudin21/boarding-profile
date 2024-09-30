@extends('template.landing-page')
@section('title', $title)
@section('content')
    <section>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Alumni</li>
            </ol>
        </nav>
    </section>

    <section class="mb-5 pt-3">
        <div class="row justify-content-center">
            <div class="col-md-8 p-5">
                <div class="card">
                    <div class="card-body">
                        <h3>Daftarkan diri anda sebagai Alumni</h3>
                        @if (session('success'))
                            <div class="alert alert-success" role="alert">
                                {{ session('success') }}
                            </div>
                        @endif
                        <form action="{{ route('alumni.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="name" class="form-label">Nama Alumni</label>
                                <input type="text" value="{{ old('name') }}" name="name" class="form-control"
                                    id="name" required>
                                @error('name')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="position" class="form-label">Profesi / Pekerjaan / Mahasiswa (Sekarang)</label>
                                <input type="text" value="{{ old('position') }}" name="position" class="form-control"
                                    id="position" required>
                                @error('position')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="description" class="form-label">Deskripsi <span class="text-danger">(Sampaikan
                                        hal baik selama
                                        Sekolah)</span></label>
                                <textarea class="form-control" value="{{ old('description') }}" name="description" id="description" rows="5"
                                    required></textarea>
                                @error('description')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="photo" class="form-label">Foto Terbaru Alumni</label>
                                <input type="file" accept="image/*" value="{{ old('photo') }}" name="photo"
                                    class="form-control" id="photo" required>
                                @error('photo')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-primary">Kirim</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </section>
@endsection

@section('script')
@endsection
