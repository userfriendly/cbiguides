<?php

namespace Sykes\GuideBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

use Sykes\GuideBundle\Entity\Level;

class AnswerType extends AbstractType
{

    public function buildForm( FormBuilderInterface $builder, array $options )
    {
        $builder->add( 'answer', 'textarea' );
        $builder->add( 'level' , 'entity', array ('class' => 'Sykes\GuideBundle\Entity\Level'));
    }

    public function getName()
    {
        return 'answer';
    }

    public function getLevel()
    {
        return $level = Level();
    }

    public function setDefaultOptions( OptionsResolverInterface $resolver )
    {
        $resolver->setDefaults( array( 'data_class' => 'Sykes\GuideBundle\Entity\Answer', ) );
    }

}
