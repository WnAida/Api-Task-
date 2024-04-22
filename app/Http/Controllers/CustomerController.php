<?php

namespace App\Http\Controllers;

use App\Http\Requests\Customer_REQ;
use App\Http\Requests\Customer_Update_REQ;
use App\Http\Resources\Customer_RES;
use App\Models\Customer;
use App\Traits\ApiPaginatorTrait;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;

class CustomerController extends Controller
{
    use ApiPaginatorTrait;

    //store customer info
    public function store(Customer_REQ $request)
    {
        $validated = $request->validated();
        Log:: info("step1");
        $customer=new Customer;
        //Log:: info("step2");
        $data =$customer->create($validated);
        return $this->return_api(true, Response::HTTP_OK, null, new Customer_RES($data), null);
    }

    //update customer info
    public function update(Customer_Update_REQ $request, Customer $customer)
    {
        $validated = $request->validated();
        $id = Customer::find($customer)->first();
        $customer=$id->update($validated);
        return $this->return_api(true, Response::HTTP_OK, null, null, null);
    }

    //update customer list && can search by name
    public function customerlist(){
        $take = request()->get('take', 5);

        $search = request()->get('search', '');
        $customer = Customer::query();
        if ($search != '') {
            $data = $customer->where(function ($query) use ($search) {
                $query->where('name', 'LIKE', '%' . $search . '%');
            });
        }
        $data = $customer->paginate($take);
        return $this->return_paginated_api(true, Response::HTTP_OK, null, Customer_RES::collection($data), null, $this->apiPaginator($data));
    }

    //show customer detail (by id)
    public function showdetail(Customer $customer){
        $data = Customer::find($customer->id);
        dd($data);
        return $this->return_api(true, Response::HTTP_OK, null, new Customer_RES($data), null);
    }

    //delete customer detail
    public function delete(Customer $customer){
        $data = Customer::find($customer->id);
        $data->delete();
        return $this->return_api(true, Response::HTTP_OK,null,null,null);
    }

}
