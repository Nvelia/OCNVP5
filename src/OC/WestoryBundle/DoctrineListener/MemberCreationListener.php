<?php

namespace OC\WestoryBundle\DoctrineListener;

use Doctrine\Common\Persistence\Event\LifecycleEventArgs;
use OC\WestoryBundle\Email\MemberMailer;
use OC\WestoryBundle\Entity\Members;

class MemberCreationListener{
    /**
     * @var MemberMailer
     */
    private $memberMailer;

    public function __construct(memberMailer $memberMailer){
        $this->memberMailer = $memberMailer;
    }

    public function postPersist(LifecycleEventArgs $args){
        $entity = $args->getObject();

        if (!$entity instanceof Members){
          return;
        }

        $this->memberMailer->sendMail($entity);
    }
}
