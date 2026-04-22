<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder as EloquentBuilder;

class CategoryController extends Controller
{

    public function index(Request $request) {
        if($request->user() ) {
            $user = $request->user()->id;
            
            $incomeCats = Category::where('user_id', $user)
                ->where('isIncome', '1')
                ->get();

            $expenceCats = Category::where('user_id', $user)
                ->where('isIncome', '0')
                ->get();
        }

        return Inertia::render('Profile/Categories', 
        [
            'incomeCats' => $incomeCats,
            'expenceCats' => $expenceCats,
        ]);
    }

    public function store(Request $request) {
        // dd($request);

        $data = $request->validate([
            'title' => 'required',
            'icon' => 'required',
            'isIncome' => 'required',
        ]);

        $user_id = Auth::user()->id;
        $data = $data + ['user_id' => $user_id];

        // dd($data);

        Category::create($data);
        return redirect()->back()->with(['message' => 'Категория добавлена!',]);
    }

    public function update(Request $request, Category $id) {
        // dd($id);

        $data = $request->validate([
            'title' => 'required',
            'icon' => 'required',
        ]);

        $id->update($data);
        return redirect()->back()->with(['message' => 'Изменения сохранены!',]);
    }

    public function destroy(Category $id) {
        // dd($id);
        $id->delete();
        return redirect()->back()->with(['message' => 'Категория удалена!',]);
    }

}
