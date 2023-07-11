<?php

namespace App\Filters\v1;
use App\Filters\ApiFilter;
use Illuminate\Http\Request;

class InvoiceQuery extends ApiFilter
{
    protected $safeParms = [
        'customerId' => ['eq'],
        'amount' => ['eq', 'gt', 'lt', 'lte', 'gte'],
        'status' => ['eq', 'ne'],
        'billed_date' => ['eq', 'gt', 'lt', 'lte', 'gte'],
        'paid_date' => ['eq', 'gt', 'lt', 'lte', 'gte']
    ];
    
    protected $columnMap = [
        'customerId' => 'customer_id',
        'billedDate' => 'billed_date',
        'paidDate' => 'paid_date',
    ];
    
    protected $operatorMap = [
        'eq' => '=',
        'lt' => '<',
        'lte' => '<=',
        'gt' => '>',
        'gte' => '>=',
        'ne' => '!=',
    ];

}