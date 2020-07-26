<?php

namespace application\core;

class View
{
    public $path;
    public $route;
    public $layout = "default";
    private $type;

    private static $statusTexts = [
        // INFORMATIONAL CODES
        100 => 'Continue',
        101 => 'Switching Protocols',
        102 => 'Processing',
        // SUCCESS CODES
        200 => 'OK',
        201 => 'Created',
        202 => 'Accepted',
        203 => 'Non-Authoritative Information',
        204 => 'No Content',
        205 => 'Reset Content',
        206 => 'Partial Content',
        207 => 'Multi-status',
        208 => 'Already Reported',
        // REDIRECTION CODES
        300 => 'Multiple Choices',
        301 => 'Moved Permanently',
        302 => 'Found',
        303 => 'See Other',
        304 => 'Not Modified',
        305 => 'Use Proxy',
        306 => 'Switch Proxy', // Deprecated
        307 => 'Temporary Redirect',
        // CLIENT ERROR
        400 => 'Bad Request',
        401 => 'Unauthorized',
        402 => 'Payment Required',
        403 => 'Forbidden',
        404 => 'Not Found',
        405 => 'Method Not Allowed',
        406 => 'Not Acceptable',
        407 => 'Proxy Authentication Required',
        408 => 'Request Time-out',
        409 => 'Conflict',
        410 => 'Gone',
        411 => 'Length Required',
        412 => 'Precondition Failed',
        413 => 'Request Entity Too Large',
        414 => 'Request-URI Too Long',
        415 => 'Unsupported Media Type',
        416 => 'Requested range not satisfiable',
        417 => 'Expectation Failed',
        418 => 'I\'m a teapot',
        422 => 'Unprocessable Entity',
        423 => 'Locked',
        424 => 'Failed Dependency',
        425 => 'Unordered Collection',
        426 => 'Upgrade Required',
        428 => 'Precondition Required',
        429 => 'Too Many Requests',
        431 => 'Request Header Fields Too Large',
        // SERVER ERROR
        500 => 'Internal Server Error',
        501 => 'Not Implemented',
        502 => 'Bad Gateway',
        503 => 'Service Unavailable',
        504 => 'Gateway Time-out',
        505 => 'HTTP Version not supported',
        506 => 'Variant Also Negotiates',
        507 => 'Insufficient Storage',
        508 => 'Loop Detected',
        511 => 'Network Authentication Required',
    ];

    public function __construct($route) {
        $this->route = $route;
        $this->path = $route['controller'].'/'.$route['action'];
        $this->type = isset($route['type']) ? $route['type'] : null;
    }

    public function render($title, $vars = []) {
        extract($vars);
        $path = DIR . 'application/views/'.$this->path.'.php';
        if(!file_exists($path)){
            throw new \Exception('File not found', 404);
        } else {
            ob_start();
            require $path;
            $content = ob_get_clean();
            require DIR . 'application/views/layouts/' . $this->layout . '.php';
        }
    }

    /**
     * @return string|null
     */
    public function getType(): ?string
    {
        return $this->type;
    }

    private static function isValidStatusCode(int $code): bool
    {
        if (isset(self::$statusTexts[$code])) return true;
        return false;
    }

    public static function text(string $data = '', int $code = 200)
    {
        echo $data;
        header('Content-type:text/plain;charset=utf-8');

        if (!self::isValidStatusCode($code)) $code = 500;
        http_response_code($code);
    }

    public static function json($data = [], string $status = 'ok', int $code = 200) {
        $returnData = [
          'status' => $status,
            'body' => $data,
            'code' => $code
        ];
        $returnData = self::changeTypes($returnData);
        header('Content-type:application/json;charset=utf-8');
        http_response_code($code);
        echo json_encode($returnData, JSON_UNESCAPED_UNICODE);
    }

    /**
     * Преобразует типы. Если передается строкой цифра, переведет ее в int
     * Работает с bool, int, null
     *
     * @param $ar
     * @return mixed
     */
    private static function changeTypes($ar) {
        foreach ($ar as $k => $item) {
            if (gettype($item) === 'array') $ar[$k] = self::changeTypes($item);
            else {
                if (gettype($item) === 'string' and ctype_digit($item)) {
                    $ar[$k] = (int) $item;
                } else if (gettype($item) === 'string' and ($item === 'true' or $item === 'false')) {
                    $ar[$k] = (boolean) $item;
                } else if (gettype($item) === 'string' and $item === 'null') {
                    $ar[$k] = null;
                }
            }
        }

        return $ar;
    }

    public static function errorCode($code) {
        if (isset(self::$statusTexts[$code])) {
            throw new \Exception(self::$statusTexts[$code], $code);
        } else {
            throw new \Exception(self::$statusTexts[500], 500);
        }

        switch ($type) {
            case 'json':
                self::json([], 'error', $code);
            break;
            case 'html':
                $path = DIR . 'application/views/errors/' . $code . '.php';
                if (file_exists(DIR . $path))
                    require DIR . $path;
                else {
                    require DIR . 'application/views/errors/default.php';
                }
                break;

        }
//        $path = 'application/views/errors/' . $code . '.php';
//        if(file_exists($path)) {
//            require $path;
//        }
        exit();

    }

    public static function redirect($url) {
        header('Location: '.$url );
        exit();
    }
}