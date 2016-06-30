<?php

namespace Terah\Saasu\Values;


/**
 * Class FileAttachmentInfo
 *
 * @package Terah\Saasu\Values
 */
class FileAttachmentInfo extends RestableValue
{
    /**
     * The Id of the attachment.
     * @var integer
     */
    public $Id	                = null;

    /**
     * The size in bytes of the attachment.
     * @var integer
     */
    public $Size                = null;

    /**
     * Name of the attachment.
     * @var string
     */
    public $Name                = '';

    /**
     * Description of the attachment.
     * @var string
     */
    public $Description	        = '';

    /**
     * The Id of the item/entity that this attachment is associated with or attached to.
     * @var integer
     */
    public $ItemIdAttachedTo    = null;

    /**
     * Hypermedia links.
     * Contains contextual links to possible next actions related to this resource.
     * Only present in responses. This data is not to be sent to the server.
     * Collection of Link
     * @var
     */
    public $_links	            = [];
}