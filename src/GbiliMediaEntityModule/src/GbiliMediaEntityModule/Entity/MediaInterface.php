<?php
namespace GbiliMediaEntityModule\Entity;

interface MediaInterface
{
    public function getId();

    public function setSlug($slug);

    public function getSlug();

    public function setUser(\GbiliUserModule\Entity\UserInterface $user);

    public function getUser();

    public function getUri();

    public function getType();

    public function getSize();

    public function setDate(\DateTime $time);

    public function getDate();

    public function getSrc();

    public function setPublicdir($publicdir);

    public function getPublicdir();

    public function setFile(FileInterface $file);

    public function getFile();

    public function setLocale($locale);

    public function hasLocale();

    public function getLocale();

    public function addData(MediaDataInterface $data);

    public function addDatas(\Doctrine\Common\Collections\Collection $datas);

    public function removeAllDatas();

    public function removeDatas(\Doctrine\Common\Collections\Collection $datas);

    public function getDatas();

    public function addMetadata(MediaMetadataInterface $metadata);

    public function addMetadatas(\Doctrine\Common\Collections\Collection $metadatas);

    public function removeAllMetadatas();

    public function removeMetadatas(\Doctrine\Common\Collections\Collection $metadatas);

    public function getMetadatas();

    public function getLocalizedMetadata($locale);

    public function hasLocalizedMetadata($locale);
}
