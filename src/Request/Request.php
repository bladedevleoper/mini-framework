<?php

namespace ShoppingCart\Request;

use ShoppingCart\Enums\ServerRequestMethodEnum;
use ShoppingCart\Mappers\Requests\RequestMapper;

class Request
{
   public array $request = [];

    /** Server request method
     * @var mixed
     */
    public static $requestMethod;

    public function __construct()
    {
        $this->setRequestKeys();
    }

    public function getUrl(): string
    {
        return $this->request['uri'];
    }

    /**
     * Split and filter the current url
     * @return array
     */
    private function splitUrl(): array
    {
        $url = explode('/', $this->getUrl());

        $url = array_filter(
            array: $url,
            callback: function ($item) {
            return !empty($item) && $item != 'shopping-cart';
        });

        //re-index $url array
        return array_values($url);

    }

    public function currentRequest(): object
    {
        $this->request['request_mapping'] = RequestMapper::mapRequest($this->splitUrl());

        return $this;
    }

    private function setRequestKeys()
    {
        $this->request['uri'] = $_SERVER['REQUEST_URI'] ?? null;
        $this->request['request_method'] = $_SERVER['REQUEST_METHOD'] ?? null;
        $this->request['php_self'] = $_SERVER['PHP_SELF'] ?? null;
        $this->request['http_accept'] = $_SERVER['HTTP_ACCEPT'] ?? null;
        $this->request['http_connection'] = $_SERVER['HTTP_CONNECTION'] ?? null;
        $this->request['referer'] = $_SERVER['HTTP_REFERER'] ?? null;
        $this->request['request_uri'] = $_SERVER['REQUEST_URI'] ?? null;
        $this->request['path_info'] = $_SERVER['PATH_INFO'] ?? null;
        $this->request['request_bag'] = $this->getRequestInformation();
    }


    private function getRequestInformation()
    {
        $request = '';

        switch ($this->request['request_method']) {
            case ServerRequestMethodEnum::REQUEST_METHOD_GET:
                $request = $_GET;
                break;
            case ServerRequestMethodEnum::REQUEST_METHOD_POST:
                $request = $_POST;
                break;
        }
        return (object) [
            'params' => $request ?? null,
        ];
    }
}
