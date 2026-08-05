@extends('layouts.admin')
@section('title','Foto')
@section('content')

<section class="content-header">

    <div class="container-fluid">

        <div class="row mb-2">

            <div class="col-sm-6">
                <h1>Data Foto</h1>
            </div>

            <div class="col-sm-6 text-right">

                <a href="{{ route('foto.create') }}" class="btn btn-primary">

                    <i class="fas fa-plus"></i>

                    Tambah Foto

                </a>

            </div>

        </div>

    </div>

</section>

<section class="content">

    <div class="container-fluid">

        @if(session('success'))

        <div class="alert alert-success alert-dismissible">

            <button class="close" data-dismiss="alert">

                &times;

            </button>

            {{ session('success') }}

        </div>

        @endif

        <div class="card">

            <div class="card-header">

                <h3 class="card-title">

                    Daftar Foto

                </h3>

                <div class="card-tools">

                    <span class="badge badge-primary">

                        Total : {{ $fotos->count() }}

                    </span>

                </div>

            </div>

            <div class="card-body">
                <div class="table-responsive">


                <table class="table table-bordered table-striped">

                    <thead>

                        <tr>

                            <th width="60">No</th>
                            <th width="120">Foto</th>
                            <th>Album</th>
                            <th width="220">Aksi</th>

                        </tr>

                    </thead>

                    <tbody>

                        @forelse($fotos as $item)

                        <tr>

                            <td>

                                {{ $loop->iteration }}

                            </td>

                            <td>

                                <img
                                    src="{{ asset($item->img) }}"
                                    width="90"
                                    height="70"
                                    style="object-fit:cover;border-radius:6px;">

                            </td>

                            <td>

                                {{ $item->album->title ?? '-' }}

                            </td>

                            <td>

                                <button
                                    class="btn btn-info btn-sm"
                                    data-toggle="modal"
                                    data-target="#detailFoto{{ $item->id }}">

                                    <i class="fas fa-eye"></i>

                                </button>

                                <a
                                    href="{{ route('foto.edit',$item->id) }}"
                                    class="btn btn-warning btn-sm">

                                    <i class="fas fa-edit"></i>

                                </a>

                                <form
                                    action="{{ route('foto.destroy',$item->id) }}"
                                    method="POST"
                                    style="display:inline;">

                                    @csrf
                                    @method('DELETE')

                                    <button
                                        class="btn btn-danger btn-sm"
                                        onclick="return confirm('Yakin ingin menghapus foto ini?')">

                                        <i class="fas fa-trash"></i>

                                    </button>

                                </form>

                            </td>

                        </tr>

                        @empty

                        <tr>

                            <td colspan="4" class="text-center">

                                Belum ada data foto.

                            </td>

                        </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</section>



{{-- Modal Detail --}}

@foreach($fotos as $item)

<div
    class="modal fade"
    id="detailFoto{{ $item->id }}">

    <div class="modal-dialog">

        <div class="modal-content">

            <div class="modal-header bg-info">

                <h4 class="modal-title">

                    Detail Foto

                </h4>

                <button
                    class="close"
                    data-dismiss="modal">

                    <span>&times;</span>

                </button>

            </div>

            <div class="modal-body text-center">

                <img
                    src="{{ asset($item->img) }}"
                    class="img-fluid rounded shadow mb-3">

                <table class="table table-bordered">

                    <tr>

                        <th width="120">

                            Album

                        </th>

                        <td>

                            {{ $item->album->title ?? '-' }}

                        </td>

                    </tr>

                    <tr>

                        <th>

                            Dibuat

                        </th>

                        <td>

                            {{ $item->created_at->format('d M Y H:i') }}

                        </td>

                    </tr>

                </table>

            </div>

            <div class="modal-footer">

                <button
                    class="btn btn-secondary"
                    data-dismiss="modal">

                    Tutup

                </button>

                <a
                    href="{{ route('foto.edit',$item->id) }}"
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