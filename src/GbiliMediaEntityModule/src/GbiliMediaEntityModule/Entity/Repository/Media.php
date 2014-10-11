<?php
namespace GbiliMediaEntityModule\Entity\Repository;

class Media extends \Doctrine\ORM\EntityRepository
{
    /**
     * contains key value pairs of target -> slug
     * Where slug is the media slug, and target
     * is what you pass to getDefaultMedia(target) 
     *
     * @var array
     */
    protected $config;

    public function setConfig(array $config) {
        $this->config = $config;
        return $this;
    }

    /**
     * Get the default media for the type of entity
     * passed as parameter
     * @param string $target default media for what? Can be an entity name
     * @return media
     * @throws \Exception when not enough config, 
     * @throws \Exception config not mapping to existing media slug
     */
    public function getDefaultMedia($target='fallback')
    {
        if (!isset($this->config[$target]) {
            throw new \Exception('Missing default media slug in config');
        }

        $slug = $this->config[$target];
        $media = $this->findBySlug($slug);

        if (!$media) {
            throw new \Exception('The default media set in config, does not exist for: ' . $target) . '. Slug is ' . $slug);
        }
        return current($media);
    }

    public function getDefaultFile($entity=null)
    {
        $media = $this->getDefaultMedia($entity);
        return $media->getFile();
    }
}
