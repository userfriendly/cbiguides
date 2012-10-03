<?php

namespace Sykes\GuideBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use Sykes\GuideBundle\Entity\Answer;
use Sykes\GuideBundle\Form\Type\AnswerType;

class AnswerController extends Controller
{

    // delete answer
    public function deleteAction( Request $request )
    {
        $flashMessages = $request->getSession()->getFlashBag()->get( 'questionId' );
        $questionId = count( $flashMessages ) > 0 ? $flashMessages[0] : null;
        $em = $this->getDoctrine()->getEntityManager();
        $repo = $em->getRepository( 'SykesGuideBundle:Answer' );
        $answer = $repo->find( $request->get( 'id' ) );
        
        if ( null === $answer )
        {
            $this->createNotFoundException( 'Question not found' );
        }
        else
        {
            $em->remove( $answer );
            $em->flush();
        }
        
        return $this->redirect( $this->generateUrl( 'question_view', array( 'id' => $questionId ) ) );
    }

    // edit answer
    public function editAction( Request $request )
    {
        $em = $this->getDoctrine()->getEntityManager();
        $repo = $em->getRepository( 'SykesGuideBundle:Answer' );
        $answer = $repo->find( $request->get( 'id' ) );
        
        if ( !$answer )
            $answer = new Answer();
        $form = $this->createForm( new AnswerType(), $answer );
        
        if ( $request->getMethod() == 'POST' )
        {
            $flashMessages = $request->getSession()->getFlashBag()->get( 'questionId' );
            $questionId = count( $flashMessages ) > 0 ? $flashMessages[0] : null;
            $form->bind( $request );
            
            if ( $form->isValid() )
            {
                $question = $em->getRepository( 'SykesGuideBundle:Question' )->find( $questionId );
                $answer->setQuestion( $question );
                $em->persist( $answer );
                $em->flush();
                return $this->redirect( $this->generateUrl( 'question_view', array( 'id' => $questionId ) ) );
            }
        }
        
        return $this->render( 'SykesGuideBundle:Answer:edit.html.twig', array(
            'id' => $request->get( 'id' ),
            'answer' => $answer,
            'form' => $form->createView(),
        ));
    }
}
