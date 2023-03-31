<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Client;
use App\Models\Doctor;
use App\Models\Medicine;
use App\Models\Order;
use App\Models\OrderMedicine;
use App\Models\Pharmacy;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;

class OrderController extends Controller
{
    //
    public function index(Request $request){
        if(Auth::user()->hasrole('admin')){
            $data = Order::latest()->get();
        }
        else if(Auth::user()->hasrole('pharmacy')){
            $data = Order::where('assigned_pharmacy_id', Auth::user()->userable_id)->get();
        }
       if ($request->ajax()) {
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row) {
                    $actionBtn = '<a href="/orders/'.$row->id.'/edit" class="edit btn btn-success btn-sm">Process</a> <button type="button" class="delete btn btn-danger" data-bs-toggle="modal"
                    data-bs-target="#exampleModal" id="'.$row->id.'">DELETE </button>';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
       }
        
        return view('dashboard.order.index');
    }

    public function create(){
        $user = Auth::user();
        $pharmacies = Pharmacy::all();
        $clients = Client::all();
        $addresses=Address::all();
        $medicines=Medicine::all();
        if($user->hasRole('pharmacy'))
        {
            $doctors=Doctor::where('pharmacy_id', $user->userable_id)->get();
        }
        if($user->hasRole('admin'))
        {
            $doctors=Doctor::all();
        }
       
        return view('dashboard.order.create', ['pharmacies' => $pharmacies,'clients'=>$clients,'addresses'=>$addresses,'medicines'=>$medicines,'doctors'=>$doctors]);
    }
    
    public function store(Request $request){

        $user = Auth::user();
        $creator_type=$request->creator_type;
        $doctor = null;
        $status = 'Processing';
        $assigned_pharmacy=$request->assigned_pharmacy_id;
        if ($user->hasRole('doctor')) {
            $doctor = Doctor::find($user->userable_id);
            $creator_type = 'doctor';
            $assigned_pharmacy = Pharmacy::find($doctor->pharmacy_id);
            $doctor = $doctor->id;
        } elseif ($user->hasRole('pharmacy')) {
            $creator_type = 'pharmacy';
            $assigned_pharmacy = Pharmacy::find($user->userable_id);
        } 
       $newOrder= Order::create([
            'client_id' => $request->client_id,
            'client_address_id' => $request->client_address_id,
            'assigned_pharmacy_id' => $assigned_pharmacy,
            'doctor_id'=>$request->doctor_id,
            'status'=>$request->status,
            'is_insured'=>$request->is_insured,
            'creator_type'=>$creator_type,
            'total_price'=>$request->total_price,
            // 'medicine_id' => $request->medicine_id,
        ]);
        // $order_medicines=OrderMedicine::create();
        
        foreach ($request->medicine_id as $key => $medicine_id) {
            $newOrder->orderMedicine()->create([
                'medicine_id' => $medicine_id,
                'quantity' => 1,
             ]);
        }

        return to_route('order.index'); 
        
    }
}