<?php

namespace OC\WestoryBundle\DoctrineListener;

use Doctrine\Common\Persistence\Event\LifecycleEventArgs;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Doctrine\Common\EventSubscriber;
use OC\WestoryBundle\Entity\Members;

class HashPasswordListener implements EventSubscriber{

    private $passwordEncoder;

    public function getSubscribedEvents(){
        return['prePersist', 'preUpdate'];
    }

    public function __construct(UserPasswordEncoderInterface $passwordEncoder){
        $this->passwordEncoder = $passwordEncoder;
    }

    public function prePersist(LifecycleEventArgs $args){
        $entity = $args->getObject();

        if (!$entity instanceof Members){
          return;
        }

        $this->encodePassword($entity);
    }

    public function preUpdate(LifecycleEventArgs $args){
        $entity = $args->getObject();

        if (!is_callable([$entity, 'getPassword'])){
            return;
        }

        if(strlen($entity->getPassword()) > 20){
            return;
        }

        $this->encodePassword($entity);

        $em = $args->getEntityManager();
        $meta = $em->getClassMetadata(get_class($entity));
        $em->getUnitOfWork()->recomputeSingleEntityChangeSet($meta, $entity);
    }

    /**
     * @param Members $entity
     */
    private function encodePassword(Members $entity){
        if(!$entity->getPassword()){
            return;
        }

        $encoded = $this->passwordEncoder->encodePassword(
          $entity,
          $entity->getPassword()
        );

        $entity->setPassword($encoded);
    }


}
