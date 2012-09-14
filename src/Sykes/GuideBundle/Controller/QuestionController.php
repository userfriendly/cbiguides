<?php

namespace Sykes\GuideBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sykes\GuideBundle\Entity\Question;
use Sykes\GuideBundle\Form\Type\QuestionType;

class QuestionController extends Controller
{

    public function indexAction( Request $request )
    {
        // Get entity manager
        $em = $this->getDoctrine()->getEntityManager();
        $repo = $em->getRepository( 'SykesGuideBundle:Question' );
        // Get all question entities
        $questions = $repo->findAll();

        // checking for passed ID
        $questionId = $request->get( 'id' );
        if ( null !== $questionId )
        {
            $question = $repo->find( $questionId );
        }
        else
        {
            $question = new Question();
        }

        // Form processing
        $form = $this->createForm( new QuestionType(), $question );
        if ( $request->getMethod() == 'POST' )
        {
            $form->bind( $request );
            if ( $form->isValid() )
            {
                $em->persist( $question );
                $em->flush();
                return $this->redirect( $this->generateUrl( 'question_list' ) );
            }
        }
        // Response
        return $this->render( 'SykesGuideBundle:Question:index.html.twig', array(
                    'question' => $question,
                    'questions' => $questions,
                    'form' => $form->createView(),
                ) );
    }

    // delete question
    public function deleteAction( Request $request )
    {
        $em = $this->getDoctrine()->getEntityManager();
        $repo = $em->getRepository( 'SykesGuideBundle:Question' );
        $question = $repo->find( $request->get( 'id' ) );
        if ( null !== $question )
        {
            $em->remove( $question );
            $em->flush();
        }
        return $this->redirect( $this->generateUrl( 'question_list' ) );
    }

    public function viewAction( Request $request )
    {
        $request->getSession()->getFlashBag()->add( 'questionId', $request->get( 'id' ) );
        $em = $this->getDoctrine()->getEntityManager();
        $repo = $em->getRepository( 'SykesGuideBundle:Question' );
        $question = $repo->find( $request->get( 'id' ) );
        if ( null !== $question )
        {
            $this->createNotFoundException( 'Question not found' );
        }
        $answerId = $request->get( 'answer_id' ) ? $request->get( 'answer_id' ) : 0;
        return $this->render( 'SykesGuideBundle:Question:view.html.twig', array(
                    'question' => $question,
                    'answerId' => $answerId,
                ) );
    }

}
