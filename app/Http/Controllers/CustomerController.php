<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\DetailCustomer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index(){
        return view('customer.index');
    }

    public function store(Request $request){
        $data = $request->all();
        // dd($data);

        $customer = new Customer;
        $customer->name = $data['name'];
        $customer->email = $data['email'];
        $customer->save();

        // $detailcustomer = new DetailCustomer;
        // $detailcustomer->user_id = $customer->id;
        // $detailcustomer->legende = $data['legende'];
        // $detailcustomer->phone = $data['phone'];
        // $detailcustomer->code_postale = $data['code_postale'];
        // $detailcustomer->save();

        if(count($data['legende']) > 0){
            foreach($data['legende'] as $item => $value){
                $data2 =array(
                    'user_id' => $customer->id,
                    'legende' => $data['legende'][$item],
                    'phone' => $data['phone'][$item],
                    'code_postale' => $data['code_postale'][$item],
                );
                DetailCustomer::create($data2);
            }
        }

        return redirect()->back()->with('status','Data Inserted successffuly');
    }
}
