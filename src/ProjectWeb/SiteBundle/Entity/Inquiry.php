<?php

namespace ProjectWeb\SiteBundle\Entity;

class Inquiry
{
    public $senderEmail;
    public $senderName;
    public $subject;
    public $message;

    public function getEmail() {
        return $this->senderEmail;
    }

    public function getName() {
        return $this->senderName;
    }

    public function getMessage() {
        return $this->message;
    }

    public function getSubject() {
        return $this->subject;
    }

}