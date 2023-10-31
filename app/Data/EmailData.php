<?php

namespace App\Data;

use App\Traits\DTOToArray;

final class EmailData
{
    use DTOToArray;

    private string $emailAddress;
    private string $body;
    private string $subject;
    private string $id;
    private string $created_at;
    private string $sender_name;
    private string $sender_id;

    public function __construct()
    {
        $this->id = uniqid();
        $this->created_at = now()->format('Y-m-d H:i:s');
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }


    /**
     * @return string
     */
    public function getEmailAddress(): string
    {
        return $this->emailAddress;
    }

    /**
     * @param string $emailAddress
     * @return EmailData
     */
    public function setEmailAddress(string $emailAddress): EmailData
    {
        $this->emailAddress = $emailAddress;
        return $this;
    }

    /**
     * @return string
     */
    public function getBody(): string
    {
        return $this->body;
    }

    /**
     * @param string $body
     * @return EmailData
     */
    public function setBody(string $body): EmailData
    {
        $this->body = $body;
        return $this;
    }

    /**
     * @return string
     */
    public function getSubject(): string
    {
        return $this->subject;
    }

    /**
     * @param string $subject
     * @return EmailData
     */
    public function setSubject(string $subject): EmailData
    {
        $this->subject = $subject;
        return $this;
    }

    /**
     * @return string
     */
    public function getSenderName(): string
    {
        return $this->sender_name;
    }

    /**
     * @param string $sender_name
     * @return EmailData
     */
    public function setSenderName(string $sender_name): EmailData
    {
        $this->sender_name = $sender_name;
        return $this;
    }

    /**
     * @return string
     */
    public function getSenderId(): string
    {
        return $this->sender_id;
    }

    /**
     * @param string $sender_id
     * @return EmailData
     */
    public function setSenderId(string $sender_id): EmailData
    {
        $this->sender_id = $sender_id;
        return $this;
    }

    /**
     * @return string
     */
    public function getCreatedAt(): string
    {
        return $this->created_at;
    }


}
