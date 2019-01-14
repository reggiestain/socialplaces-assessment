<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixture extends Fixture {

    private $encoder;
    
    public function __construct(UserPasswordEncoderInterface $encoder) {
        
        $this->encoder = $encoder;
    }
    
    public function load(ObjectManager $manager) {
        
        $user = new User;
        $user->setUsername('admin'); 
        $user->setEmail('reggiestain@gmail.com'); 
        $user->setRoles(array('ROLE_ADMIN')); 
        $user->setPassword(
            $this->encoder->encodePassword($user, 'admin')
        ); 
        
        $manager->persist($user);
        
        $user = new User;
        $user->setUsername('guest'); 
        $user->setEmail('reggiestain15@gmail.com'); 
        $user->setRoles(array('ROLE_USER')); 
        
        $user->setPassword(
            $this->encoder->encodePassword($user, 'guest')
        ); 
        
        $manager->persist($user);
        
        $manager->flush();
    }

}
