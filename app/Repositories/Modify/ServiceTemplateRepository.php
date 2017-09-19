<?php
namespace App\Repositories\Modify;

use App\Repositories\Interfaces\ServiceTemplateInterface;

class ServiceTemplateRepository implements ServiceTemplateInterface
{
    protected $configForm;
    private $formtype;
    public function __construct($configForm)
    {
        $this->configForm = $configForm;
        $this->formtype = 'template.input-form';
        // $this->generateInput();
    }
    public function generateInput()
    {
        return view($this->formtype, ['data' => $this->configForm])->render();
    }
    public function setConfigFile($fileName = '')
    {
        $this->configForm = \Config::get($fileName);
    }
    public function getConfigFile()
    {
        return $this->configForm;
    }
    public function injectionNode($data = array())
    {
        $this->configForm = array_merge($this->configForm, $data);
        $this->recapValue(\Request::all());
    }
    public function setFormType($formtype = '')
    {
        $this->formtype = $formtype;
    }
    public function recapValue($recap)
    {
        foreach ($recap as $key => $value) {
            // dump($key . "::" . $value);
            foreach ($this->configForm as $configKey => $configValue) {
                if ($configValue['name'] == $key) {
                    $this->configForm[$configKey]['value'] = $value;
                }
                if ($configValue['name'] == 'created_at') {
                    $this->configForm[$configKey]['start_date'] = \Request::has('start_date') ? \Request::get('start_date') : '';
                    $this->configForm[$configKey]['end_date'] = \Request::has('end_date') ? \Request::get('end_date') : '';
                }
            }

        }
        // dump($this->configForm);
    }

}
