<?php

namespace Terah\Saasu\Values;

/**
 * Class BuildItem
 *
 * @package Terah\Saasu\Values
 */
class BuildItem extends Value
{
    /**
     * The unique Id/key of the item.
     * @var int
     */
    public $Id              = null;

    /**
     * The code of the item.
     * @var string
     */
    public $Code            = '';

    /**
     * The description of the item.
     * @var string
     */
    public $Description     = '';

    /**
     * The quantity on hand of the item.
     * @var float
     */
    public $Quantity        = null;

    /**
     * Hypermedia links.
     * Contains contextual links to possible next actions related to this resource.
     * Only present in responses.
     * This data is not to be sent to the server.
     * Collection of Link
     * @var array
     */
    public $_links          = [];
}
