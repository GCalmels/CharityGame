<?php

namespace CG\UserBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ChangePasswordFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        // add your custom field
        $builder->add('saveButton', 'submit');
    }
    
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {    
        $resolver->setDefaults(array(
            'translation_domain' => 'CGUserBundle'
        ));
    }

    public function getParent()
    {
        return 'fos_user_change_password';
    }

    public function getName()
    {
        return 'cg_user_change_password';
    }
}