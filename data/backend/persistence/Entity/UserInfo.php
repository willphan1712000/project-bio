<?php

namespace persistence\Entity;

use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\Table;

#[Entity]
#[Table('UserInfo')]
class UserInfo extends EntityFunction
{
    #[Id, Column(name: 'username', nullable: false)]
    protected $username;

    #[Column(name: 'name', nullable: true)]
    protected ?string $name;

    #[Column(name: 'image', nullable: true)]
    protected ?string $image;

    #[Column(name: 'organization', nullable: true)]
    protected ?string $organization;

    #[Column(name: 'position', nullable: true)]
    protected ?string $position;

    #[Column(name: 'description', nullable: true)]
    protected ?string $description;

    #[Column(name: 'Email', nullable: true)]
    protected ?string $Email;

    #[Column(name: 'Address', nullable: true)]
    protected ?string $Address;
}
