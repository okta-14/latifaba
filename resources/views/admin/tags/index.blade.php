@extends('layouts.admin')

@section('title','Tag')

@section('content')

<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">

            <div class="col-sm-6">
                <h1>Data Tag</h1>
            </div>

            <div class="col-sm-6 text-right">
                <a href="{{ route('tags.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Tambah Tag
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
                    Daftar Tag
                </h3>

                <div class="card-tools">

                    <span class="badge badge-primary">
                        Total : {{ $tags->count() }}
                    </span>

                </div>

            </div>

            <div class="card-body">
                <div class="table-responsive">


                <table class="table table-bordered table-striped">

                    <thead>

                        <tr class="text-center">

                            <th width="60">No</th>
                            <th>Nama Tag</th>
                            <th width="120">Hit</th>
                            <th width="170">Aksi</th>

                        </tr>

                    </thead>

                    <tbody>

                        @forelse($tags as $item)

                        <tr>

                            <td class="text-center">
                                {{ $loop->iteration }}
                            </td>

                            <td>
                                {{ $item->getTranslation('title', 'id') }}
                            </td>

                            <td class="text-center">
                                {{ $item->hit }}
                            </td>

                            <td class="text-center">

                                <a href="{{ route('tags.edit', $item->id) }}"
                                   class="btn btn-warning btn-sm">

                                    <i class="fas fa-edit"></i>

                                </a>

                                <form action="{{ route('tags.destroy', $item->id) }}"
                                      method="POST"
                                      style="display:inline">

                                    @csrf
                                    @method('DELETE')

                                    <button type="submit"
                                            class="btn btn-danger btn-sm"
                                            onclick="return confirm('Yakin ingin menghapus tag ini?')">

                                        <i class="fas fa-trash"></i>

                                    </button>

                                </form>

                            </td>

                        </tr>

                        @empty

                        <tr>

                            <td colspan="4" class="text-center">
                                Data tag belum tersedia.
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