<?php

namespace App\Models;

use Curfle\DAO\Model;
use Curfle\DAO\Relationships\OneToOneRelationship;

class Nachricht extends Model
{

    public int $id;

    /**
     * @param string|null $inhalt
     * @param bool|null $bestaetigt
     * @param string|null $erstellt
     * @param bool|null $namen_veroeffentlichen
     * @param bool|null $nachricht_bei_interaktion
     */
    public function __construct(
        public ?string $inhalt = null,
        public ?bool $bestaetigt = null,
        public ?string $erstellt = null,
        public ?bool $namen_veroeffentlichen = null,
        public ?bool $nachricht_bei_interaktion = null,
    )
    {
    }

    /**
     * @inheritDoc
     */
    static function config(): array
    {
        return [
            "table" => "nachricht",
        ];
    }

    /**
     * Returns the associated citizen.
     *
     * @return OneToOneRelationship
     */
    public function eintrag(): OneToOneRelationship
    {
        return $this->hasOne(Eintrag::class);
    }

    /**
     * Returns the associated citizen.
     *
     * @return OneToOneRelationship
     */
    public function buerger(): OneToOneRelationship
    {
        return $this->hasOne(Buerger::class);
    }
}