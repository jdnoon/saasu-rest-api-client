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

class Response
{
    protected $code     = null;
    protected $error    = null;
    protected $data     = [];

    public function __construct($code, array $data=[], $error=null)
    {
        $this->code     = $code;
        $this->data     = $data;
        $this->error    = $error;
    }
}