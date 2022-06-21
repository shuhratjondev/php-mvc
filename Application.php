<?php

namespace shuhratjon\mvc;

use shuhratjon\mvc\db\Database;
use Exception;

class Application
{

    public static string $ROOT_DIR;

    public string $layout = 'main';
    public string $userClass;
    public static Application $app;
    public Router $router;
    public Request $request;
    public ?Controller $controller = null;
    public Response $response;
    public Database $db;
    public Session $session;
    public ?UserModel $user;
    public View $view;

    public function __construct($ROOT_DIR, array $config)
    {
        $this->userClass = $config['userClass'];
        self::$ROOT_DIR = $ROOT_DIR;
        self::$app = $this;
        $this->request = new Request();
        $this->response = new Response();
        $this->router = new Router($this->request, $this->response);
        $this->session = new Session();
        $this->view = new View();

        $this->db = new Database($config['db']);

        $primaryValue = $this->session->get('user');
        if ($primaryValue) {
            $primaryKey = $this->userClass::primaryKey();
            $this->user = $this->userClass::findOne([$primaryKey => $primaryValue]);
        } else {
            $this->user = null;
        }

    }


    public function run()
    {
        try {
            echo $this->router->resolve();
        } catch (Exception $e) {
            $this->response->setStatusCode($e->getCode());
            echo $this->view->renderView('_error', [
                'exception' => $e
            ]);
        }
    }

    /**
     * @param Controller $controller
     */
    public function setController(Controller $controller): void
    {
        $this->controller = $controller;
    }

    /**
     * @return Controller
     */
    public function getController(): Controller
    {
        return $this->controller;
    }

    public function login(UserModel $user)
    {
        $this->user = $user;
        $primaryKey = $this->user->primaryKey();
        $primaryValue = $user->{$primaryKey};
        $this->session->set('user', $primaryValue);
        return true;
    }

    public function logout()
    {
        $this->user = null;
        $this->session->remove('user');
    }


    public static function isGuest(): bool
    {
        return !self::$app->user;
    }

}