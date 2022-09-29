<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\SubCategory;
use App\Models\SubImage;
use App\Models\Unit;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    private $categories;
    private $subCategories;
    private $brands;
    private $units;
    private $product;
    private $products;
    public function index()
    {
        $this->categories     = Category::all();
        $this->subCategories  = SubCategory::all();
        $this->brands         = Brand::all();
        $this->units          = Unit::all();
        return view('admin.product.index',[
            'categories'      => $this->categories,
            'subCategories'   => $this->subCategories,
            'brands'          => $this->brands,
            'units'           => $this->units,
        ]);
    }

    public function getSubCategory()
    {
        $categoryId = $_GET['id'];
        $subCategories = SubCategory::where('category_id', $categoryId)->get();
        return response()->json($subCategories);
    }

    public function create(Request $request)
    {
        $request->validate([
            'category_id'       => 'required',
            'sub_category_id'   => 'required',
            'brand_id'          => 'required',
            'unit_id'           => 'required',
            'name'              => 'required|unique:products,name',
            'code'              => 'required|unique:products,code',
            'regular_price'     => 'required',
            'selling_price'     => 'required',
            'stock_amount'      => 'required',
            'image'             => 'required|image',

        ]);
        $this->product = Product::newProduct($request);
        SubImage::newSubImage($this->product, $request->file('sub_image'));
        return redirect()->back()->with('message', 'Product Info Create Successfully');
    }

    public function manage()
    {
        $this->products = Product::all();

        return view('admin.product.manage', ['products' => $this->products]);
    }

    public function detail($id)
    {
        $this->product = Product::find($id);
        return view('admin.product.detail',['product' => $this->product]);
    }

    public function edit($id)
    {
        $this->product = Product::find($id);
        $this->categories     = Category::all();
        $this->subCategories  = SubCategory::all();
        $this->brands         = Brand::all();
        $this->units          = Unit::all();
        return view('admin.product.edit', [
            'product' => $this->product,
            'categories'      => $this->categories,
            'subCategories'   => $this->subCategories,
            'brands'          => $this->brands,
            'units'           => $this->units,
        ]);
    }

    public function update(Request $request, $id)
    {
        $this->product = Product::updateProduct($request, $id);
        if($request->file('sub_image'))
        {
            SubImage::updateSubImage($this->product, $request->file('sub_image'));
        }
        return redirect('/manage-product')->with('message', 'product update successfully');

    }

    public function delete($id)
    {
        Product::deleteProduct($id);
        return redirect()->back()->with('message', 'Product delete successfully');
    }
}
