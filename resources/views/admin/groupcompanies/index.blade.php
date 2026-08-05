@extends('layouts.admin')
@section('title','Group Companies')
@section('content')

<section class="content-header">

    <div class="container-fluid">

        <div class="row mb-2">

            <div class="col-sm-6">

                <h1>Group Companies</h1>

            </div>

            <div class="col-sm-6 text-right">

                <a href="{{ route('groupcompanies.create') }}" class="btn btn-primary">

                    <i class="fas fa-plus"></i>

                    Tambah Data

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

                    Daftar Group Companies

                </h3>


                <div class="card-tools">

                    <span class="badge badge-primary">

                        Total : {{ $companies->count() }}

                    </span>

                </div>

            </div>



            <div class="card-body">
                <div class="table-responsive">


                <table class="table table-bordered table-striped">


                    <thead>

                        <tr>

                            <th width="60">
                                No
                            </th>

                            <th width="120">
                                Logo
                            </th>

                            <th>
                                Title
                            </th>

                            <th>
                                Website
                            </th>

                            <th width="120">
                                Status
                            </th>

                            <th width="220">
                                Aksi
                            </th>

                        </tr>

                    </thead>



                    <tbody>


                        @forelse($companies as $item)


                        <tr>


                            <td>

                                {{ $loop->iteration }}

                            </td>



                            <td>


                                <img

                                    src="{{ asset($item->image) }}"

                                    width="90"

                                    height="70"

                                    style="object-fit:contain;border-radius:6px;"

                                >


                            </td>



                            <td>

                                {{ $item->title }}

                            </td>



                            <td>


                                @if($item->url)

                                    <a

                                        href="{{ $item->url }}"

                                        target="_blank"

                                    >

                                        <i class="fas fa-external-link-alt"></i>

                                        Website

                                    </a>


                                @else

                                    -

                                @endif


                            </td>




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




                            <td>



                                <button

                                    class="btn btn-info btn-sm"

                                    data-toggle="modal"

                                    data-target="#detail{{ $item->id }}"

                                >

                                    <i class="fas fa-eye"></i>

                                </button>




                                <a

                                    href="{{ route('groupcompanies.edit',$item->id) }}"

                                    class="btn btn-warning btn-sm"

                                >

                                    <i class="fas fa-edit"></i>

                                </a>




                                <form

                                    action="{{ route('groupcompanies.destroy',$item->id) }}"

                                    method="POST"

                                    style="display:inline;"

                                >


                                    @csrf

                                    @method('DELETE')



                                    <button

                                        class="btn btn-danger btn-sm"

                                        onclick="return confirm('Yakin ingin menghapus data ini?')"

                                    >

                                        <i class="fas fa-trash"></i>

                                    </button>


                                </form>



                            </td>


                        </tr>



                        @empty


                        <tr>


                            <td colspan="6" class="text-center">


                                Belum ada data.


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





{{-- Modal Detail --}}


@foreach($companies as $item)


<div class="modal fade" id="detail{{ $item->id }}">


    <div class="modal-dialog">


        <div class="modal-content">



            <div class="modal-header bg-info">


                <h4 class="modal-title">

                    Detail Group Company

                </h4>



                <button

                    type="button"

                    class="close"

                    data-dismiss="modal"

                >

                    <span>&times;</span>

                </button>


            </div>




            <div class="modal-body text-center">



                <img

                    src="{{ asset($item->image) }}"

                    class="img-fluid rounded shadow mb-3"

                    style="max-height:220px;object-fit:contain;"

                >




                <table class="table table-bordered">



                    <tr>


                        <th width="120">

                            Title

                        </th>


                        <td>

                            {{ $item->title }}

                        </td>


                    </tr>




                    <tr>


                        <th>

                            Website

                        </th>



                        <td>


                            @if($item->url)


                                <a

                                    href="{{ $item->url }}"

                                    target="_blank"

                                >

                                    {{ $item->url }}

                                </a>


                            @else

                                -

                            @endif


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

                            Dibuat

                        </th>


                        <td>

                            {{ $item->created_at->format('d M Y H:i') }}

                        </td>


                    </tr>



                </table>


            </div>





            <div class="modal-footer">



                <button

                    class="btn btn-secondary"

                    data-dismiss="modal"

                >

                    Tutup

                </button>




                <a

                    href="{{ route('groupcompanies.edit',$item->id) }}"

                    class="btn btn-warning"

                >

                    <i class="fas fa-edit"></i>

                    Edit

                </a>



            </div>



        </div>


    </div>


</div>


@endforeach



@endsection