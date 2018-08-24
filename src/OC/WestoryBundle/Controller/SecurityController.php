<?php

namespace OC\WestoryBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class SecurityController extends Controller{

	public function loginAction(Request $request){
		if($this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_REMEMBERED')) {
			$request->getSession()->getFlashBag()->add('info', "Vous pouvez vous connecter");
			return $this->redirectToRoute('oc_westory_homepage_index');
		}

		$authenticationUtils = $this->get('security.authentication_utils');

		$request->getSession()->getFlashBag()->add('info', "Identifiant et/ou mot de passe incorrect.");
		return $this->render('@OCWestory/Default/index.html.twig');
	}
}