<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\ServiceTransactionInterface;

class TariffController extends Controller
{
    protected $transaction;
    public function __construct(ServiceTransactionInterface $transaction)
    {
        $this->transaction = $transaction;
    }
    public function index()
    {
        $this->transaction->setConfigFile('ir-tariff');
        $view['data'] = $this->transaction->call3rdQueryOperator();
        // dump($view['data']);
        $view['view'] = $this->transaction->generateInput();
        return view('backend.tariff', $view);
    }
}
