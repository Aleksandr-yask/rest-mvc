<?php


namespace application\models\interfaces;


interface DatabaseModelWorkerInterface
{
    public function create($entity);

//    public function update();

    public function get();

    public function getBy();

    public function lastInsertId();

    public function delete($id);

}