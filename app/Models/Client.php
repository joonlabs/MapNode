<?php

namespace App\Models;

use Curfle\DAO\Model;
use Curfle\DAO\Relationships\OneToManyRelationship;

class Client extends Model
{

    public int $id;

    public function __construct(
        public ?string $name = null,
        public ?string $identifier = null,
        public ?float $map_latitude = null,
        public ?float $map_longitude = null,
        public ?int $map_zoom = null,
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
            "table" => "client",
        ];
    }

    /**
     * Returns the associated entries.
     *
     * @return OneToManyRelationship
     */
    public function entries() : OneToManyRelationship
    {
        return $this->hasMany(Entry::class);
    }
}