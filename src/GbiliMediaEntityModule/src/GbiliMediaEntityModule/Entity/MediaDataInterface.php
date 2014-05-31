<?php
namespace GbiliMediaEntityModule\Entity;

interface MediaDataInterface 
{
    public function getId();

    public function setMedia(MediaInterface $media=null);

    public function getMedia();

    public function hasMedia();
}
