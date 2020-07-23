@extends('admin.template.admin')

@section('content')
   <br>
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Sales Graph</h3>
                </div>
                <div class="card-body">
                    <canvas class="chart" id="sales-chart" style="height: 250px"></canvas>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">latest transaction here</h3>
                </div>
                <div class="card-body">
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
                        $page = ($page - 1) * $paginate;
                        @endphp
                        @foreach ($transactions as $item)
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
                            {{$transactions->links()}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.min.js"></script>
    <script>
        var chart = document.getElementById('sales-chart').getContext('2d');
        var areaChart = new Chart(chart, {
            type : 'line',
            data : {
                labels : {!! json_encode($chart['months']) !!},
                datasets : [
                    {
                        label : "Overal Sales",
                        data : {{ json_encode($chart['totals']) }}
                    }
                ]
            }
        });
     
    </script>  
@endsection
