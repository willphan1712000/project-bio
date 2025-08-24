<?php

namespace persistence\Entity;

use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\Table;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;

#[Entity]
#[Table('Purchase')]
class Purchase extends EntityFunction
{
    #[Id, Column(name: 'purchase_id'), GeneratedValue]
    protected int $purchase_id;
    #[Column(name: 'username')]
    protected string $username;
    #[Column(name: 'subtotal', type: 'decimal', precision: 10, scale: 2)]
    protected float $subtotal;
    #[Column(name: 'total', type: 'decimal', precision: 10, scale: 2)]
    protected float $total;
    #[Column(name: 'purchasedAt')]
    protected \DateTime $purchasedAt;

    function __construct()
    {
        $this->purchasedAt = new \Datetime();
    }
}
