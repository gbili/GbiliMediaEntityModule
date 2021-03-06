<?php
namespace GbiliMediaEntityModule\Entity;

interface MediaInterface
{
    public function getId();

    public function setSlug($slug);

    public function getSlug();

    public function setUser(\GbiliUserModule\Entity\UserInterface $user);

    public function getUser();

    public function hasUser();

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
}
