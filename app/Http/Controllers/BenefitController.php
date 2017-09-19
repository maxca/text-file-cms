<?php

namespace App\Http\Controllers\Backend;

use App\Benefit;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateStepRequest;
use App\Http\Requests\UpdateStepRequest;
use App\Repositories\Interfaces\ServiceBenefitInterface;
use App\Repositories\Interfaces\ServiceWarpTemplateInterface;

class BenefitController extends Controller
{
    protected $template;
    protected $benefit;
    public function __construct(ServiceWarpTemplateInterface $template, ServiceBenefitInterface $benefit)
    {
        $this->template = $template;
        $this->benefit = $benefit;
    }
    public function index()
    {
        $this->template->setFormType('template.input-form-one');
        $this->template->setConfigFile('ir-create-step');
        $this->template->recapValue(\Request::all());
        $view['view'] = $this->template->generateFrom();
        return view('backend.create-step', $view);
    }
    public function store(CreateStepRequest $request)
    {
        $this->benefit->create($request->all());
        $redirect = $this->template->warpupRequestPerson($request->get('person'));
        return redirect()->route($redirect)
            ->withFlashSuccess(trans('lang.alert.create-step-success'));
    }
    public function edit($id)
    {
        $nodeData = $this->benefit->findID($id);
        $this->template->setConfigFile('ir-create-step');
        $this->template->setFormType('template.input-form-one');
        $this->template->recapValue($nodeData);
        $view['view'] = $this->template->generateFrom();
        return view('backend.create-step', $view);
    }
    public function getVIP()
    {
        $view['data'] = $this->benefit->getBenefit(['person' => 'VIP']);
        $view['view'] = $this->template->generateFrom('ir-step-search', \Config::get('ir-inject-node.vip'));
        return view('backend.step-list', $view);
    }
    public function getNormal()
    {
        $view['data'] = $this->benefit->getBenefit(['person' => 'Normal']);
        $view['view'] = $this->template->generateFrom('ir-step-search', \Config::get('ir-inject-node.normal'));
        return view('backend.step-list', $view);
    }
    public function update(UpdateStepRequest $request, $id)
    {
        $this->benefit->update($id);
        return redirect("admin/step/benefit/{$id}/edit")
            ->withFlashSuccess(trans('lang.alert.update-step-success'));
    }
    public function destroy($id)
    {
        $this->benefit->delete($id);
        return back()
            ->withFlashSuccess(trans('lang.alert.delete-step-success'));
    }
}
