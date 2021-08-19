<?php

namespace App\Models;

use Curfle\DAO\Model;
use Curfle\DAO\Relationships\OneToManyRelationship;
use Curfle\DAO\Relationships\OneToOneRelationship;

class User extends Model
{

    const ROLE_ADMIN = 1;
    const ROLE_USER = 2;

    public int $id;

    /**
     * @param string|null $firstname
     * @param string|null $lastname
     * @param string|null $email
     * @param int|null $role
     * @param int|null $client_id
     * @param int|null $created
     */
    public function __construct(
        public ?string $firstname = null,
        public ?string $lastname = null,
        public ?string $email = null,
        public ?int    $role = null,
        public ?int    $client_id = null,
        public ?int    $created = null,
    )
    {
    }

    /**
     * @inheritDoc
     */
    static function config(): array
    {
        return [
            "table" => "user",
        ];
    }

    /**
     * Returns the associated client.
     *
     * @return OneToOneRelationship
     */
    public function client(): OneToOneRelationship
    {
        return $this->hasOne(Client::class);
    }

    /**
     * Returns the associated tokens.
     *
     * @return OneToManyRelationship
     */
    public function tokens(): OneToManyRelationship
    {
        return $this->hasMany(Token::class);
    }
}