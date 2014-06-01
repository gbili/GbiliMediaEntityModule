<?php
return array(
    \Doctrine\ORM\Events::loadClassMetadata => array(
        array(
            // If some other module registered the same listener to the same event with the same params,
            // should it be overriden by this?
            'priority' => 0,
            // What is the listener class whose method these listeners_params should be passed to
            'listener_class' => '\Doctrine\ORM\Tools\ResolveTargetEntityListener',
            // What specific method will the params be passed to?
            'listener_method' => 'addResolveTargetEntity',
            // Every element is a set of params. Each will be passed to a new listener class instance
            'listeners_params' => array( 
                // the key is the identifier used to create a hash
                // array elements are params
                '\GbiliMediaEntityModule\Entity\MediaInterface' => array( 
                    '\GbiliMediaEntityModule\Entity\MediaInterface', 
                    '\GbiliMediaEntityModule\Entity\Media', 
                    array(),
                ),
                '\GbiliMediaEntityModule\Entity\MediaDataInterface' => array(
                    '\GbiliMediaEntityModule\Entity\MediaDataInterface', 
                    '\GbiliMediaEntityModule\Entity\MediaData', 
                    array(),
                ),
                '\GbiliMediaEntityModule\Entity\MediaMetadataInterface' => array(
                    '\GbiliMediaEntityModule\Entity\MediaMetadataInterface', 
                    '\GbiliMediaEntityModule\Entity\MediaMetadata', 
                    array(),
                ),
                '\GbiliMediaEntityModule\Entity\FileInterface' => array(
                    '\GbiliMediaEntityModule\Entity\FileInterface', 
                    '\GbiliMediaEntityModule\Entity\File', 
                    array(),
                ),
            ),
        ),
    ),
);
