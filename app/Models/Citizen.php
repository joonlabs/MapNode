<?php

namespace App\Models;

use Curfle\DAO\Model;

class Citizen extends Model
{
    public int $id;

    /**
     * @param string|null $firstname
     * @param string|null $lastname
     * @param string|null $email
     * @param string|null $street
     * @param string|null $housenumber
     * @param string|null $city
     * @param int|null $zip
     * @param string|null $phone
     * @param int|null $created
     */
    public function __construct(
        public ?string $firstname = null,
        public ?string $lastname = null,
        public ?string $email = null,
        public ?string $street = null,
        public ?string $housenumber = null,
        public ?string $city = null,
        public ?int $zip = null,
        public ?string $phone = null,
        public ?int $created = null,
    )
    {
    }

    /**
     * @inheritDoc
     */
    static function config(): array
    {
        return [
            "table" => "citizen",
        ];
    }
}