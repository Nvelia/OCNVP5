<?php

namespace OC\WestoryBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class SecurityController extends Controller{

	public function loginAction(Request $request){
		if($this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_REMEMBERED')) {
			$request->getSession()->getFlashBag()->add('info', "Vous êtes connecté.");
			return $this->redirectToRoute('oc_westory_homepage_index');
		}

		$request->getSession()->getFlashBag()->add('info', "Identifiant et/ou mot de passe incorrect.");
		return $this->render('@OCWestory/default/index.html.twig');
	}
}