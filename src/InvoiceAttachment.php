<?php

namespace Terah\Saasu;
use Terah\Saasu\Values\FileAttachmentInfo;
use function Terah\Assert\Assert;
use Terah\Saasu\Values\RestableValue;

/**
 * Class InvoiceAttachment
 *
 * @package Terah\Saasu
 */
class InvoiceAttachment extends Entity
{
    use EntityFetchOneTrait;
    use EntityFetchTrait;
    use EntityCreateTrait;
    use EntityDeleteTrait;

    protected $singularAttribute    = 'InvoiceAttachment';
    protected $pluralAttribute      = 'InvoiceAttachments';
    protected $filters              = [];

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
        $this->pluralAttribute = "Attachments/{$filters['InvoiceId']}";
        unset($filters['InvoiceId']);
        return $this->_fetchAll($filters);
    }
}