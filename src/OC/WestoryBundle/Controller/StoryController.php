<?php

namespace OC\WestoryBundle\Controller;

use OC\WestoryBundle\Entity\Story;
use OC\WestoryBundle\Form\StoryType;
use OC\WestoryBundle\Entity\Post;
use OC\WestoryBundle\Form\PostType;
use OC\WestoryBundle\Entity\Comment;
use OC\WestoryBundle\Form\CommentType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;


class StoryController extends Controller{
	
	public function addAction(Request $request){
		$this->denyAccessUnlessGranted('ROLE_USER');

		$story = new Story();
		$formStory = $this->createForm(StoryType::class, $story);

		if($request->isMethod('POST') && $formStory->handleRequest($request)->isValid()){
      		$user = $this->getUser();
      		$em = $this->getDoctrine()->getManager();
      		$em->getRepository(Story::class)->insertStory($story, $user);

      		$request->getSession()->getFlashBag()->add('info', "Histoire publiée.");
			return $this->redirectToRoute('oc_westory_view_story', array('id' => $story->getId()));
    	}

		return $this->render('@OCWestory/story/addStory.html.twig', array(
			'formAddStory' 	=> $formStory->createView(),
		));	
	}

	public function viewAction(Story $story, Request $request, $pageCom){
		$em = $this->getDoctrine()->getManager();
		$user = $this->getUser();
		$post = new Post();
		$formPost = $this->createForm(PostType::class, $post);
		$comment = new Comment();
		$formComment = $this->createForm(CommentType::class, $comment);
		$currentChapter = $story->getPostNumber() + 1;

		if($story === null){
			throw new NotFoundHttpException("L'histoire n'a pas été trouvée.");
		}

		if ($pageCom < 1) {
      		throw new NotFoundHttpException('Page "'.$page.'" inexistante.');
    	}

    	$comPerPage = 10;

    	$listComments = $em
			->getRepository(Comment::class)
			->getComments($pageCom, $comPerPage, $story)
		;

    	$pageComNumber = ceil(count($listComments) / $comPerPage);

		if ($pageCom -1 > $pageComNumber) {
      		throw $this->createNotFoundException("La page ".$page." n'existe pas.");
   		}

		if($formPost->handleRequest($request)->isSubmitted() && $formPost->isValid()){
			$chapter = $story->getPostNumber() + 1;
      		$em->getRepository(Post::class)->insertPost($post, $story, $user, $chapter);
			return $this->redirectToRoute('oc_westory_view_story', array('id' => $story->getId()));
    	}

    	if($formComment->handleRequest($request)->isSubmitted() && $formComment->isValid()){
      		$em->getRepository(Comment::class)->insertComment($comment, $story, $user);
			return $this->redirectToRoute('oc_westory_view_story', array('id' => $story->getId()));
    	}

		$listPosts = $em
			->getRepository(Post::class)
			->findBy(array('story' => $story))
		;

		$currentPosts = $em
			->getRepository(Post::class)
			->getCurrentPosts($story, $currentChapter)
		;

		return $this->render('@OCWestory/story/displayStory.html.twig', array(
			'formAddPost' 		=> $formPost->createView(),
			'formAddComment'	=> $formComment->createView(),
			'story' 			=> $story,
			'posts'				=> $listPosts,
			'currentPosts'		=> $currentPosts,
			'comments'			=> $listComments,
			'pageComNumber' 	=> $pageComNumber,
			'pageCom' 			=> $pageCom,
		));
	}

	public function viewAllAction($page, Request $request){

		if ($page < 1) {
      		throw new NotFoundHttpException('Page "'.$page.'" inexistante.');
    	}

    	$storyPerPage = 5;

		$stories = $this
			->getDoctrine()
			->getRepository(Story::class)
			->getCurrentStories($page, $storyPerPage)
		;

		$pageNumber = ceil(count($stories) / $storyPerPage);

		if ($page-1 > $pageNumber) {
      		throw $this->createNotFoundException("La page ".$page." n'existe pas.");
   		}

		return $this->render('@OCWestory/story/inProgress.html.twig', array(
			'stories' 		=> $stories,
			'pageNumber' 	=> $pageNumber,
			'page' 			=> $page,
		));	
	}

	public function viewFinishedAction($page, Request $request){

		if ($page < 1) {
      		throw new NotFoundHttpException('Page "'.$page.'" inexistante.');
    	}

    	$storyPerPage = 5;

		$stories = $this
			->getDoctrine()
			->getRepository(Story::class)
			->getStoriesFinished($page, $storyPerPage)
		;

		$pageNumber = ceil(count($stories) / $storyPerPage);

		if ($page-1 > $pageNumber) {
      		throw $this->createNotFoundException("La page ".$page." n'existe pas.");
   		}
     
      return $this->render('@OCWestory/story/finishedStories.html.twig', array(
      		'stories' 		=> $stories,
			'pageNumber' 	=> $pageNumber,
			'page' 			=> $page,
      	));
  }





}