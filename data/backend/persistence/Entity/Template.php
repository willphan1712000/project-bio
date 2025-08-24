<?php

namespace persistence\Entity;

use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\Table;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;

#[Entity]
#[Table('Template')]
class Template extends EntityFunction
{
    #[Id, Column(name: 'username')]
    protected string $username;
    #[Id, Column(name: 'template_id')]
    protected int $template_id;
}
