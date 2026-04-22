<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Transaction;
use Illuminate\Database\Eloquent\Builder as EloquentBuilder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class TransactionController extends Controller
{

    public function index(Request $request) {
        if($request->user() ) {
            $user = $request->user()->id;
            
            $filters = $request->only('category', 'type');
        
            $availableCats = Category::where('user_id', $user)
                ->when($request->type, function (EloquentBuilder $query, string $type) {
                    $query->where('isIncome', $type);
                })
                ->get();

            $transactions = Transaction::where('user_id', $user)
                ->when($request->category, function (EloquentBuilder $query, string $category) {
                    $query->where('category_id', $category);
                })
                ->when($request->type, function (EloquentBuilder $query, string $type) {
                    $query->where('isIncome', $type);
                })
                ->orderBy('publish_date', 'DESC')
                ->paginate(10)
                ->withQueryString();

            $transactions->load(['category']);
            $transactions->getCollection()->transform(function ($value) {
                return $value;
            });
        }

        return Inertia::render('Transactions', 
        [
            'transactions' => Inertia::scroll(fn () => $transactions),
            'filters' => $filters,
            'availableCats' => $availableCats,
        ]);
    }

    public function store(Request $request) {
        // dd($request);

        $data = $request->validate([
            'name' => 'required',
            'sum' => 'required',
            'category_id' => '',
            'isIncome' => 'required',
            'publish_date' => '',
        ]);

        $user_id = Auth::user()->id;
        $data = $data + ['user_id' => $user_id];

        // dd($data);

        Transaction::create($data);
        return redirect()->back()->with(['message' => 'Операция добавлена!',]);
    }

    public function update(Request $request, Transaction $id) {
        // dd($id);

        $data = $request->validate([
            'name' => 'required',
            'sum' => 'required',
            'category_id' => '',
        ]);

        $id->update($data);
        return redirect()->back()->with(['message' => 'Изменения сохранены!',]);
    }

    public function destroy(Transaction $id) {
        // dd($id);
        $id->delete();
        return redirect()->back()->with(['message' => 'Операция удалена!',]);
    }
}
