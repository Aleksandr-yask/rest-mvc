<?php


namespace application\entity;


class Iactive
{
    private $id;
    private $client_id;
    private $type;
    private $createdTime;
    private $is_deleted;
    private $showForUser = 1;


    public function __construct($client_id, $type)
    {
        $this->client_id = $client_id;
        $this->type = $type;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @return mixed
     */
    public function getClientId()
    {
        return $this->client_id;
    }

    /**
     * @return mixed
     */
    public function getCreatedTime()
    {
        return $this->createdTime;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getIsDeleted()
    {
        return $this->is_deleted;
    }

    /**
     * @param mixed $type
     */
    public function setType($type): void
    {
        $this->type = $type;
    }

    /**
     * @return int
     */
    public function getShowForUser(): int
    {
        return $this->showForUser;
    }

}