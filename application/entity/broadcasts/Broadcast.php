<?php


namespace application\entity\broadcasts;


class Broadcast
{
    private $iactiveId;
    private $title = '';
    private $description = '';
    private $memo;
    private $messageCount = 0;

    public function __construct($id, $title, $description = '', $memo = '')
    {
        $this->iactiveId = $id;
        $this->title = $title;
        $this->description = $description;
        $this->memo = $memo;
    }

    /**
     * @return string
     */
    public function getTitle(): string
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
     * @return int
     */
    public function getMessageCount(): int
    {
        return $this->messageCount;
    }

    /**
     * @return mixed
     */
    public function getIactiveId()
    {
        return $this->iactiveId;
    }

    /**
     * @return string
     */
    public function getMemo(): string
    {
        return $this->memo;
    }

}