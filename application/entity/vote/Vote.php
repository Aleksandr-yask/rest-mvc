<?php


namespace application\entity\vote;


class Vote
{

    private $iactiveId;
    /**
     * @var int активность
     *  0 - not active
     *  1 - active
     */
    private $activity = 0;
    private $user;
    private $title;
    private $description;
    private $notes;
    private $startTime;
    private $endTime;
    private $votesCount = 0;

    public function __construct($iactiveId, $user, $title = '', $description = '', $notes = '')
    {
        $this->iactiveId = $iactiveId;
        $this->user = $user;
        $this->title = $title;
        $this->description = $description;
        $this->notes = $notes;
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
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @return mixed
     */
    public function getEndTime()
    {
        return $this->endTime;
    }

    /**
     * @return mixed
     */
    public function getIactiveId()
    {
        return $this->iactiveId;
    }

    /**
     * @return mixed
     */
    public function getNotes()
    {
        return $this->notes;
    }

    /**
     * @return mixed
     */
    public function getStartTime()
    {
        return $this->startTime;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @return mixed
     */
    public function getVotesCount()
    {
        return $this->votesCount;
    }

    /**
     * @param mixed $activity
     */
    public function setActivity($activity): void
    {
        $this->activity = $activity;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description): void
    {
        $this->description = $description;
    }

    /**
     * @param mixed $endTime
     */
    public function setEndTime($endTime): void
    {
        $this->endTime = $endTime;
    }

    /**
     * @param mixed $iactiveId
     */
    public function setIactiveId($iactiveId): void
    {
        $this->iactiveId = $iactiveId;
    }

    /**
     * @param mixed $notes
     */
    public function setNotes($notes): void
    {
        $this->notes = $notes;
    }

    /**
     * @param mixed $startTime
     */
    public function setStartTime($startTime): void
    {
        $this->startTime = $startTime;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title): void
    {
        $this->title = $title;
    }

    /**
     * @param mixed $votesCount
     */
    public function setVotesCount($votesCount): void
    {
        $this->votesCount = $votesCount;
    }

    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->user;
    }

}