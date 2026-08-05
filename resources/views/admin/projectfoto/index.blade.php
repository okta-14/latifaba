@extends('layouts.admin')

@section('title','Foto Program')

@section('content')

<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">

            <div class="col-sm-6">
                <h1>Data Foto Program</h1>
            </div>

            <div class="col-sm-6 text-right">
                <a href="{{ route('projectfoto.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Tambah Foto
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
                    Daftar Foto Program
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

                            <th width="50">No</th>
                            <th>Foto</th>
                            <th>Program</th>
                            <th width="150">Aksi</th>

                        </tr>

                    </thead>

                    <tbody>

                        @forelse($fotos as $item)

                        <tr>

                            <td>{{ $loop->iteration }}</td>

                            <td width="120">

                                @if($item->img)

                                <img src="{{ asset($item->img) }}"
                                     width="100"
                                     height="70"
                                     style="object-fit:cover;border-radius:5px;">

                                @else

                                <span class="text-muted">-</span>

                                @endif

                            </td>

                            <td>{{ $item->program->title ?? '-' }}</td>

                            <td>

                                <a href="{{ route('projectfoto.edit',$item->id) }}"
                                   class="btn btn-warning btn-sm">

                                    <i class="fas fa-edit"></i>

                                </a>

                                <form action="{{ route('projectfoto.destroy',$item->id) }}"
                                      method="POST"
                                      style="display:inline">

                                    @csrf
                                    @method('DELETE')

                                    <button class="btn btn-danger btn-sm"
                                            onclick="return confirm('Yakin ingin menghapus foto ini?')">

                                        <i class="fas fa-trash"></i>

                                    </button>

                                </form>

                            </td>

                        </tr>

                        @empty

                        <tr>

                            <td colspan="4" class="text-center">
                                Data foto belum tersedia.
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