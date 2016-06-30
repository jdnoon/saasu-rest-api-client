<?php

namespace Terah\Saasu\Values;

/**
 * Class FileAttachment
 * @package Terah\Saasu\Values
 */
class FileAttachment extends RestableValue
{
    /**
     * 	This is an array of bytes and represents the data of the attachment (ie. the attachment itself).
     * You must convert the file you want to attach into a byte array.
     * This is usually done programmatically which our client code does for you.
     * This process is called serialisation and more information on this can be found here -
     * http://en.wikipedia.org/wiki/Serialization	Collection of byte
     * @var string
     */
    public $AttachmentData                          = '';

    /**
     * A flag that indicates if an attachment of the same name already exists, whether it can be overwritten or not when storing.
     * @var boolean
     */
    public $AllowExistingAttachmentToBeOverwritten  = false;

    /**
     * Name of the attachment.
     * @var	string
     */
    public $Name                                    = '';

    /**
     * Description of the attachment.
     * @var string
     */
    public $Description                             = '';

    /**
     * 	The Id of the item/entity that this attachment is associated with or attached to.
     * @var integer
     */
    public $ItemIdAttachedTo                        = null;

    /**
     * Hypermedia links. Contains contextual links to possible next actions related to this resource.
     * Only present in responses.
     * This data is not to be sent to the server.
     * Collection of Link
     * @var array
     */
    public $_links                                  = [];
}