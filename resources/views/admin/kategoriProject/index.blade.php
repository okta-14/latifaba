@extends('layouts.admin')

@section('title', 'Kategori Project')

@section('content')

<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">

            <div class="col-sm-6">
                <h1>Data Kategori Project</h1>
            </div>

            <div class="col-sm-6 text-right">
                <a href="{{ route('kategoriProject.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Tambah Kategori Project
                </a>
            </div>

        </div>
    </div>
</section>

<section class="content">

    <div class="container-fluid">

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show">
                <button type="button" class="close" data-dismiss="alert">
                    <span>&times;</span>
                </button>

                {{ session('success') }}
            </div>
        @endif

        <div class="card">

            <div class="card-header">

                <h3 class="card-title">
                    Daftar Kategori Project
                </h3>

                <div class="card-tools">
                    <span class="badge badge-primary">
                        Total : {{ $kategori->count() }}
                    </span>
                </div>

            </div>

            <div class="card-body">
                <div class="table-responsive">

                <table id="example1" class="table table-bordered table-striped">

                    <thead>
                        <tr>
                            <th width="60">No</th>
                            <th>Title</th>
                            <th>Slug</th>
                            <th width="170">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>

                        @forelse($kategori as $item)

                            <tr>

                                <td>{{ $loop->iteration }}</td>

                                <td>{{ $item->title }}</td>

                                <td>{{ $item->slug }}</td>

                                <td>

                                    <a href="{{ route('kategoriProject.edit', $item->id) }}"
                                        class="btn btn-warning btn-sm">

                                        <i class="fas fa-edit"></i>

                                    </a>

                                    <form action="{{ route('kategoriProject.destroy', $item->id) }}"
                                        method="POST"
                                        style="display:inline-block">

                                        @csrf
                                        @method('DELETE')

                                        <button type="submit"
                                            class="btn btn-danger btn-sm"
                                            onclick="return confirm('Yakin ingin menghapus kategori project ini?')">

                                            <i class="fas fa-trash"></i>

                                        </button>

                                    </form>

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td colspan="4" class="text-center">
                                    Belum ada data kategori project.
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