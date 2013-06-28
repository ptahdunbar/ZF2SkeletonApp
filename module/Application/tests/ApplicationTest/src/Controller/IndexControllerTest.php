<?php

namespace ApplicationTest\Controller;

class IndexControllerTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Fully Qualified Class Name.
     *
     * @var string
     */
    protected $fqcn = 'Application\Controller\IndexController';

    /**
     * @var \Application\Controller\IndexController
     */
    protected $instance;

    public function setUp()
    {
        $this->instance = new $this->fqcn;
    }

    public function testIndexActionReturnsViewModel()
    {
        $this->assertInstanceOf(
            '\Zend\View\Model\ViewModel',
            $this->instance->indexAction()
        );
    }
}