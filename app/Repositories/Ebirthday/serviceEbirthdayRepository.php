<?php
namespace App\Repositories\Ebirthday;

use App\Repositories\BaseRepository;
use App\Repositories\Modify\ServiceTransactionRepository as Service3rd;
use Hashids\Hashids;

class serviceEbirthdayRepository extends BaseRepository
{
    protected $hasIds, $data;
    protected $params, $call3rd;

    public function __construct(Service3rd $call3rd)
    {
        parent::__construct();
        $this->model = $this->models();
        $this->hasIds = new Hashids('!@#42861!@#$_*8', 5);
        $this->call3rd = $call3rd;
    }
    public function models()
    {
        return app()->make("App\Models\EbirthdayModel");
    }
    public function encrypt($id)
    {
        return $this->hasIds->encode($id);
    }
    public function decrypt($hash)
    {
        return $this->hasIds->decode($hash);
    }
    public function createTransaction($params)
    {
        $this->total = 1;
        $this->data = $this->model->create($params);
        return $this;
    }
    public function warpResponse()
    {
        $this->data->url = \URL::to('birthday/' . self::encrypt($this->data->id));
        $this->initialParam($this->data->url);
        $response = $this->callGoogleApi();
        $this->data->short_url = isset($response['id']) ? $response['id'] : '';
        $this->data->response = !empty($response) ? $response : [];
        $this->data->save();

        return $this->response($this->data);
    }
    public function getMemberData($id = 0)
    {
        return $this->model->where('id', $id)->first();
    }
    public function page($limit = 10)
    {
        $this->model = $this->model->where(function ($query) {
            $params = \Request::all();
            if (!empty($params['msisdn'])) {
                $query->where('msisdn', $params['msisdn']);
            }if (!empty($params['sender'])) {
                $query->where('sender', $params['sender']);
            }if (!empty($params['url'])) {
                $query->where('url', $params['url']);
            }if (!empty($params['name'])) {
                $query->where('name', 'like', '%' . $params['name'] . '%');
            }
        });
        return $this->model->orderBy('id', 'desc')->paginate($limit);
    }
    public function initialParam($url)
    {
        $this->params = [
            'longUrl' => $url,
            'key' => config('api.key'),
        ];
    }
    public function callGoogleApi()
    {
        $curlObj = curl_init();
        curl_setopt($curlObj, CURLOPT_URL, config('api.url') . "?key=" . config('api.key'));
        curl_setopt($curlObj, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curlObj, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($curlObj, CURLOPT_HEADER, 0);
        curl_setopt($curlObj, CURLOPT_HTTPHEADER, array('Content-type:application/json'));
        curl_setopt($curlObj, CURLOPT_POST, 1);
        curl_setopt($curlObj, CURLOPT_POSTFIELDS, json_encode($this->params));

        $response = curl_exec($curlObj);

        $json = json_decode($response, true);

        curl_close($curlObj);
        return $json;
    }

}
