<?php

namespace App\Http\Requests;

use App\Http\Responses\PunkAPIResponse;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Str;


/**
 * Returns all beers with ABV greater than the supplied number
 *
 * @see PunkAPIResponse::$abv
 * @return int|null
 *
 * @property-read null|int $abv_gt;
 * 
 *
 * Returns all beers with ABV less than the supplied number
 *
 * @see PunkAPIResponse::$abv
 * @var int|null
 *
 * @property-read null|int $abv_lt;
 * 
 *
 * Returns all beers with IBU greater than the supplied number
 *
 * @see PunkAPIResponse::$ibu
 * @var int|null
 *
 * @property-read null|int $ibu_gt;
 * 
 *
 * Returns all beers with IBU less than the supplied number
 *
 * @see PunkAPIResponse::$ibu
 * @var int|null
 *
 * @property-read null|int $ibu_lt;
 * 
 *
 * 	Returns all beers with EBC greater than the supplied number
 *
 * @see PunkAPIResponse::$ebc
 * @var int|null
 *
 * @property-read null|int $ebc_gt;
 * 
 *
 * Returns all beers with EBC less than the supplied number
 *
 * @see PunkAPIResponse::$ebc
 * @var int|null
 *
 * @property-read null|int $ebc_lt;
 * 
 *
 * Returns all beers matching the supplied name (this will match partial strings as well so e.g punk will
 * return Punk IPA).
 *
 * @see PunkAPIResponse::$name
 * @var string|null
 *
 * @property-read null|string $beer_name;
 * 
 *
 * Returns all beers matching the supplied yeast name, this performs a fuzzy match.
 *
 * @see PunkAPIResponse::$ingredients
 * @var string|null
 *
 * @property-read null|string $yeast;
 * 
 *
 * Returns all beers matching the supplied malt name, this performs a fuzzy match.
 *
 * @see PunkAPIResponse::$ingredients
 * @var string|null
 *
 * @property-read null|string $malt;
 * 
 *
 * Returns all beers matching the supplied hops name, this performs a fuzzy match.
 *
 * @see PunkAPIResponse::$ingredients
 * @var string|null
 *
 * @property-read null|string $hops;
 * 
 *
 * Returns all beers matching the supplied hops name, this performs a fuzzy match.
 *
 * @see PunkAPIResponse::$food_pairing
 * @var string|null
 *
 * @property-read null|string $food;
 * 
 *
 * Returns all beers brewed before this date, the date format is mm-yyyy e.g 10-2011
 *
 * @see PunkAPIResponse::$first_brewed
 * @var string|null
 *
 * @property-read null|string $brewed_before;
 * 
 *
 * Returns all beers brewed before this date, the date format is mm-yyyy e.g 10-2011
 *
 * @see PunkAPIResponse::$first_brewed
 * @var string|null
 *
 * @property-read null|string $brewed_after;
 * 
 *
 * Returns all beers matching the supplied ID's. You can pass in multiple ID's by separating them with a | symbol or in array.
 *
 * @var null|string|array
 *
 * @property-read null|string|array $ids;
 *
 * @property-read int $page
 *
 * @property-read int $per_page
 *
 */
class PunkAPIParams
{
    const PROPERTIES=[
        'page',
        'per_page',
        'abv_gt',
        'abv_lt',
        'ibu_gt',
        'ibu_lt',
        'ebc_gt',
        'ebc_lt',
        'beer_name',
        'yeast',
        'brewed_before',
        'brewed_after',
        'hops',
        'malt',
        'food',
        'ids'
    ];


    public function __construct(
        private array $array
    ) {}

    /**
     * @param $value
     * @return string|null
     */
    private function _getDate($value): ?string
    {
        return is_string($value) ? $value : ($value instanceof Carbon ? $value->format('m-Y') : null);
    }

    /**
     * @param string $name
     * @return string
     */
    public function __get(string $name)
    {
        if (!array_key_exists($name , $this->array)) {
            return match ($name) {
                'page' => 1,
                'per_page' => 25,
                default => null
            };
        }
        $value =  $this->array[$name];
        return match ($name) {
            'beer_name', 'yeast', 'hops', 'malt', 'food' => Str::slug($value, '_'),
            'brewed_before', 'brewed_after' => $this->_getDate($value),
            'ids' => is_array($value) ? join('|', $value) : (is_string($value) ? $value : null),
            default => $value
        };
    }

    /**
     * @return array
     */
    public function get(): array
    {
        $properties = self::PROPERTIES;
        $result = [];
        foreach ($properties as $property) {
            $value = $this->$property;
            if (!$value) {
                continue ;
            }
            $result[$property] = $value;
        }
        return $result;
    }
}