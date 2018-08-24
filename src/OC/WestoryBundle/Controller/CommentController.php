<?php

namespace OC\WestoryBundle\Controller;

use OC\WestoryBundle\Entity\Comment;
use OC\WestoryBundle\Entity\Members;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Cookie;
use Symfony\Component\HttpFoundation\Response;




class CommentController extends Controller{
	
	public function deleteComAction(Request $request, Comment $com){
		$this->denyAccessUnlessGranted('ROLE_USER');

		if($com === null){
			throw new NotFoundHttpException("Ce commentaire n'a pas été trouvé.");
		}

		$user = $this->getUser();
		$em = $this->getDoctrine()->getManager();
		$storyId = $com->getStory()->getId();

		if($user->getUsername() == $com->getAuthor() OR $user->getUsername() == $com->getStory()->getAuthor()){
			$em->remove($com);
			$em->flush();

			$request->getSession()->getFlashBag()->add('info', "Commentaire supprimé.");
			return $this->redirectToRoute('oc_westory_view_story', array('id' => $storyId));
		}

		else{
			throw new NotFoundHttpException("Vous n'avez pas l'autorisation d'effectuer cette action");
		}
	}

	public function reportComAction(Request $request, Comment $com){
		$this->denyAccessUnlessGranted('ROLE_USER');

		if($com === null){
			throw new NotFoundHttpException("Ce commentaire n'a pas été trouvé.");
		}

		$em = $this->getDoctrine()->getManager();
		$storyId = $com->getStory()->getId();
		$ocp5ReportComCookieName = 'reportCom'.$com->getId();
		$response = new Response();

		if($request->cookies->has($ocp5ReportComCookieName)){
			$request->getSession()->getFlashBag()->add('info', "Vous avez déjà signalé ce commentaire.");
		}

		else{
			$cookie = new cookie($ocp5ReportComCookieName, 'exists', time() + (86400 * 30));
			$response->headers->setCookie($cookie);
			$response->send();

			$com->setReport($com->getReport() + 1);
			$em->flush();
			$request->getSession()->getFlashBag()->add('info', "Votre signalement a bien été pris en compte");
		}
		
		return $this->redirectToRoute('oc_westory_view_story', array('id' => $storyId));
	}
}