@extends('layouts.admin')
@section('title','media')
@section('content')

<!-- Header -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Data Media</h1>
            </div>

            <div class="col-sm-6 text-right">
                <a href="{{ route('media.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Tambah Media
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Isi -->
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
                <h3 class="card-title">Daftar Media</h3>
                <div class="card-tools">
                    <span class="badge badge-primary">
                        Total: {{ $media->count() }}
                    </span>
                </div>
            </div>

            <div class="card-body">
                <div class="table-responsive">


                <table class="table table-bordered table-striped">

                    <thead>
                        <tr>
                            <th width="50">No</th>
                            <th>Title</th>
                            <th>URL</th>
                            <th width="220">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($media as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->title }}</td>
                            <td>
                                <a href="{{ $item->url }}" target="_blank" class="text-primary">
                                    <i class="fas fa-link"></i> {{ Str::limit($item->url, 30) }}
                                </a>
                            </td>
                            <td>
                                {{-- TOMBOL DETAIL --}}
                                <button type="button" 
                                        class="btn btn-info btn-sm" 
                                        data-toggle="modal" 
                                        data-target="#modalDetailMedia{{ $item->id }}">
                                    <i class="fas fa-eye"></i>
                                </button>

                                {{-- TOMBOL EDIT --}}
                                <a href="{{ route('media.edit', $item->id) }}"
                                   class="btn btn-warning btn-sm">
                                    <i class="fas fa-edit"></i>
                                </a>

                                {{-- TOMBOL HAPUS --}}
                                <form action="{{ route('media.destroy', $item->id) }}"
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
                            <td colspan="4" class="text-center">
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
                        Total Data: {{ $media->count() }}
                    </small>
                </div>
            </div>

        </div>

    </div>
</section>

{{-- MODAL DETAIL MEDIA (DILUAR CARD) --}}
@foreach($media as $item)
<div class="modal fade" id="modalDetailMedia{{ $item->id }}" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <h4 class="modal-title">
                    <i class="fas fa-photo-video"></i> Detail Media
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table table-bordered table-striped">
                    <tr>
                        <th width="35%">ID</th>
                        <td>{{ $item->id }}</td>
                    </tr>
                    <tr>
                        <th>Title</th>
                        <td><strong>{{ $item->title }}</strong></td>
                    </tr>
                    <tr>
                        <th>URL</th>
                        <td>
                            <a href="{{ $item->url }}" target="_blank" class="text-primary">
                                {{ $item->url }}
                            </a>
                            <br>
                            <a href="{{ $item->url }}" target="_blank" class="btn btn-primary btn-sm mt-2">
                                <i class="fas fa-external-link-alt"></i> Buka URL
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <th>Dibuat</th>
                        <td>{{ $item->created_at->format('d M Y H:i') }}</td>
                    </tr>
                    @if($item->updated_at)
                    <tr>
                        <th>Diperbarui</th>
                        <td>{{ $item->updated_at->format('d M Y H:i') }}</td>
                    </tr>
                    @endif
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                    <i class="fas fa-times"></i> Tutup
                </button>
                <a href="{{ route('media.edit', $item->id) }}" class="btn btn-warning">
                    <i class="fas fa-edit"></i> Edit
                </a>
            </div>
</div>
        </div>
    </div>
</div>
@endforeach

@endsection