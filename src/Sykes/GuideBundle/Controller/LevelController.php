<?php

namespace Sykes\GuideBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use Sykes\GuideBundle\Entity\Level;
use Sykes\GuideBundle\Form\Type\LevelType;

class LevelController extends Controller
{
    // list all existing Levels    
    public function indexAction( Request $request )
    {
        // Get entity manager
        $em = $this->getDoctrine()->getEntityManager();
        $repo = $em->getRepository( 'SykesGuideBundle:Level' );
        // Get all level entities
        $levels = $repo->findAll();
        // Form processing
        if ( null !== $levelId = $request->get( 'id' ) )
        {
            $level = $repo->find( $levelId );
        }
        else
        {
            $level = new Level();
        }
        $form = $this->createForm( new LevelType(), $level );
        if ( $request->getMethod() == 'POST' )
        {
            $form->bind( $request );
            if ( $form->isValid() )
            {
                $em->persist( $level );
                $em->flush();
                return $this->redirect( $this->generateUrl( 'level_list' ) );
            }
        }
        // Response
        return $this->render( 'SykesGuideBundle:Level:index.html.twig', array(
                    'level' => $level,
                    'levels' => $levels,
                    'form' => $form->createView(),
                ) );
    }

    // delete new Level
    public function deleteAction( Request $request )
    {
        $em = $this->getDoctrine()->getEntityManager();
        $repo = $em->getRepository( 'SykesGuideBundle:Level' );
        $level = $repo->find( $request->get( 'id' ) );
        if ( null !== $level )
        {
            $em->remove( $level );
            $em->flush();
        }
        return $this->redirect( $this->generateUrl( 'level_list' ) );
    }

}
