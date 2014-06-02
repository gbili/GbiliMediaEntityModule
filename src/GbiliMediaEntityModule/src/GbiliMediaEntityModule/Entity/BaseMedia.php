<?php
namespace GbiliMediaEntityModule\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\MappedSuperclass
 */
class BaseMedia implements 
    MediaInterface,
    \GbiliUserModule\IsOwnedByInterface
{
    /**
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="\GbiliUserModule\Entity\UserInterface", cascade={"persist"})
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $user;

    /**
     * @ORM\Column(name="slug", type="string", length=64)
     */
    private $slug;

    /**
     * @ORM\Column(name="publicdir", type="string", length=64)
     */
    private $publicdir;

    /**
     * @ORM\ManyToOne(targetEntity="\GbiliMediaEntityModule\Entity\FileInterface")
     * @ORM\JoinColumn(name="file_id", referencedColumnName="id", onDelete="CASCADE")
     */
    private $file;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime", nullable=false)
     */
    private $date;

    public function __construct()
    {
        $this->metadatas = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function getId()
    {
        return $this->id;
    }

    public function setSlug($slug)
    {
        $this->slug = $slug;
    }

    public function getSlug()
    {
        return $this->slug;
    }

    public function setUser(\GbiliUserModule\Entity\UserInterface $user)
    {
        $this->user = $user;
        return $this;
    }

    public function getUser()
    {
        if ($this->hasUser()) {
            throw new \Exception('Media has no user associated');
        }
        return $this->user;
    }

    public function hasUser()
    {
        return null !== $this->user;
    }

    public function getUri()
    {
        return $this->getFile()->getUri();
    }

    public function getType()
    {
        return $this->getFile()->getType();
    }

    public function getSize()
    {
        return $this->getFile()->getSize();
    }

   /**
    * @ORM\PrePersist
    */
    public function setDate(\DateTime $time)
    {
        $this->date = $time;
    }

   /**
    * Get Created Date
    *
    * @return \DateTime
    */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Handy method to get the src attribute
     * @return string
     */
    public function getSrc()
    {
        return $this->getPublicdir() . '/' . $this->getFile()->getBasename();
    }

    /**
     * Directory from which image is publicly
     * accessible
     */
    public function setPublicdir($publicdir)
    {
        $this->publicdir = $publicdir;
        return $this;
    }

    public function getPublicdir()
    {
        return $this->publicdir;
    }

    public function setFile(FileInterface $file)
    {
        $this->file = $file;
    }

    public function getFile()
    {
        return $this->file;
    }

    public function setLocale($locale)
    {
        $this->locale = $locale;
    }

    public function hasLocale()
    {
        return null !== $this->locale;
    }

    public function getLocale()
    {
        return $this->locale;
    }

    public function isOwnedBy(\GbiliUserModule\Entity\UserInterface $user)
    {
        return $this->getUser() === $user;
    }
}
