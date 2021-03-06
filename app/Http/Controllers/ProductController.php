<?php

namespace App\Http\Controllers;

use App\Brand;
use App\Category;
use App\Inventory;
use App\Product;
use App\Supplier;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function __construct()
    {
        return $this->middleware('roles:1')->only(['index']);
    }
    //Vistas
    public function index()
    {
        $products = Product::all();
        return view('admin.product.index', compact('products'));
    }
    public function create()
    {
        $product = new Product();
        $brands = Brand::all(); //Todos las marcas
        $suppliers = Supplier::all(); //Todos los proveedores
        $categories = Category::all(); //Todas las categorias
        return view('admin.product.create', compact('product', 'brands', 'suppliers', 'categories'));
    }

    public function store(Request $request)
    {
        $data = Request()->validate([
            'name' => 'required',
            'description' => 'required',
            'purchase_price' => 'required',
            'sale_price' => 'required',
            'discount' => 'required',
            'quanty' => 'required',
            'model' => 'required',
            'brand_id' => 'required',
            'supplier_id' => 'required',
            'category_id' => 'required'
        ]);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('productos', 'public');
        }

        $newProduct = Product::create($data);
        //Inserto al inventario el producto
        Inventory::create([
            "stock" => $data['quanty'],
            "status" => 1,
            "product_id" => $newProduct->id
        ]);
        return redirect()->route('product.create')->with('success', 'Agregado exitosamente!!');
    }

    public function edit(Product $product)
    {
        $brands = Brand::all(); //Todos las marcas
        $suppliers = Supplier::all(); //Todos los proveedores
        $categories = Category::all(); //Todas las categorias
        return view('admin.product.edit', compact('product', 'brands', 'suppliers', 'categories'));
    }
    public function update(Request $request, Product $product)
    {
        $data = Request()->validate([
            'name' => 'required',
            'description' => 'required',
            'purchase_price' => 'required',
            'sale_price' => 'required',
            'discount' => 'required',
            'model' => 'required',
            'brand_id' => 'required',
            'supplier_id' => 'required',
            'category_id' => 'required'
        ]);
        if ($request->hasFile('image')) {
            Storage::delete('public/' . $product['image']);
            $data['image'] = $request->file('image')->store('productos', 'public');
        }
        $product->update($data);
        return redirect()->route('product.index')->with('success', 'Producto actualizado exitosamente!!');
    }
    /* vista nosotros*/
    public function nosotros()
    {

        return view('nosotros');
    }
    /* vista politicas*/

    public function politicas()
    {

        return view('politicas.politicas');
    }
    /* vista condiciones*/

    public function condiciones()
    {

        return view('politicas.condiciones');
    }
    /* vista condiciones*/

    public function como_comprar()
    {

        return view('politicas.como_comprar');
    }
    public function destroy(Product $product)
    {
        Storage::delete('public/' . $product['image']);
        $product->delete();
        return redirect()->route('product.index')->with('success', 'Producto eliminado!');
    }


    public function show_products($category = null)
    {

        if (!empty($category)) {
            $cate = Category::where('name', $category)->get();
            $products = Product::where('category_id', $cate[0]->id)->paginate(8);
            $categories = Category::all();
            return view('products', compact('products', 'categories'));
        } else {
            $products = Product::paginate(8);
            $categories = Category::all();
            return view('products', compact('products', 'categories'));
        }
    }
    public function show_product(Product $product = null)
    { //Routing model binding

        return view('show-product', compact('product'));
    }
}
