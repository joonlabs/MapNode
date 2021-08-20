<?php

namespace App\Models;

use Curfle\DAO\Model;

class Kategorie extends Model
{
    public int $id;

    /**
     * @param string|null $name
     * @param string|null $farbe
     */
    public function __construct(
        public ?string $name = null,
        public ?string $farbe = null,
    )
    {
    }

    /**
     * @inheritDoc
     */
    static function config(): array
    {
        return [
            "table" => "kategorie",
        ];
    }
}