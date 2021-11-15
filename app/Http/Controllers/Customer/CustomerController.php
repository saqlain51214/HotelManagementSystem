<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\Customer;
use App\Country;
use App\State;
use App\City;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CustomerController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */

    public function index(Request $request)
    {
        $model = str_slug('customer','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $keyword = $request->get('search');
            $perPage = 25;

            if (!empty($keyword)) {
                $customer = Customer::where('first_name', 'LIKE', "%$keyword%")
                ->orWhere('last_name', 'LIKE', "%$keyword%")
                ->orWhere('father_name', 'LIKE', "%$keyword%")
                ->orWhere('customer_type', 'LIKE', "%$keyword%")
                ->orWhere('country', 'LIKE', "%$keyword%")
                ->orWhere('province', 'LIKE', "%$keyword%")
                ->orWhere('city', 'LIKE', "%$keyword%")
                ->orWhere('phone_number', 'LIKE', "%$keyword%")
                ->orWhere('cell_number', 'LIKE', "%$keyword%")
                ->orWhere('cnic', 'LIKE', "%$keyword%")
                ->orWhere('passport', 'LIKE', "%$keyword%")
                ->orWhere('cnic_or_passport_expiry_date', 'LIKE', "%$keyword%")
                ->orWhere('address', 'LIKE', "%$keyword%")
                ->orWhere('customer_status', 'LIKE', "%$keyword%")
                ->orWhere('tour_reason', 'LIKE', "%$keyword%")
                ->orWhere('next_destination', 'LIKE', "%$keyword%")
                ->paginate($perPage);
            } else {
                $customer = Customer::paginate($perPage);
            }

            return view('customer.customer.index', compact('customer'));
        }
        return response(view('403'), 403);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $model = str_slug('customer','-');
        $countries = Country::all();
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            return view('customer.customer.create',compact('countries'));
        }
        return response(view('403'), 403);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
       
        $model = str_slug('customer','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            
            $requestData = $request->all();
            
            Customer::create($requestData);
            Session::flash('message','Customer has been added');
            return redirect('customer/customer')->with('flash_message', 'Customer added!');
        }
        return response(view('403'), 403);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $model = str_slug('customer','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $customer = Customer::findOrFail($id);
            return view('customer.customer.show', compact('customer'));
        }
        return response(view('403'), 403);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $action = 'EDIT';
        $countries = Country::all();
        $model = str_slug('customer','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            $customer = Customer::findOrFail($id);
            return view('customer.customer.edit', compact('customer','countries','action'));
        }
        return response(view('403'), 403);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {
        dd($request);
       
        $model = str_slug('customer','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            
            $requestData = $request->all();
            
            $customer = Customer::findOrFail($id);
             $customer->update($requestData);

             return redirect('customer/customer')->with('flash_message', 'Customer updated!');
        }
        return response(view('403'), 403);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        $model = str_slug('customer','-');
        if(auth()->user()->permissions()->where('name','=','delete-'.$model)->first()!= null) {
            Customer::destroy($id);

            return redirect('customer/customer')->with('flash_message', 'Customer deleted!');
        }
        return response(view('403'), 403);

    }

    
    // by saqlain raza

    
    public function getState($country_id=null){
        if($country_id == null){
            Session::flash('message','Something went wrong! Please refresh the page');
        }else{
            $states = State::where('country_id',$country_id)->get();
            echo $states;
        }
    }

    public function getCitie($state_id=null){
     
        if($state_id == null){
            Session::flash('message','Something went wrong! Please refresh the page');
        }else{
            $states = City::where('state_id',$state_id)->get();
            dd($states);
            echo $states;
        }
    }
}
