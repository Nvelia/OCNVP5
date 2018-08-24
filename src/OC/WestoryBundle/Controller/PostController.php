<?php

namespace OC\WestoryBundle\Controller;

use OC\WestoryBundle\Entity\Post;
use OC\WestoryBundle\Entity\Members;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Cookie;
use Symfony\Component\HttpFoundation\Response;




class PostController extends Controller{
	
	public function deletePostAction(Request $request, Post $post){
		$this->denyAccessUnlessGranted('ROLE_USER');

		if($post === null){
			throw new NotFoundHttpException("Le chapitre n'a pas été trouvé.");
		}

		$user = $this->getUser();
		$em = $this->getDoctrine()->getManager();
		$storyId = $post->getStory()->getId();

		if($user->getUsername() == $post->getAuthor()){
			$em->remove($post);
			$em->flush();

			$request->getSession()->getFlashBag()->add('info', "Chapitre proposé, supprimé.");
			return $this->redirectToRoute('oc_westory_view_story', array('id' => $storyId));
		}

		else{
			$request->getSession()->getFlashBag()->add('info', "Vous n'avez pas l'autorisation d'effectuer cette action");
		}
	}

	public function addVoteAction(Request $request, Post $post){
		$this->denyAccessUnlessGranted('ROLE_USER');

		if($post === null){
			throw new NotFoundHttpException("Le chapitre n'a pas été trouvé.");
		}

		$user = $this->getUser();

		if($user->getVotesNumber() > 0){
			$em = $this->getDoctrine()->getManager();
			$post = $em->getRepository(Post::class)->find($post->getId());
			$author = $em->getRepository(Members::class)->findOneBy(array('username' => $post->getAuthor()));
			$author->incrementVotesReceived();
			$post->incrementVoteNumber();
			$user->decrementVotesNumber();
			$em->flush();
			$request->getSession()->getFlashBag()->add('info', "Votre vote a bien été pris en compte");
		}
		else{
			$request->getSession()->getFlashBag()->add('info', "Plus aucun vote disponible");
		}

		$story = $post->getStory();
		return $this->redirectToRoute('oc_westory_view_story', array('id' => $story->getId()));
	}

	public function reportPostAction(Request $request, Post $post){
		$this->denyAccessUnlessGranted('ROLE_USER');

		if($post === null){
			throw new NotFoundHttpException("Le chapitre n'a pas été trouvé.");
		}

		$em = $this->getDoctrine()->getManager();
		$storyId = $post->getStory()->getId();
		$ocp5ReportCookieName = 'reportChapter'.$post->getId();
		$response = new Response();

		if($request->cookies->has($ocp5ReportCookieName)){
			$request->getSession()->getFlashBag()->add('info', "Vous avez déjà signalé cette publication.");
		}

		else{
			$cookie = new cookie($ocp5ReportCookieName, 'exists', time() + (86400 * 30));
			$response->headers->setCookie($cookie);
			$response->send();

			$post->setReports($post->getReports() + 1);
			$em->flush();
			$request->getSession()->getFlashBag()->add('info', "Votre signalement a bien été pris en compte");
		}
		
		return $this->redirectToRoute('oc_westory_view_story', array('id' => $storyId));
	}
}