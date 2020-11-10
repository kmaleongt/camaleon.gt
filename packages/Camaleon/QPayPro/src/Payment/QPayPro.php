<?php

namespace Camaleon\QPayPro\Payment;

use Webkul\Payment\Payment\Payment;

class QPayPro extends Payment
{
    /**
     * Payment method code
     *
     * @var string
     */
    protected $code  = 'qpaypro';

    public function getRedirectUrl()
    {
        dump($this->getCart());
    }
}