<?php
namespace App\Repositories\Modify;

use App\Benefit;
use App\LogUpdateBenefit;
use App\Repositories\Interfaces\ServiceBenefitInterface;

class ServiceBenefitRepository implements ServiceBenefitInterface
{
    public function model()
    {
        return new Benefit();
    }
    public function modelLog()
    {
        return new LogUpdateBenefit();
    }
    public function getBenefit($param)
    {
        return $this->model()->where(function ($query) use ($param) {
            if (!empty($param['person'])) {
                $query->where('person', $param['person']);
            }if (\Request::has('type')) {
                $query->where('type', \Request::get('type'));
            }if (\Request::has('price')) {
                $query->where('price', \Request::get('price'));
            }if (\Request::has('step')) {
                $query->where('step', \Request::get('step'));
            }
        })->orderBy('step', 'asc')
            ->paginate(30);
    }
    public function create($data)
    {
        $model = $this->model()->create($data);
        $olddata = $model;
        $this->saveLog($olddata->id, $olddata->toArray(), 'create');
        return $model;
    }
    public function delete($id)
    {
        $olddata = $this->model()->where('id', $id)->first();
        $this->saveLog($id, $olddata->toArray(), 'delete');
        return $this->model()->where('id', $id)->delete();
    }
    public function findID($id = 0)
    {
        $data = $this->model()->find($id);
        if (count($data) > 0) {
            return $data->toArray();
        }
        return false;
    }
    public function update($id = 0)
    {
        $update = [
            'step' => \Request::get('step', ''),
            'price' => \Request::get('price', ''),
            'type' => \Request::get('type', ''),
            'person' => \Request::get('person', ''),
        ];
        $this->saveLog($id, $update, 'update');
        return $this->model()->where('id', $id)->update($update);
    }
    public function saveLog($id, $param, $action)
    {
        $username = access()->user()->name;
        $user_id = access()->user()->id;
        $olddata = $this->model()->find($id);
        $createLogParams = [
            'user_id' => $user_id,
            'username' => $username,
            'action' => $action,
            'id_step' => $id,
            'step_old' => $olddata->step,
            'step_new' => $param['step'],
            'price_old' => $olddata->price,
            'price_new' => $param['price'],
            'person_old' => $olddata->person,
            'person_new' => $param['person'],
            'type_old' => $olddata->type,
            'type_new' => $param['type'],

        ];
        $this->modelLog()->create($createLogParams);
    }

}
