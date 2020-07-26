<?php
namespace application\entity;


class Iactives
{
    private $user;
    private $type;
    private $activity = '';
    private $is_active = 0;

    private $title;
    private $description;
    private $memo;

    public function __construct($user, $type, $title, $desc = '', $memo = '')
    {
        $this->user = $user;
        $this->type = $type;
        $this->title = $title;
        $this->description = $desc;
        $this->memo = $memo;
    }

    /**
     * @return mixed
     */
    public function getActivity()
    {
        return $this->activity;
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
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @return mixed
     */
    public function getIsActive()
    {
        return $this->is_active;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @return string
     */
    public function getMemo(): string
    {
        return $this->memo;
    }
}