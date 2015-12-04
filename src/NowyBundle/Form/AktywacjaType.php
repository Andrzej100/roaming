<?php

namespace NowyBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class AktywacjaType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('od',null, array(
    'attr'=>array('style'=>'display:none;'),
    'label'=>' '           
))
            ->add('aktywacja')
            ->add('do')
            ->add('nrtelefon')
            ->add('package')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'NowyBundle\Entity\Aktywacja'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'nowybundle_aktywacja';
    }
}
