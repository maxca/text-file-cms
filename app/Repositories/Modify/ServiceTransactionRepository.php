<?php
namespace App\Repositories\Modify;

use App\Repositories\Interfaces\ServiceTemplateInterface;
use App\Repositories\Interfaces\ServiceTransactionInterface;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;

class ServiceTransactionRepository implements ServiceTransactionInterface
{
    protected $template;
    private $limit;
    private $offset;
    private $model;
    public function __construct(ServiceTemplateInterface $template)
    {
        $this->template = $template;
        $this->limit = 30;
        $this->offset = 0;
        $this->model = $this->model();
    }
    public function model()
    {
        return app()->make('App\Models\Transaction');
    }
    public function getPaginate()
    {
        return $this->model->paginate($this->limit);
    }
    public function query()
    {
        return $this->model->where(function ($query) {
            if (\Request::has('msisdn')) {
                $query->where('msisdn', \Request::get('msisdn'));
            }if (\Request::has('operator')) {
                $query->where('operator', \Request::get('operator'));
            }if (\Request::has('step')) {
                $query->where('step', \Request::get('step'));
            }if (\Request::has('action')) {
                $query->where('action', \Request::get('action'));
            }if (\Request::has('mcc_mnc')) {
                $query->where('mcc_mnc', \Request::get('mcc_mnc'));
            }if (\Request::has('type')) {
                $query->where('type', \Request::get('type'));
            }if (\Request::has('accepted')) {
                $query->where('accepted', \Request::get('accepted'));
            }if (\Request::has('device')) {
                $query->where('device', 'like', '%' . \Request::get('device') . '%');
            }if (\Request::has('browser')) {
                $query->where('browser', 'like', '%' . \Request::get('browser') . '%');
            }if (\Request::has('warning_level')) {
                $query->where('warning_level', \Request::get('warning_level'));
            }if (\Request::has('start_date')) {
                $query->where('created_at', '>=', $this->convertDate(\Request::get('start_date')));
            }if (\Request::has('end_date')) {
                $query->where('created_at', '<=', $this->convertDate(\Request::get('end_date')));
            }
        })->orderby('id', 'desc')->paginate($this->limit);

    }
    public function convertDate($date = '')
    {
        return date('Y-m-d H:i:s', strtotime(str_replace(['/'], "-", $date)));
    }
    public function setLimit($limit = 30)
    {
        $this->limit = $limit;
    }
    public function setOffset($offset = 0)
    {
        $this->offset = $offset;
    }
    public function generateInput()
    {
        $this->template->recapValue(\Request::all());
        return $this->template->generateInput();
    }
    public function setConfigFile($template = '')
    {
        $this->template->setConfigFile($template);
    }
    public function genSearFormTransaction($value = '')
    {

    }
    public function call3rdQueryOperator()
    {
        $page = \Request::has('page') ? \Request::get('page') : 1;
        $this->offset = ($page == 1) ? $this->offset : ($this->limit * $page) - $this->limit;
        $url = env('SHARE_SERVICE_API') . 'api/v1/international/query-operator-report';
        $url = $url . '?' . http_build_query(\Request::all()) . "&limit=" . $this->limit . "&offset=" . $this->offset;
        $call3rdApi = $this->call3rd($url);
        if (isset($_GET['m_dd'])) {
            dump($this->offset);
            dump($page);
            dump($url);
            dump($call3rdApi);
        }
        if ($call3rdApi['header']['code'] == 200) {
            return $this->paginate($call3rdApi['data'], $call3rdApi['total']);
        } else {
            return $this->paginate([], 0);
        }
        return false;
    }
    public function paginate($items, $total)
    {
        return new LengthAwarePaginator($items, $total,
            $this->limit, Paginator::resolveCurrentPage(), array('path' => Paginator::resolveCurrentPath()));
    }
    public function call3rd($url)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        $response = curl_exec($ch);
        curl_close($ch);
        return json_decode($response, true);
    }
    public function call3rdPost($url, $data)
    {
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_TIMEOUT, 60);
        $response = curl_exec($ch);

        if (isset($data['debug'])) {
            dump(curl_getinfo($ch, CURLINFO_HTTP_CODE));
            dump(curl_errno($ch));
            dump(curl_error($ch));
            curl_close($ch);
        }
        return json_decode($response, true);
    }

}
