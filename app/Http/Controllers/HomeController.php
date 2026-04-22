<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Inertia\Inertia;
use App\Models\Transaction;
use App\Models\User;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Route;
use Illuminate\Database\Eloquent\Builder as EloquentBuilder;
use phpDocumentor\Reflection\Types\Array_;

class HomeController extends Controller
{
    public function index(Request $request) {

        // $post = Transaction::find(1);
        // dd($post->category);
        // dd($user->categories);
        // dd(Carbon::now()->subMonth());

        if($request->user() ) {

            $filters = $request->only('month', 'year');

            $transactions = Transaction::where('user_id', 
                $request->user()->id)
                ->when($request->month, function (EloquentBuilder $query, string $month) {
                    $query->whereMonth('publish_date', $month);
                })
                ->when($request->year, function (EloquentBuilder $query, string $year) {
                    $query->whereYear('publish_date', $year);
                })
                ->when(!$filters, function ($query) {
                    $query->whereYear('publish_date', Carbon::now()->year);
                    $query->whereMonth('publish_date', Carbon::now()->month);
                })
                ->orderBy('publish_date', 'DESC')
                ;

            $fistdate = Transaction::where('user_id', $request->user()->id)->orderBy('publish_date', 'asc')->first();


            $last = Transaction::where('user_id', 
                $request->user()->id)
                ->when($filters, function ($query, $filters) {
                    // dd($filters);
                    $currentDate = $filters['year'].'-'.$filters['month'].'-01';
                    $date = Carbon::createFromDate($currentDate)->subMonth();
                    $query->whereYear('publish_date', $date->year);
                    $query->whereMonth('publish_date', $date->month);
                })
                ->when(!$filters, function ($query) {
                    $query->whereYear('publish_date', Carbon::now()->subMonth()->year);
                    $query->whereMonth('publish_date', Carbon::now()->subMonth()->month);
                })
                ;

            $lastIncome = $last->get()->diff(Transaction::whereIn('isIncome', [0])->get())->sum('sum');
            $lastExpence = $last->get()->diff(Transaction::whereIn('isIncome', [1])->get())->sum('sum');

            $income = $transactions->get()->diff(Transaction::whereIn('isIncome', [0])->get())->sum('sum');
            $expence = $transactions->get()->diff(Transaction::whereIn('isIncome', [1])->get())->sum('sum');

            if ($lastIncome >= $income) $incomeStats = 0;
            else $incomeStats = 1;

            if ($lastExpence >= $expence) $expenceStats = 0;
            else $expenceStats = 1;

        }


        return $request->user() 
        ? Inertia::render('Dashboard', [
            'transactions' => $transactions->limit(10)->get()->load(['category']),
            'allIncome' => $income,
            'allExpence' => $expence,
            'filters' => $filters,
            'firstdate' => $fistdate,
            'lastIncome' => $incomeStats,
            'lastExpence' => $expenceStats,
        ])
        : Inertia::render('Welcome', [
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
        ]);
    }
}
