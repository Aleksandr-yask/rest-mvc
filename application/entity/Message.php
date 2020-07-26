<?php
namespace application\entity;

use application\lib\MessageHandler;

class Message
{

    /** @var string Имя автора */
    private $author;

    private $firstName = '';

    private $lastName = '';

    private $iactiveID = 0;
    private $iactiveType = '';
    private $iactiveResult = '';
    private $answer = '';

    /** @var string канал в котором проверять */
    private $channel;

    /** @var string|int номер телефона / id автора */
    private $authorId;

    /** @var int|string номер телефона / id  нашего пользователя */
    private $recipient;

    /** @var string сообщение */
    private $text;

    /** @var string статус сообщения */
    private $status = '';

    private $phoneNumber;

    private $attachments = [];

    /** @var int генерированный хэш сообщения */
    private $messageHash = 0;

    public function __construct(string $channel, string $authorId,
                                string $recipient, string $text, string $author,
                                string $firstName = '', string $lastName = '', $phoneNumber = '', $uniq = '')
    {
        $this->channel = $channel;
        $this->authorId = $authorId;
        $this->recipient = '+' . $recipient;
        $this->text = $text;
        $this->author = $author;
        $this->phoneNumber = $phoneNumber;
        $this->messageHash = MessageHandler::hashMessage($this->authorId, $this->channel, $this->text, $uniq);

        $this->firstName = $firstName;
        $this->lastName = $lastName;
    }

    /**
     * @return string
     */
    public function getText(): string
    {
        return $this->text;
    }

    /**
     * @return int|string
     */
    public function getAuthorId()
    {
        return $this->authorId;
    }

    /**
     * @return string
     */
    public function getChannel(): string
    {
        return $this->channel;
    }

    /**
     * @return int|string
     */
    public function getRecipient()
    {
        return $this->recipient;
    }

    /**
     * @return string
     */
    public function getStatus(): string
    {
        return $this->status;
    }

    /**
     * @param string $status
     */
    public function setStatus(string $status): void
    {
        $this->status = $status;
    }

    /**
     * @return string
     */
    public function getAuthor(): string
    {
        return $this->author;
    }

    /**
     * @return string
     */
    public function getFirstName(): string
    {
        return $this->firstName;
    }

    /**
     * @return string
     */
    public function getLastName(): string
    {
        return $this->lastName;
    }

    /**
     * @return string
     */
    public function getIactiveID(): string
    {
        return $this->iactiveID;
    }

    /**
     * @param string $iactiveID
     */
    public function setIactiveID(string $iactiveID): void
    {
        $this->iactiveID = $iactiveID;
    }

    /**
     * @return string
     */
    public function getIactiveResult(): string
    {
        return $this->iactiveResult;
    }

    /**
     * @return string
     */
    public function getIactiveType(): string
    {
        return $this->iactiveType;
    }

    /**
     * @param string $iactiveType
     */
    public function setIactiveType(string $iactiveType): void
    {
        $this->iactiveType = $iactiveType;
    }

    /**
     * @param string $iactiveResult
     */
    public function setIactiveResult(string $iactiveResult): void
    {
        $this->iactiveResult = $iactiveResult;
    }

    /**
     * @return string
     */
    public function getAnswer(): string
    {
        return $this->answer;
    }

    /**
     * @param string $answer
     */
    public function setAnswer(string $answer): void
    {
        $this->answer = $answer;
    }

    /**
     * @return string
     */
    public function getPhoneNumber(): string
    {
        return $this->phoneNumber;
    }

    /**
     * @return array
     */
    public function getAttachments(): array
    {
        return $this->attachments;
    }

    /**
     * @param array $attachments
     */
    public function setAttachments(array $attachments): void
    {
        $this->attachments = $attachments;
    }

    /**
     * @return int
     */
    public function getMessageHash(): int
    {
        return $this->messageHash;
    }

}