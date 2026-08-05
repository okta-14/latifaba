@extends('layouts.admin')
@section('title','Edit Group Company')
@section('content')

<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">

            <div class="col-sm-6">
                <h1>Edit Group Company</h1>
            </div>

            <div class="col-sm-6 text-right">
                <a href="{{ route('groupcompanies.index') }}" class="btn btn-secondary">
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
                    Form Edit Group Company
                </h3>
            </div>

            @if($errors->any())
                <div class="alert alert-danger alert-dismissible m-3">

                    <button
                        type="button"
                        class="close"
                        data-dismiss="alert"
                    >
                        &times;
                    </button>

                    <h5>
                        <i class="fas fa-ban"></i>
                        Validasi Gagal!
                    </h5>

                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>

                </div>
            @endif

            <form
                action="{{ route('groupcompanies.update', $company->id) }}"
                method="POST"
                enctype="multipart/form-data"
            >

                @csrf
                @method('PUT')

                <div class="card-body">

                    {{-- Nama Unit Bisnis --}}
                    <div class="form-group">

                        <label>
                            Nama Unit Bisnis
                            <span class="text-danger">*</span>
                        </label>

                        <input
                            type="text"
                            name="title"
                            value="{{ old('title', $company->title) }}"
                            class="form-control @error('title') is-invalid @enderror"
                            placeholder="Masukkan nama unit bisnis"
                        >

                        @error('title')
                            <span class="invalid-feedback">
                                {{ $message }}
                            </span>
                        @enderror

                    </div>

                    {{-- Website URL --}}
                    <div class="form-group">

                        <label>Website URL</label>

                        <input
                            type="text"
                            name="url"
                            value="{{ old('url', $company->url) }}"
                            class="form-control @error('url') is-invalid @enderror"
                            placeholder="https://contoh.com"
                        >

                        @error('url')
                            <span class="invalid-feedback">
                                {{ $message }}
                            </span>
                        @enderror

                    </div>

                    {{-- Logo --}}
                    <div class="form-group">

                        <label>
                            Logo / Gambar
                        </label>

                        <div class="custom-file">

                            <input
                                type="file"
                                id="image"
                                name="image"
                                accept="image/*"
                                class="custom-file-input @error('image') is-invalid @enderror"
                            >

                            <label
                                class="custom-file-label"
                                for="image"
                            >
                                Pilih Gambar...
                            </label>

                        </div>

                        @error('image')
                            <span class="text-danger d-block mt-2">
                                {{ $message }}
                            </span>
                        @enderror

                        <div class="mt-3">
                            <img
                                id="preview"
                                src="{{ asset($company->image) }}"
                                alt="Preview"
                                class="img-thumbnail"
                                style="max-width:300px;"
                            >
                        </div>

                        <small class="text-muted d-block mt-2">
                            Kosongkan jika tidak ingin mengganti gambar.
                        </small>

                    </div>

                    {{-- Status --}}
                    <div class="form-group">

                        <label>
                            Status
                            <span class="text-danger">*</span>
                        </label>

                        <select
                            name="status"
                            class="form-control @error('status') is-invalid @enderror"
                        >

                            <option
                                value="Show"
                                {{ old('status', $company->status) == 'Show' ? 'selected' : '' }}
                            >
                                Show
                            </option>

                            <option
                                value="Hide"
                                {{ old('status', $company->status) == 'Hide' ? 'selected' : '' }}
                            >
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

                    <button
                        type="submit"
                        class="btn btn-info"
                    >
                        <i class="fas fa-save"></i>
                        Update
                    </button>

                    <a
                        href="{{ route('groupcompanies.index') }}"
                        class="btn btn-dark"
                    >
                        Batal
                    </a>

                </div>

            </form>

        </div>

    </div>
</section>

<script>
document.getElementById('image').addEventListener('change', function (e) {

    let file = e.target.files[0];

    if (file) {

        document.querySelector('.custom-file-label').innerHTML = file.name;

        let reader = new FileReader();

        reader.onload = function (event) {

            let preview = document.getElementById('preview');

            preview.src = event.target.result;
            preview.style.display = 'block';

        };

        reader.readAsDataURL(file);

    }

});
</script>

@endsection

