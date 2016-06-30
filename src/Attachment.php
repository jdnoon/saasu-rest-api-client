<?php

namespace Terah\Saasu;
use Terah\Saasu\Values\FileAttachmentInfo;
use function Terah\Assert\Assert;
use Terah\Saasu\Values\RestableValue;

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
        'singular'                  => 'InvoiceAttachment',
        'plural'                    => 'InvoiceAttachments'
    ];

    protected $filters          = [];

    /**
     * @param \stdClass $data
     * @return FileAttachmentInfo
     */
    protected function getValueObject(\stdClass $data)
    {
        return new FileAttachmentInfo($data);
    }

    /**
     * @param array $filters
     *
     * @return RestableValue[]
     */
    public function fetch(array $filters=[])
    {
        Assert($filters)->keyExists('InvoiceId');
        Assert($filters['InvoiceId'])->id();
        $this->entities['plural'] = "Attachments/{$filters['InvoiceId']}";
        unset($filters['InvoiceId']);
        return parent::fetch($filters);
    }
}