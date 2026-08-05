@extends('layouts.admin')
@section('title','Album')
@section('content')

<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">

            <div class="col-sm-6">
                <h1>Data Album</h1>
            </div>

            <div class="col-sm-6 text-right">
                <a href="{{ route('albumadmin.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Tambah Album
                </a>
            </div>

        </div>
    </div>
</section>

<section class="content">

    <div class="container-fluid">

        @if(session('success'))

        <div class="alert alert-success alert-dismissible">

            <button type="button"
                class="close"
                data-dismiss="alert">
                &times;
            </button>

            {{ session('success') }}

        </div>

        @endif

        <div class="card">

            <div class="card-header">

                <h3 class="card-title">
                    Daftar Album
                </h3>

                <div class="card-tools">

                    <span class="badge badge-primary">
                        Total : {{ $albums->count() }}
                    </span>

                </div>

            </div>

            <div class="card-body">
                <div class="table-responsive">


                <table class="table table-bordered table-striped">

                    <thead>

                        <tr>

                            <th width="50">No</th>
                            <th>Gambar</th>
                            <th>Tanggal</th>
                            <th>Judul</th>
                            <th>Status</th>
                            <th>Hit</th>
                            <th width="220">Aksi</th>

                        </tr>

                    </thead>

                    <tbody>

                        @forelse($albums as $item)

                        <tr>

                            <td>{{ $loop->iteration }}</td>

                            <td width="100">

                                <img src="{{ asset($item->img) }}"
                                    width="80"
                                    height="60"
                                    style="object-fit:cover;border-radius:5px;">

                            </td>

                            <td>
                                {{ \Carbon\Carbon::parse($item->date)->format('d M Y') }}
                            </td>

                            <td>
                                {{ $item->title }}
                            </td>

                            <td>

                                @if($item->status=='Show')

                                <span class="badge badge-success">
                                    Show
                                </span>

                                @else

                                <span class="badge badge-danger">
                                    Hide
                                </span>

                                @endif

                            </td>

                            <td>{{ $item->hit }}</td>

                            <td>

                                <button
                                    class="btn btn-info btn-sm"
                                    data-toggle="modal"
                                    data-target="#detailAlbum{{ $item->id }}">

                                    <i class="fas fa-eye"></i>

                                </button>

                                <a href="{{ route('albumadmin.edit',$item->id) }}"
                                    class="btn btn-warning btn-sm">

                                    <i class="fas fa-edit"></i>

                                </a>

                                <form
                                    action="{{ route('albumadmin.destroy',$item->id) }}"
                                    method="POST"
                                    style="display:inline">

                                    @csrf
                                    @method('DELETE')

                                    <button
                                        class="btn btn-danger btn-sm"
                                        onclick="return confirm('Yakin ingin menghapus album ini?')">

                                        <i class="fas fa-trash"></i>

                                    </button>

                                </form>

                            </td>

                        </tr>

                        @empty

                        <tr>

                            <td colspan="7" class="text-center">
                                Data album belum tersedia.
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
@foreach($albums as $item)

<div class="modal fade"
    id="detailAlbum{{ $item->id }}">

    <div class="modal-dialog modal-lg">

        <div class="modal-content">

            <div class="modal-header bg-info">

                <h4 class="modal-title">
                    Detail Album
                </h4>

                <button
                    class="close"
                    data-dismiss="modal">

                    <span>&times;</span>

                </button>

            </div>

            <div class="modal-body">

                <div class="row">

                    <div class="col-md-7 text-center">

                        <img src="{{ asset($item->img) }}"
                            class="img-fluid rounded shadow">

                    </div>

                    <div class="col-md-5">

                        <table class="table table-bordered">

                            <tr>

                                <th width="130">
                                    Tanggal
                                </th>

                                <td>
                                    {{ \Carbon\Carbon::parse($item->date)->format('d M Y') }}
                                </td>

                            </tr>

                            <tr>

                                <th>Judul</th>

                                <td>
                                    {{ $item->title }}
                                </td>

                            </tr>

                            <tr>

                                <th>Status</th>

                                <td>

                                    @if($item->status=='Show')

                                    <span class="badge badge-success">
                                        Show
                                    </span>

                                    @else

                                    <span class="badge badge-danger">
                                        Hide
                                    </span>

                                    @endif

                                </td>

                            </tr>

                            <tr>

                                <th>Hit</th>

                                <td>
                                    {{ $item->hit }}
                                </td>

                            </tr>

                            <tr>

                                <th>Slug</th>

                                <td>
                                    {{ $item->slug }}
                                </td>

                            </tr>

                        </table>

                    </div>

                </div>

            </div>

            <div class="modal-footer">

                <button
                    class="btn btn-secondary"
                    data-dismiss="modal">

                    Tutup

                </button>

                <a href="{{ route('albumadmin.edit',$item->id) }}"
                    class="btn btn-warning">

                    <i class="fas fa-edit"></i>

                    Edit

                </a>

            </div>
            </div>
        </div>

    </div>

</div>

@endforeach

@endsection