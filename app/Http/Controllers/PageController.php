<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;

class PageController extends Controller
{
    public function home(): View
    {
        return view('pages.home', [
            'projects' => config('site.projects'),
            'products' => config('site.products'),
        ]);
    }

    public function services(): View
    {
        return view('pages.services', [
            'products' => config('site.products'),
            'categories' => config('site.categories'),
        ]);
    }

    public function product(string $slug): View
    {
        $product = config("site.products.{$slug}");

        abort_if($product === null, 404);

        return view('pages.product', [
            'slug' => $slug,
            'product' => $product,
            'categoryName' => config("site.categories.{$product['category']}"),
        ]);
    }

    public function about(): View
    {
        return view('pages.about');
    }
}
