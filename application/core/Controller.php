<?php

namespace application\core;

use application\http\Request;
use application\http\Response;
use application\models\interfaces\DatabaseModelWorkerInterface;

abstract class Controller extends Request
{
    public $route;
    public $view;
    public $acl;
    /** @var $model DatabaseModelWorkerInterface */
    public $model;
    private $config;
    public $response;
    private $serverHost;
    private $clientNumber;

    public function __construct($route)
    {
        parent::__construct();
        $this->clientNumber = getSessionData('user') ?? $GLOBALS['user']; // TODO: change this then create auth
        $this->route = $route;
        $this->serverHost = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]";
        $this->response = new Response();
        $this->view = new View($route);
        $this->config = require_once DIR.'application/config/app.cfg.php';

        if (!$this->checkAcl()) {
            View::errorCode(403);
        }

        $this->model = $this->loadModel($route['controller']);
    }

    public function loadModel($name)
    {
        $name = ucfirst($name);
        $path = 'application\models\\' .$name;
        if (class_exists($path)) {
            return new $path;
        } else
            View::errorCode(404);
    }

    public function checkAcl()
    {
        $this->acl = require DIR . 'application/acl/ACL.php';
        if($this->isAcl('all')) {
            return true;
        }
        elseif(isAuthByAccountNotAnonymously() and isAuth() and $this->isAcl('not_anonymous_auth')) {
            return true;
        }
        elseif(isAuthAnonymous() and isAuth() and $this->isAcl('anonymous_auth')) {
            return true;
        }
        elseif(isAuth() and $this->isAcl('auth')) {
            return true;
        }
        return false;

    }

    public function isAcl($key) {
        return in_array($this->route['action'], $this->acl[$key]);
    }

    /**
     * @return mixed
     */
    public function getConfigItem($name)
    {
        return $this->config[$name];
    }

    /**
     * @return string
     */
    public function getServerHost(): string
    {
        return $this->serverHost;
    }

    /**
     * @return mixed
     */
    public function getClientNumber()
    {
        return $this->clientNumber;
    }
}