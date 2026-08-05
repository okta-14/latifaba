@extends('layouts.admin')
@section('title','user')
@section('content')

<!-- Header -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Data User</h1>
            </div>

            <div class="col-sm-6 text-right">
                <a href="{{ route('user.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Tambah User
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Isi -->
<section class="content">
    <div class="container-fluid">

        @if(session('success'))
            <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                {{ session('success') }}
            </div>
        @endif

        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Daftar User</h3>
                <div class="card-tools">
                    <span class="badge badge-primary">
                        Total: {{ $users->count() }}
                    </span>
                </div>
            </div>

            <div class="card-body">
                <div class="table-responsive">


                <table class="table table-bordered table-striped">

                    <thead>
                        <tr>
                            <th width="50">No</th>
                            <th>Username</th>
                            <th>Nama</th>
                            <th>Level</th>
                            <th width="220">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($users as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->username }}</td>
                            <td>{{ $item->nama }}</td>
                            <td>
                                @if($item->level == 'admin')
                                    <span class="badge badge-danger">Admin</span>
                                @elseif($item->level == 'petugas')
                                    <span class="badge badge-warning">Petugas</span>
                                @else
                                    <span class="badge badge-success">User</span>
                                @endif
                            </td>
                            <td>
                                {{-- TOMBOL DETAIL --}}
                                <button type="button" 
                                        class="btn btn-info btn-sm" 
                                        data-toggle="modal" 
                                        data-target="#modalDetailUser{{ $item->id }}">
                                    <i class="fas fa-eye"></i>
                                </button>

                                {{-- TOMBOL EDIT --}}
                                <a href="{{ route('user.edit', $item->id) }}"
                                   class="btn btn-warning btn-sm">
                                    <i class="fas fa-edit"></i>
                                </a>

                                {{-- TOMBOL HAPUS --}}
                                <form action="{{ route('user.destroy', $item->id) }}"
                                      method="POST"
                                      style="display:inline;">

                                    @csrf
                                    @method('DELETE')

                                    <button class="btn btn-danger btn-sm"
                                            onclick="return confirm('Yakin ingin menghapus data ini?')">
                                        <i class="fas fa-trash"></i>
                                    </button>

                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center">
                                <i class="fas fa-database text-muted"></i> Data belum tersedia.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>

                </table>

            </div>

            <div class="card-footer clearfix">
                <div class="float-right">
                    <small class="text-muted">
                        Total Data: {{ $users->count() }}
                    </small>
                </div>
            </div>

        </div>

    </div>
</section>

{{-- MODAL DETAIL USER (DILUAR CARD) --}}
@foreach($users as $item)
<div class="modal fade" id="modalDetailUser{{ $item->id }}" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <h4 class="modal-title">
                    <i class="fas fa-user"></i> Detail User
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table table-bordered table-striped">
                    <tr>
                        <th width="35%">ID</th>
                        <td>{{ $item->id }}</td>
                    </tr>
                    <tr>
                        <th>Username</th>
                        <td><strong>{{ $item->username }}</strong></td>
                    </tr>
                    <tr>
                        <th>Nama Lengkap</th>
                        <td>{{ $item->nama }}</td>
                    </tr>
                    <tr>
                        <th>Level</th>
                        <td>
                            @if($item->level == 'admin')
                                <span class="badge badge-danger">Admin</span>
                            @elseif($item->level == 'petugas')
                                <span class="badge badge-warning">Petugas</span>
                            @else
                                <span class="badge badge-success">User</span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>Email</th>
                        <td>{{ $item->email ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th>Dibuat</th>
                        <td>{{ $item->created_at->format('d M Y H:i') }}</td>
                    </tr>
                    @if($item->updated_at)
                    <tr>
                        <th>Diperbarui</th>
                        <td>{{ $item->updated_at->format('d M Y H:i') }}</td>
                    </tr>
                    @endif
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                    <i class="fas fa-times"></i> Tutup
                </button>
                <a href="{{ route('user.edit', $item->id) }}" class="btn btn-warning">
                    <i class="fas fa-edit"></i> Edit
                </a>
            </div>
        </div>
</div>
    </div>
</div>
@endforeach

@endsection