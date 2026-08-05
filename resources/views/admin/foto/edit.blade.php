@extends('layouts.admin')
@section('title','Edit Foto')
@section('content')

<section class="content-header">

    <div class="container-fluid">

        <div class="row mb-2">

            <div class="col-sm-6">

                <h1>Edit Foto</h1>

            </div>

            <div class="col-sm-6 text-right">

                <a href="{{ route('foto.index') }}" class="btn btn-secondary">

                    <i class="fas fa-arrow-left"></i>

                    Kembali

                </a>

            </div>

        </div>

    </div>

</section>

<section class="content">

    <div class="container-fluid">

        <div class="card card-warning">

            <div class="card-header">

                <h3 class="card-title">

                    Form Edit Foto

                </h3>

            </div>

            @if($errors->any())

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

                    @foreach($errors->all() as $error)

                    <li>{{ $error }}</li>

                    @endforeach

                </ul>

            </div>

            @endif

            <form
                action="{{ route('foto.update',$foto->id) }}"
                method="POST"
                enctype="multipart/form-data">

                @csrf
                @method('PUT')

                <div class="card-body">

                    {{-- Album --}}
                    <div class="form-group">

                        <label>

                            Album
                            <span class="text-danger">*</span>

                        </label>

                        <select
                            name="album_id"
                            class="form-control @error('album_id') is-invalid @enderror">

                            <option value="">

                                -- Pilih Album --

                            </option>

                            @foreach($albums as $album)

                            <option
                                value="{{ $album->id }}"
                                {{ old('album_id',$foto->album_id)==$album->id ? 'selected' : '' }}>

                                {{ $album->title }}

                            </option>

                            @endforeach

                        </select>

                        @error('album_id')

                        <span class="invalid-feedback">

                            {{ $message }}

                        </span>

                        @enderror

                    </div>

                    {{-- Foto --}}
                    <div class="form-group">

                        <label>

                            Ganti Foto

                        </label>

                        <div class="custom-file">

                            <input
                                type="file"
                                id="img"
                                name="img"
                                accept="image/*"
                                class="custom-file-input @error('img') is-invalid @enderror">

                            <label class="custom-file-label" for="img">

                                Pilih Foto...

                            </label>

                        </div>

                        @error('img')

                        <span class="text-danger d-block mt-2">

                            {{ $message }}

                        </span>

                        @enderror

                        <small class="text-muted">

                            Kosongkan jika tidak ingin mengganti foto.

                        </small>

                    </div>

                    {{-- Preview --}}
                    <div class="form-group">

                        <label>

                            Preview

                        </label>

                        <br>

                        <img
                            id="preview"
                            src="{{ asset($foto->img) }}"
                            class="img-thumbnail"
                            style="max-width:300px;">

                    </div>

                </div>

                <div class="card-footer">

                    <button
                        type="submit"
                        class="btn btn-warning">

                        <i class="fas fa-save"></i>

                        Update

                    </button>

                    <a
                        href="{{ route('foto.index') }}"
                        class="btn btn-dark">

                        Batal

                    </a>

                </div>

            </form>

        </div>

    </div>

</section>

<script>

document.getElementById('img').addEventListener('change',function(e){

    let file = e.target.files[0];

    if(file){

        document.querySelector('.custom-file-label').innerHTML=file.name;

        let reader = new FileReader();

        reader.onload=function(event){

            let preview=document.getElementById('preview');

            preview.src=event.target.result;

        }

        reader.readAsDataURL(file);

    }

});

</script>

@endsection