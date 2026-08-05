        @extends('layouts.admin')
        @section('title','Review')
        @section('content')

        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">

                    <div class="col-sm-6">
                        <h1>Data Review</h1>
                    </div>

                    <div class="col-sm-6 text-right">
                        <a href="{{ route('reviewadmin.create') }}" class="btn btn-primary">
                            <i class="fas fa-plus"></i>
                            Tambah Review
                        </a>
                    </div>

                </div>
            </div>
        </section>


        <section class="content">
        <div class="container-fluid">


        @if(session('success'))

        <div class="alert alert-success alert-dismissible">
            <button class="close" data-dismiss="alert">
                &times;
            </button>

            {{ session('success') }}

        </div>

        @endif



        <div class="card">

        <div class="card-header">

        <h3 class="card-title">
        Daftar Review
        </h3>


        <div class="card-tools">

        <span class="badge badge-primary">
        Total : {{ $reviews->count() }}
        </span>

        </div>

        </div>



        <div class="card-body">
            <div class="table-responsive">



        <table class="table table-bordered table-striped">

        <thead>

        <tr>

        <th width="60">No</th>
        <th>Nama</th>
        <th>Pekerjaan</th>
        <th width="120">Rating</th>
        <th>Review</th>
        <th width="100">Status</th>
        <th width="220">Aksi</th>

        </tr>

        </thead>


        <tbody>


        @forelse($reviews as $item)


        @php

        $pekerjaan = $item->pekerjaan;

        if(is_array($pekerjaan)){

            $pekerjaan = $pekerjaan['id']
                ?? $pekerjaan['en']
                ?? $pekerjaan['jp']
                ?? '';

        }


        $reviewText = $item->review;


        if(is_array($reviewText)){

            $reviewText = $reviewText['id']
                ?? $reviewText['en']
                ?? $reviewText['jp']
                ?? '';

        }


        @endphp




        <tr>


        <td>
        {{ $loop->iteration }}
        </td>



        <td>
        {{ $item->nama }}
        </td>



        <td>
        {{ $pekerjaan }}
        </td>




        <td>

        @for($i=1;$i <= $item->stars;$i++)

        <i class="fas fa-star text-warning"></i>

        @endfor


        </td>



        <td>

        {{ \Illuminate\Support\Str::limit($reviewText,50) }}

        </td>




        <td class="text-center">


        @if($item->status == 'Show')

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
        data-target="#detailReview{{ $item->id }}">

        <i class="fas fa-eye"></i>

        </button>



        <a href="{{ route('reviewadmin.edit',$item->id) }}"
        class="btn btn-warning btn-sm">

        <i class="fas fa-edit"></i>

        </a>




        <form
        action="{{ route('reviewadmin.destroy',$item->id) }}"
        method="POST"
        style="display:inline;">


        @csrf
        @method('DELETE')


        <button
        class="btn btn-danger btn-sm"
        onclick="return confirm('Yakin ingin menghapus review ini?')">

        <i class="fas fa-trash"></i>

        </button>


        </form>


        </td>


        </tr>



        @empty


        <tr>

        <td colspan="7" class="text-center">

        Belum ada data review.

        </td>

        </tr>


        @endforelse



        </tbody>


        </table>


        </div>

        </div>


        </div>
        </section>






        {{-- MODAL DETAIL --}}

        @foreach($reviews as $item)


        @php

        $pekerjaan = $item->pekerjaan;

        if(is_array($pekerjaan)){

        $pekerjaan = $pekerjaan['id']
        ?? $pekerjaan['en']
        ?? $pekerjaan['jp']
        ?? '';

        }



        $reviewText = $item->review;

        if(is_array($reviewText)){

        $reviewText = $reviewText['id']
        ?? $reviewText['en']
        ?? $reviewText['jp']
        ?? '';

        }


        @endphp




        <div class="modal fade" id="detailReview{{ $item->id }}">


        <div class="modal-dialog">

        <div class="modal-content">


        <div class="modal-header bg-info">


        <h4 class="modal-title">
        Detail Review
        </h4>


        <button class="close" data-dismiss="modal">

        <span>&times;</span>

        </button>


        </div>




        <div class="modal-body">


        <table class="table table-bordered">


        <tr>

        <th width="140">
        Nama
        </th>

        <td>
        {{ $item->nama }}
        </td>

        </tr>



        <tr>

        <th>
        Pekerjaan
        </th>

        <td>
        {{ $pekerjaan }}
        </td>

        </tr>




        <tr>

        <th>
        Rating
        </th>


        <td>

        @for($i=1;$i <= $item->stars;$i++)

        <i class="fas fa-star text-warning"></i>

        @endfor


        ({{ $item->stars }}/5)

        </td>

        </tr>




        <tr>

        <th>
        Status
        </th>


        <td>


        @if($item->status == 'Show')

        <span class="badge badge-success">
        Show
        </span>

        @else

        <span class="badge badge-danger">
        Hide
        </span>


        @endif


        </td>

        </tr>




        <tr>

        <th>
        Review
        </th>


        <td>

        {{ $reviewText }}

        </td>

        </tr>




        <tr>

        <th>
        Dibuat
        </th>


        <td>

        {{ $item->created_at->format('d M Y H:i') }}

        </td>

        </tr>



        </table>



        </div>




        <div class="modal-footer">


        <button class="btn btn-secondary"
        data-dismiss="modal">

        Tutup

        </button>



        <a href="{{ route('reviewadmin.edit',$item->id) }}"
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