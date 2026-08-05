@extends('layouts.admin')

@section('title','Program')

@section('content')

<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">

            <div class="col-sm-6">
                <h1>Data Program</h1>
            </div>

            <div class="col-sm-6 text-right">
                <a href="{{ route('programadmin.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Tambah Program
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
                    Daftar Program
                </h3>

                <div class="card-tools">

                    <span class="badge badge-primary">
                        Total : {{ $programs->total() }}
                    </span>

                </div>

            </div>

            <div class="card-body">
                <div class="table-responsive">


                <table class="table table-bordered table-striped">

                    <thead>

                        <tr>

                            <th width="50">No</th>
                            <th>Image</th>
                            <th>Title</th>
                            <th>Kategori</th>
                            <th>Service</th>
                            <th>Tanggal</th>
                            <th>Hit</th>
                            <th>Status</th>
                            <th width="220">Aksi</th>

                        </tr>

                    </thead>

                    <tbody>

                        @forelse($programs as $item)

                        <tr>

                            <td>{{ $loop->iteration + ($programs->currentPage()-1)*$programs->perPage() }}</td>

                            <td width="100">

                                @if($item->img)

                               <img src="{{ asset($item->img) }}"
                                     width="80"
                                     height="60"
                                     style="object-fit:cover;border-radius:5px;">

                                @else

                                <span class="text-muted">-</span>

                                @endif

                            </td>

                            <td>{{ \Illuminate\Support\Str::limit($item->title,40) }}</td>

                            <td>{{ $item->category->title ?? '-' }}</td>

                            <td>{{ $item->service->title ?? '-' }}</td>

                            <td>{{ $item->date }}</td>

                            <td>{{ $item->hit }}</td>

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

                            <td>

                                <button
                                    class="btn btn-info btn-sm"
                                    data-toggle="modal"
                                    data-target="#detailProgram{{ $item->id }}">

                                    <i class="fas fa-eye"></i>

                                </button>

                                <a href="{{ route('programadmin.edit',$item->id) }}"
                                   class="btn btn-warning btn-sm">

                                    <i class="fas fa-edit"></i>

                                </a>

                                <form action="{{ route('programadmin.destroy',$item->id) }}"
                                      method="POST"
                                      style="display:inline">

                                    @csrf
                                    @method('DELETE')

                                    <button class="btn btn-danger btn-sm"
                                            onclick="return confirm('Yakin ingin menghapus program ini?')">

                                        <i class="fas fa-trash"></i>

                                    </button>

                                </form>

                            </td>

                        </tr>

                        @empty

                        <tr>

                            <td colspan="9" class="text-center">
                                Data program belum tersedia.
                            </td>

                        </tr>

                        @endforelse

                    </tbody>

                </table>

                {{ $programs->links() }}

            </div>

        </div>

    </div>

</section>

{{-- Modal Detail --}}

@foreach($programs as $item)

<div class="modal fade"
     id="detailProgram{{ $item->id }}">

    <div class="modal-dialog modal-xl">

        <div class="modal-content">

            <div class="modal-header bg-info">

                <h4 class="modal-title">
                    Detail Program
                </h4>

                <button type="button"
                        class="close"
                        data-dismiss="modal">

                    <span>&times;</span>

                </button>

            </div>

            <div class="modal-body">

                <div class="row">

                    <div class="col-md-4 text-center">

                        @if($item->img)

                        <img src="{{ asset('storage/'.$item->img) }}"
                             class="img-fluid rounded shadow">

                        @endif

                    </div>

                    <div class="col-md-8">

                        <table class="table table-bordered">

                            <tr>
                                <th width="170">Title</th>
                                <td>{{ $item->title }}</td>
                            </tr>

                            <tr>
                                <th>Tanggal</th>
                                <td>{{ $item->date }}</td>
                            </tr>

                            <tr>
                                <th>Kategori</th>
                                <td>{{ $item->category->title ?? '-' }}</td>
                            </tr>

                            <tr>
                                <th>Service</th>
                                <td>{{ $item->service->title ?? '-' }}</td>
                            </tr>

                            <tr>
                                <th>Lokasi</th>
                                <td>{{ $item->lokasi ?? '-' }}</td>
                            </tr>

                            <tr>
                                <th>Content</th>
                                <td>{!! nl2br(e($item->content)) !!}</td>
                            </tr>

                            <tr>
                                <th>Status</th>
                                <td>
                                    @if($item->status=='Show')
                                        <span class="badge badge-success">Show</span>
                                    @else
                                        <span class="badge badge-danger">Hide</span>
                                    @endif
                                </td>
                            </tr>

                            <tr>
                                <th>Slug</th>
                                <td>{{ $item->slug }}</td>
                            </tr>

                            <tr>
                                <th>Hit</th>
                                <td>{{ $item->hit }}</td>
                            </tr>

                            <tr>
                                <th>URL</th>
                                <td>
                                    @if($item->url)
                                        <a href="{{ $item->url }}" target="_blank">
                                            {{ $item->url }}
                                        </a>
                                    @else
                                        -
                                    @endif
                                </td>
                            </tr>

                        </table>

                    </div>

                </div>

            </div>

            <div class="modal-footer">

                <button class="btn btn-secondary"
                        data-dismiss="modal">

                    Tutup

                </button>

                <a href="{{ route('programadmin.edit',$item->id) }}"
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