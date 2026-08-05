@extends('layouts.admin')
@section('title', 'Edit Album')

@section('content')

<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">

            <div class="col-sm-6">
                <h1>Edit Album</h1>
            </div>

            <div class="col-sm-6 text-right">

                <a href="{{ route('albumadmin.index') }}" class="btn btn-secondary">
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
            Form Edit Album
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

<form action="{{ route('albumadmin.update',$album->id) }}"
      method="POST"
      enctype="multipart/form-data">


@csrf

@method('PUT')



<div class="card-body">


    {{-- Tanggal --}}

    <div class="form-group">

        <label>
            Tanggal <span class="text-danger">*</span>
        </label>


        <input
            type="date"
            name="date"
            value="{{ old('date',$album->date) }}"
            class="form-control @error('date') is-invalid @enderror">


        @error('date')

            <span class="invalid-feedback">
                {{ $message }}
            </span>

        @enderror


    </div>

    {{-- Judul --}}

    <div class="form-group">

        <label>
            Judul Album <span class="text-danger">*</span>
        </label>


        <input
            type="text"
            name="title"
            maxlength="100"
            value="{{ old('title',$album->title) }}"
            placeholder="Masukkan judul album"
            class="form-control @error('title') is-invalid @enderror">


        @error('title')

            <span class="invalid-feedback">
                {{ $message }}
            </span>

        @enderror


    </div>


    {{-- Gambar Lama --}}

    <div class="form-group">


        <label>
            Cover Saat Ini
        </label>


        <br>


        @if($album->img)

        <img src="{{ asset($album->img) }}"
             width="200"
             class="img-thumbnail mb-3">

        @endif



    </div>


    {{-- Upload Gambar Baru --}}

    <div class="form-group">

        <label>
            Ganti Cover Album
        </label>

        <div class="custom-file">

            <input
                type="file"
                id="img"
                name="img"
                accept="image/*"
                class="custom-file-input @error('img') is-invalid @enderror">


            <label class="custom-file-label" for="img">

                Pilih Gambar Baru...

            </label>


        </div>



        @error('img')

            <span class="text-danger d-block mt-2">
                {{ $message }}
            </span>

        @enderror



        <small class="text-muted">

            Kosongkan jika tidak ingin mengganti gambar.

            <br>

            Format: JPG, JPEG, PNG, WEBP (Maksimal 2 MB)

        </small>


    </div>





    {{-- Preview Baru --}}

    <div class="form-group">


        <img
            id="preview"
            src="#"
            class="img-thumbnail"
            style="display:none; max-width:250px;">


    </div>






    {{-- Status --}}

    <div class="form-group">


        <label>
            Status <span class="text-danger">*</span>
        </label>



        <select
            name="status"
            class="form-control @error('status') is-invalid @enderror">


            <option value="">
                -- Pilih Status --
            </option>


            <option value="Show"
                {{ old('status',$album->status) == 'Show' ? 'selected':'' }}>

                Show

            </option>


            <option value="Hide"
                {{ old('status',$album->status) == 'Hide' ? 'selected':'' }}>

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

        Update

    </button>



    <a href="{{ route('albumadmin.index') }}"
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