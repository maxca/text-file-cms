<?php
namespace App\Repositories\Modify;

use App\Repositories\Interfaces\ServiceTemplateInterface;
use App\Repositories\Interfaces\ServiceWarpTemplateInterface;

class ServiceWarpTemplateRepository implements ServiceWarpTemplateInterface
{
    protected $template;
    protected $filename;

    public function __construct(ServiceTemplateInterface $template)
    {
        $this->template = $template;
    }
    public function setConfigFile($filename)
    {
        return $this->template->setConfigFile($filename);
    }
    public function generateFrom($filename = '', $node = array())
    {
        if (!empty($filename)) {
            $this->template->setConfigFile($filename);
        }
        if (!empty($node)) {
            $this->injectionNode($node);
        }
        return $this->template->generateInput();
    }
    public function injectionNode($node = array())
    {
        return $this->template->injectionNode($node);
    }
    public function setFormType($formtype = '')
    {
        return $this->template->setFormType($formtype);
    }
    public function recapValue($data = array())
    {
        return $this->template->recapValue($data);
    }
    public function warpupRequestPerson($person = '')
    {
        switch ($person) {
            case 'VIP':
                $redirect = 'management.step.vip';
                break;
            case 'Normal':
                $redirect = 'management.step.normal';
                break;
            default:
                $redirect = 'management.admin.step.benefit.index';
                break;
        }
        return $redirect;
    }

}
