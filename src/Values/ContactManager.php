<?php

namespace Terah\Saasu\Values;

class ContactManager extends Value
{
    /**
     * Contact's Id in Saasu system.
     * @var int
     */
    public $Id                        = null;

    /**
     * Identifier used for concurrency checking. Required for update.
     * @var string
     */
    public $LastUpdatedId             = '';

    /**
     * The salutation or title of the contact. Valid values: Mr., Mrs., Ms., Dr., Prof.
     * @var string
     */
    public $Salutation                = '';

    /**
     * The first or given name of the contact.
     * @var string
     */
    public $GivenName                 = '';

    /**
     * The middle initials of the contact.
     * @var null
     */
    public $MiddleInitials            = null;

    /**
     * The last name or surname of the contact.
     * @var string
     */
    public $FamilyName                = '';

    /**
     * Contact's position or role.
     * @var string
     */
    public $PositionTitle             = '';

    /**
     * Hypermedia links.
     * Contains contextual links to possible next actions related to this resource.
     * Only present in responses. This data is not to be sent to the server.
     * Collection ofLink
     * @var array
     */
    public $_links                    = [];
}
