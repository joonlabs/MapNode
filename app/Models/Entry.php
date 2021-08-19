<?php

namespace App\Models;

use Curfle\DAO\Model;
use Curfle\DAO\Relationships\OneToManyRelationship;
use Curfle\DAO\Relationships\OneToOneRelationship;

class Entry extends Model
{

    public int $id;

    /**
     * @param string|null $name
     * @param string|null $content
     * @param float|null $latitude
     * @param float|null $longitude
     * @param string|null $email
     * @param bool|null $commited
     * @param bool|null $chat_available
     * @param int|null $created
     */
    public function __construct(
        public ?string $name = null,
        public ?string $content = null,
        public ?float $latitude = null,
        public ?float $longitude = null,
        public ?string $email = null,
        public ?bool $commited = null,
        public ?bool $chat_available = null,
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
            "table" => "entry",
        ];
    }

    /**
     * Returns the associated category.
     *
     * @return OneToOneRelationship
     */
    public function category(): OneToOneRelationship
    {
        return $this->hasOne(Category::class);
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

    /**
     * Returns the associated messages.
     *
     * @return OneToManyRelationship
     */
    public function messages() : OneToManyRelationship
    {
        return $this->hasMany(Message::class);
    }
}