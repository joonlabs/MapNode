<?php

namespace App\Models;

use Curfle\DAO\AuthenticatableModel;
use Curfle\DAO\Relationships\OneToManyRelationship;
use Curfle\DAO\Relationships\OneToOneRelationship;

class Benutzer extends AuthenticatableModel
{

    const ROLE_ADMIN = 1;
    const ROLE_USER = 2;

    public int $id;

    /**
     * @param string|null $vorname
     * @param string|null $nachname
     * @param string|null $email
     * @param int|null $benutzerrolle
     * @param int|null $mandant_id
     * @param string|null $erstellt
     */
    public function __construct(
        public ?string $vorname = null,
        public ?string $nachname = null,
        public ?string $email = null,
        public ?int    $benutzerrolle = null,
        public ?int    $mandant_id = null,
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
            "table" => "benutzer",
        ];
    }

    /**
     * Returns the associated mandant.
     *
     * @return OneToOneRelationship
     */
    public function mandant(): OneToOneRelationship
    {
        return $this->hasOne(Mandant::class);
    }

    /**
     * @return string
     */
    protected static function getPasswordColumnForAuth(): string
    {
        // change "password" to "passwort"
        return "passwort";
    }
}