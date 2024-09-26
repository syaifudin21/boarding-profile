@extends('template.landing-page')
@section('title', $title)
@section('content')
    <section>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Contact</li>
            </ol>
        </nav>
    </section>

    <section class="mb-5 pt-3">
        <div class="row">
            <div class="col-md-6">
                <h3>Contact Us</h3>
                <p>If you have any questions or need assistance, please feel free to contact us.</p>
                <ul>
                    <li>Email: {{ $profile->email }}</li>
                    <li>Phone: {{ $profile->phone }}</li>
                    <li>Address: {{ $profile->address }}</li>
                </ul>
            </div>
            <div class="col-md-6">
                <h3>Send Us a Message</h3>
                @if (session('success'))
                    <div class="alert alert-success" role="alert">
                        {{ session('success') }}
                    </div>
                @endif
                <form action="{{ route('message.store') }}" method="post">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" value="{{ old('name') }}" name="name" class="form-control" id="name"
                            required>
                        @error('name')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" value="{{ old('email') }}" name="email" class="form-control" id="email"
                            required>
                        @error('email')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="message" class="form-label">Message</label>
                        <textarea class="form-control" value="{{ old('message') }}" name="message" id="message" rows="5" required></textarea>
                        @error('message')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>



    </section>
@endsection

@section('script')
@endsection
