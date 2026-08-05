@extends('layouts.admin')

@section('title','Service')

@section('content')

<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">

            <div class="col-sm-6">
                <h1>Data Service</h1>
            </div>

            <div class="col-sm-6 text-right">
                <a href="{{ route('service.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Tambah Service
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
                    Daftar Service
                </h3>

                <div class="card-tools">

                    <span class="badge badge-primary">
                        Total : {{ $service->count() }}
                    </span>

                </div>

            </div>

            <div class="card-body">
                <div class="table-responsive">


                <table class="table table-bordered table-striped">

                    <thead>

                        <tr>

                            <th width="50">No</th>
                            <th>Icon</th>
                            <th>Image</th>
                            <th>Title</th>
                            <th>Short</th>
                            <th>Status</th>
                            <th width="220">Aksi</th>

                        </tr>

                    </thead>

                    <tbody>

                        @forelse($service as $item)

                        <tr>

                            <td>{{ $loop->iteration }}</td>

                            <td width="90">

                                @if($item->icon)

                                <img src="{{ asset('uploads/service/icon/'.$item->icon) }}"
                                     width="60"
                                     height="60"
                                     style="object-fit:cover;border-radius:5px;">

                                @else

                                <span class="text-muted">-</span>

                                @endif

                            </td>

                            <td width="100">

                                @if($item->img)

                                <img src="{{ asset('uploads/service/img/'.$item->img) }}"
                                     width="80"
                                     height="60"
                                     style="object-fit:cover;border-radius:5px;">

                                @else

                                <span class="text-muted">-</span>

                                @endif

                            </td>

                            <td>{{ $item->title }}</td>

                            <td>{{ \Illuminate\Support\Str::limit($item->short,40) }}</td>

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
                                    data-target="#detailService{{ $item->id }}">

                                    <i class="fas fa-eye"></i>

                                </button>

                                <a href="{{ route('service.edit',$item->id) }}"
                                   class="btn btn-warning btn-sm">

                                    <i class="fas fa-edit"></i>

                                </a>

                                <form action="{{ route('service.destroy',$item->id) }}"
                                      method="POST"
                                      style="display:inline">

                                    @csrf
                                    @method('DELETE')

                                    <button class="btn btn-danger btn-sm"
                                            onclick="return confirm('Yakin ingin menghapus service ini?')">

                                        <i class="fas fa-trash"></i>

                                    </button>

                                </form>

                            </td>

                        </tr>

                        @empty

                        <tr>

                            <td colspan="7" class="text-center">
                                Data service belum tersedia.
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

@foreach($service as $item)

<div class="modal fade"
     id="detailService{{ $item->id }}">

    <div class="modal-dialog modal-xl">

        <div class="modal-content">

            <div class="modal-header bg-info">

                <h4 class="modal-title">
                    Detail Service
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

                        <img src="{{ asset('uploads/service/img/'.$item->img) }}"
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
                                <th>Short</th>
                                <td>{{ $item->short }}</td>
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

                <a href="{{ route('service.edit',$item->id) }}"
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