<?php

namespace Sykes\WebsiteBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

use Sykes\WebsiteBundle\Entity\User;

class CreateUserCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName( 'sykes:user:create' )
            ->setDescription( 'Create a website user' )
            ->addArgument( 'username', InputArgument::REQUIRED, 'Set the username' )
            ->addArgument( 'password', InputArgument::REQUIRED, 'Set the password' )
            ->addOption( 'role', 'r', InputOption::VALUE_REQUIRED, 'Set the role of the user', 'ROLE_USER' )
        ;
    }

    protected function execute( InputInterface $input, OutputInterface $output )
    {
        // Read input arguments and options
        $username = $input->getArgument( 'username' );
        $password = $input->getArgument( 'password' );
        $role = $input->getOption( 'role' );
        // Get the entity manager from the dependency injection container
        $em = $this->getContainer()->get( 'doctrine' )->getEntityManager();
        // Create a User entity instance
        $user = new User();
        // Make the entity manager manage the entity instance
        $em->persist( $user );
        // Set username and role
        $user->setUsername( $username );
        $user->addRole( $role );
        // Get the encoder factory
        $factory = $this->getContainer()->get( 'security.encoder_factory' );
        // Get an encoder instance for this User entity instance
        $encoder = $factory->getEncoder( $user );
        // Encode and set the password
        $password = $encoder->encodePassword( $password, $user->getSalt() );
        $user->setPassword( $password );
        // Flush to disk
        $em->flush();
    }
}
