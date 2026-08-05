@extends('layouts.admin')

@section('title', 'Client')

@section('content')

<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">

            <div class="col-sm-6">
                <h1>Data Client</h1>
            </div>

            <div class="col-sm-6 text-right">
                <a href="{{ route('client.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Tambah Client
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

                <button type="button"
                        class="close"
                        data-dismiss="alert"
                        aria-label="Close">
                    <span>&times;</span>
                </button>
            </div>
        @endif

        <div class="card">

            <div class="card-header">

                <h3 class="card-title">
                    Daftar Client
                </h3>

                <div class="card-tools">
                    <span class="badge badge-primary">
                        Total : {{ $client->count() }}
                    </span>
                </div>

            </div>

            <div class="card-body">


                <div class="table-responsive">

                    <table class="table table-bordered table-striped align-middle">

                        <thead>
                            <tr>
                                <th width="60">No</th>
                                <th width="120">Logo</th>
                                <th>Title</th>
                                <th width="100">Status</th>
                                <th>URL</th>
                                <th width="120" class="text-center">Aksi</th>
                            </tr>
                        </thead>

                        <tbody>

                        @forelse($client as $item)

                            <tr>

                                <td>{{ $loop->iteration }}</td>

                                <td class="text-center">
                                    <img src="{{ asset('uploads/client/' . $item->img) }}"
                                         alt="{{ $item->title }}"
                                         class="img-thumbnail"
                                         style="width:80px;height:80px;object-fit:cover;">
                                </td>

                                <td>{{ $item->title }}</td>

                                <td>
                                    @if($item->status == 'Show')
                                        <span class="badge badge-success">
                                            Show
                                        </span>
                                    @else
                                        <span class="badge badge-secondary">
                                            Hide
                                        </span>
                                    @endif
                                </td>

                                <td style="max-width:350px;">
                                    @if($item->url)
                                        <a href="{{ $item->url }}"
                                           target="_blank"
                                           title="{{ $item->url }}"
                                           style="word-break: break-all;">
                                            {{ $item->url }}
                                        </a>
                                    @else
                                        <span class="text-muted">
                                            -
                                        </span>
                                    @endif
                                </td>

                                <td class="text-center">

                                    <a href="{{ route('client.edit', $item->id) }}"
                                       class="btn btn-warning btn-sm">
                                        <i class="fas fa-edit"></i>
                                    </a>

                                    <form action="{{ route('client.destroy', $item->id) }}"
                                          method="POST"
                                          class="d-inline">

                                        @csrf
                                        @method('DELETE')

                                        <button type="submit"
                                                class="btn btn-danger btn-sm"
                                                onclick="return confirm('Yakin ingin menghapus client ini?')">
                                            <i class="fas fa-trash"></i>
                                        </button>

                                    </form>

                                </td>

                            </tr>

                        @empty

                            <tr>
                                <td colspan="6" class="text-center">
                                    Data client belum tersedia.
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