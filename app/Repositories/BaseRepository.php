<?php

namespace App\Repositories;

use App\Libraries\Benchmark;
use App\Repositories\BaseRepositoryInterface;

class BaseRepository implements BaseRepositoryInterface
{
    protected $total;
    protected $model;
    protected $lang, $mergeCheck, $dataMerge;
    protected $langList = ['en', 'th'];

    public function __construct()
    {
        $transaction_id = \Request::get('transaction_id', generateTransection());
        $this->benchmark = new Benchmark();
        $this->benchmark->mark('start');
    }
    public function getData()
    {
        return $this->response($this->model->get());
    }
    public function response($data)
    {
        if (count($data) > 0) {
            $response = $this->renderJson(200, $data);
        } else {
            $response = $this->renderJson(404);
        }
        return $response;
    }
    public function reponseModel()
    {
        return $this->renderJson(200, $this->model);
    }
    public function renderJson($code = 200, $data = '')
    {
        $data = !empty($data) && !is_array($data) ? $data->toArray() : $data;
        $response = [
            'header' => [
                'code' => $code,
                'message' => $code == 200 ? 'OK' : 'Not found',
            ],
            'transaction_id' => \Request::get('transaction_id', generateTransection()),
            // 'total' => $this->total,
            // 'count_result' => count($data),
            'date_current' => date('Y-m-d H:i:s'),

            'data' => [
                'item' => $data,
            ],

        ];
        if ($this->mergeCheck === true) {
            $response['data']['merges'] = $this->dataMerge;
        }
        $this->benchmark->mark('end');
        $responseTime = $this->benchmark->elapsed_time('start', 'end');
        $responseReturn['process_time'] = $responseTime;
        $response['process_time'] = $responseTime;
        // $requestAll = \Request::all();
        $requestAll = [];
        if (isset($requestAll['password'])) {
            unset($requestAll['password']);
        }
        return array_merge($response, $requestAll);
    }

    public function getTotals()
    {
        $this->total = $this->model->count();
        return $this;
    }
    public function setLimitOffset($limit = 30, $offset = 0)
    {
        $this->model = $this->model->take($limit)->skip($offset);
        return $this;
    }
    public function orderBy($column = 'id', $sort = 'desc')
    {
        $this->model = $this->model->orderBy($column, $sort);
        return $this;
    }
    public function withLang($lang = 'all')
    {
        switch ($lang) {
            case 'all':
                $this->model = $this->model->with('langs');
                break;
            default:
                $this->model = $this->model->with(['langs' => function ($query) use ($lang) {
                    $query->where('lang', $lang);
                }]);
                break;
        }
        $this->model = $this->model->wherehas('langs', function ($query) {});
        return $this;
    }
    public function createData($params = array())
    {
        $this->total = 1;
        return $this->response($this->model->create($params));
    }
    public function updateData($params = array())
    {
        $this->total = 1;
        $this->model->find($params['id'])->update($params);
        return $this->response($this->model->find($params['id']));
    }
    public function delete($params = array())
    {
        $this->total = 1;
        $data = $this->model->find($params['id']);
        $data->delete();
        return $this->response($data);
    }
    public function setLang($lang = 'en')
    {
        \App::setLocale($lang);
        return $this;
    }
    public function setDataMerge($data)
    {
        $this->dataMerge[$data['key']] = $data['data'];
    }
    public function setDataMergestatus($status)
    {
        $this->mergeCheck = $status;
    }
    public function warpLang($input)
    {
        # code...
    }

}
