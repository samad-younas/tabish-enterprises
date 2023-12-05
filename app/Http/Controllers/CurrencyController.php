<?php

namespace App\Http\Controllers;

use App\Models\Currency;
use App\Models\Purchase;
use App\Models\Sale;
use Illuminate\Http\Request;
use Carbon\Carbon;

class CurrencyController extends Controller
{
    public function index(){
        return view('currency.index');
    }
    public function saleIndex(){
        return view('sale.index');
    }
    public function purchaseIndex(){
        return view('purchase.index');
    }
    public function saveOrUpdateSale(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'cnic' => 'required',
            'amount' => 'required',
            'sale_price' => 'required',
            'currency' => 'required',
            'total' => 'required',
        ]);
        $sale = Sale::findOrNew($request->id);
        $sale->name = $request->name;
        $sale->cnic = $request->cnic;
        $sale->sale_price = $request->sale_price;
        $sale->purchase_price = $request->currency['purchase_price'];
        $sale->currency = $request->currency['currency_name'];
        $sale->currency_id = $request->currency['id'];
        $sale->amount = $request->amount;
        $sale->total = $request->total;
        $sale->save();
        $action = (isset($request->id) ? 'updated' : 'created');
        return response()->json(['success' => true, 'message' => "Sale $action successfully"], $request->id ? 200 : 201);
    }
    public function saveOrUpdatePurchase(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'cnic' => 'required',
            'amount' => 'required',
            'sale_price' => 'required',
            'currency' => 'required',
            'total' => 'required',
        ]);
        $sale = Purchase::findOrNew($request->id);
        $sale->name = $request->name;
        $sale->cnic = $request->cnic;
        $sale->sale_price = $request->sale_price;
        $sale->purchase_price = $request->currency['purchase_price'];
        $sale->currency = $request->currency['currency_name'];
        $sale->currency_id = $request->currency['id'];
        $sale->amount = $request->amount;
        $sale->total = $request->total;
        $sale->save();
        $action = (isset($request->id) ? 'updated' : 'created');
        return response()->json(['success' => true, 'message' => "Purchase $action successfully"], $request->id ? 200 : 201);
    }
    public function saveOrUpdateCurrency(Request $request)
    {
        $request->validate([
            'currency_name' => 'required|string',
            'sale_price' => 'required|numeric',
            'purchase_price' => 'required|numeric',
        ]);
        $currency = Currency::findOrNew($request->id);
        $currency->currency_name = $request->currency_name;
        $currency->sale_price = $request->sale_price;
        $currency->purchase_price = $request->purchase_price;
        $currency->save();
        $action = (isset($request->id) ? 'updated' : 'created');
        return response()->json(['success' => true, 'message' => "Currency $action successfully"], $request->id ? 200 : 201);
    }
    public function getCurrency(){
        return Currency::all();
    }
    public function getSale(){
        return Sale::with('Currency')->get();
    }
    public function getPurchase(){
        return Purchase::with('Currency')->get();
    }
    public function getSaleSearch(Request $request){
        list($startDate, $endDate) = explode(' - ', $request->date);
        $startTimestamp = Carbon::createFromFormat('m/d/Y', $startDate)->startOfDay();
        $endTimestamp = Carbon::createFromFormat('m/d/Y', $endDate)->endOfDay();
        $results = Sale::whereBetween('created_at', [$startTimestamp, $endTimestamp])->with('Currency')->get();
        return $results;
    }
    public function getPurchaseSearch(Request $request){
        list($startDate, $endDate) = explode(' - ', $request->date);
        $startTimestamp = Carbon::createFromFormat('m/d/Y', $startDate)->startOfDay();
        $endTimestamp = Carbon::createFromFormat('m/d/Y', $endDate)->endOfDay();
        $results = Purchase::whereBetween('created_at', [$startTimestamp, $endTimestamp])->with('Currency')->get();
        return $results;
    }
    public function deleteCurrency($id){
        $currency = Currency::find($id);
        if($currency){
            $currency->delete();
            return response()->json([
                'success' => true,
            ]);
        }else{
            return response()->json([
                'success' => true,
            ]);
        }
    }
    public function deletePurchase($id){
        $purchase = Purchase::find($id);
        if($purchase){
            $purchase->delete();
            return response()->json([
                'success' => true,
            ]);
        }else{
            return response()->json([
                'success' => true,
            ]);
        }
    }
    public function deleteSale($id){
        $sale = Sale::find($id);
        if($sale){
            $sale->delete();
            return response()->json([
                'success' => true,
            ]);
        }else{
            return response()->json([
                'success' => true,
            ]);
        }
    }
}
