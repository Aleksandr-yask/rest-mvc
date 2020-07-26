<?php
namespace application\lib\DirWorker;

class DirMaker
{
    /**
     * Создает несуществующие директории в пути
     *
     * @param $startPath - путь который не поверяется
     * @param $checkPath - путь который проверяется
     * @return bool - false если имя папки указано не верно
     */
    public static function dirMaker($startPath, $checkPath)
    {
        if (file_exists($startPath.$checkPath)) return true;
        $pieces = explode("/", $checkPath);
        $path = '';

        foreach($pieces as $k => $item) {
            $path .= $item.'/';
            if ($item === '') {
                if($checkPath[0] === '/' or $checkPath[strlen($checkPath)-1] === '/') {
                    if ($k === 0 or $k === count($pieces)-1) {
                        // первый или последний / - игнор
                    } else {
                        return false;
                    }
                } else {
                    return false;
                }
            } else {
                if (!file_exists($startPath.$path)) {
                    mkdir($startPath.$path);
                }
            }
        }
        return true;
    }
}