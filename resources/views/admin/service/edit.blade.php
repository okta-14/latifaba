@extends('layouts.admin')
@section('title','Edit Service')

@section('content')

<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">

            <div class="col-sm-6">
                <h1>Edit Service</h1>
            </div>

            <div class="col-sm-6 text-right">
                <a href="{{ route('service.index') }}" class="btn btn-secondary">
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
            Form Edit Service
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

    <form action="{{ route('service.update', $service->id) }}"
          method="POST"
          enctype="multipart/form-data">

        @csrf
        @method('PUT')

        <div class="card-body">

            {{-- Title (Indonesia) --}}
            <div class="form-group">
                <label>Title (Indonesia) <span class="text-danger">*</span></label>
                <input type="text"
                       name="title[id]"
                       class="form-control @error('title.id') is-invalid @enderror"
                       value="{{ old('title.id', $service->getTranslation('title', 'id', false)) }}"
                       placeholder="Masukkan title">
                @error('title.id')
                <span class="invalid-feedback">{{ $message }}</span>
                @enderror
                <small class="text-muted">
                    Versi Inggris &amp; Jepang akan otomatis diterjemahkan
                </small>
            </div>

            {{-- Title (English) --}}
            <div class="form-group">
                <label>Title (English)</label>
                <input type="text"
                       name="title[en]"
                       class="form-control @error('title.en') is-invalid @enderror"
                       value="{{ old('title.en', $service->getTranslation('title', 'en', false)) }}"
                       placeholder="Kosongkan untuk auto-translate">
                @error('title.en')
                <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            {{-- Title (Japanese) --}}
            <div class="form-group">
                <label>タイトル (日本語)</label>
                <input type="text"
                       name="title[jp]"
                       class="form-control @error('title.jp') is-invalid @enderror"
                       value="{{ old('title.jp', $service->getTranslation('title', 'jp', false)) }}"
                       placeholder="空欄の場合、自動翻訳">
                @error('title.jp')
                <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            {{-- Short Description (Indonesia) --}}
            <div class="form-group">
                <label>Short Description (Indonesia) <span class="text-danger">*</span></label>
                <textarea name="short[id]"
                          rows="3"
                          class="form-control @error('short.id') is-invalid @enderror"
                          placeholder="Masukkan deskripsi singkat">{{ old('short.id', $service->getTranslation('short', 'id', false)) }}</textarea>
                @error('short.id')
                <span class="invalid-feedback">{{ $message }}</span>
                @enderror
                <small class="text-muted">
                    Versi Inggris &amp; Jepang akan otomatis diterjemahkan
                </small>
            </div>

            {{-- Short Description (English) --}}
            <div class="form-group">
                <label>Short Description (English)</label>
                <textarea name="short[en]"
                          rows="3"
                          class="form-control @error('short.en') is-invalid @enderror"
                          placeholder="Kosongkan untuk auto-translate">{{ old('short.en', $service->getTranslation('short', 'en', false)) }}</textarea>
                @error('short.en')
                <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            {{-- Short Description (Japanese) --}}
            <div class="form-group">
                <label>簡単な説明 (日本語)</label>
                <textarea name="short[jp]"
                          rows="3"
                          class="form-control @error('short.jp') is-invalid @enderror"
                          placeholder="空欄の場合、自動翻訳">{{ old('short.jp', $service->getTranslation('short', 'jp', false)) }}</textarea>
                @error('short.jp')
                <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            {{-- Content (Indonesia) --}}
            <div class="form-group">
                <label>Content (Indonesia) <span class="text-danger">*</span></label>
                <textarea name="content[id]"
                          rows="6"
                          class="form-control @error('content.id') is-invalid @enderror"
                          placeholder="Masukkan isi service">{{ old('content.id', $service->getTranslation('content', 'id', false)) }}</textarea>
                @error('content.id')
                <span class="invalid-feedback">{{ $message }}</span>
                @enderror
                <small class="text-muted">
                    Versi Inggris &amp; Jepang akan otomatis diterjemahkan
                </small>
            </div>

            {{-- Content (English) --}}
            <div class="form-group">
                <label>Content (English)</label>
                <textarea name="content[en]"
                          rows="6"
                          class="form-control @error('content.en') is-invalid @enderror"
                          placeholder="Kosongkan untuk auto-translate">{{ old('content.en', $service->getTranslation('content', 'en', false)) }}</textarea>
                @error('content.en')
                <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            {{-- Content (Japanese) --}}
            <div class="form-group">
                <label>コンテンツ (日本語)</label>
                <textarea name="content[jp]"
                          rows="6"
                          class="form-control @error('content.jp') is-invalid @enderror"
                          placeholder="空欄の場合、自動翻訳">{{ old('content.jp', $service->getTranslation('content', 'jp', false)) }}</textarea>
                @error('content.jp')
                <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            {{-- Icon --}}
            <div class="form-group">

                <label>
                    Icon
                </label>

                <div class="custom-file">

                    <input
                        type="file"
                        id="icon"
                        name="icon"
                        accept="image/*"
                        class="custom-file-input @error('icon') is-invalid @enderror">

                    <label class="custom-file-label" for="icon">
                        Pilih Icon...
                    </label>

                </div>

                @error('icon')
                    <span class="text-danger d-block mt-2">
                        {{ $message }}
                    </span>
                @enderror

                <small class="text-muted">
                    Format: JPG, JPEG, PNG, WEBP, SVG (Maksimal 2 MB). Kosongkan jika tidak ingin mengubah icon.
                </small>

            </div>

            <div class="form-group">

                @if($service->icon)
                <p class="mb-1"><small class="text-muted">Icon saat ini:</small></p>
                <img
                    src="{{ asset('uploads/service/icon/' . $service->icon) }}"
                    class="img-thumbnail mb-2"
                    style="max-width:100px;">
                @endif

                <img
                    id="previewIcon"
                    src="#"
                    class="img-thumbnail"
                    style="display:none;max-width:150px;">

            </div>

            {{-- Image --}}
            <div class="form-group">

                <label>
                    Image
                </label>

                <div class="custom-file">

                    <input
                        type="file"
                        id="img"
                        name="img"
                        accept="image/*"
                        class="custom-file-input @error('img') is-invalid @enderror">

                    <label class="custom-file-label" for="img">
                        Pilih Gambar...
                    </label>

                </div>

                @error('img')
                    <span class="text-danger d-block mt-2">
                        {{ $message }}
                    </span>
                @enderror

                <small class="text-muted">
                    Format: JPG, JPEG, PNG, WEBP (Maksimal 4 MB). Kosongkan jika tidak ingin mengubah gambar.
                </small>

            </div>

            <div class="form-group">

                @if($service->img)
                <p class="mb-1"><small class="text-muted">Gambar saat ini:</small></p>
                <img
                    src="{{ asset('uploads/service/img/' . $service->img) }}"
                    class="img-thumbnail mb-2"
                    style="max-width:250px;">
                @endif

                <img
                    id="previewImg"
                    src="#"
                    class="img-thumbnail"
                    style="display:none;max-width:250px;">

            </div>

            <div class="form-group">

                <label>
                    Status <span class="text-danger">*</span>
                </label>

                <select name="status"
                        class="form-control @error('status') is-invalid @enderror">

                    <option value="">-- Pilih Status --</option>

                    <option value="Show"
                        {{ old('status', $service->status)=='Show' ? 'selected' : '' }}>
                        Show
                    </option>

                    <option value="Hide"
                        {{ old('status', $service->status)=='Hide' ? 'selected' : '' }}>
                        Hide
                    </option>

                </select>

                @error('status')
                <span class="invalid-feedback">
                    {{ $message }}
                </span>
                @enderror

            </div>

            <div class="form-group">

                <label>URL</label>

                <input type="url"
                       name="url"
                       class="form-control @error('url') is-invalid @enderror"
                       value="{{ old('url', $service->url) }}"
                       placeholder="https://example.com">

                @error('url')
                <span class="invalid-feedback">
                    {{ $message }}
                </span>
                @enderror

            </div>

        </div>

        <div class="card-footer">

            <button type="submit"
                    class="btn btn-info">

                <i class="fas fa-save"></i>
                Update

            </button>

            <a href="{{ route('service.index') }}"
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

previewImage('icon','previewIcon');
previewImage('img','previewImg');
</script>
@endsection