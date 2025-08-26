<?php

namespace persistence\Entity;

use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\Table;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;

#[Entity()]
#[Table('Style')]
class Style extends EntityFunction
{
    #[Id, Column(name: 'id'), GeneratedValue]
    protected int $id;
    #[Column(name: 'element')]
    protected string $element;
    #[Column(name: 'username')]
    protected string $username;
    #[Column(name: 'template_id')]
    protected int $template_id;
    #[Column(name: 'font')]
    protected string $font;
    #[Column(name: 'fontSize')]
    protected string $fontSize;
    #[Column(name: 'fontColor')]
    protected string $fontColor;
    #[Column(name: 'background')]
    protected string $background;
}
