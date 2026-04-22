<?php

namespace App\Http\Middleware;

use App\Models\Category;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Middleware;
use Tighten\Ziggy\Ziggy;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that is loaded on the first page visit.
     *
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determine the current asset version.
     */
    public function version(Request $request): ?string
    {
        return parent::version($request);
    }

    /**
     * Define the props that are shared by default.
     *
     * @return array<string, mixed>
     */
    public function share(Request $request): array
    {

        if ($request->user()) {
            $categoryIncome = User::find($request->user()->id)->categories->diff(Category::whereIn('isIncome', [0])->get());
            $categoryExpence = User::find($request->user()->id)->categories->diff(Category::whereIn('isIncome', [1])->get());
        } else {
            $categoryIncome = '';
            $categoryExpence = '';
        }

        return [
            ...parent::share($request),
            'auth' => [
                'user' => $request->user(),
                'categoryIncome' => $categoryIncome,
                'categoryExpence' =>  $categoryExpence
            ],
            'ziggy' => fn () => [
                ...(new Ziggy)->toArray(),
                'location' => $request->url(),
            ],
            'flash' => [
                'message' => fn () => $request->session()->get('message'),
            ],
        ];
    }
}
