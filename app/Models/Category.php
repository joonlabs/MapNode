<?php

namespace App\Models;

use Curfle\DAO\Model;

class Category extends Model
{
    public int $id;

    /**
     * @param string|null $name
     * @param string|null $color
     */
    public function __construct(
        public ?string $name = null,
        public ?string $color = null,
    )
    {
    }

    /**
     * @inheritDoc
     */
    static function config(): array
    {
        return [
            "table" => "category",
        ];
    }
}