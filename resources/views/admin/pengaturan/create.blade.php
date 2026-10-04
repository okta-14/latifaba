@extends('layouts.admin')
@section('title','Tambah Pengaturan')

@section('content')

<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Tambah Pengaturan</h1>
            </div>
            <div class="col-sm-6 text-right">
                <a href="{{ route('pengaturan.index') }}" class="btn btn-secondary">
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
                <h3 class="card-title">Form Tambah Pengaturan</h3>
            </div>

            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible m-3">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h5><i class="icon fas fa-ban"></i> Validasi Gagal!</h5>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('pengaturan.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="card-body">

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Company <span class="text-danger">*</span></label>
                                <input type="text" name="company" class="form-control @error('company') is-invalid @enderror" value="{{ old('company') }}" placeholder="Masukkan nama perusahaan">
                                @error('company')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Header</label>
                                <textarea name="header" class="form-control @error('header') is-invalid @enderror" rows="2" placeholder="Baris 1 (biru)&#10;Baris 2 (merah)">{{ old('header') }}</textarea>
                                <small class="text-muted">Baris pertama tampil biru, baris kedua tampil merah (tekan Enter untuk baris baru).</small>
                                @error('header')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">

                            {{-- Address (Indonesia) --}}
                            <div class="form-group">
                                <label>Alamat (Indonesia) <span class="text-danger">*</span></label>
                                <textarea name="address[id]" class="form-control @error('address.id') is-invalid @enderror" rows="3" placeholder="Masukkan alamat lengkap">{{ old('address.id') }}</textarea>
                                @error('address.id')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                                <small class="text-muted">
                                    Versi Inggris &amp; Jepang akan otomatis diterjemahkan
                                </small>
                            </div>

                            {{-- Address (English) --}}
                            <div class="form-group">
                                <label>Address (English)</label>
                                <textarea name="address[en]" class="form-control @error('address.en') is-invalid @enderror" rows="3" placeholder="Kosongkan untuk auto-translate">{{ old('address.en') }}</textarea>
                                @error('address.en')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            {{-- Address (Japanese) --}}
                            <div class="form-group">
                                <label>住所 (日本語)</label>
                                <textarea name="address[jp]" class="form-control @error('address.jp') is-invalid @enderror" rows="3" placeholder="空欄の場合、自動翻訳">{{ old('address.jp') }}</textarea>
                                @error('address.jp')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Google Maps</label>
                                <textarea name="map" class="form-control @error('map') is-invalid @enderror" rows="3" placeholder="Masukkan embed Google Maps">{{ old('map') }}</textarea>
                                <small class="text-muted">
                                    Buka Google Maps → Share → Embed a map → copy kode &lt;iframe&gt; lalu tempel di sini.
                                </small>
                                @error('map')
                                    <span class="invalid-feedback d-block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Phone / WhatsApp <span class="text-danger">*</span></label>
                                <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone') }}" placeholder="Contoh: 08123456789 atau +628123456789">
                                <small class="text-muted">Masukkan nomor dengan format: 08123456789 atau +628123456789</small>
                                @error('phone')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Email <span class="text-danger">*</span></label>
                                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" placeholder="Masukkan alamat email">
                                @error('email')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Website</label>
                                <input type="text" name="website" class="form-control @error('website') is-invalid @enderror" value="{{ old('website') }}" placeholder="Contoh: example.com atau https://example.com">
                                <small class="text-muted">Masukkan URL website tanpa http:// atau dengan http://</small>
                                @error('website')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Fax</label>
                                <input type="text" name="fax" class="form-control @error('fax') is-invalid @enderror" value="{{ old('fax') }}" placeholder="Masukkan nomor fax">
                                @error('fax')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Script</label>
                                <textarea name="script" class="form-control @error('script') is-invalid @enderror" rows="3" placeholder="Masukkan script tracking">{{ old('script') }}</textarea>
                                @error('script')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>URL Popup</label>
                                <input type="text" name="url_popup" class="form-control @error('url_popup') is-invalid @enderror" value="{{ old('url_popup') }}" placeholder="Contoh: example.com/popup atau https://example.com/popup">
                                <small class="text-muted">Masukkan URL popup</small>
                                @error('url_popup')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label><i class="fas fa-image text-success"></i> Background</label>
                                <div class="custom-file">
                                    <input type="file" name="background" class="custom-file-input @error('background') is-invalid @enderror">
                                    <label class="custom-file-label">Pilih Background...</label>
                                </div>
                                <small class="text-muted">Format: jpg, jpeg, png, gif | Max: 2MB</small>
                                @error('background')
                                    <span class="invalid-feedback d-block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label><i class="fas fa-image text-success"></i> Background Intro</label>
                                <div class="custom-file">
                                    <input type="file" name="background_intro" class="custom-file-input @error('background_intro') is-invalid @enderror">
                                    <label class="custom-file-label">Pilih Background Intro...</label>
                                </div>
                                <small class="text-muted">Format: jpg, jpeg, png, gif | Max: 2MB</small>
                                @error('background_intro')
                                    <span class="invalid-feedback d-block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label><i class="fas fa-image text-primary"></i> Logo</label>
                                <div class="custom-file">
                                    <input type="file" name="logo" class="custom-file-input @error('logo') is-invalid @enderror">
                                    <label class="custom-file-label">Pilih Logo...</label>
                                </div>
                                <small class="text-muted">Format: jpg, jpeg, png, gif | Max: 2MB</small>
                                @error('logo')
                                    <span class="invalid-feedback d-block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label><i class="fas fa-image text-primary"></i> Favicon</label>
                                <div class="custom-file">
                                    <input type="file" name="favicon" class="custom-file-input @error('favicon') is-invalid @enderror">
                                    <label class="custom-file-label">Pilih Favicon...</label>
                                </div>
                                <small class="text-muted">Format: ico, jpg, jpeg, png, gif | Max: 2MB</small>
                                @error('favicon')
                                    <span class="invalid-feedback d-block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Popup</label>
                                <input type="text" name="popup" class="form-control @error('popup') is-invalid @enderror" value="{{ old('popup') }}" placeholder="Masukkan popup">
                                @error('popup')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Catalog</label>
                                <input type="text" name="catalog" class="form-control @error('catalog') is-invalid @enderror" value="{{ old('catalog') }}" placeholder="Contoh: catalog.example.com atau https://catalog.example.com">
                                <small class="text-muted">Masukkan URL catalog</small>
                                @error('catalog')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Member</label>
                                <input type="text" name="member" class="form-control @error('member') is-invalid @enderror" value="{{ old('member') }}" placeholder="Contoh: member.example.com atau https://member.example.com">
                                <small class="text-muted">Masukkan URL member</small>
                                @error('member')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Copyright</label>
                                <input type="text" name="copyright" class="form-control @error('copyright') is-invalid @enderror" value="{{ old('copyright') }}" placeholder="Masukkan copyright">
                                @error('copyright')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Intro</label>
                                <textarea name="intro" class="form-control @error('intro') is-invalid @enderror" rows="3" placeholder="Masukkan intro text">{{ old('intro') }}</textarea>
                                @error('intro')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Cek</label>
                                <input type="text" name="cek" class="form-control @error('cek') is-invalid @enderror" value="{{ old('cek') }}" placeholder="Masukkan kode cek" maxlength="5">
                                @error('cek')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Meta Title</label>
                                <input type="text" name="meta_title" class="form-control @error('meta_title') is-invalid @enderror" value="{{ old('meta_title') }}" placeholder="Masukkan meta title untuk SEO">
                                @error('meta_title')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Meta Keyword</label>
                                <textarea name="meta_keyword" class="form-control @error('meta_keyword') is-invalid @enderror" rows="3" placeholder="Masukkan meta keyword, pisahkan dengan koma">{{ old('meta_keyword') }}</textarea>
                                @error('meta_keyword')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Meta Description</label>
                                <textarea name="meta_description" class="form-control @error('meta_description') is-invalid @enderror" rows="3" placeholder="Masukkan meta description untuk SEO">{{ old('meta_description') }}</textarea>
                                @error('meta_description')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>SEO</label>
                                <textarea name="seo" class="form-control @error('seo') is-invalid @enderror" rows="3" placeholder="Masukkan SEO script">{{ old('seo') }}</textarea>
                                @error('seo')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-info">
                        <i class="fas fa-save"></i> Simpan
                    </button>
                    <a href="{{ route('pengaturan.index') }}" class="btn btn-dark">Batal</a>
                </div>

            </form>
        </div>
    </div>
</section>

@endsection

@push('scripts')
<script>
    // Auto update file input label
    $(document).ready(function() {
        $('.custom-file-input').on('change', function() {
            let fileName = $(this).val().split('\\').pop();
            $(this).next('.custom-file-label').addClass("selected").html(fileName);
        });
    });
</script>
@endpush