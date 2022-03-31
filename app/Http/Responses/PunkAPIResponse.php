<?php

namespace App\Http\Responses;

use Illuminate\Support\Carbon;
use JetBrains\PhpStorm\Pure;
use App\Models\Beer;

class PunkAPIResponse
{
    /**
     * @var int
     */
    public ?int $id = null;

    /**
     * @var ?string
     */
    public ?string $name = null;

    /**
     * @var ?string
     */
    public ?string $tagline = null;

    /**
     * Could be in format "m/Y" or "Y".
     *
     * @var ?string
     */
    public ?string $first_brewed = null;

    /**
     * @var ?string
     */
    public ?string $description = null;

    /**
     * @var ?string
     */
    public ?string $image_url = null;

    /**
     * Alcohol by volume
     *
     * @link https://en.wikipedia.org/wiki/Alcohol_by_volume
     * @var ?float
     */
    public ?float $abv = null;

    /**
     * International Bitterness Units
     *
     * @link https://en.wikipedia.org/wiki/Beer_measurement
     * @var ?float
     */
    public ?float $ibu = null;

    /**
     * Final Gravity
     *
     * @link https://beerandbrewing.com/dictionary/hX2U1Flmkp/
     * @link https://en.wikipedia.org/wiki/Gravity_(alcoholic_beverage)
     * @var ?float
     */
    public ?float $target_fg = null;

    /**
     * Original Gravity
     *
     * @link https://beerconnoisseur.com/articles/what-original-gravity
     * @link https://en.wikipedia.org/wiki/Gravity_(alcoholic_beverage)
     * @var ?float
     */
    public ?float $target_og = null;

    /**
     * European Brewery Convention
     *
     * @link https://en.wikipedia.org/wiki/European_Brewery_Convention
     * @var ?float
     */
    public ?float $ebc = null;

    /**
     * Standard Reference Method
     *
     * @link https://en.wikipedia.org/wiki/Standard_Reference_Method
     * @var ?float
     */
    public ?float $srm = null;

    /**
     * @link https://beerandbrewing.com/dictionary/qeh4iQVXXP/
     * @var ?float
     */
    public ?float $ph = null;

    /**
     * @link https://en.wikipedia.org/wiki/Attenuation_(brewing)
     * @var ?float
     */
    public ?float $attenuation_level = null;

    /**
     * @var array
     */
    public ?array $volume = null;

    /**
     * @var array
     */
    public ?array $boil_volume = null;

    /**
     * @var array
     */
    public ?array $method = null;

    /**
     * @var array
     */
    public ?array $ingredients = null;

    /**
     * @var array
     */
    public ?array $food_pairing = null;

    /**
     * @var ?string
     */
    public ?string $brewers_tips = null;

    /**
     * @var string|null
     */
    public ?string $contributed_by = null;

    /**
     * @param array $response
     */
    public function __construct(array $response = [])
    {
        foreach ($response as $key => $value) {
            $this->$key = $value;
        }
    }

    /**
     * @param array $response
     * @return Beer
     */
    #[Pure] public static function asBeer(array $response = []): Beer
    {
        return new Beer(new self($response));
    }
}