<?php

namespace Camaleon\QPayPro\Models;

use Illuminate\Database\Eloquent\Model;
use Webkul\Product\Models\ProductProxy;
use Camaleon\QPayPro\Contracts\TransactionPayment as TransactionPaymentContract;

class TransactionPayment extends Model implements TransactionPaymentContract
{
    protected $fillable = [];
}