<?php

namespace App\Http\Controllers\Api\v1;
use App\Filters\v1\CustomerQuery;
use App\Models\Customer;
use App\Http\Requests\v1\BulkStoreInvoiceRequest;
use App\Http\Requests\v1\UpdateCustomerRequest;
use App\Http\Controllers\Controller;
use App\Http\Resources\v1\CustomerResource;
use App\Http\Resources\v1\CustomerCollection;



use Illuminate\Http\Request;



class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    
    {
        $filter = new CustomerQuery();
        $filterItems = $filter->transform($request); //[['column', 'operator', 'value']]
        
        $includeInvoices = $request->query('includeInvoices');
        
        $customers = Customer::where($filterItems);
        
        if($includeInvoices){ 
            $customers = $customers->with('invoices');
        }

            return new CustomerCollection($customers->paginate()->appends($request->query()));
         
    }
    
    /**
     * Show the form for creating a new resource.
     */

    

    /**
     * Store a newly created resource in storage.
     */
    public function store(BulkStoreInvoiceRequest $request)
    {
        return new CustomerResource(Customer::create($request->all()));
    }

    /**
     * Display the specified resource.
     */
    public function show(Customer $customer)
    {
        $includeInvoices = request()->query('includeInvoices');
        
        if ($includeInvoices){
            return new CustomerResource($customer->loadMissing('invoices'));
        }
        return new CustomerResource($customer);
    }

    /**
     * Show the form for editing the specified resource.
     */


    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCustomerRequest $request, Customer $customer)
    {
        $customer->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Customer $customer)
    {
        //
    }
}
