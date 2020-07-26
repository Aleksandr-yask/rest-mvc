<?php


namespace application\entity\broadcasts;


class BroadcastsMessages
{

    private $id;
    private $broadcastId;
    private $author;
    private $content;
    private $channel;
    private $msg_id;
    private $senderNumber;
    private $date;
    private $labels = '';
    private $status = '';
    private $favorite = '';
    private $attachments = '[]';
    private $region = 0;
    private $image = '';
    private $isCreate = 0;
    private $isDeleted = 0;

    public function __construct($msg_id, $broadcastId, $author, $senderNumber, $content, $channel, $date,
                                $image = '', $isCreate = 0, $status = '', $fav = '', $attachments = '', $labels = '', $region = 0)
    {
        $this->msg_id = $msg_id;
        $this->broadcastId = $broadcastId;
        $this->author = $author;
        $this->content = $content;
        $this->channel = $channel;
        $this->date = $date;
        $this->senderNumber = $senderNumber;
        $this->status = $status;
        $this->favorite = $fav;
        $this->attachments = $attachments;
        $this->region = $region;
        $this->image = $image;
        $this->labels = $labels;
        $this->isCreate = $isCreate;
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
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getAttachments()
    {
        return $this->attachments;
    }

    /**
     * @return mixed
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @return mixed
     */
    public function getChannel()
    {
        return $this->channel;
    }

    /**
     * @return mixed
     */
    public function getRegion()
    {
        return $this->region;
    }

    /**
     * @return mixed
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @return mixed
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @return mixed
     */
    public function getFavorite()
    {
        return $this->favorite;
    }

    /**
     * @return mixed
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @return mixed
     */
    public function getIsCreate()
    {
        return $this->isCreate;
    }

    /**
     * @return mixed
     */
    public function getLabels()
    {
        return $this->labels;
    }

    /**
     * @return mixed
     */
    public function getMsgId()
    {
        return $this->msg_id;
    }

    /**
     * @return mixed
     */
    public function getSenderNumber()
    {
        return $this->senderNumber;
    }

    /**
     * @return mixed
     */
    public function getBroadcastId()
    {
        return $this->broadcastId;
    }
}