@extends('layouts.admin')
@section('title','Tambah Media')
@section('content')

<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Tambah Media</h1>
            </div>
            <div class="col-sm-6 text-right">
                <a href="{{ route('media.index') }}" class="btn btn-secondary">
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
                <h3 class="card-title">Form Tambah Media</h3>
            </div>

            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible m-3">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h5><i class="icon fas fa-ban"></i> Validasi Gagal!</h5>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('media.store') }}" method="POST">
                @csrf

                <div class="card-body">

                    <div class="form-group">
                        <label>Title <span class="text-danger">*</span></label>
                        <input type="text" 
                               name="title" 
                               class="form-control @error('title') is-invalid @enderror" 
                               value="{{ old('title') }}" 
                               placeholder="Masukkan judul media">
                        @error('title')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>URL <span class="text-danger">*</span></label>
                        <input type="url" 
                               name="url" 
                               class="form-control @error('url') is-invalid @enderror" 
                               value="{{ old('url') }}" 
                               placeholder="https://example.com/gambar.jpg atau https://www.youtube.com/embed/xxx">
                        @error('url')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                        <small class="text-muted">
                            <i class="fas fa-info-circle"></i> 
                            Masukkan URL lengkap dengan http:// atau https://
                            <br>
                            <i class="fas fa-youtube text-danger"></i> Untuk YouTube: https://www.youtube.com/embed/VIDEO_ID
                            <br>
                            <i class="fas fa-image text-primary"></i> Untuk gambar: https://example.com/gambar.jpg
                        </small>
                    </div>

                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-info">
                        <i class="fas fa-save"></i> Simpan
                    </button>
                    <a href="{{ route('media.index') }}" class="btn btn-dark">Batal</a>
                </div>

            </form>
        </div>
    </div>
</section>

@endsection