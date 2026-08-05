@extends('layouts.admin')
@section('title','Kategori')

@section('content')

<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">

            <div class="col-sm-6">
                <h1>Data Kategori</h1>
            </div>

            <div class="col-sm-6 text-right">
                <a href="{{ route('kategori.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Tambah Kategori
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

        <h3 class="card-title">
            Daftar Kategori
        </h3>

        <div class="card-tools">

            <span class="badge badge-primary">
                Total : {{ $kategoris->count() }}
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
                    <th>Slug</th>
                    <th width="180">Aksi</th>
                </tr>

            </thead>


            <tbody>

            @forelse($kategoris as $item)

            <tr>

                <td>
                    {{ $loop->iteration }}
                </td>

                <td>
                    {{ $item->title }}
                </td>

                <td>
                    {{ $item->slug }}
                </td>

                <td>

                    <a href="{{ route('kategori.edit',$item->id) }}"
                       class="btn btn-warning btn-sm">

                        <i class="fas fa-edit"></i>

                    </a>


                    <form action="{{ route('kategori.destroy',$item->id) }}"
                          method="POST"
                          style="display:inline">

                        @csrf
                        @method('DELETE')

                        <button type="submit"
                                class="btn btn-danger btn-sm"
                                onclick="return confirm('Yakin ingin menghapus kategori ini?')">

                            <i class="fas fa-trash"></i>

                        </button>

                    </form>

                </td>

            </tr>


            @empty

            <tr>

                <td colspan="4" class="text-center">
                    Data kategori belum tersedia.
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
