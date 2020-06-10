<?php


namespace Api;


use Exception;
use RuntimeException;

abstract class Api
{
    public $apiName = '';
    protected $method = '';
    public $requestUri = [];
    public $requestParams = [];

    protected $action = ''; //Название метод для выполнения

    public function __construct()
    {
        header("Access-Control-Allow-Orgin: *");
        header("Access-Control-Allow-Methods: *");
        header("Content-Type: application/json");

        //Массив GET параметров разделенных слешем
        $this->requestUri = explode('/', trim($_SERVER['REQUEST_URI'], '/'));
        $this->requestParams = $_REQUEST;

        //Определение метода запроса
        $this->method = $_SERVER['REQUEST_METHOD'];
        if ($this->method == 'POST' && array_key_exists('HTTP_X_HTTP_METHOD', $_SERVER)) {
            if ($_SERVER['HTTP_X_HTTP_METHOD'] == 'DELETE') {
                $this->method = 'DELETE';
            } else if ($_SERVER['HTTP_X_HTTP_METHOD'] == 'PUT') {
                $this->method = 'PUT';
            } else {
                throw new Exception("Unexpected Header");
            }
        }
    }

    public function run()
    {
        $requestUrl = $this->requestUri;
        //Первые 2 элемента массива URI должны быть "api" и название таблицы
        if (array_shift($requestUrl) !== 'api') {
            throw new RuntimeException('API Not Found', 404);
        }
        //Определение действия для обработки
        $this->action = $this->getAction();

        if (method_exists($this, $this->action)) {
            return $this->{$this->action}();
        } else {
            throw new RuntimeException('Api Not Found', 404);
        }
    }


    protected function getAction()
    {
        $method = $this->method;
        $requestUrl = $this->requestUri;
        switch ($method) {
            case 'GET':
                if (isset($this->requestParams['filter']) && $requestUrl[1] === $this->apiName) {
                    return 'filterAction';

                } else if (isset($this->requestParams['search']) && $requestUrl[1] === $this->apiName) {
                    return 'searchAction';

                } else if ($requestUrl[1] === $this->apiName) {
                    return 'indexAction';
                }
                break;
//            case 'POST':
//                return 'createAction';
//                break;
//            case 'PUT':
//                return 'updateAction';
//                break;
//            case 'DELETE':
//                return 'deleteAction';
//                break;
            default:
                return null;
        }
    }

    protected function requestStatus($code)
    {
        $status = array(
            200 => 'OK',
            404 => 'Not Found',
            405 => 'Method Not Allowed',
            500 => 'Internal Server Error',
        );
        return ($status[$code]) ? $status[$code] : $status[500];
    }

    protected function response($data, $status = 200)
    {
        header("HTTP/1.1 " . $status . " " . $this->requestStatus($status));
        return json_encode($data, JSON_PRETTY_PRINT);
    }

}