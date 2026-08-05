@extends('layouts.admin')
@section('title', 'Edit Blog')
@section('content')

<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Edit Blog</h1>
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
                    Form Edit Blog
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

            <form action="{{ route('blogadmin.update', $blog->id) }}"
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
                            value="{{ old('date', $blog->date) }}"
                            class="form-control @error('date') is-invalid @enderror">
                        @error('date')
                        <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Judul (Indonesia) --}}
                    <div class="form-group">
                        <label>
                            Judul Blog (Indonesia) <span class="text-danger">*</span>
                        </label>
                        <input
                            type="text"
                            name="title[id]"
                            value="{{ old('title.id', $blog->getTranslation('title', 'id')) }}"
                            placeholder="Masukkan judul blog"
                            class="form-control @error('title.id') is-invalid @enderror">
                        @error('title.id')
                        <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Judul (English) --}}
                    <div class="form-group">
                        <label>Title (English)</label>
                        <input
                            type="text"
                            name="title[en]"
                            value="{{ old('title.en', $blog->getTranslation('title', 'en')) }}"
                            placeholder="Kosongkan untuk auto-translate dari Bahasa Indonesia"
                            class="form-control @error('title.en') is-invalid @enderror">
                        @error('title.en')
                        <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Judul (Japanese) --}}
                    <div class="form-group">
                        <label>タイトル (日本語)</label>
                        <input
                            type="text"
                            name="title[jp]"
                            value="{{ old('title.jp', $blog->getTranslation('title', 'jp')) }}"
                            placeholder="空欄の場合、インドネシア語から自動翻訳されます"
                            class="form-control @error('title.jp') is-invalid @enderror">
                        @error('title.jp')
                        <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
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
                                {{ old('id_category', $blog->id_category)==$category->id?'selected':'' }}>
                                {{ $category->title }}
                            </option>
                            @endforeach
                        </select>
                        @error('id_category')
                        <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Caption (Indonesia) --}}
                    <div class="form-group">
                        <label>Caption (Indonesia)</label>
                        <textarea
                            name="caption[id]"
                            rows="3"
                            class="form-control"
                            placeholder="Masukkan caption">{{ old('caption.id', $blog->getTranslation('caption', 'id')) }}</textarea>
                    </div>

                    {{-- Caption (English) --}}
                    <div class="form-group">
                        <label>Caption (English)</label>
                        <textarea
                            name="caption[en]"
                            rows="3"
                            class="form-control"
                            placeholder="Kosongkan untuk auto-translate dari Bahasa Indonesia">{{ old('caption.en', $blog->getTranslation('caption', 'en')) }}</textarea>
                    </div>

                    {{-- Caption (Japanese) --}}
                    <div class="form-group">
                        <label>キャプション (日本語)</label>
                        <textarea
                            name="caption[jp]"
                            rows="3"
                            class="form-control"
                            placeholder="空欄の場合、インドネシア語から自動翻訳されます">{{ old('caption.jp', $blog->getTranslation('caption', 'jp')) }}</textarea>
                    </div>

                    {{-- Content (Indonesia) --}}
                    <div class="form-group">
                        <label>
                            Content (Indonesia) <span class="text-danger">*</span>
                        </label>
                        <textarea
                            name="content[id]"
                            rows="8"
                            class="form-control @error('content.id') is-invalid @enderror"
                            placeholder="Masukkan isi blog">{{ old('content.id', $blog->getTranslation('content', 'id')) }}</textarea>
                        @error('content.id')
                        <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Content (English) --}}
                    <div class="form-group">
                        <label>Content (English)</label>
                        <textarea
                            name="content[en]"
                            rows="8"
                            class="form-control"
                            placeholder="Kosongkan untuk auto-translate dari Bahasa Indonesia">{{ old('content.en', $blog->getTranslation('content', 'en')) }}</textarea>
                    </div>

                    {{-- Content (Japanese) --}}
                    <div class="form-group">
                        <label>コンテンツ (日本語)</label>
                        <textarea
                            name="content[jp]"
                            rows="8"
                            class="form-control"
                            placeholder="空欄の場合、インドネシア語から自動翻訳されます">{{ old('content.jp', $blog->getTranslation('content', 'jp')) }}</textarea>
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
                                        value="{{ $tag->id }}"
                                        {{ in_array((string) $tag->id, explode(';', $blog->tags)) ? 'checked' : '' }}>
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
                        <span class="text-danger">{{ $message }}</span>
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
                            class="form-control">{{ old('keyword', $blog->keyword) }}</textarea>
                        <small class="text-muted">
                            Pisahkan keyword menggunakan koma (,)
                        </small>
                    </div>

                    {{-- Gambar --}}
                    <div class="form-group">
                        <label>
                            Gambar Blog
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
                            Format JPG, JPEG, PNG, WEBP maksimal 2 MB. Kosongkan jika tidak ingin mengubah gambar.
                        </small>
                    </div>

                    {{-- Preview + Gambar Lama --}}
                    <div class="form-group">
                        @if($blog->img)
                        <p class="mb-1">
                            <small class="text-muted">Gambar saat ini:</small>
                        </p>
                        <img
                            src="{{ asset($blog->img) }}"
                            class="img-thumbnail mb-2"
                            style="max-width:250px;">
                        @endif
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
                            <option value="Show"
                                {{ old('status', $blog->status)=='Show'?'selected':'' }}>
                                Show
                            </option>
                            <option value="Hide"
                                {{ old('status', $blog->status)=='Hide'?'selected':'' }}>
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
                        Update
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