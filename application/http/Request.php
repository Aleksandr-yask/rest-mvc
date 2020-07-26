<?php
namespace application\http;

class Request
{
    private $cookie;

    private $request;

    private $files;

    private $headers;

    /**
     * Request constructor.
     */
    public function __construct() {
        $this->request = $_REQUEST;
        $this->cookie = $_COOKIE;
        $this->files = $_FILES;
        $this->headers = $this->getAllHeader();
    }

    /**
     * get param from GET params (?param=value&param2=value2)
     */
    public function get($key) {
        return isset($_GET[$key]) ? $this->clean($_GET[$key]) : null;
    }

    public function post($key = null) {
        return $_POST[$key] !== null ? $this->clean($_POST[$key]) : $_POST;
    }

    public function input($key) {
        $postData = file_get_contents("php://input");
        $request = json_decode($postData, true);

        return isset($request[$key]) ? $this->clean($request[$key]) : null;
    }

    public function getMethod() {
        return strtoupper($_SERVER['REQUEST_METHOD']);
    }

    public function getClientIp() {
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            $ip = $_SERVER['REMOTE_ADDR'];
        }
        return $ip;
    }

    public function getRequestUrl() {
        return $this->clean($_SERVER['REQUEST_URI']);
    }

    /**
     * @return array
     */
    public function getCookie(): array
    {
        return $this->cookie;
    }

    /**
     * @return array
     */
    public function getFiles(): array
    {
        return $this->files;
    }

    /**
     * @return array
     */
    public function getRequest(): array
    {
        return $this->request;
    }

    public function getHeader(string $name): ?string
    {

        return $this->headers[$name] ?? null;
    }

    private function getAllHeader(): array
    {
        $headers = array();
        foreach($_SERVER as $key => $value) {
            if (substr($key, 0, 5) <> 'HTTP_') {
                continue;
            }
            $header = str_replace(' ', '-', ucwords(str_replace('_', ' ', strtolower(substr($key, 5)))));
            $headers[$header] = $value;
        }
        return $headers;
    }


    private function clean($data) {
        if (is_array($data)) {
            foreach ($data as $key => $value) {

                // Delete key
                unset($data[$key]);

                // Set new clean key
                $data[$this->clean($key)] = $this->clean($value);
            }
        } else {
            $data = htmlspecialchars($data, ENT_COMPAT, 'UTF-8');
        }

        return $data;
    }
}