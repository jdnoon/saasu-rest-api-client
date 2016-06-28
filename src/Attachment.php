<?php

namespace Terah\Saasu;

/**
 * Class Attachment
 * @package Terah\Saasu
 * @property string AttachmentData
 * @property bool AllowExistingAttachmentToBeOverwritten
 * @property string Name
 * @property string Description
 * @property int ItemIdAttachedTo
 * @property array _links
 */
class Attachment extends Entity
{
    protected $entities         = [
        'singular'                  => 'Attachment',
        'plural'                    => 'Attachments'
    ];

    protected $fields           = [
        'AttachmentData'            =>  null,
        'AllowExistingAttachmentToBeOverwritten' =>  false,
        'Name'                      =>  '',
        'Description'               =>  '',
        'ItemIdAttachedTo'          =>  null,
        '_links'                    =>  [],
    ];
}