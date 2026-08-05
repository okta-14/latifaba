@extends('layouts.admin')
@section('title','Pengaturan')
@section('content')

<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Data Pengaturan</h1>
            </div>
            <div class="col-sm-6 text-right">
                <a href="{{ route('pengaturan.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Tambah Pengaturan
                </a>
            </div>
        </div>
    </div>
</section>

<section class="content">
    <div class="container-fluid">

        @if(session('success'))
            <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                {{ session('success') }}
            </div>
        @endif

        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Daftar Pengaturan</h3>
                <div class="card-tools">
                    <span class="badge badge-primary">
                        Total: {{ $pengaturan->count() }}
                    </span>
                </div>
            </div>

            <div class="card-body">
                <div class="table-responsive">

                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th width="50">No</th>
                            <th>Company</th>
                            <th>Phone / WhatsApp</th>
                            <th>Email</th>
                            <th>Website</th>
                            <th width="220">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($pengaturan as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->company }}</td>
                            <td>
                                <a href="{{ $item->whatsapp_url }}" target="_blank" class="btn btn-success btn-xs">
                                    <i class="fab fa-whatsapp"></i> {{ $item->phone }}
                                </a>
                            </td>
                            <td>
                                <a href="mailto:{{ $item->email }}" class="btn btn-info btn-xs">
                                    <i class="fas fa-envelope"></i> {{ $item->email }}
                                </a>
                            </td>
                            <td>
                                @if($item->website)
                                    <a href="{{ $item->website_url }}" target="_blank" class="btn btn-primary btn-xs">
                                        <i class="fas fa-external-link-alt"></i> Kunjungi
                                    </a>
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>
                            <td>
                                <button type="button" 
                                        class="btn btn-info btn-sm" 
                                        data-toggle="modal" 
                                        data-target="#modalDetail{{ $item->id }}">
                                    <i class="fas fa-eye"></i>
                                </button>

                                <a href="{{ route('pengaturan.edit', $item->id) }}"
                                   class="btn btn-warning btn-sm">
                                    <i class="fas fa-edit"></i>
                                </a>

                                <form action="{{ route('pengaturan.destroy', $item->id) }}"
                                      method="POST"
                                      style="display:inline;">

                                    @csrf
                                    @method('DELETE')

                                    <button class="btn btn-danger btn-sm"
                                            onclick="return confirm('Yakin ingin menghapus data ini?')">
                                        <i class="fas fa-trash"></i>
                                    </button>

                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center">
                                <i class="fas fa-database text-muted"></i> Data belum tersedia.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>

            </div>

            <div class="card-footer clearfix">
                <div class="float-right">
                    <small class="text-muted">
                        Total Data: {{ $pengaturan->count() }}
                    </small>
                </div>
            </div>

        </div>

    </div>
</section>

