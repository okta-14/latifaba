@extends('layouts.admin')

@section('title', 'Edit User')

@section('content')

<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Edit User</h1>
            </div>

            <div class="col-sm-6 text-right">
                <a href="{{ route('user.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Kembali
                </a>
            </div>
        </div>
    </div>
</section>

<section class="content">

    <div class="container-fluid">

        <div class="card card-warning">

            <div class="card-header bg-info">
                <h3 class="card-title">Form Edit User</h3>
            </div>

            <form action="{{ route('user.update', $user->id) }}" method="POST">

                @csrf
                @method('PUT')

                <div class="card-body">

                    <div class="form-group">
                        <label>Username</label>
                        <input type="text"
                               name="username"
                               class="form-control @error('username') is-invalid @enderror"
                               value="{{ old('username', $user->username) }}">

                        @error('username')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Nama</label>
                        <input type="text"
                               name="nama"
                               class="form-control @error('nama') is-invalid @enderror"
                               value="{{ old('nama', $user->nama) }}">

                        @error('nama')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Password</label>
                        <input type="password"
                               name="password"
                               class="form-control @error('password') is-invalid @enderror">

                        <small class="text-muted">
                            Kosongkan jika password tidak ingin diubah.
                        </small>

                        @error('password')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Level</label>

                        <select name="level"
                                class="form-control @error('level') is-invalid @enderror">

                            <option value="admin" {{ $user->level == 'admin' ? 'selected' : '' }}>
                                Admin
                            </option>

                            <option value="petugas" {{ $user->level == 'petugas' ? 'selected' : '' }}>
                                Petugas
                            </option>

                            <option value="user" {{ $user->level == 'user' ? 'selected' : '' }}>
                                User
                            </option>

                        </select>

                        @error('level')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>

                </div>

                <div class="card-footer">

                    <button type="submit" class="btn bg-info">
                        <i class="fas fa-save"></i> Update
                    </button>

                    <a href="{{ route('user.index') }}" class="btn btn-dark">
                        Batal
                    </a>

                </div>

            </form>

        </div>

    </div>

</section>

@endsection