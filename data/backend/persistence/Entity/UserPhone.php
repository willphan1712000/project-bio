<?php

namespace persistence\Entity;

use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\Table;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;

#[Entity]
#[Table('UserPhone')]
class UserPhone extends EntityFunction
{
    #[Id, Column(name: 'username', nullable: false)]
    protected $username;

    #[Column(name: 'Mobile', nullable: true)]
    protected ?string $Mobile;
    #[Column(name: 'MobileCode', nullable: true)]
    protected ?string $MobileCode;
    #[Column(name: 'MobileFlag', nullable: true)]
    protected ?string $MobileFlag;

    #[Column(name: 'Work', nullable: true)]
    protected ?string $Work;
    #[Column(name: 'WorkCode', nullable: true)]
    protected ?string $WorkCode;
    #[Column(name: 'WorkFlag', nullable: true)]
    protected ?string $WorkFlag;

    #[Column(name: 'HotLine', nullable: true)]
    protected ?string $HotLine;
    #[Column(name: 'HotLineCode', nullable: true)]
    protected ?string $HotLineCode;
    #[Column(name: 'HotLineFlag', nullable: true)]
    protected ?string $HotLineFlag;

    #[Column(name: 'Viber', nullable: true)]
    protected ?string $Viber;
    #[Column(name: 'ViberCode', nullable: true)]
    protected ?string $ViberCode;
    #[Column(name: 'ViberFlag', nullable: true)]
    protected ?string $ViberFlag;

    #[Column(name: 'Whatsapp', nullable: true)]
    protected ?string $Whatsapp;
    #[Column(name: 'WhatsappCode', nullable: true)]
    protected ?string $WhatsappCode;
    #[Column(name: 'WhatsappFlag', nullable: true)]
    protected ?string $WhatsappFlag;
}
