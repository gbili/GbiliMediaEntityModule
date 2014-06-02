<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/zf2 for the canonical source repository
 * @copyright Copyright (c) 2005-2013 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace GbiliMediaEntityModule\Controller\Plugin;

/**
 *
 */
class MediaEntityCreator extends \Zend\Mvc\Controller\Plugin\AbstractPlugin
{
    /**
     * Create medias from array of GbiliMediaEntityModule\Entity\File 
     *
     * @param array $files instances of GbiliMediaEntityModule\Entity\File 
     */
    public function __invoke(array $files = array())
    {
        $controller = $this->getController();
        $objectManager = $controller->em();
        $config        = $controller->getServiceLocator()->get('Config');
        $publicDir     = $config['file_uploader']['constants']['IMAGES_SRC_DIRPATH'];
        $locale        = $controller->locale();

        $mediaEntityClassMetadata = $objectManager->getClassMetadata('\GbiliMediaEntityModule\Entity\Media')->associationMappings;
        $mediaMetadataClassname = '\\' . $mediaEntityClassMetadata['metadatas']['targetEntity'];
        $mediaUserdataClassname = '\\' . $mediaEntityClassMetadata['userdata']['targetEntity'];
        
        $user = $controller->identity();
        
        if (!$user->hasData()) {
            $userdata = new $mediaUserdataClassname();
            $user->setData($userdata);
            $objectManager->persist($user);
        }

        $createdMedias = array();
        foreach ($files as $file) {
            $media = new \GbiliMediaEntityModule\Entity\Media();
            $metadata = new $mediaMetadataClassname();

            $basename = $file->getBasename();
            $metadata->setAlt($basename);
            $metadata->setLocale($locale);

            $media->addMetadata($metadata);
            $media->setSlug($basename);
            $media->setFile($file);
            $media->setPublicdir($publicDir);
            $media->setDate(new \DateTime());
            $media->setUserData($userdata);

            $objectManager->persist($media);
            $objectManager->flush();

            $createdMedias[] = $media;
        }
        return $createdMedias;
    }
}
