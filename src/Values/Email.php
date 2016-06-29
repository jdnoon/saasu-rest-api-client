<?php

namespace Terah\Saasu\Values;


/**
 * Class Email
 *
 * @package Terah\Saasu\Values
 */
class Email extends Value
{
    /**
     * Who the email is from.
     * @var string
     */
    public $From        = '';

    /**
     * Who the email is being sent to.
     * @var string
     */
    public $To          = '';

    /**
     * Subject of the email.
     * @var string
     */
    public $Subject     = '';

    /**
     * The body of the email message.
     * @var string
     */
    public $Body        = '';

    /**
     * The CC address to send a copy of the email to.
     * @var string
     */
    public $Cc          = '';

    /**
     * The BCC address (blind carbon copy) o send a copy of the email to.
     * @var string
     */
    public $Bcc         = '';
}


