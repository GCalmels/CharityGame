<?php

namespace CG\UserBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ProfileFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
                ->add('saveButton', 'submit');
    }
    
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {    
        $resolver->setDefaults(array(
            'translation_domain' => 'CGUserBundle'
        ));

    }

    public function getParent()
    {
        return 'fos_user_profile';
    }

    public function getName()
    {
        return 'cg_user_profile';
    }
}