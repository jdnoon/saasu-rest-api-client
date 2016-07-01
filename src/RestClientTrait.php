<?php
namespace Terah\Saasu;

use function Terah\Assert\Assert;
use Terah\Saasu\Values\Value;

trait RestClientTrait
{
    /** @var RestClient */
    protected $saasu                = null;
    protected $filters              = [];
    protected $pluralAttribute      = '';
    protected $singularAttribute    = '';


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