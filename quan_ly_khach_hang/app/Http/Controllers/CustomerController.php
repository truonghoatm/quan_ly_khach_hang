<?php

namespace App\Http\Controllers;

use App\City;
use App\Customer;
use App\Http\Requests\StoreCustomerRequest;
use Faker\Provider\sr_Cyrl_RS\Person;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CustomerController extends Controller
{
    public function index(){
        $customers = Customer::all();
        $cities = City::all();
        return view('customers.list',compact('customers', 'cities'));
    }
    public function create(){
        $cities = City::all();
        return view('customers.create',compact('cities'));
    }
    public function store(StoreCustomerRequest $request){
        $customer = new Customer();
        $customer->name = $request->input('name');
        $customer->email = $request->input('email');
        $customer->dob = $request->input('dob');
        $customer->city_id = $request->input('city_id');
        $customer->save();
        Session::flash('success', 'Tao moi khach hang thanh cong');
        return redirect()->route('customers.index');
    }
//    public function checkValidation(StoreCustomerRequest $request){
//        $success = "Du lieu luu thanh cong";
//        return view('customers.create',compact('success'));

//    }
    public function edit($id){
        $customer = Customer::findOrFail($id);
        $cities = City::all();
        return view('customers.edit', compact('customer', 'cities'));
    }
    public function update(Request $request, $id){
        $customer = Customer::findOrFail($id);
        $customer->name = $request->input('name');
        $customer->email = $request->input('email');
        $customer->dob = $request->input('dob');
        $customer->city_id =$request->input('city_id');
        $customer->save();
        Session::flash('success', 'Cap nhat khach hang thanh cong');
        return redirect()->route('customers.index');

    }
    public function destroy($id){
        $customer = Customer::findOrFail($id);
        $customer->delete();
        return redirect()->route('customers.index');
    }
    public function filterByCity(Request $request){
        $idCity = $request->input('city_id');
        $cityFilter = City::findOrFail($idCity);
        $customers = Customer::where('city_id', $cityFilter->id)->get();
        $totalCustomerFilter = count($customers);
        $cities = City::all();
        return view('customers.list', compact('totalCustomerFilter', 'cities', 'customers', 'cityFilter'));
    }
}
