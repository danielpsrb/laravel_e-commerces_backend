<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    // Get all stores
    public function index()
    {
        $stores = User::where('roles', 'seller')->get();
        return response()->json([
            'status' => 'success',
            'message' => 'List Store',
            'data' => $stores,
        ]);
    }

    //Product by store
    public function productByStore($id)
    {
        $products = Product::where('seller_id', $id)->get();

        return response()->json([
            'status' => 'success',
            'message' => 'List Product By Store',
            'data' => $products,
        ]);
    }

    // Get store is live streaming
    public function liveStreaming()
    {
        $stores = User::where('roles', 'seller')->where('is_live_streaming', 1)->get();
        return response()->json([
            'status' => 'success',
            'message' => 'List Store Live Streaming',
            'data' => $stores,
        ]);
    }
}
