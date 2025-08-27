<?php

namespace persistence\Entity;

use DateTime;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\Table;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;

#[Entity]
#[Table('User')]
class User extends EntityFunction
{
    #[Id, Column(name: 'username', nullable: false)]
    protected string $username;

    #[Column(name: 'password', nullable: false)]
    protected string $password;

    #[Column(name: 'email', nullable: false)]
    protected string $email;

    #[Column(name: 'token', nullable: true)]
    protected ?string $token;

    #[Column(name: 'deleteToken', nullable: true)]
    protected ?string $deleteToken;

    #[Column(name: 'defaultTemplate', nullable: false)]
    protected int $defaultTemplate;

    #[Column(name: 'createdAt', type: 'datetime')]
    protected DateTime $createdAt;

    function __construct()
    {
        $this->createdAt = new DateTime();
    }
}
