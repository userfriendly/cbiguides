<?php

namespace Sykes\WebsiteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\SecurityContext;

use Sykes\WebsiteBundle\Entity\User;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render( 'SykesWebsiteBundle:Default:index.html.twig' );
    }
    
    public function loginAction( Request $request )
    {
        $session = $request->getSession();
        if ( $request->attributes->has( SecurityContext::AUTHENTICATION_ERROR ) )
        {
            $error = $request->attributes->get( SecurityContext::AUTHENTICATION_ERROR );
        }
        else
        {
            $error = $session->get( SecurityContext::AUTHENTICATION_ERROR );
            $session->remove( SecurityContext::AUTHENTICATION_ERROR );
        }
        return $this->render( 'SykesWebsiteBundle:Default:login.html.twig', array(
            'last_username' => $session->get( SecurityContext::LAST_USERNAME ),
            'error'         => $error,
        ));
    }
    
    public function createUserAction( Request $request )
    {
        $factory = $this->get( 'security.encoder_factory' );
        $em = $this->getDoctrine()->getEntityManager();
                
        $user = new User();
        $encoder = $factory->getEncoder( $user );
        $password = $encoder->encodePassword( 'N236T33b', $user->getSalt() );
        $user->setUsername( 'User' );
        $user->setPassword( $password );
        $em->persist( $user );
                
        $user2 = new User();
        $encoder = $factory->getEncoder( $user2 );
        $password = $encoder->encodePassword( 'G1fkZBmR', $user2->getSalt() );
        $user2->setUsername( 'Admin' );
        $user2->setPassword( $password );
        $em->persist( $user2 );
                
        $user3 = new User();
        $encoder = $factory->getEncoder( $user3 );
        $password = $encoder->encodePassword( 'sAMko4Uw', $user3->getSalt() );
        $user3->setUsername( 'Superadmin' );
        $user3->setPassword( $password );
        $em->persist( $user3 );
        
        $em->flush();
        return $this->redirect( '/' );
    }
}
