<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\Customer;
use DB;
use Exception;
use Illuminate\Support\Facades\Validator;
class CustomerController extends Controller
{
    public function index(){
        $customers = Customer::get();
        return view('modules.manufacturing.customer', [
            'customers' => $customers,
        ]);
    }
    public function store(Request $request)
    {
        $validation = $request->validate([
            'customer_lname' => 'required|max:30',
            'customer_fname' => 'required|max:30',
            'branch_name' => 'required|max:50',
            'contact_number' => 'required|numeric',
            'email_address' => 'required|unique:man_customers,email_address',
            'address' => 'required',
            'company_name' => 'required|alpha_dash',
        ]);

        try {
            $form_data = $request->input();
            $data = \App\Models\Customer::create($form_data);
            return response($data);
        } catch (Exception $e) {
            return $e;
        }
    }

    public function update(Request $request, $id)
    {
        $validation = $request->validate([
            'customer_lname' => 'required|max:30',
            'customer_fname' => 'required|max:30',
            'branch_name' => 'required|max:50',
            'contact_number' => 'required|numeric',
            'address' => 'required',
            'company_name' => 'required|alpha_dash',
        ]);

        try {
            $customer = Customer::where('id', $id)->first();
            $customer->customer_lname = $request->input('customer_lname');
            $customer->customer_fname = $request->input('customer_fname');
            $customer->branch_name = $request->input('branch_name');
            $customer->contact_number = $request->input('contact_number');
            $customer->address = $request->input('address');
            $customer->company_name = $request->input('company_name');
            $customer->save();
            return response($customer);
        } catch (Exception $e) {
            return response('There was an error upon updating!');
        }
    }
}
