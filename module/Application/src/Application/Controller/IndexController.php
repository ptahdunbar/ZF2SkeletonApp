<?php

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class IndexController extends AbstractActionController
{
    /**
     * Default action if none provided.
     *
     * @return array
     */
    public function indexAction()
    {
        return new ViewModel;
    }
}