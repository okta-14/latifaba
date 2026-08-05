@extends('layouts.admin')
@section('title','Video')
@section('content')

<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Data Video</h1>
            </div>

            <div class="col-sm-6 text-right">
                <a href="{{ route('video.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Tambah Video
                </a>
            </div>
        </div>
    </div>
</section>

<section class="content">
    <div class="container-fluid">

        @if(session('success'))
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert">
                &times;
            </button>
            {{ session('success') }}
        </div>
        @endif

        <div class="card">

            <div class="card-header">
                <h3 class="card-title">Daftar Video</h3>

                <div class="card-tools">
                    <span class="badge badge-primary">
                        Total : {{ $videos->count() }}
                    </span>
                </div>
            </div>

            <div class="card-body">
                <div class="table-responsive">


                <table class="table table-bordered table-striped">

                    <thead>
                        <tr>
                            <th width="50">No</th>
                            <th>Tanggal</th>
                            <th>Judul</th>
                            <th>Status</th>
                            <th>Hit</th>
                            <th width="220">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>

                    @forelse($videos as $item)

                    <tr>

                        <td>{{ $loop->iteration }}</td>

                        <td>{{ \Carbon\Carbon::parse($item->date)->format('d M Y') }}</td>

                        <td>{{ $item->title }}</td>

                        <td>
                            @if($item->status == 'Show')
                                <span class="badge badge-success">Show</span>
                            @else
                                <span class="badge badge-danger">Hide</span>
                            @endif
                        </td>

                        <td>{{ $item->hit }}</td>

                        <td>

                            <button class="btn btn-info btn-sm"
                                data-toggle="modal"
                                data-target="#detailVideo{{ $item->id }}">
                                <i class="fas fa-eye"></i>
                            </button>

                            <a href="{{ route('video.edit',$item->id) }}"
                                class="btn btn-warning btn-sm">
                                <i class="fas fa-edit"></i>
                            </a>

                            <form action="{{ route('video.destroy',$item->id) }}"
                                method="POST"
                                style="display:inline">

                                @csrf
                                @method('DELETE')

                                <button class="btn btn-danger btn-sm"
                                    onclick="return confirm('Yakin ingin menghapus video ini?')">
                                    <i class="fas fa-trash"></i>
                                </button>

                            </form>

                        </td>

                    </tr>

                    @empty

                    <tr>
                        <td colspan="6" class="text-center">
                            Data video belum tersedia.
                        </td>
                    </tr>

                    @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </div>
</section>

{{-- MODAL DETAIL --}}
@foreach($videos as $item)

@php
    preg_match('/(?:youtu\.be\/|watch\?v=)([^&]+)/', $item->source, $match);
    $youtubeId = $match[1] ?? '';
@endphp

<div class="modal fade" id="detailVideo{{ $item->id }}">
    <div class="modal-dialog modal-xl">

        <div class="modal-content">

            <div class="modal-header bg-info">
                <h4 class="modal-title">
                    Detail Video
                </h4>

                <button class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>

            <div class="modal-body">

                <div class="row">

                    <div class="col-md-7">

                        @if($youtubeId)

                        <div class="embed-responsive embed-responsive-16by9">

                            <iframe
                                class="embed-responsive-item"
                                src="https://www.youtube.com/embed/{{ $youtubeId }}"
                                allowfullscreen>
                            </iframe>

                        </div>

                        @else

                        <div class="alert alert-danger">
                            Link YouTube tidak valid.
                        </div>

                        @endif

                    </div>

                    <div class="col-md-5">

                        <table class="table table-bordered">

                            <tr>
                                <th width="140">Tanggal</th>
                                <td>{{ \Carbon\Carbon::parse($item->date)->format('d M Y') }}</td>
                            </tr>

                            <tr>
                                <th>Judul</th>
                                <td>{{ $item->title }}</td>
                            </tr>

                            <tr>
                                <th>Status</th>
                                <td>
                                    @if($item->status == 'Show')
                                        <span class="badge badge-success">Show</span>
                                    @else
                                        <span class="badge badge-danger">Hide</span>
                                    @endif
                                </td>
                            </tr>

                            <tr>
                                <th>Hit</th>
                                <td>{{ $item->hit }}</td>
                            </tr>

                            <tr>
                                <th>Slug</th>
                                <td>{{ $item->slug }}</td>
                            </tr>

                            <tr>
                                <th>Link</th>
                                <td>
                                    <a href="{{ $item->source }}" target="_blank">
                                        Buka di YouTube
                                    </a>
                                </td>
                            </tr>

                        </table>

                    </div>

                </div>

                <div class="mt-3">
                    <h5>Deskripsi</h5>

                    <div class="border rounded p-3">
                        {!! nl2br(e($item->content)) !!}
                    </div>
                </div>

            </div>

            <div class="modal-footer">

                <button class="btn btn-secondary" data-dismiss="modal">
                    Tutup
                </button>

                <a href="{{ route('video.edit',$item->id) }}"
                    class="btn btn-warning">
                    <i class="fas fa-edit"></i> Edit
                </a>

            </div>

        </div>
</div>

    </div>
</div>

@endforeach

@endsection