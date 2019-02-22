<?php

namespace App\Http\Controllers;

use App\City;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CityController extends Controller
{
    public function index(){
        $cities = City::all();
        return view('cities.list', compact('cities'));

    }
    public function create(){
        return view('cities.create');
    }
    public function store(Request $request){
        $city = new City();
        $city->name = $request->input('name');
        $city->save();
        return redirect()->route('cities.index');
    }
    public function edit($id){
        $city = City::findOrFail($id);
        return view('cities.edit', compact('city'));
    }
    public function update(Request $request, $id){
        $city = City::findOrFail($id);
        $city->name = $request->input('name');
        $city->save();
        Session::flash('success', 'Cap nhat thanh cong');
        return redirect()->route('cities.index');

}
    public function destroy($id){
        $city = City::findOrFail($id);
        $city->delete();
        Session::flash('success', 'Xoa thanh cong');
        return redirect()->route('cities.index');
    }

}
