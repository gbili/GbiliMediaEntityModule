<?php
namespace GbiliMediaEntityModule\Entity;

interface MediaMetadataInterface 
{
    public function getId();

    public function setMedia(MediaInterface $media=null);

    public function getMedia();

    public function hasMedia();

    public function setAlt($alt);

    public function getAlt();

    public function setDescription($description=null);

    public function getDescription();

    public function setLocale($locale);

    public function hasLocale();

    public function getLocale();
}
