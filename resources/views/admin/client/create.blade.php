@extends('layouts.admin')
@section('title', 'Tambah Client')

@section('content')

<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">

            <div class="col-sm-6">
                <h1>Tambah Client</h1>
            </div>

            <div class="col-sm-6 text-right">
                <a href="{{ route('client.index') }}" class="btn btn-secondary">
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
                    Form Tambah Client
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

            <form action="{{ route('client.store') }}"
                  method="POST"
                  enctype="multipart/form-data">

                @csrf

                <div class="card-body">

                    {{-- Nama Client --}}
                    <div class="form-group">

                        <label>
                            Nama Client <span class="text-danger">*</span>
                        </label>

                        <input
                            type="text"
                            name="title"
                            maxlength="255"
                            value="{{ old('title') }}"
                            placeholder="Masukkan nama client"
                            class="form-control @error('title') is-invalid @enderror">

                        @error('title')
                            <span class="invalid-feedback">
                                {{ $message }}
                            </span>
                        @enderror

                    </div>

                    {{-- Logo Client --}}
                    <div class="form-group">

                        <label>
                            Logo Client <span class="text-danger">*</span>
                        </label>

                        <div class="custom-file">

                            <input
                                type="file"
                                id="img"
                                name="img"
                                accept="image/*"
                                class="custom-file-input @error('img') is-invalid @enderror">

                            <label class="custom-file-label" for="img">
                                Pilih Gambar...
                            </label>

                        </div>

                        @error('img')
                            <span class="text-danger d-block mt-2">
                                {{ $message }}
                            </span>
                        @enderror

                        <small class="text-muted">
                            Format: JPG, JPEG, PNG, WEBP (Maksimal 2 MB)
                        </small>

                    </div>

                    {{-- Preview --}}
                    <div class="form-group">

                        <img
                            id="preview"
                            src="#"
                            class="img-thumbnail"
                            style="display:none; max-width:200px;">

                    </div>

                    {{-- Website --}}
                    <div class="form-group">

                        <label>
                            Website Client
                        </label>

                        <input
                            type="url"
                            name="url"
                            value="{{ old('url') }}"
                            placeholder="https://example.com"
                            class="form-control @error('url') is-invalid @enderror">

                        @error('url')
                            <span class="invalid-feedback">
                                {{ $message }}
                            </span>
                        @enderror

                    </div>

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
                                {{ old('status') == 'Show' ? 'selected' : '' }}>
                                Show
                            </option>

                            <option value="Hide"
                                {{ old('status') == 'Hide' ? 'selected' : '' }}>
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
                        <i class="fas fa-save"></i> Simpan
                    </button>

                    <a href="{{ route('client.index') }}"
                       class="btn btn-dark">
                        Batal
                    </a>

                </div>

            </form>

        </div>

    </div>
</section>

<script>
document.getElementById('img').addEventListener('change', function(e){

    let file = e.target.files[0];

    if(file){

        document.querySelector('.custom-file-label').innerHTML = file.name;

        let reader = new FileReader();

        reader.onload = function(event){

            let preview = document.getElementById('preview');

            preview.src = event.target.result;
            preview.style.display = "block";

        }

        reader.readAsDataURL(file);

    }

});
</script>

@endsection