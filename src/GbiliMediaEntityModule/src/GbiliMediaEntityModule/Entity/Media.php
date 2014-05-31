<?php
namespace GbiliMediaEntityModule\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="gbilimem__medias")
 */
class Media implements 
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
     * @ORM\ManyToOne(targetEntity="\GbiliUserModule\Entity\UserDataInterface", inversedBy="medias", cascade={"persist"})
     * @ORM\JoinColumn(name="userdata_id", referencedColumnName="id")
     */
    private $userdata;

    /**
     * @ORM\Column(name="slug", type="string", length=64)
     */
    private $slug;

    /**
     * @ORM\Column(name="publicdir", type="string", length=64)
     */
    private $publicdir;

    /**
     * The media is linked to this post
     * @ORM\OneToMany(targetEntity="\GbiliMediaEntityModule\Entity\MediaDataInterface", mappedBy="media", cascade={"persist"})
     */
    private $datas;

    /**
     * @ORM\ManyToOne(targetEntity="\GbiliMediaEntityModule\Entity\FileInterface", inversedBy="medias")
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
        $this->datas = new \Doctrine\Common\Collections\ArrayCollection();
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
        $this->userdata = $user->getData();
        return $this;
    }

    public function getUser()
    {
        return $this->userdata->getUser();
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
     * Heavy: n^2
     * TODO find a better solution for uniqueness of localized data
     */
    public function addData(MediaData $data)
    {
        if ($data->hasMedia()) {
            throw new \Exception(
                ($data->getMedia() === $this)
                    ? 'This data already has a different media' 
                    : 'addData will set the media so dont set it yourself'
            );
        }

        if (!$data->hasLocale()) {
            throw new \Exception('Data needs to have a locale');
        }

        if ($this->hasLocalizedData($data->getLocale())) {
            throw new \Exception('Only one data per locale');
        }

        $data->setMedia($this);
        $this->datas->add($data);
    }

    public function addDatas(\Doctrine\Common\Collections\Collection $datas)
    {
        foreach ($datas as $data) {
            $this->addData($data);
        }
    }

    public function removeAllDatas()
    {
        $this->removeDatas($this->getDatas());
    }

    public function removeDatas(\Doctrine\Common\Collections\Collection $datas)
    {
        foreach ($datas as $data) {
            $this->removeData($data);
        }
    }

    public function getDatas()
    {
        return $this->datas;
    }

    public function getLocalizedData($locale)
    {
        foreach ($this->datas->toArray() as $existingMeta)  {
            if ($existingMeta->getLocale() === $locale) {
                return $existingMeta;
            }
        }
        return null;
    }

    public function hasLocalizedData($locale)
    {
        return null !== $this->getLocalizedData($locale);
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
        return $this->userdata->getUser() === $user;
    }
}
