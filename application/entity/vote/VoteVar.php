<?php


namespace application\entity\vote;


class VoteVar
{
    private $pollId;
    private $name;
    private $varnum;
    private $comment;
    private $count = 0;
    private $activity = 1;

    public function __construct($id, $name, $num, $comment)
    {
        $this->pollId = $id;
        $this->name = $name;
        $this->varnum = $num;
        $this->comment = $comment;
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
    public function getComment()
    {
        return $this->comment;
    }

    /**
     * @return mixed
     */
    public function getCount()
    {
        return $this->count;
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
    public function getPollId()
    {
        return $this->pollId;
    }

    /**
     * @return mixed
     */
    public function getVarnum()
    {
        return $this->varnum;
    }


}