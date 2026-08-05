@extends('layouts.admin')

@section('title','Kontak Kami')

@section('content')

<section class="content-header">
    <div class="container-fluid">

        <div class="row mb-2">

            <div class="col-sm-6">
                <h1>Data Kontak</h1>
            </div>

            <div class="col-sm-6 text-right">
                <a href="{{ route('kontakkami.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus"></i>
                    Tambah Kontak
                </a>
            </div>

        </div>

    </div>
</section>

<section class="content">

<div class="container-fluid">

@if(session('success'))

<div class="alert alert-success alert-dismissible fade show">

    {{ session('success') }}

    <button type="button" class="close" data-dismiss="alert">
        <span>&times;</span>
    </button>

</div>

@endif

<div class="card">

    <div class="card-header">

        <h3 class="card-title">
            Daftar Kontak
        </h3>

        <div class="card-tools">

            <span class="badge badge-primary">
                Total : {{ $kontakkami->count() }}
            </span>

        </div>

    </div>

    <div class="card-body">
        

        <div class="table-responsive">

            <table class="table table-bordered table-striped">

                <thead>

                    <tr>
                        <th width="60">No</th>
                        <th>Kontak</th>
                        <th>Title</th>
                        <th>Type</th>
                        <th width="150">Aksi</th>
                    </tr>

                </thead>

                <tbody>

                @forelse($kontakkami as $item)

                    <tr>

                        <td>{{ $loop->iteration }}</td>

                        <td>{{ $item->kontak }}</td>

                        <td>{{ $item->title }}</td>

                        <td>{{ $item->type }}</td>

                        <td>

                            <a href="{{ route('kontakkami.edit',$item->id) }}"
                               class="btn btn-warning btn-sm">

                                <i class="fas fa-edit"></i>

                            </a>

                            <form action="{{ route('kontakkami.destroy',$item->id) }}"
                                  method="POST"
                                  class="d-inline">

                                @csrf
                                @method('DELETE')

                                <button type="submit"
                                        class="btn btn-danger btn-sm"
                                        onclick="return confirm('Yakin ingin menghapus kontak ini?')">

                                    <i class="fas fa-trash"></i>

                                </button>

                            </form>

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="5" class="text-center">
                            Data kontak belum tersedia.
                        </td>

                    </tr>

                @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

</div>

</section>

@endsection