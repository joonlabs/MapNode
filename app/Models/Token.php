<?php

namespace App\Models;

use Curfle\DAO\Model;

class Token extends Model
{

    public int $id;

    public function __construct(
        public ?string $value = null,
    )
    {
    }

    /**
     * @inheritDoc
     */
    static function config(): array
    {
        return [
            "table" => "myTable",
        ];
    }
}