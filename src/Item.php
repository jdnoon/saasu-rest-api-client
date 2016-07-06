<?php


namespace Terah\Saasu;

use Terah\Saasu\Values\ItemDetail;

/**
 * Class Item
 *
 * @package Terah\Saasu
 */
class Item extends Entity
{
    use EntityFetchOneTrait;
    use EntityFetchTrait;
    use EntityCreateTrait;
    use EntityUpdateTrait;
    use EntityDeleteTrait;

    protected $singularAttribute    = 'Item';
    protected $pluralAttribute      = 'Items';
    protected $filters              = [
        // Filter item records by type.	string
        'ItemType'                      => null,
        // Filter item records by specifying search method to search which can be either 'Contains' or 'StartsWith' and searches on the code or description.	string
        'SearchMethod'                  => null,
        // Filter item records by specifying text to search for in code or description.	string
        'SearchText'                    => null,
        // Specifies the page number of the result set to return.	integer
        'Page'                          => null,
        // Specifies the number of records on each page of results. Maximum page size is 100. Defaults to 25 if not specified.	integer
        'PageSize'                      => null,
    ];

    /**
     * @param \stdClass $data
     * @return ItemDetail
     */
    protected function getValueObject(\stdClass $data)
    {
        return new ItemDetail($data);
    }
}
