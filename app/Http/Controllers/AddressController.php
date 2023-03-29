<?php

namespace App\Http\Controllers;
use App\Models\Address;
use App\Models\Area;
use App\Models\Client;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class AddressController extends Controller
{
    public function index(Request $request){
        if ($request->ajax()) {
            $data = Address::latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $actionBtn = '<a id="$row->id" class="btn btn-primary" href="' . route('address.edit', $row->id) . '">Edit</a>  <button type="button" class="delete btn btn-danger" data-bs-toggle="modal"
                    data-bs-target="#exampleModal" id="'.$row->id.'">DELETE </button>';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('dashboard.address.index');
    }
    public function create(){
        $areas = Area::all();
        $clients = Client::all();
        return view('dashboard.address.create', ['areas'=> $areas, 'clients'=> $clients]);
    }
    public function store(){
        Address::create([
            'area_id' => request()->area_id,
            'street_name' => request()->street_name,
            'building_number' => request()->building_number,
            'floor_number' => request()->floor_number,
            'flat_number' => request()->flat_number,
            'is_main'   => request()->is_main,
            'client_id' => request()->client_id,
        ]);
        return to_route('address.index');
    }
    public function edit($id){
        $areas = Area::all();
        $clients = Client::all();
        $address= Address::find($id);
        return view('dashboard.address.edit',['address' => $address, 'areas'=> $areas, 'clients'=> $clients]);
    }
    public function update($id){
        $address = Address::find($id);
        $this->updateArea($address);
        return redirect()->route('address.index');
    }
    public function destroy($id){
        $address = Address::find($id);
        $address->delete();
        return redirect()->route('address.index');
    }
    private function updateArea($address) {

        $address->area_id = request()->area_id;
        $address->street_name = request()->street_name;
        $address->building_number = request()->building_number;
        $address->floor_number = request()->floor_number;
        $address->flat_number = request()->flat_number;
        $address->is_main = request()->is_main;
        $address->client_id = request()->client_id;
        $address->save();
    }

}
