@extends('layouts.admin')
@section('title','Tambah Video')
@section('content')

<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">

            <div class="col-sm-6">
                <h1>Tambah Video</h1>
            </div>

            <div class="col-sm-6 text-right">
                <a href="{{ route('video.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Kembali
                </a>
            </div>

        </div>
    </div>
</section>

<section class="content">

    <div class="container-fluid">

        <div class="card card-info">

            <div class="card-header">
                <h3 class="card-title">
                    Form Tambah Video
                </h3>
            </div>

            @if ($errors->any())
            <div class="alert alert-danger alert-dismissible m-3">

                <button type="button"
                    class="close"
                    data-dismiss="alert">
                    &times;
                </button>

                <h5>
                    <i class="fas fa-ban"></i>
                    Validasi Gagal!
                </h5>

                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>

            </div>
            @endif

            <form action="{{ route('video.store') }}" method="POST">

                @csrf

                <div class="card-body">

                    <div class="form-group">
                        <label>Tanggal <span class="text-danger">*</span></label>

                        <input
                            type="date"
                            name="date"
                            value="{{ old('date', date('Y-m-d')) }}"
                            class="form-control @error('date') is-invalid @enderror">

                        @error('date')
                        <span class="invalid-feedback">
                            {{ $message }}
                        </span>
                        @enderror

                    </div>

                    <div class="form-group">

                        <label>Judul <span class="text-danger">*</span></label>

                        <input
                            type="text"
                            name="title"
                            maxlength="100"
                            value="{{ old('title') }}"
                            placeholder="Masukkan judul video"
                            class="form-control @error('title') is-invalid @enderror">

                        @error('title')
                        <span class="invalid-feedback">
                            {{ $message }}
                        </span>
                        @enderror

                    </div>

                    <div class="form-group">

                        <label>Deskripsi <span class="text-danger">*</span></label>

                        <textarea
                            name="content"
                            rows="6"
                            placeholder="Masukkan deskripsi video"
                            class="form-control @error('content') is-invalid @enderror">{{ old('content') }}</textarea>

                        @error('content')
                        <span class="invalid-feedback">
                            {{ $message }}
                        </span>
                        @enderror

                    </div>

                    <div class="form-group">

                        <label>Link YouTube <span class="text-danger">*</span></label>

                        <input
                            type="url"
                            name="source"
                            value="{{ old('source') }}"
                            placeholder="https://www.youtube.com/watch?v=xxxxxxxx"
                            class="form-control @error('source') is-invalid @enderror">

                        @error('source')
                        <span class="invalid-feedback">
                            {{ $message }}
                        </span>
                        @enderror

                        <small class="text-muted">

                            <i class="fab fa-youtube text-danger"></i>

                            Tempel link YouTube seperti:

                            <br>

                            https://www.youtube.com/watch?v=XXXXXXXXXXX

                            <br>

                            atau

                            <br>

                            https://youtu.be/XXXXXXXXXXX

                        </small>

                    </div>

                    <div class="form-group">

                        <label>Status <span class="text-danger">*</span></label>

                        <select
                            name="status"
                            class="form-control @error('status') is-invalid @enderror">

                            <option value="">-- Pilih Status --</option>

                            <option value="Show"
                                {{ old('status')=='Show' ? 'selected' : '' }}>
                                Show
                            </option>

                            <option value="Hide"
                                {{ old('status')=='Hide' ? 'selected' : '' }}>
                                Hide
                            </option>

                        </select>

                        @error('status')
                        <span class="invalid-feedback">
                            {{ $message }}
                        </span>
                        @enderror

                    </div>

                </div>

                <div class="card-footer">

                    <button class="btn btn-info">

                        <i class="fas fa-save"></i>

                        Simpan

                    </button>

                    <a href="{{ route('video.index') }}"
                        class="btn btn-dark">

                        Batal

                    </a>

                </div>

            </form>

        </div>

    </div>

</section>

@endsection