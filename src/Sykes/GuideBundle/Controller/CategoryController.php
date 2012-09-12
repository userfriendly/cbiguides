<?php

namespace Sykes\GuideBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use Sykes\GuideBundle\Entity\Category;
use Sykes\GuideBundle\Form\Type\CategoryType;

class CategoryController extends Controller
{
    public function indexAction( Request $request )
    {
        // Get entity manager
        $em = $this->getDoctrine()->getEntityManager();
        $repo = $em->getRepository( 'SykesGuideBundle:Category' );
        // Get all category entities
        $categories = $repo->findAll();
        // Form processing
        if ( null !== $categoryId = $request->get( 'id' ) )
        {
            $category = $repo->find( $categoryId );
        }
        else
        {
            $category = new Category();
        }
        $form = $this->createForm( new CategoryType(), $category );
        if ( $request->getMethod() == 'POST' )
        {
            $form->bind( $request );
            if ( $form->isValid() )
            {
                $em->persist( $category );
                $em->flush();
                return $this->redirect( $this->generateUrl( 'category_list' ) );
            }
        }
        // Response
        return $this->render( 'SykesGuideBundle:Category:index.html.twig', array(
                    'category' => $category,
                    'categories' => $categories,
                    'form' => $form->createView(),
                ) );
    }

    // delete category
    public function deleteAction( Request $request )
    {
        $em = $this->getDoctrine()->getEntityManager();
        $repo = $em->getRepository( 'SykesGuideBundle:Category' );
        $category = $repo->find( $request->get( 'id' ) );
        if ( null !== $category )
        {
            $em->remove( $category );
            $em->flush();
        }
        return $this->redirect( $this->generateUrl( 'category_list' ) );
    }
}
