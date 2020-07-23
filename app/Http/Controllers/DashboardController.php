<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Transaction;

class DashboardController extends Controller
{
    public function index()
    {

        $sql = "SELECT MONTHNAME(trx_date) month, count(*) total FROM transactions " . " GROUP BY MONTHNAME(trx_date) " . " ORDER BY MONTH(trx_date)";

        $trx = DB::select($sql);

        $month = [];
        $total = [];

        foreach ($trx as $key => $value) {
            $month[] = $value->month;
            $total[] = $value->total;
        }

        $chart = [
            'months' => $month,
            'totals' => $total,
        ];

        $data = [
            'chart' => $chart
        ];

        // dd($data);
        $paginate = 3;
        $transactions = Transaction::with('product')->paginate($paginate);

        return view('admin.dashboard', compact('transactions', 'paginate'))->with($data);
    }
}
