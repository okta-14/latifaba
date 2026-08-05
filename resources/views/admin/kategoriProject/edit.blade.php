@extends('layouts.admin')

@section('title', 'Edit Kategori Project')

@section('content')

<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">

            <div class="col-sm-6">
                <h1>Edit Kategori Project</h1>
            </div>

            <div class="col-sm-6 text-right">
                <a href="{{ route('kategoriProject.index') }}" class="btn btn-secondary">
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
                    Form Edit Kategori Project
                </h3>
            </div>

            @if ($errors->any())

                <div class="alert alert-danger alert-dismissible m-3">

                    <button type="button" class="close" data-dismiss="alert">
                        <span>&times;</span>
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

            <form action="{{ route('kategoriProject.update', $kategori->id) }}" method="POST">

                @csrf
                @method('PUT')

                <div class="card-body">

                    <div class="form-group">

                        <label>
                            Nama Kategori Project <span class="text-danger">*</span>
                        </label>

                        <input
                            type="text"
                            name="title"
                            maxlength="255"
                            value="{{ old('title', $kategori->title) }}"
                            placeholder="Masukkan nama kategori project"
                            class="form-control @error('title') is-invalid @enderror">

                        @error('title')
                            <span class="invalid-feedback">
                                {{ $message }}
                            </span>
                        @enderror

                    </div>

                    <div class="form-group">

                        <label>Slug</label>

                        <input
                            type="text"
                            class="form-control"
                            value="{{ $kategori->slug }}"
                            readonly>

                        <small class="text-muted">
                            Slug akan otomatis diperbarui sesuai judul kategori project.
                        </small>

                    </div>

                </div>

                <div class="card-footer">

                    <button type="submit" class="btn btn-info">
                        <i class="fas fa-save"></i> Update
                    </button>

                    <a href="{{ route('kategoriProject.index') }}" class="btn btn-secondary">
                        Batal
                    </a>

                </div>

            </form>

        </div>

    </div>

</section>

@endsection