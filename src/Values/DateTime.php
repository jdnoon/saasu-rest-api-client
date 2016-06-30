<?php

namespace Terah\Saasu\Values;

class DateTime extends \DateTime implements \JsonSerializable
{
    public function jsonSerialize()
    {
        return preg_replace('/[0-9]{3}$/', '', $this->format('Y-m-d\TH:i:s.u'));
    }
}