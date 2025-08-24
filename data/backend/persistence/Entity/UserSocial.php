<?php

namespace persistence\Entity;

use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\Table;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;

#[Entity]
#[Table('UserSocial')]
class UserSocial extends EntityFunction
{
    #[Id, Column(name: 'username', nullable: false)]
    protected $username;

    #[Column(name: 'Facebook', nullable: true)]
    protected ?string $Facebook;
    #[Column(name: 'Instagram', nullable: true)]
    protected ?string $Instagram;
    #[Column(name: 'Messenger', nullable: true)]
    protected ?string $Messenger;
    #[Column(name: 'X', nullable: true)]
    protected ?string $X;
    #[Column(name: 'Tiktok', nullable: true)]
    protected ?string $Tiktok;
    #[Column(name: 'Youtube', nullable: true)]
    protected ?string $Youtube;
    #[Column(name: 'Threads', nullable: true)]
    protected ?string $Threads;
    #[Column(name: 'Linkedin', nullable: true)]
    protected ?string $Linkedin;
    #[Column(name: 'Pinterest', nullable: true)]
    protected ?string $Pinterest;
    #[Column(name: 'Zalo', nullable: true)]
    protected ?string $Zalo;
    #[Column(name: 'Booking', nullable: true)]
    protected ?string $Booking;
    #[Column(name: 'OrderOnline', nullable: true)]
    protected ?string $OrderOnline;
    #[Column(name: 'HotSale', nullable: true)]
    protected ?string $HotSale;
    #[Column(name: 'Website', nullable: true)]
    protected ?string $Website;
    #[Column(name: 'Menu', nullable: true)]
    protected ?string $Menu;
    #[Column(name: 'Zillow', nullable: true)]
    protected ?string $Zillow;
    #[Column(name: 'Realtor', nullable: true)]
    protected ?string $Realtor;
}
