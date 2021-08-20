<?php

namespace App\Models;

use Curfle\DAO\Model;

class Buerger extends Model
{
    public int $id;

    /**
     * @param string|null $vorname
     * @param string|null $nachname
     * @param string|null $email
     * @param string|null $strasse
     * @param string|null $hausnummer
     * @param string|null $stadt
     * @param int|null $plz
     * @param string|null $telefon
     * @param int|null $erstellt
     */
    public function __construct(
        public ?string $vorname = null,
        public ?string $nachname = null,
        public ?string $email = null,
        public ?string $strasse = null,
        public ?string $hausnummer = null,
        public ?string $stadt = null,
        public ?int $plz = null,
        public ?string $telefon = null,
        public ?string $erstellt = null,
    )
    {
    }

    /**
     * @inheritDoc
     */
    static function config(): array
    {
        return [
            "table" => "buerger",
        ];
    }
}