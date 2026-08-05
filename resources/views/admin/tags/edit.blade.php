@extends('layouts.admin')

@section('title', 'Edit Tag')

@section('content')

<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">

            <div class="col-sm-6">
                <h1>Edit Tag</h1>
            </div>

            <div class="col-sm-6 text-right">
                <a href="{{ route('tags.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Kembali
                </a>
            </div>

        </div>
    </div>
</section>

<section class="content">

    <div class="card card-primary">

        <div class="card-header">
            <h3 class="card-title">Form Edit Tag</h3>
        </div>

        <form action="{{ route('tags.update', $tag->id) }}" method="POST">

            @csrf
            @method('PUT')

            <div class="card-body">

                <div class="form-group">
                    <label for="title_id">Nama Tag (Indonesia)</label>

                    <input
                        type="text"
                        name="title[id]"
                        id="title_id"
                        class="form-control @error('title.id') is-invalid @enderror"
                        placeholder="Masukkan nama tag"
                        value="{{ old('title.id', $tag->getTranslation('title', 'id')) }}"
                    >

                    @error('title.id')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror

                </div>

                <div class="form-group">
                    <label for="title_en">Name (English)</label>

                    <input
                        type="text"
                        name="title[en]"
                        id="title_en"
                        class="form-control"
                        value="{{ old('title.en', $tag->getTranslation('title', 'en')) }}"
                    >
                </div>

                <div class="form-group">
                    <label for="title_jp">タグ名 (日本語)</label>

                    <input
                        type="text"
                        name="title[jp]"
                        id="title_jp"
                        class="form-control"
                        value="{{ old('title.jp', $tag->getTranslation('title', 'jp')) }}"
                    >
                </div>

            </div>

            <div class="card-footer">

                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Update
                </button>

                <a href="{{ route('tags.index') }}" class="btn btn-secondary">
                    Batal
                </a>

            </div>

        </form>

    </div>

</section>

@endsection