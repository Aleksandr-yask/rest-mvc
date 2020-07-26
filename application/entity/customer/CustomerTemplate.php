<?php

namespace application\entity\customer;

class CustomerTemplate
{
    private $id;
    private $name;
    private $json;
    private $isDefault = 0;
    private $isDeleted = 0;
    private $user;
    private $lastUsed = 1;

    public function __construct($name, $json, $user)
    {
        $this->name = $name;
        /* Проверяем на валидность json */
        $json = json_decode($json, true);
        if ($json === null) throw new \Exception('Not valid JSON');
        $json = json_encode($json, JSON_UNESCAPED_UNICODE);
        $this->json = $json;
        $this->user = $user;
    }

    /**
     * @return mixed
     */
    public function getIsDeleted()
    {
        return $this->isDeleted;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @return mixed
     */
    public function getIsDefault()
    {
        return $this->isDefault;
    }

    /**
     * @return mixed
     */
    public function getJson()
    {
        return $this->json;
    }

    /**
     * @return mixed
     */
    public function getLastUsed()
    {
        return $this->lastUsed;
    }

}