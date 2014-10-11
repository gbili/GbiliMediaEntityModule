<?php
namespace GbiliMediaEntityModule\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="GbiliMediaEntityModule\Entity\Repository\Media")
 * @ORM\Table(name="gbilimem__medias")
 */
class Media extends BaseMedia
{
}
