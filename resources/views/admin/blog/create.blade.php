@extends('layouts.admin')
@section('title', 'Tambah Blog')
@section('content')

<section class="content-header">
    <div class="container-fluid">

        <div class="row mb-2">

            <div class="col-sm-6">
                <h1>Tambah Blog</h1>
            </div>

            <div class="col-sm-6 text-right">
                <a href="{{ route('blogadmin.index') }}" class="btn btn-secondary">
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
                    Form Tambah Blog
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

                    <li>
                        {{ $error }}
                    </li>

                    @endforeach

                </ul>

            </div>

            @endif



            <form action="{{ route('blogadmin.store') }}"
                method="POST"
                enctype="multipart/form-data">


                @csrf


                <div class="card-body">


                    {{-- Tanggal --}}

                    <div class="form-group">

                        <label>
                            Tanggal <span class="text-danger">*</span>
                        </label>

                        <input
                            type="date"
                            name="date"
                            value="{{ old('date',date('Y-m-d')) }}"
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
                            Judul Blog <span class="text-danger">*</span>
                        </label>

                        <input
                            type="text"
                            name="title[id]"
                            value="{{ old('title.id') }}"
                            placeholder="Masukkan judul blog"
                            class="form-control @error('title.id') is-invalid @enderror">

                        @error('title.id')
                        <span class="invalid-feedback">{{ $message }}</span>
                        @enderror

                        <small class="text-muted">
                            Versi Inggris & Jepang akan otomatis diterjemahkan
                        </small>

                    </div>





                    {{-- Kategori --}}

                    <div class="form-group">

                        <label>
                            Kategori <span class="text-danger">*</span>
                        </label>


                        <select
                            name="id_category"
                            class="form-control @error('id_category') is-invalid @enderror">


                            <option value="">
                                -- Pilih Kategori --
                            </option>


                            @foreach($categories as $category)


                            <option
                                value="{{ $category->id }}"
                                {{ old('id_category')==$category->id?'selected':'' }}>

                                {{ $category->title }}

                            </option>


                            @endforeach


                        </select>


                        @error('id_category')

                        <span class="invalid-feedback">
                            {{ $message }}
                        </span>

                        @enderror


                    </div>





                    {{-- Caption --}}

                    <div class="form-group">

                        <label>
                            Caption
                        </label>


                        <textarea
                            name="caption[id]"
                            rows="3"
                            class="form-control"
                            placeholder="Masukkan caption">{{ old('caption.id') }}</textarea>

                        <small class="text-muted">
                            Versi Inggris & Jepang akan otomatis diterjemahkan
                        </small>


                    </div>






                    {{-- Content --}}

                    <div class="form-group">

                        <label>
                            Content <span class="text-danger">*</span>
                        </label>


                        <textarea
                            name="content[id]"
                            rows="8"
                            class="form-control @error('content.id') is-invalid @enderror"
                            placeholder="Masukkan isi blog">{{ old('content.id') }}</textarea>

                        @error('content.id')
                        <span class="invalid-feedback">{{ $message }}</span>
                        @enderror

                        <small class="text-muted">
                            Versi Inggris & Jepang akan otomatis diterjemahkan
                        </small>


                    </div>






                    {{-- Tags --}}

                    <div class="form-group">

                        <label>
                            Tags <span class="text-danger">*</span>
                        </label>


                        <div class="row">


                            @foreach($tags as $tag)


                            <div class="col-md-3">


                                <div class="custom-control custom-checkbox">


                                    <input
                                        type="checkbox"
                                        class="custom-control-input"
                                        id="tag{{ $tag->id }}"
                                        name="tags[]"
                                        value="{{ $tag->id }}">


                                    <label
                                        class="custom-control-label"
                                        for="tag{{ $tag->id }}">

                                        {{ $tag->getTranslation('title', 'id') }}

                                    </label>


                                </div>


                            </div>


                            @endforeach


                        </div>



                        @error('tags')

                        <span class="text-danger">
                            {{ $message }}
                        </span>

                        @enderror


                    </div>







                    {{-- Keyword --}}

                    <div class="form-group">


                        <label>
                            Keyword
                        </label>


                        <textarea
                            name="keyword"
                            rows="3"
                            placeholder="contoh: tutorial laravel, framework php, belajar crud"
                            class="form-control">{{ old('keyword') }}</textarea>


                        <small class="text-muted">
                            Pisahkan keyword menggunakan koma (,)
                        </small>


                    </div>







                    {{-- Gambar --}}

                    <div class="form-group">


                        <label>
                            Gambar Blog <span class="text-danger">*</span>
                        </label>



                        <div class="custom-file">


                            <input
                                type="file"
                                id="img"
                                name="img"
                                accept="image/*"
                                class="custom-file-input">


                            <label
                                class="custom-file-label"
                                for="img">

                                Pilih Gambar...

                            </label>


                        </div>



                        <small class="text-muted">

                            Format JPG, JPEG, PNG, WEBP maksimal 2 MB

                        </small>


                    </div>






                    {{-- Preview --}}

                    <div class="form-group">


                        <img
                            id="preview"
                            src="#"
                            class="img-thumbnail"
                            style="display:none;max-width:250px;">


                    </div>








                    {{-- Status --}}

                    <div class="form-group">


                        <label>
                            Status <span class="text-danger">*</span>
                        </label>


                        <select
                            name="status"
                            class="form-control">


                            <option value="">
                                -- Pilih Status --
                            </option>


                            <option value="Show">
                                Show
                            </option>


                            <option value="Hide">
                                Hide
                            </option>


                        </select>


                    </div>



                </div>






                <div class="card-footer">


                    <button
                        type="submit"
                        class="btn btn-info">

                        <i class="fas fa-save"></i>
                        Simpan

                    </button>


                    
                        <a
                        href="{{ route('blogadmin.index') }}"
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


    let file=e.target.files[0];


    if(file){


        document.querySelector('.custom-file-label').innerHTML=file.name;


        let reader=new FileReader();


        reader.onload=function(event){


            let preview=document.getElementById('preview');


            preview.src=event.target.result;

            preview.style.display="block";


        }


        reader.readAsDataURL(file);


    }


});

</script>


@endsection