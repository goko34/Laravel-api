<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
// use App\Http\Requests\Products\StoreRequest;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $products = Product::all();

            return response()->json([
                'status' => 'success',
                'products' => $products,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $data = $request->validate([
                "name" => "required",
                "price" => "required|numeric",
                "description" => "required|nullable",
            ], [
                "name.required" => "Ürün adını boş bırakmayınız",
                "price.required" => "Fiyat bilgisini boş bırakmayınız",
                "price.numeric" => "Fiyat kısmına sadece sayı giriniz",
                "description.required" => "Açıklama kısmını boş bırakmayınız",
            ]);

            $product = Product::create($data);

            return response()->json([
                'status' => 'success',
                'message' => 'Product created successfully',
                'product' => $product,
            ], 201);
        } catch (ValidationException $e) {
            return response()->json([
                'status' => 'error',
                'errors' => $e->errors(),
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    public function show($id)
    {
        try {
            $product = Product::find($id);
            if ($product) {
                return response()->json([
                    'status' => 'success',
                    'product' => $product,
                ]);
            } else {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Product not found',
                ], 404);
            }
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try
        {
            $request->validate([
                "name" => "required",
                "price" => "required|numeric",
                "description" => "required|nullable",
            ], [
                "name.required" => "Ürün adını boş bırakmayınız",
                "price.required" => "Fiyat bilgisini boş bırakmayınız",
                "price.numeric" => "Fiyat kısmına sadece sayı giriniz",
                "description.required" => "Açıklama kısmını boş bırakmayınız",
            ]);

            $product = Product::find($id);
            if ($product) {
                $product->update($request->all());
                return response()->json([
                    'status' => 'success',
                    'message' => 'Product updated successfully',
                    'product' => $product,
                ]);
            } else {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Product not found',
                ], 404);
            }
        }
        catch (ValidationException $e) {
            return response()->json([
                'status' => 'error',
                'errors' => $e->errors(),
            ], 422);
        }
            catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Product::destroy($id);
        return response()->json([
            'id' => $id,
            'status' =>'success',
            'message' => 'Product deleted successfully'
        ], 200);
    }
}
