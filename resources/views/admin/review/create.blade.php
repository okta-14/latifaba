@extends('layouts.admin')
@section('title', 'Tambah Review')

@section('content')

<section class="content-header">

    <div class="container-fluid">

        <div class="row mb-2">

            <div class="col-sm-6">
                <h1>Tambah Review</h1>
            </div>

            <div class="col-sm-6 text-right">

                <a href="{{ route('reviewadmin.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i>
                    Kembali
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
                    Form Tambah Review
                </h3>
            </div>

            @if ($errors->any())

            <div class="alert alert-danger alert-dismissible m-3">

                <button type="button" class="close" data-dismiss="alert">
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

            <form action="{{ route('reviewadmin.store') }}" method="POST">

                @csrf

                <div class="card-body">

                    {{-- Nama --}}
                    <div class="form-group">

                        <label>
                            Nama <span class="text-danger">*</span>
                        </label>

                        <input
                            type="text"
                            name="nama"
                            maxlength="255"
                            value="{{ old('nama') }}"
                            class="form-control @error('nama') is-invalid @enderror">

                        @error('nama')
                            <span class="invalid-feedback">
                                {{ $message }}
                            </span>
                        @enderror

                    </div>

                    {{-- Pekerjaan Indonesia --}}
                    <div class="form-group">

                        <label>
                            Pekerjaan (Indonesia) <span class="text-danger">*</span>
                        </label>

                        <input
                            type="text"
                            name="pekerjaan[id]"
                            value="{{ old('pekerjaan.id') }}"
                            class="form-control @error('pekerjaan.id') is-invalid @enderror">

                        @error('pekerjaan.id')
                            <span class="invalid-feedback">
                                {{ $message }}
                            </span>
                        @enderror

                        <small class="text-muted">
                            Jika English & Jepang dikosongkan maka akan diterjemahkan otomatis.
                        </small>

                    </div>

                    {{-- Pekerjaan English --}}
                    <div class="form-group">

                        <label>Pekerjaan (English)</label>

                        <input
                            type="text"
                            name="pekerjaan[en]"
                            value="{{ old('pekerjaan.en') }}"
                            class="form-control">

                    </div>

                    {{-- Pekerjaan Jepang --}}
                    <div class="form-group">

                        <label>Pekerjaan (日本語)</label>

                        <input
                            type="text"
                            name="pekerjaan[jp]"
                            value="{{ old('pekerjaan.jp') }}"
                            class="form-control">

                    </div>

                    <hr>

                    {{-- Rating --}}
                    <div class="form-group">

                        <label>
                            Rating <span class="text-danger">*</span>
                        </label>

                        <select
                            name="stars"
                            class="form-control @error('stars') is-invalid @enderror">

                            <option value="">-- Pilih Rating --</option>

                            @for($i=5;$i>=1;$i--)
                                <option
                                    value="{{ $i }}"
                                    {{ old('stars')==$i?'selected':'' }}>
                                    {{ $i }} Bintang
                                </option>
                            @endfor

                        </select>

                        @error('stars')
                            <span class="invalid-feedback">
                                {{ $message }}
                            </span>
                        @enderror

                    </div>

                    {{-- Review Indonesia --}}
                    <div class="form-group">

                        <label>
                            Review (Indonesia) <span class="text-danger">*</span>
                        </label>

                        <textarea
                            name="review[id]"
                            rows="6"
                            class="form-control @error('review.id') is-invalid @enderror">{{ old('review.id') }}</textarea>

                        @error('review.id')
                            <span class="invalid-feedback">
                                {{ $message }}
                            </span>
                        @enderror

                        <small class="text-muted">
                            Jika English & Jepang dikosongkan maka akan diterjemahkan otomatis.
                        </small>

                    </div>

                    {{-- Review English --}}
                    <div class="form-group">

                        <label>Review (English)</label>

                        <textarea
                            name="review[en]"
                            rows="6"
                            class="form-control">{{ old('review.en') }}</textarea>

                    </div>

                    {{-- Review Jepang --}}
                    <div class="form-group">

                        <label>Review (日本語)</label>

                        <textarea
                            name="review[jp]"
                            rows="6"
                            class="form-control">{{ old('review.jp') }}</textarea>

                    </div>

                    <hr>

                    {{-- Status --}}
                    <div class="form-group">

                        <label>
                            Status <span class="text-danger">*</span>
                        </label>

                        <select
                            name="status"
                            class="form-control @error('status') is-invalid @enderror">

                            <option value="">-- Pilih Status --</option>

                            <option value="Show"
                                {{ old('status')=='Show'?'selected':'' }}>
                                Show
                            </option>

                            <option value="Hide"
                                {{ old('status')=='Hide'?'selected':'' }}>
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

                    <button type="submit" class="btn btn-info">
                        <i class="fas fa-save"></i>
                        Simpan
                    </button>

                    <a href="{{ route('reviewadmin.index') }}" class="btn btn-dark">
                        Batal
                    </a>

                </div>

            </form>

        </div>

    </div>

</section>

@endsection