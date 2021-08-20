<?php

namespace App\Models;

use Curfle\DAO\Model;
use Curfle\DAO\Relationships\OneToManyRelationship;

class Mandant extends Model
{

    public int $id;

    /**
     * @param string|null $name
     * @param string|null $kennung
     * @param float|null $karte_latitude
     * @param float|null $karte_longitude
     * @param int|null $karte_zoom
     * @param int|null $erstellt
     */
    public function __construct(
        public ?string $name = null,
        public ?string $kennung = null,
        public ?float $karte_latitude = null,
        public ?float $karte_longitude = null,
        public ?int $karte_zoom = null,
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
            "table" => "mandant",
        ];
    }

    /**
     * Returns the associated entries.
     *
     * @return OneToManyRelationship
     */
    public function eintraege() : OneToManyRelationship
    {
        return $this->hasMany(Eintrag::class);
    }
}