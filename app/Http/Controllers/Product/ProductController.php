<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\StoreProductRequest;
use App\Http\Requests\Product\UpdateProductRequest;
use App\Models\Category;
use App\Models\Product;
use App\Models\Unit;
use Exception;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Http\Request;
use Picqer\Barcode\BarcodeGeneratorHTML;
use Illuminate\Support\Str;

use Illuminate\Support\Facades\Storage;
class ProductController extends Controller
{
    public function index()
    {
        $products = Product::where("user_id", auth()->id())->count();

        return view('products.index', [
            'products' => $products,
        ]);
    }

    public function create(Request $request)
    {
        $categories = Category::where("user_id", auth()->id())->get(['id', 'name']);
        $units = Unit::where("user_id", auth()->id())->get(['id', 'name']);

        if ($request->has('category')) {
            $categories = Category::where("user_id", auth()->id())->whereSlug($request->get('category'))->get();
        }

        if ($request->has('unit')) {
            $units = Unit::where("user_id", auth()->id())->whereSlug($request->get('unit'))->get();
        }

        return view('products.create', [
            'categories' => $categories,
            'units' => $units,
        ]);
    }

    // public function store(StoreProductRequest $request)
    // {
    //     /**
    //      * Handle upload image
    //      */
    //     $image = "";
    //     if ($request->hasFile('product_image')) {
    //         $image = $request->file('product_image')->store('products', 'public');
    //     }

    //     Product::create([
    //         "code" => IdGenerator::generate([
    //             'table' => 'products',
    //             'field' => 'code',
    //             'length' => 4,
    //             'prefix' => 'PC'
    //         ]),

    //         'product_image'     => $image,
    //         'name'              => $request->name,
    //         'category_id'       => $request->category_id,
    //         'unit_id'           => $request->unit_id,
    //         'quantity'          => $request->quantity,
    //         'buying_price'      => $request->buying_price,
    //         'selling_price'     => $request->selling_price,
    //         'quantity_alert'    => $request->quantity_alert,
    //         'tax'               => $request->tax,
    //         'tax_type'          => $request->tax_type,
    //         'notes'             => $request->notes,
    //         "user_id" => auth()->id(),
    //         "slug" => Str::slug($request->name, '-'),
    //         "uuid" => Str::uuid()
    //     ]);


    //     return to_route('products.index')->with('success', 'Producto creado!');
    // }

    public function store(StoreProductRequest $request)
    {
        $image = "";
        if ($request->hasFile('product_image')) {
            $file = $request->file('product_image');
            $fileName = hexdec(uniqid()) . '.' . $file->getClientOriginalExtension();
            $path = 'public/products/';

            $file->storeAs($path, $fileName);
            $image = $fileName;
        }

        Product::create([
            "code" => IdGenerator::generate([
                'table' => 'products',
                'field' => 'code',
                'length' => 4,
                'prefix' => 'PC'
            ]),

            'product_image'     => $image,
            'name'              => $request->name,
            'category_id'       => $request->category_id,
            'unit_id'           => $request->unit_id,
            'quantity'          => $request->quantity,
            'buying_price'      => $request->buying_price,
            'selling_price'     => $request->selling_price,
            'quantity_alert'    => $request->quantity_alert,
            'tax'               => $request->tax,
            'tax_type'          => $request->tax_type,
            'notes'             => $request->notes,
            "user_id" => auth()->id(),
            "slug" => Str::slug($request->name, '-'),
            "uuid" => Str::uuid()
        ]);

        return to_route('products.index')->with('success', 'El producto ha sido creado!');
    }

    public function show($uuid)
    {
        $product = Product::where("uuid", $uuid)->firstOrFail();
        // Generate a barcode
        $generator = new BarcodeGeneratorHTML();

        $barcode = $generator->getBarcode($product->code, $generator::TYPE_CODE_128);

        return view('products.show', [
            'product' => $product,
            'barcode' => $barcode,
        ]);
    }

    public function edit($uuid)
    {
        $product = Product::where("uuid", $uuid)->firstOrFail();
        return view('products.edit', [
            'categories' => Category::where("user_id", auth()->id())->get(),
            'units' => Unit::where("user_id", auth()->id())->get(),
            'product' => $product
        ]);
    }

    // public function update(UpdateProductRequest $request, $uuid)
    // {
    //     $product = Product::where("uuid", $uuid)->firstOrFail();
    //     $product->update($request->except('product_image'));

    //     $image = $product->product_image;
    //     if ($request->hasFile('product_image')) {

    //         // Delete Old Photo
    //         if ($product->product_image) {
    //             unlink(public_path('storage/') . $product->product_image);
    //         }
    //         $image = $request->file('product_image')->store('products', 'public');
    //     }

    //     $product->name = $request->name;
    //     $product->slug = Str::slug($request->name, '-');
    //     $product->category_id = $request->category_id;
    //     $product->unit_id = $request->unit_id;
    //     $product->quantity = $request->quantity;
    //     $product->buying_price = $request->buying_price;
    //     $product->selling_price = $request->selling_price;
    //     $product->quantity_alert = $request->quantity_alert;
    //     $product->tax = $request->tax;
    //     $product->tax_type = $request->tax_type;
    //     $product->notes = $request->notes;
    //     $product->product_image = $image;
    //     $product->save();


    //     return redirect()
    //         ->route('products.index')
    //         ->with('success', 'El producto ha sido actualizado!');
    // }
    public function update(UpdateProductRequest $request, $uuid)
    {
        $product = Product::where("uuid", $uuid)->firstOrFail();
        $product->update($request->except('product_image'));

        if ($file = $request->file('product_image')) {
            $fileName = hexdec(uniqid()) . '.' . $file->getClientOriginalExtension();
            $path = 'public/products/';

            // Delete Old Photo
            if ($product->product_image) {
                Storage::delete($path . $product->product_image);
            }

            $file->storeAs($path, $fileName);
            $product->product_image = $fileName;
        }

        $product->name = $request->name;
        $product->slug = Str::slug($request->name, '-');
        $product->category_id = $request->category_id;
        $product->unit_id = $request->unit_id;
        $product->quantity = $request->quantity;
        $product->buying_price = $request->buying_price;
        $product->selling_price = $request->selling_price;
        $product->quantity_alert = $request->quantity_alert;
        $product->tax = $request->tax;
        $product->tax_type = $request->tax_type;
        $product->notes = $request->notes;
        $product->save();

        return redirect()
            ->route('products.index')
            ->with('success', 'El producto ha sido actualizado!');
    }

    public function destroy($uuid)
    {
        try{
        $product = Product::where("uuid", $uuid)->firstOrFail();
        /**
         * Delete photo if exists.
         */
        if ($product->product_image) {
            // check if image exists in our file system
            if (file_exists(public_path('storage/') . $product->product_image)) {
                unlink(public_path('storage/') . $product->product_image);
            }
        }

        $product->delete();

        return redirect()
            ->route('products.index')
            ->with('success', 'El producto ha sido eliminado!');
        } catch (Exception $e) {
            return redirect()
                ->back()
                ->with('success', 'No se ha podido eliminar porque cuenta con datos asociados!');
        }
    }
}
