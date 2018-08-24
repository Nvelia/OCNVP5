<?php

namespace OC\WestoryBundle\Validator;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class NoSpam extends Constraint{

  	public $message = "Vous avez déjà publié une histoire aujourd'hui, réessayez demain.";

  	public function validatedBy(){
  		return 'oc_westory_nospam';
  	}
}