<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Slider;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FrontendController extends Controller
{
    public function index()
    {
        $sliders = Slider::where('status', '0')->get();
        $trendingProducts = Product::where('trending', '1')->latest()->take(15)->get();
        $newArrivalProducts = Product::latest()->take(14)->get();
        $featuredProducts = Product::where('featured', '1')->latest()->take(14)->get();

        return view('frontend.index', compact(['sliders', 'trendingProducts', 'newArrivalProducts', 'featuredProducts']));
    }

    public function searchProducts(Request $request){
        if($request->search){
            $searchProducts = Product::where('name', 'LIKE', '%' . $request->search. '%')->latest()->paginate(10);

            return view('frontend.pages.search', compact('searchProducts'));
        }else{
            session()->flash('message', 'Empty Search');

            return redirect()->back();
        }
    }

    public function newArrival()
    {
        $newArrivalProducts = Product::latest()->take(15)->get();

        return view('frontend.pages.new-arrival', compact('newArrivalProducts'));
    }

    public function featuredProducts()
    {
        $featuredProducts = Product::where('featured', '1')->latest()->get();

        return view('frontend.pages.featured-products', compact('featuredProducts'));
    }

    public function categories()
    {

        $categories = Category::where('status', '0')->get();

        return view('frontend.collections.category.index', compact('categories'));
    }

    public function product($category_slug)
    {
        $category = Category::where('slug', $category_slug)->first();

        if ($category) {
            $products = $category->products()->get();

            return view('frontend.collections.product.index', compact(['products', 'category']));
        } else {
            return redirect()->back();
        }

    }

    public function productView($category_slug, $product_slug)
    {
        // dd($category_slug, $product_slug);

        $category = Category::where('slug', $category_slug)->first();
        if ($category) {
            $product = $category->products()->where('slug', $product_slug)->first();
            if ($product) {
                return view('frontend.collections.product.view', compact(['product', 'category']));
            } else {
                return redirect()->back();
            }
        } else {
            return redirect()->back();
        }
    }

    public function thankYou()
    {
        return view('frontend.thank-you');
    }
}