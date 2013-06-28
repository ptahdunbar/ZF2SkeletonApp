<?php

namespace ApplicationTest\Controller;

use Tests\Bootstrap;

use Zend\Http\Request,
    Zend\Http\Response;

use Zend\Mvc\MvcEvent;

use Zend\Mvc\Router\RouteMatch,
    Zend\Mvc\Router\Http\TreeRouteStack as HttpRouter;

class IndexControllerTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Fully Qualified Class Name.
     *
     * @var string
     */
    protected $fqcn = 'Application\Controller\IndexController';

    /**
     * @var \Application\Controller\IndexController $controller
     */
    protected $controller;

    /**
     * @var \Zend\Http\Request $request
     */
    protected $request;

    /**
     * @var \Zend\Http\Response $response
     */
    protected $response;

    /**
     * @var \Zend\Mvc\Router\RouteMatch $routeMatch
     */
    protected $routeMatch;

    /**
     * @var \Zend\Mvc\MvcEvent $event
     */
    protected $event;

    protected function setUp()
    {
        $serviceManager = Bootstrap::getServiceManager();

        $this->controller = new $this->fqcn;
        $this->request    = new Request;
        $this->routeMatch = new RouteMatch(['controller' => 'index']);
        $this->event      = new MvcEvent;

        $config = $serviceManager->get('Config');

        $routerConfig = isset($config['router']) ? $config['router'] : [];
        $router = HttpRouter::factory($routerConfig);

        $this->event->setRouter($router);
        $this->event->setRouteMatch($this->routeMatch);

        $this->controller->setEvent($this->event);
        $this->controller->setServiceLocator($serviceManager);
    }

    public function testIndexActionCanBeAccessed()
    {
        $this->routeMatch->setParam('action', 'index');

        $result   = $this->controller->dispatch($this->request);
        $response = $this->controller->getResponse();

        $this->assertEquals(200, $response->getStatusCode());
    }

    public function testIndexActionReturnsViewModel()
    {
        $this->assertInstanceOf(
            '\Zend\View\Model\ViewModel',
            $this->controller->indexAction()
        );
    }
}