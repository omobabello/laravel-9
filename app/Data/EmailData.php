<?php

namespace App\Data;

final class EmailData
{
    private string $emailAddress;
    private string $body;
    private string $subject;

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

}
