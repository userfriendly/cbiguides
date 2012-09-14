<?php

namespace Sykes\GuideBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class QuestionType extends AbstractType
{

    public function buildForm( FormBuilderInterface $builder, array $options )
    {
        $builder->add( 'question', 'textarea' );
        $builder->add( 'category', 'entity', array( 'class' => 'Sykes\GuideBundle\Entity\Category' ) );
      
    }

    public function getName()
    {
        return 'question';
    }

    public function setDefaultOptions( OptionsResolverInterface $resolver )
    {
        $resolver->setDefaults( array( 'data_class' => 'Sykes\GuideBundle\Entity\Question', ) );
    }

}
