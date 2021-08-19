<?php

namespace App\Models;

use Curfle\DAO\Model;
use Curfle\DAO\Relationships\OneToOneRelationship;

class Message extends Model
{

    public int $id;

    /**
     * @param string|null $content
     * @param bool|null $commited
     * @param int|null $created
     */
    public function __construct(
        public ?string $content = null,
        public ?bool $commited = null,
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
            "table" => "myTable",
        ];
    }

    /**
     * Returns the associated citizen.
     *
     * @return OneToOneRelationship
     */
    public function entry(): OneToOneRelationship
    {
        return $this->hasOne(Entry::class);
    }

    /**
     * Returns the associated citizen.
     *
     * @return OneToOneRelationship
     */
    public function citizen(): OneToOneRelationship
    {
        return $this->hasOne(Citizen::class);
    }
}