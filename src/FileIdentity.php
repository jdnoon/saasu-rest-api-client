<?php

namespace Terah\Saasu;

use Terah\Saasu\Values\FileIdentityDetail;

use function Terah\Assert\Assert;

/**
 * Class FileIdentity
 *
 * @package Terah\Saasu
 */
class FileIdentity extends Entity
{
    use EntityFetchOneTrait;
    use EntityFetchTrait;

    protected $singularAttribute    = 'FileIdentity';
    protected $pluralAttribute      = 'FileIdentities';

    /**
     * @var array
     */
    protected $filters           = [
        //	Specifies the page number of the result set to return.	integer	None.
        'Page'                      => null,
        //	Specifies the number of records on each page of results.
        // Maximum page size is 100. Defaults to 25 if not specified.	integer	None.
        'PageSize'                  => null,
    ];

    /**
     * @param null|int $id
     * @return string
     */
    public function getSingular($id=null)
    {
        Assert($this->singularAttribute)->notEmpty();
        return $this->singularAttribute;
    }

    /**
     * @param \stdClass $data
     * @return FileIdentityDetail
     */
    protected function getValueObject(\stdClass $data)
    {
        return new FileIdentityDetail($data);
    }
}


