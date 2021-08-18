<?php

namespace App\Models;

use Curfle\DAO\Model;

class User extends Model
{

    public int $id;
    public string $firstname;
    public string $lastname;
    public string $email;

    /**
     * @param string|null $firstname
     * @param string|null $lastname
     * @param string|null $email
     */
    public function __construct(string $firstname = null, string $lastname = null, string $email = null)
    {
        $this->firstname = $firstname;
        $this->lastname = $lastname;
        $this->email = $email;
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
}