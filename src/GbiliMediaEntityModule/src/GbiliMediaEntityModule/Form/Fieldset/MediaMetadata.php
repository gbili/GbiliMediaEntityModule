<?php
namespace GbiliMediaEntityModule\Form\Fieldset;

class MediaMetadata extends \Zend\Form\Fieldset 
    implements \Zend\InputFilter\InputFilterProviderInterface
{
    public function __construct(\Doctrine\Common\Persistence\ObjectManager $objectManager)
    {
        parent::__construct('metadata');

        $this->setHydrator(new \DoctrineModule\Stdlib\Hydrator\DoctrineObject($objectManager))
             ->setObject(new \GbiliMediaEntityModule\Entity\MediaMetadata());
        
        $this->add(array(
            'name' => 'id',
            'type'  => 'Zend\Form\Element\Hidden',
        ));

        $this->add(array(
            'name' => 'alt',
            'type'  => 'Zend\Form\Element\Text',
            'options' => array(
                'label' => 'Alternate Text'
            ),
            'attributes' => array(
                'placeholder' => 'Displayed when image not loaded',
                'class' => 'form-control',
            )
        ));

        $this->add(array(
            'name' => 'description',
            'type'  => 'Zend\Form\Element\Textarea',
            'options' => array(
                'label' => 'Description',
            ),
            'attributes' => array(
                'class' => 'form-control',
                'rows' => '8',
                'placeholder' => 'Describe the image',
            )
        ));

    }

    public function getInputFilterSpecification()
    {
        return array(
            'id' => array(
                'required' => false,
                'filters'  => array(
                    array('name' => 'Int'),
                ),
            ),

            'alt' => array(
                'required' => true,
                'filters'  => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                ),
                'validators' => array(
                    array(
                        'name'    => 'StringLength',
                        'options' => array(
                            'encoding' => 'UTF-8',
                            'min'      => 1,
                            'max'      => 255,
                        ),
                    ),
                ),
            ),

            'description' => array(
                'required' => true,
                'filters'  => array(
                    array('name' => 'StringTrim'),
                ),
                'validators' => array(
                    array(
                        'name'    => 'StringLength',
                        'options' => array(
                            'encoding' => 'UTF-8',
                            'min'      => 1,
                        ),
                    ),
                ),
            ),
        );
    }
}
