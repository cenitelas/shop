<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductFormRequest;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    public function sortByCategory(string $view,Category $category)
    {
        $categories = Category::query()
            ->get();
        $products = Product::query()
            ->where('category_id',$category->id)
            ->latest()
            ->paginate(6);
        return view($view,[
            'categories'=>$categories,
            'products'=>$products,
            'sort'=>$category->name
        ]);
    }

    public function sortByPrice(string $view,string $type)
    {
        $categories = Category::query()
            ->get();
        $products = Product::query()
            ->orderBy('price',$type)
            ->latest()
            ->paginate(6);
        return view($view,[
            'categories'=>$categories,
            'products'=>$products
        ]);
    }

    public function search(Request $request)
    {
        $view = $request['view'];
        $search = $request['search'];
        $categories = Category::query()
            ->get();
        $products = Product::query()
            ->where('name','like','%' . $search . '%')
            ->latest()
            ->paginate(6);
        return view($view,[
            'categories'=>$categories,
            'products'=>$products,
            'search'=>$search
        ]);
    }

    public function index()
    {
//        $this->authorize('view-any', Products::class);
        $products = Product::query()
            ->latest()
            ->paginate(6);
        return view('products.index', [
            'products' => $products
        ]);
    }

    public function create()
    {
        $this->authorize('create', Product::class);
        if(auth()->user()->role->name!=="admin") {
            return redirect()->route('posts.index');
        }
        return view('products.form', [
            'categories' => Category::query()->get()
        ]);
    }

    public function store(ProductFormRequest $request)
    {
        $this->authorize('create', Product::class);

        $product = Product::query()->create($this->getData($request));

        return redirect()->route('products.show', $product);
    }

    public function show(Product $product)
    {
//        $this->authorize('view', $product);;
        return view('products.show', [
            'product' => $product
        ]);
    }

    public function edit(Product $product)
    {
        $this->authorize('update', $product);
        if(auth()->user()->role->name!=="admin") {
            return redirect()->route('posts.index');
        }
        return view('products.form', [
            'product' => $product,
            'categories' => Category::query()->get()
        ]);
    }

    public function addCart(Request $request)
    {
        $product = Product::all()
            ->where('id',$request['product_id'])
            ->first();
        return response()->json(['name' => $product->name], 200);
    }

    public function update(ProductFormRequest $request, Product $product)
    {
        $this->authorize('update', $product);
        $product->update($request->validated());
        return redirect()->route('products.show', $product);
    }

    public function destroy(Product $product)
    {
        $this->authorize('delete', $product);
        if(auth()->user()->role->name==="admin") {
            $product->delete();
        }
        return redirect()->route('home.index');
    }

    protected function uploadImage(ProductFormRequest $request){
        if(!$request->hasFile('image'))
            return null;

        return $request->file('image')->store('public/images');
    }

    protected function getData(ProductFormRequest $request){
        $data = $request->validated();
        $data['user_id'] = auth()->user()->id;
        $data['image_path'] = $this->uploadImage($request);
        unset($data['image']);
        return $data;
    }
}
