@extends('layouts.admin')
@section('title','Edit Foto Program')

@section('content')

<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">

            <div class="col-sm-6">
                <h1>Edit Foto Program</h1>
            </div>

            <div class="col-sm-6 text-right">
                <a href="{{ route('projectfoto.index') }}" class="btn btn-secondary">
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

    <form action="{{ route('projectfoto.update', $foto->id) }}"
          method="POST"
          enctype="multipart/form-data">

        @csrf
        @method('PUT')

        <div class="card-body">

            <div class="form-group">

                <label>
                    Program <span class="text-danger">*</span>
                </label>

                <select name="id_project"
                        class="form-control @error('id_project') is-invalid @enderror">

                    <option value="">-- Pilih Program --</option>

                    @foreach($programs as $program)

                    <option value="{{ $program->id }}"
                        {{ old('id_project', $foto->id_project)==$program->id ? 'selected' : '' }}>
                        {{ $program->title }}
                    </option>

                    @endforeach

                </select>

                @error('id_project')
                <span class="invalid-feedback">
                    {{ $message }}
                </span>
                @enderror

            </div>

            {{-- Foto --}}
            <div class="form-group">

                <label>
                    Foto
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
                    Format: JPG, JPEG, PNG, WEBP (Maksimal 2 MB). Kosongkan jika tidak ingin mengubah foto.
                </small>

            </div>

            <div class="form-group">

                @if($foto->img)
                <p class="mb-1"><small class="text-muted">Foto saat ini:</small></p>
                <img
                    src="{{ asset($foto->img) }}"
                    class="img-thumbnail mb-2"
                    style="max-width:250px;">
                @endif

                <img
                    id="previewImg"
                    src="#"
                    class="img-thumbnail"
                    style="display:none;max-width:250px;">

            </div>

        </div>

        <div class="card-footer">

            <button type="submit"
                    class="btn btn-info">

                <i class="fas fa-save"></i>
                Update

            </button>

            <a href="{{ route('projectfoto.index') }}"
               class="btn btn-dark">

                Batal

            </a>

        </div>

    </form>

</div>

</div>

</section>

<script>
function previewImage(inputId, previewId){

    document.getElementById(inputId).addEventListener('change', function(e){

        let file = e.target.files[0];

        if(file){

            this.nextElementSibling.innerHTML = file.name;

            let reader = new FileReader();

            reader.onload = function(event){

                let preview = document.getElementById(previewId);

                preview.src = event.target.result;
                preview.style.display = "block";

            }

            reader.readAsDataURL(file);

        }

    });

}

previewImage('img','previewImg');
</script>
@endsection