<?php

namespace Terah\Saasu;

use function Terah\Assert\Assert;
use Terah\Saasu\Values\RestableValue;

trait EntityFetchTrait
{
    use RestClientTrait;

    /**
     * @param string $keyedOn
     * @param string $valueField
     * @param array $filters
     * @return array
     * @throws \Exception
     */
    public function fetchList($keyedOn, $valueField, array $filters=[])
    {
        $results    = $this->fetch($filters);
        $data       = [];
        foreach ( $results as $idx => $item )
        {
            $data[$item->{$keyedOn}] = $item->{$valueField};
        }
        return $data;
    }

    /**
     * @param array $filters
     *
     * @return RestableValue[]
     */
    public function fetch(array $filters=[])
    {
        return $this->_fetchAll($filters);
    }

    /**
     * @param array $filters
     *
     * @return RestableValue[]
     */
    protected function _fetchAll(array $filters=[])
    {
        Assert($this->filters)->keysExist(array_keys($filters));

        $plural                 = $this->getPlural();
        $resultObjs             = [];
        $filters['pagesize']    = ! empty($filters['pagesize']) ? $filters['pagesize'] : 25;
        $filters['page']        = ! empty($filters['page']) ? $filters['page'] : 1;
        $maxIterations          = 100; // 2500 records
        $count                  = 0;
        while ( $count < $maxIterations )
        {
            $data           = $this->saasu->method(Client::FETCH)->data($filters)->sendRequest(strtolower($this->getPlural()));
            $linksData      = $data->_links;
            $data           = isset($data->{$plural}) ? $data->{$plural} : [];
            foreach ( $data as $idx => $item )
            {
                $resultObjs[] = $this->getValueObject($item);
            }
            if ( count($data) < $filters['pagesize'] )
            {
                return $resultObjs;
            }
            foreach ( $linksData as $linkObj )
            {
                if ( $linkObj->rel !== 'next' )
                {
                    continue;
                }
                $urlParts               = (object)parse_url($linkObj->href);
                parse_str($urlParts->query, $query);
                $filters['page']        = (int)$query['page'];
                $filters['pagesize']    = (int)$query['pagesize'];
            }
            $count++;
        }

        return $resultObjs;
    }
}