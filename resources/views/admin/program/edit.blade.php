@extends('layouts.admin')
@section('title', 'Edit Program')

@section('content')

<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Edit Program</h1>
            </div>
            <div class="col-sm-6 text-right">
                <a href="{{ route('programadmin.index') }}" class="btn btn-secondary">
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
                    Form Edit Program
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

            <form action="{{ route('programadmin.update', $program->id) }}"
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
                            value="{{ old('date', $program->date) }}"
                            class="form-control @error('date') is-invalid @enderror">
                        @error('date')
                        <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Title (Indonesia) --}}
                    <div class="form-group">
                        <label>
                            Title (Indonesia) <span class="text-danger">*</span>
                        </label>
                        <input
                            type="text"
                            name="title[id]"
                            value="{{ old('title.id', $program->title['id'] ?? '') }}"
                            placeholder="Masukkan judul program"
                            class="form-control @error('title.id') is-invalid @enderror">
                        @error('title.id')
                        <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                        <small class="text-muted">
                            Versi Inggris & Jepang akan otomatis diterjemahkan
                        </small>
                    </div>

                    {{-- Title (English) --}}
                    <div class="form-group">
                        <label>Title (English)</label>
                        <input
                            type="text"
                            name="title[en]"
                            value="{{ old('title.en', $program->title['en'] ?? '') }}"
                            placeholder="Kosongkan untuk auto-translate"
                            class="form-control @error('title.en') is-invalid @enderror">
                        @error('title.en')
                        <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Title (Japanese) --}}
                    <div class="form-group">
                        <label>タイトル (日本語)</label>
                        <input
                            type="text"
                            name="title[jp]"
                            value="{{ old('title.jp', $program->title['jp'] ?? '') }}"
                            placeholder="空欄の場合、自動翻訳"
                            class="form-control @error('title.jp') is-invalid @enderror">
                        @error('title.jp')
                        <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Kategori Project --}}
                    <div class="form-group">
                        <label>
                            Kategori Project <span class="text-danger">*</span>
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
                                {{ old('id_category', $program->id_category)==$category->id?'selected':'' }}>
                                {{ $category->title }}
                            </option>
                            @endforeach
                        </select>
                        @error('id_category')
                        <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Service --}}
                    <div class="form-group">
                        <label>
                            Service <span class="text-danger">*</span>
                        </label>
                        <select
                            name="id_service"
                            class="form-control @error('id_service') is-invalid @enderror">
                            <option value="">
                                -- Pilih Service --
                            </option>
                            @foreach($services as $service)
                            <option
                                value="{{ $service->id }}"
                                {{ old('id_service', $program->id_service)==$service->id?'selected':'' }}>
                                {{ $service->title }}
                            </option>
                            @endforeach
                        </select>
                        @error('id_service')
                        <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
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
                            placeholder="Masukkan isi program">{{ old('content.id', $program->content['id'] ?? '') }}</textarea>
                        @error('content.id')
                        <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                        <small class="text-muted">
                            Versi Inggris & Jepang akan otomatis diterjemahkan
                        </small>
                    </div>

                    {{-- Content (English) --}}
                    <div class="form-group">
                        <label>Content (English)</label>
                        <textarea
                            name="content[en]"
                            rows="8"
                            class="form-control"
                            placeholder="Kosongkan untuk auto-translate">{{ old('content.en', $program->content['en'] ?? '') }}</textarea>
                    </div>

                    {{-- Content (Japanese) --}}
                    <div class="form-group">
                        <label>コンテンツ (日本語)</label>
                        <textarea
                            name="content[jp]"
                            rows="8"
                            class="form-control"
                            placeholder="空欄の場合、自動翻訳">{{ old('content.jp', $program->content['jp'] ?? '') }}</textarea>
                    </div>

                    {{-- Gambar --}}
                    <div class="form-group">
                        <label>
                            Gambar Program
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
                        @if($program->img)
                        <p class="mb-1">
                            <small class="text-muted">Gambar saat ini:</small>
                        </p>
                        <img
                            src="{{ asset($program->img) }}"
                            class="img-thumbnail mb-2"
                            style="max-width:250px;">
                        @endif
                        <img
                            id="preview"
                            src="#"
                            class="img-thumbnail"
                            style="display:none;max-width:250px;">
                    </div>

                    {{-- Lokasi --}}
                    <div class="form-group">
                        <label>
                            Lokasi
                        </label>
                        <input
                            type="text"
                            name="lokasi"
                            value="{{ old('lokasi', $program->lokasi) }}"
                            placeholder="Masukkan lokasi"
                            class="form-control @error('lokasi') is-invalid @enderror">
                        @error('lokasi')
                        <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- URL --}}
                    <div class="form-group">
                        <label>URL</label>
                        <input
                            type="url"
                            name="url"
                            value="{{ old('url', $program->url) }}"
                            placeholder="https://example.com"
                            class="form-control @error('url') is-invalid @enderror">
                        @error('url')
                        <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
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
                                {{ old('status', $program->status)=='Show'?'selected':'' }}>
                                Show
                            </option>
                            <option value="Hide"
                                {{ old('status', $program->status)=='Hide'?'selected':'' }}>
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
                        href="{{ route('programadmin.index') }}"
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