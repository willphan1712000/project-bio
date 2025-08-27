<?php

namespace persistence\Entity;

use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\Table;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;

#[Entity]
#[Table('Template')]
class Template extends EntityFunction
{
    #[Id, Column(name: 'id'), GeneratedValue]
    protected int $id;
    #[Column(name: 'username')]
    protected string $username;
    #[Column(name: 'template_id')]
    protected int $template_id;
}
