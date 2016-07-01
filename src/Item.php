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
    protected $filters              = [];

    /**
     * @param \stdClass $data
     * @return ItemDetail
     */
    protected function getValueObject(\stdClass $data)
    {
        return new ItemDetail($data);
    }
}
