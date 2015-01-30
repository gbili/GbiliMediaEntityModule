<?php
namespace GbiliMediaEntityModule\Form;

class MediaEditor extends \Zend\Form\Form 
{
    public function __construct(\Doctrine\Common\Persistence\ObjectManager $objectManager)
    {
        parent::__construct('form-media-edit');

        // The form will hydrate an object of type Post
        $this->setHydrator(new \DoctrineModule\Stdlib\Hydrator\DoctrineObject($objectManager));
        
        //Add the user fieldset, and set it as the base fieldset
        $mediaFieldset = new Fieldset\Media($objectManager);
        $mediaFieldset->setUseAsBaseFieldset(true);
        $this->add($mediaFieldset);

        $mediaMetadataFieldset = new Fieldset\MediaMetadata($objectManager);
        $this->add($mediaMetadataFieldset);

        $this->add(array(
            'name' => 'security',
            'type' => 'Zend\Form\Element\Csrf'
        ));

        $this->add(array(
            'name' => 'submit',
            'attributes' => array(
                'type'  => 'submit',
                'value' => 'Save',
                'id' => 'submitbutton',
                'class' => 'btn btn-default', 
            ),
        ));
    }

    public function getInputFilterSpecification()
    {
        return array(
            'security' => array(
                'required' => true,
                'validators' => array(
                    array('name' => 'Csrf'),
                ),
            )
        );
    }
}
