<?php

namespace Sykes\GuideBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use Sykes\GuideBundle\Entity\Answer;
use Sykes\GuideBundle\Form\Type\AnswerType;

class AnswerController extends Controller
{

    public function indexAction( Request $request )
    {
        // Get entity manager
        $em = $this->getDoctrine()->getEntityManager();
        $repo = $em->getRepository( 'SykesGuideBundle:Answer' );
        // Get all answer entities
        $answers = $repo->findAll();
        
        // checking for passed ID
        $answerId = $request->get( 'id' );
        if ( null !== $answerId )
        {
            $answer = $repo->find( $answerId );
        }
        else
        {
            $answer = new Answer();
        }
        
        // Form processing
        $form = $this->createForm( new AnswerType(), $answer );
        if ( $request->getMethod() == 'POST' )
        {
            $form->bind( $request );
            if ( $form->isValid() )
            {
                $em->persist( $answer );
                $em->flush();
                return $this->redirect( $this->generateUrl( 'answer_list' ) );
            }
        }
        // Response
        return $this->render( 'SykesGuideBundle:Answer:index.html.twig', array(
                    'answer' => $answer,
                    'answers' => $answers,
                    'form' => $form->createView(),
                ) );
    }

    // delete answer
    public function deleteAction( Request $request )
    {
        $em = $this->getDoctrine()->getEntityManager();
        $repo = $em->getRepository( 'SykesGuideBundle:Answer' );
        $answer = $repo->find( $request->get( 'id' ) );
        if ( null !== $answer )
        {
            $em->remove( $answer );
            $em->flush();
        }
        return $this->redirect( $this->generateUrl( 'answer_list' ) );
    }

}
