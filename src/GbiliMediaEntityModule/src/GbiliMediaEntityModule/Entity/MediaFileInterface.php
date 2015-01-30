<?php
namespace GbiliMediaEntityModule\Entity;

interface MediaFileInterface
{
    public function getMedias();
    public function addMedia(MediaInterface $media);
    public function addMedias(\Doctrine\Common\Collections\Collection $medias);
    public function unlinkMedias(\Doctrine\Common\Collections\Collection $medias, $newFile=null);
    public function unlinkMedia(MediaInterface $media, $newFile=null);
}
