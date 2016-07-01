<?php
/**
  * @package Terah\Saasu
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 * @author        Terry Cullen - terry@terah.com.au
 */
namespace Terah\Saasu;

/**
 * Class Entity
 *
 * @package Terah\Saasu
 */
abstract class Entity
{å
    /** @var RestClient */
    protected $saasu                = null;
    protected $filters              = [];
    protected $pluralAttribute      = '';
    protected $singularAttribute    = '';

    public function __construct(RestClient $saasu)
    {
        $this->saasu = $saasu;
    }

    /**
     * @return string
     */
    public function getPlural()
    {
        Assert($this->pluralAttribute)->notEmpty();
        return $this->pluralAttribute;
    }


    /**
     * @param null|int $id
     * @return string
     */
    public function getSingular($id=null)
    {
        Assert($this->singularAttribute)->notEmpty();
        $idReference = $id ? "/{$id}" : '';
        return $this->singularAttribute . $idReference;
    }

    /**
     * @return $this
     */
    public function reset()
    {
        $this->saasu->reset();
        return $this;
    }

    /**
     * @param $data
     * @return Value
     */
    abstract protected function getValueObject(\stdClass $data);

}