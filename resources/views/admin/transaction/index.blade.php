@extends('admin.template.admin')

@section('content')
    <br>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">
                            Transactions
                        </h3>
                        <div class="card-tools">
                            <a href="{{ route('transaction.create') }}" class="btn btn-tool">
                                <i class="fa fa-plus"></i>&nbsp; Add
                            </a>
                        </div>
                    </div>
                    <div class="card-body">

                        @if (Session::has('message'))
                            <div class="alert alert-success">
                                <i class="fa fa-check"></i>
                                {!! Session::get('message') !!}
                            </div>
                        @endif

                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Produk</th>
                                    <th>Tanggal</th>
                                    <th>Price</th>
                                </tr>
                            </thead>
                            @php 
                            $page = isset($_GET['page']) == null ? 1 : $_GET['page'];
                            $page = ($page - 1) * $pagination;
                            @endphp
                            @foreach ($transaction as $item)
                                <tbody>
                                    <tr>
                                        <td>{{ ++$page }}</td>
                                        <td>{{ $item->product->name }}</td>
                                        <td>{{ date('d-m-Y H:i', strtotime($item->trx_date ))}}</td>
                                        <td>Rp. {{ number_format($item->price, 0, 0, ".") }}</td>
                                    </tr>
                                </tbody>
                            @endforeach
                        </table>
                        <div class="row mt-2">
                            <div class="col-md-12">
                                {{$transaction->links()}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection
