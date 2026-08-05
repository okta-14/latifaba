@extends('layouts.admin')
@section('title','Tambah Foto Program')

@section('content')

<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">

            <div class="col-sm-6">
                <h1>Tambah Foto Program</h1>
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
            Form Tambah Foto
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

    <form action="{{ route('projectfoto.store') }}"
          method="POST"
          enctype="multipart/form-data">

        @csrf

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
                        {{ old('id_project')==$program->id ? 'selected' : '' }}>
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

            {{-- Foto (multiple) --}}
            <div class="form-group">

                <label>
                    Foto <span class="text-danger">*</span>
                </label>

                <div class="custom-file">

                    <input
                        type="file"
                        id="img"
                        name="img[]"
                        accept="image/*"
                        multiple
                        class="custom-file-input @error('img') is-invalid @enderror">

                    <label class="custom-file-label" for="img">
                        Pilih Foto (bisa lebih dari satu)...
                    </label>

                </div>

                @error('img')
                    <span class="text-danger d-block mt-2">
                        {{ $message }}
                    </span>
                @enderror

                @error('img.*')
                    <span class="text-danger d-block mt-1">
                        {{ $message }}
                    </span>
                @enderror

                <small class="text-muted">
                    Format: JPG, JPEG, PNG, WEBP (Maksimal 2 MB per foto). Bisa pilih beberapa foto sekaligus.
                </small>

            </div>

            <div class="form-group">

                <div id="previewContainer"
                     class="d-flex flex-wrap gap-2">
                </div>

            </div>

        </div>

        <div class="card-footer">

            <button type="submit"
                    class="btn btn-info">

                <i class="fas fa-save"></i>
                Simpan

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
document.getElementById('img').addEventListener('change', function(e){

    let files = e.target.files;

    this.nextElementSibling.innerHTML = files.length + ' foto dipilih';

    let container = document.getElementById('previewContainer');
    container.innerHTML = '';

    Array.from(files).forEach(function(file){

        let reader = new FileReader();

        reader.onload = function(event){

            let img = document.createElement('img');
            img.src = event.target.result;
            img.className = 'img-thumbnail';
            img.style.maxWidth = '150px';
            img.style.marginRight = '8px';
            img.style.marginBottom = '8px';

            container.appendChild(img);

        }

        reader.readAsDataURL(file);

    });

});
</script>
@endsection