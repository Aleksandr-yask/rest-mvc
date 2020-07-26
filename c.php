<?php
/* -------------------------------------
Консольное приложение для создания файлов и папок с классами
-------------------------------------*/
$conf = [
  'rout' => '',
  'controller' => '',
  'model' => '',
  'action' => '',
  'acl' => 1
];
start();
function start() {
    echo "Welcome \n";
    normalFan();
//    echo 'Включить краткий вид? (Y/N): ';
//    $line = mb_strtolower(getLine());
//    if ($line == 'y'or $line == 'н')
//        smallFun();
//    else
//        normalFan();
}

function smallFun() {
    global $conf;
    echo "Краткий ввод: \n1) Путь (routes.php)\n2) Название контроллера (NameController, models->Name.php)\n3) Модель (Action)\n4) Тип доступа (1 - all, 2 - authorize, 3 - guest, 4 - admin)\n5)Метод (get, post, put)\nРазделитель - |\n";
    $line = getLine();
    $vars = explode("|", $line);
    if (count($vars) < 5)
        die('Недостаточно параметров');

    $conf['rout']       = trim($vars[0]);
    $conf['controller'] = trim($vars[1]);
    $conf['model']      = trim($vars[2]);
    $conf['action']     = trim($vars[2]);
    $conf['acl']        = trim($vars[3]);
    $conf['method']     = trim($vars[4]);
    startInsert();
}

function normalFan() {
    global $conf;

    $arr = require 'application/config/routes.php';

    echo "Введите route []: \n";
    $line = getLine();
    $line = !empty($line) ? $line : '';
    $conf['rout'] = $line;

    echo "Введите название контроллера [Example]: \n";
    $line = getLine();
    $line = !empty($line) ? $line : 'Example';
    $conf['controller'] = $line;

    echo "Введите название action [Example]: \n";
    $line = getLine();
    $line = !empty($line) ? $line : 'Example';
    $conf['model'] = $line;
    $conf['action'] = $line;

    echo "Введите тип доступа (1 - all, 2 - authorize, 3 - guest, 4 - admin) [1]: \n";
    $line = getLine();
    $line = !empty($line) ? $line : '1';
    $conf['acl'] = $line;

    echo "Введите метод [get]: \n";
    $line = getLine();
    $line = !empty($line) ? $line : 'GET';
    $meths = [
        'GET',
        'HEAD',
        'POST',
        'PUT',
        'DELETE',
        'CONNECT',
        'OPTIONS',
        'TRACE',
        'PATCH'
    ];

    if (array_search(mb_strtoupper($line), $meths) === false)
        die('Неизвестный метод, доступны: '. implode(',', $meths));
    $conf['method'] = $line;


    echo "Введите тип запроса (HTML, JSON, XML ...) [JSON]: \n";
    $line = getLine();
    $line = !empty($line) ? $line : 'JSON';
    $conf['type'] = $line;

    if (array_search($conf['rout'], array_column($arr, 'url')) !== false and array_search($conf['method'], array_column($arr, 'method')) !== false)
        die('Такой путь с методом уже существует');

    startInsert();
}

function startInsert() {
    global $conf;
    route($conf);
    controller($conf);
    model($conf);
    acl($conf);
    fileContent($conf);
    echo 'Создано!';
}

function route($route) {
    $s = file_get_contents('application/config/routes.php');
    $p = "
    [
        'url' => '$route[rout]',
        'controller' => '$route[controller]',
        'action' => '$route[model]',
        'method' => '$route[method]',
        'type' => '$route[type]'
    ],
    //new_line//end_line";
    $s2 = preg_replace('/\/\/new_line(.*)\/\/end_line/', $p, $s);
    if ($s2)
        file_put_contents('application/config/routes.php', $s2);
    else
        exit('Файл routes.php не имеет new_line и end_line');
}

function controller($ctrl) {
    $fileName = 'application/controllers/'.ucfirst($ctrl['controller']).'Controller.php';
    if (file_exists($fileName)) {
        $f = file_get_contents($fileName);
        $f = trim($f);
        $rout = empty($ctrl['rout']) ? '/' : $ctrl['rout'];
        $p = '
        
   /** 
    * @url: '.$rout.'
    * @method: '.mb_strtoupper($ctrl['method']).'
    * @type: '.$ctrl['type'].'
    */
   public function '.$ctrl['action'].'Action'.ucfirst(mb_strtolower($ctrl['method'])).'() {
       View::json();
   }
    //e::::d
    ';

        $s = preg_replace('/\/\/e::(.*)::d/', $p, $f);
        if ($s)
            file_put_contents($fileName, $s);
        else
            exit('Файл Controller не имеет //e::::d');
    } else {
        $file = fopen($fileName, 'w');
        $rout = empty($ctrl['rout']) ? '/' : $ctrl['rout'];
        $p = '<?php
/**
 * '.ucfirst($ctrl['controller']).'Controller
 */

namespace application\controllers;
    
use application\core\Controller;
    
class '.ucfirst($ctrl['controller']).'Controller'.' extends Controller
{
   /** 
    * @url: '.$rout.'
    * @method: '.mb_strtoupper($ctrl['method']).'
    * @type: '.$ctrl['type'].'
    */
   public function '.$ctrl['action'].'Action'.ucfirst(mb_strtolower($ctrl['method'])).'() {
       
   }
    //e::::d    
}';
        fwrite($file, $p);
        fclose($file);
    }
}

function model($mdl) {
    $fileName = 'application/models/'.ucfirst($mdl['controller']).'.php';
    if (!file_exists($fileName)) {
        $file = fopen($fileName, 'w');
        $p = '<?php
/**
 * '.ucfirst($mdl['controller']).'
 */

namespace application\models;

use application\core\Model;

class '.ucfirst($mdl['controller']).' extends Model
{
    
}';
        fwrite($file, $p);
        fclose($file);
    }
}

function acl($acl) {
    if ($acl['acl'] == 1) {
        aclChange($acl, '/\/\/alle:(.*):alld/', '//alle::alld');
    } elseif($acl['acl'] == 2) {
        aclChange($acl, '/\/\/authorizee:(.*):authorized/', '//authorizee::authorized');
    } elseif($acl['acl'] == 3) {
        aclChange($acl, '/\/\/gueste:(.*):guestd/', '//gueste::guestd');
    } elseif($acl['acl'] == 4) {
        aclChange($acl, '/\/\/admine:(.*):admind/', '//admine::admind');
    }
}

function aclChange($acl, $r, $bd) {
    $s = file_get_contents('application/acl/ACL.php');

    $p = "'".$acl['action']."',
        ".$bd."";

    $s2 = preg_replace($r, $p, $s);
    if ($s2)
        file_put_contents('application/acl/ACL.php', $s2);
    else
        exit('Файл routes.php не имеет new_line и end_line');
}

function fileContent($arr) {
    $path = 'application/views/'.$arr['controller'].'/';
    if (file_exists($path)) {
        if (!file_exists($path.$arr['action'].'.php'))
            fopen($path.$arr['action'].'.php', 'w');
    } else {
        mkdir($path);
        fopen($path.$arr['action'].'.php', 'w');
    }
}

function getLine() {
    $handle = fopen ("php://stdin","r");
    return trim(fgets($handle));
}