{{-- MODAL DETAIL --}}
@foreach($pengaturan as $item)
<div class="modal fade" id="modalDetail{{ $item->id }}" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <h4 class="modal-title">
                    <i class="fas fa-cogs"></i> Detail Pengaturan
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <table class="table table-bordered table-striped">
                            <tr>
                                <th width="40%">Company</th>
                                <td>{{ $item->company }}</td>
                            </tr>
                            <tr>
                                <th>Address</th>
                                <td>{{ $item->address }}</td>
                            </tr>
                            <tr>
                                <th>Phone / WhatsApp</th>
                                <td>
                                    <a href="{{ $item->whatsapp_url }}" target="_blank" class="btn btn-success btn-sm">
                                        <i class="fab fa-whatsapp"></i> {{ $item->phone }}
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <th>Fax</th>
                                <td>{{ $item->fax ?? '-' }}</td>
                            </tr>
                            <tr>
                                <th>Email</th>
                                <td>
                                    <a href="mailto:{{ $item->email }}">{{ $item->email }}</a>
                                </td>
                            </tr>
                            <tr>
                                <th>Website</th>
                                <td>
                                    @if($item->website)
                                        <a href="{{ $item->website_url }}" target="_blank">{{ $item->website_url }}</a>
                                    @else
                                        -
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th>Header</th>
                                <td>{{ $item->header ?? '-' }}</td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-md-6">
                        <table class="table table-bordered table-striped">
                            <tr>
                                <th width="40%">Popup</th>
                                <td>{{ $item->popup ?? '-' }}</td>
                            </tr>
                            <tr>
                                <th>Copyright</th>
                                <td>{{ $item->copyright ?? '-' }}</td>
                            </tr>
                            <tr>
                                <th>Catalog</th>
                                <td>
                                    @if($item->catalog)
                                        <a href="{{ $item->catalog }}" target="_blank">Lihat Catalog</a>
                                    @else
                                        -
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th>Member</th>
                                <td>
                                    @if($item->member)
                                        <a href="{{ $item->member }}" target="_blank">Link Member</a>
                                    @else
                                        -
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th>URL Popup</th>
                                <td>
                                    @if($item->popup_url)
                                        <a href="{{ $item->popup_url }}" target="_blank">{{ $item->popup_url }}</a>
                                    @else
                                        -
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th>Cek</th>
                                <td>{{ $item->cek ?? '-' }}</td>
                            </tr>
                            <tr>
                                <th>Meta Title</th>
                                <td>{{ $item->meta_title ?? '-' }}</td>
                            </tr>
                        </table>
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-md-12">
                        <h5 class="text-info"><i class="fas fa-images"></i> Gambar</h5>
                        <hr>
                        <div class="row">
                            @if($item->logo)
                            <div class="col-md-3 text-center">
                                <label>Logo</label><br>
                                <img src="{{ asset($item->logo) }}" alt="Logo" style="max-width: 100px; max-height: 100px; border: 1px solid #ddd; padding: 5px; border-radius: 5px;">
                            </div>
                            @endif
                            @if($item->favicon)
                            <div class="col-md-3 text-center">
                                <label>Favicon</label><br>
                                <img src="{{ asset($item->favicon) }}" alt="Favicon" style="max-width: 100px; max-height: 100px; border: 1px solid #ddd; padding: 5px; border-radius: 5px;">
                            </div>
                            @endif
                            @if($item->background)
                            <div class="col-md-3 text-center">
                                <label>Background</label><br>
                                <img src="{{ asset($item->background) }}" alt="Background" style="max-width: 100px; max-height: 100px; border: 1px solid #ddd; padding: 5px; border-radius: 5px;">
                            </div>
                            @endif
                            @if($item->background_intro)
                            <div class="col-md-3 text-center">
                                <label>Background Intro</label><br>
                                <img src="{{ asset($item->background_intro) }}" alt="Background Intro" style="max-width: 100px; max-height: 100px; border: 1px solid #ddd; padding: 5px; border-radius: 5px;">
                            </div>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-md-12">
                        <h5 class="text-info"><i class="fas fa-code"></i> SEO & Script</h5>
                        <hr>
                        <table class="table table-bordered table-striped">
                            <tr>
                                <th width="20%">Meta Title</th>
                                <td>{{ $item->meta_title ?? '-' }}</td>
                            </tr>
                            <tr>
                                <th>Meta Description</th>
                                <td>{{ $item->meta_description ?? '-' }}</td>
                            </tr>
                            <tr>
                                <th>Meta Keyword</th>
                                <td>{{ $item->meta_keyword ?? '-' }}</td>
                            </tr>
                            <tr>
                                <th>SEO</th>
                                <td><pre style="max-height: 100px; overflow-y: auto;">{{ $item->seo ?? '-' }}</pre></td>
                            </tr>
                            <tr>
                                <th>Script</th>
                                <td><pre style="max-height: 100px; overflow-y: auto;">{{ $item->script ?? '-' }}</pre></td>
                            </tr>
                            <tr>
                                <th>Intro</th>
                                <td>{{ $item->intro ?? '-' }}</td>
                            </tr>
                            <tr>
                                <th>Map</th>
                                <td><pre style="max-height: 100px; overflow-y: auto;">{{ $item->map ?? '-' }}</pre></td>
                            </tr>
                        </table>
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-md-12">
                        <small class="text-muted">
                            <i class="fas fa-clock"></i> Dibuat: {{ $item->created_at->format('d M Y H:i') }}
                            @if($item->updated_at)
                            | <i class="fas fa-edit"></i> Diperbarui: {{ $item->updated_at->format('d M Y H:i') }}
                            @endif
                        </small>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                    <i class="fas fa-times"></i> Tutup
                </button>
                <a href="{{ route('pengaturan.edit', $item->id) }}" class="btn btn-warning">
                    <i class="fas fa-edit"></i> Edit
                </a>
            </div>
             </div>
        </div>
    </div>
</div>
@endforeach

@endsection