@extends('layouts.admin')
@section('title','Tambah Kategori project')

@section('content')

<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">

            <div class="col-sm-6">
                <h1>Tambah Kategori project</h1>
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
            Form Tambah Kategori Project
        </h3>
    </div>



    @if($errors->any())

    <div class="alert alert-danger alert-dismissible m-3">

        <button type="button" class="close" data-dismiss="alert">
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





    <form action="{{ route('kategoriProject.store') }}"
          method="POST">

        @csrf


        <div class="card-body">


            <div class="form-group">

                <label>
                    Nama Kategori Project <span class="text-danger">*</span>
                </label>


                <input
                    type="text"
                    name="title"
                    maxlength="255"
                    value="{{ old('title') }}"
                    placeholder="Masukkan nama kategori Project"
                    class="form-control @error('title') is-invalid @enderror">


                @error('title')

                <span class="invalid-feedback">
                    {{ $message }}
                </span>

                @enderror


            </div>



            <div class="form-group">

                <label>
                    Slug
                </label>


                <input
                    type="text"
                    class="form-control"
                    placeholder="Slug dibuat otomatis"
                    readonly>


                <small class="text-muted">
                    Slug akan otomatis dibuat dari nama kategori Project.
                </small>


            </div>


        </div>



        <div class="card-footer">

            <button type="submit" class="btn btn-info">

                <i class="fas fa-save"></i>
                Simpan

            </button>


            <a href="{{ route('kategoriProject.index') }}"
               class="btn btn-dark">

                Batal

            </a>


        </div>


    </form>


</div>

</div>

</section>

@endsection