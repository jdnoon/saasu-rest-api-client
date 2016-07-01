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
{
    use RestClientTrait;

    public function __construct(RestClient $saasu)
    {
        $this->saasu = $saasu;
    }
}