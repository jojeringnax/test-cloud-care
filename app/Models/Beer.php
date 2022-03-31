<?php

namespace App\Models;

use App\Http\Responses\PunkAPIResponse;
use Illuminate\Support\Carbon;

/**
 * @property
 */
class Beer
{
    /**
     * @param PunkAPIResponse|null $punkAPIResponse
     */
    public function __construct(
        private ?PunkAPIResponse $punkAPIResponse = null
    )
    {}

    /**
     * @param PunkAPIResponse $punkAPIResponse
     */
    public function setResponse(PunkAPIResponse $punkAPIResponse): void
    {
        $this->punkAPIResponse = $punkAPIResponse;
    }

    /**
     * @param string $name
     * @return mixed
     */
    public function __get(string $name)
    {
        if (!$this->punkAPIResponse || !isset($this->punkAPIResponse->$name)) {
            return null;
        }
        if ($name === 'first_brewed') {
            /**
             * @see PunkAPIResponse::$first_brewed
             */
            $value = $this->punkAPIResponse->first_brewed;
            $split = preg_split('/\//', $value);
            return match (count($split)) {
                1 => (new Carbon)->setDate($value, 1, 1),
                2 => Carbon::createFromFormat('m/Y', $value),
                default => null,
            };
        }
        return $this->punkAPIResponse->$name;
    }
}