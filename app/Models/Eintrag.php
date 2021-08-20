<?php

namespace App\Models;

use Curfle\DAO\Model;
use Curfle\DAO\Relationships\OneToManyRelationship;
use Curfle\DAO\Relationships\OneToOneRelationship;

class Eintrag extends Model
{

    public int $id;

    /**
     * @param string|null $name
     * @param string|null $inhalt
     * @param float|null $latitude
     * @param float|null $longitude
     * @param string|null $email
     * @param bool|null $bestaetigt
     * @param bool|null $chat_verfuegbar
     * @param int|null $erstellt
     */
    public function __construct(
        public ?string $name = null,
        public ?int $status = null,
        public ?string $inhalt = null,
        public ?float $latitude = null,
        public ?float $longitude = null,
        public ?bool $bestaetigt = null,
        public ?bool $chat_verfuegbar = null,
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
            "table" => "eintrag",
        ];
    }

    /**
     * Returns the associated category.
     *
     * @return OneToOneRelationship
     */
    public function kategorie(): OneToOneRelationship
    {
        return $this->hasOne(Kategorie::class);
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
     * Returns the associated messages.
     *
     * @return OneToManyRelationship
     */
    public function nachrichten() : OneToManyRelationship
    {
        return $this->hasMany(Nachricht::class);
    }
}