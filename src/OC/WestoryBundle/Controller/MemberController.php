<?php

namespace OC\WestoryBundle\Controller;

use OC\WestoryBundle\Entity\Members;
use OC\WestoryBundle\Form\MembersType;
use OC\WestoryBundle\Entity\Avatar;
use OC\WestoryBundle\Form\AvatarType;
use OC\WestoryBundle\Form\ChapterSelectType;
use OC\WestoryBundle\Entity\Story;
use OC\WestoryBundle\Entity\Post;
use OC\WestoryBundle\Form\ForgottenPassType;
use OC\WestoryBundle\Form\ResetPasswordType;
use OC\WestoryBundle\Form\ChangePasswordType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;


class MemberController extends Controller{
	
	public function addAction(Request $request){
		$member = new Members();
		$form = $this->createForm(MembersType::class, $member);

		$form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
			$em = $this->getDoctrine()->getManager();
			$em->persist($member);
			$em->flush();
    		
			$request->getSession()->getFlashBag()->add('info', "Inscription réussie. Vous pouvez vous connecter");
			return $this->redirectToRoute('oc_westory_homepage');
		}

		return $this->render('@OCWestory/member/registration.html.twig', array('form' => $form->createView(),));
	}

	public function viewMemberAreaAction(Request $request, $page){
		$this->denyAccessUnlessGranted('ROLE_USER');

		$em = $this->getDoctrine()->getManager();
		$user = $this->getUser();
		$avatar = new Avatar();
		$form = $this->createForm(AvatarType::class, $avatar);
		$storyPerPage = 5;
		$storySelect = new Story();
		$userPosts = [];
		$formOrder = $this->createForm(ChapterSelectType::class);

		$form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
			$member = $em
				->getRepository(Members::class)
				->find($user->getId());
			$member->setAvatar($avatar);
			$em->flush();

			$request->getSession()->getFlashBag()->add('info', "Avatar modifié");
			return $this->redirectToRoute('oc_westory_memberArea');
		}

		$formOrder->handleRequest($request);
		if($formOrder->isSubmitted()){

			$userPosts = $em
				->getRepository(Post::class)
				->getSelectedPosts(
					$user->getUsername(),
					$formOrder->get('story')->getData(),
					$formOrder->get('isValid')->getData()
				);
		}

		if ($page < 0) {
      		throw new NotFoundHttpException('Page "'.$page.'" inexistante.');
    	}

    	$userStories = $em
			->getRepository(Story::class)
			->getUserStories($user->getUsername(), $page, $storyPerPage);
		$pageNumber = ceil(count($userStories) / $storyPerPage);

		if ($page-1 > $pageNumber) {
      		throw $this->createNotFoundException("La page ".$page." n'existe pas.");
   		}

		$stories = $em
			->getRepository(Story::class)
			->findAll();

		return $this->render('@OCWestory/member/memberArea.html.twig', array(
				'userStories'			=> $userStories,
				'userPosts'				=> $userPosts,
				'stories'				=> $stories,
				'form'					=> $form->createView(),
				'formOrder'				=> $formOrder->createView(),
				'pageNumber' 			=> $pageNumber,
				'page' 					=> $page,
			));

	}

	public function viewMemberPageAction($member, $page, Request $request){

		if($member === null){
			throw new NotFoundHttpException("Ce membre n'a pas été trouvé.");
		}

		$em = $this->getDoctrine()->getManager();
		$user = $this->getUser();
		$storyPerPage = 5;
		$memberPosts = [];
		$formOrder = $this->createForm(ChapterSelectType::class);

		$memberInfo = $em
			->getRepository(Members::class)
			->findOneBy(array('username' => $member));

		if($user == $memberInfo){
			return $this->redirectToRoute('oc_westory_memberArea');
		}

		if ($page < 0) {
      		throw new NotFoundHttpException('Page "'.$page.'" inexistante.');
    	}    	

    	$memberStories = $em
			->getRepository(Story::class)
			->getUserStories($memberInfo->getUsername(), $page, $storyPerPage);

    	$pageNumber = ceil(count($memberStories) / $storyPerPage);

		if ($page-1 > $pageNumber) {
      		throw $this->createNotFoundException("La page ".$page." n'existe pas.");
   		}

		$formOrder->handleRequest($request);
		if($formOrder->isSubmitted()){
			$memberPosts = $em
				->getRepository(Post::class)
				->getSelectedPosts(
					$memberInfo->getUsername(),
					$formOrder->get('story')->getData(),
					$formOrder->get('isValid')->getData()
				);
		}

		return $this->render('@OCWestory/member/memberPage.html.twig', array(
				'memberInfo'				=> $memberInfo,
				'memberStories'				=> $memberStories,
				'memberPosts'				=> $memberPosts,
				'pageNumber' 				=> $pageNumber,
				'page' 						=> $page,
				'formOrder'				=> $formOrder->createView(),
			));
	}

	public function forgottenPasswordAction(Request $request){
		$member = new Members;
		$form = $this->createForm(ForgottenPassType::class, $member);
		$em = $this->getDoctrine()->getManager();

		$form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
        	$userValid = $em
        		->getRepository(Members::class)
        		->getUserValid($member->getUsername(), $member->getEmailAddress()
        		);

        	if($userValid !== null){
        		$mailer = $this->get('mailer'); 

				$message = (new \Swift_Message('Demande de réinitialisation du mot de passe'))
			        ->setFrom("infos.ocnv@gmail.com")
			        ->setTo($userValid->getEmailAddress())
			        ->setBody(
			            $this->renderView(
			                '@OCWestory/emails/resetPassword.html.twig',
			                array(	'name' => $userValid->getUsername(),
			            			'member'				=> $userValid)
			            ),
			            'text/html'
			        );

		    	$mailer->send($message);
        	}
        	else{
        		$request->getSession()->getFlashBag()->add('info', "Aucun membre correspondant.");
        	}

        	$request->getSession()->getFlashBag()->add('info', "Un Email de réinitialisation du mot de passe a été envoyé.");
			return $this->redirectToRoute('oc_westory_homepage');
        }

		return $this->render('@OCWestory/member/forgottenPassword.html.twig', array(
			'form'					=> $form->createView(),
		));
	}

	public function changePasswordAction(Request $request){
		$this->denyAccessUnlessGranted('ROLE_USER');

		$em = $this->getDoctrine()->getManager();
		$member = $em
			->getRepository(Members::class)
			->findOneBy(array('username' => $this->getUser()->getUsername()
		));
		$oldPassword = $this->getUser()->getPassword();
		$form = $this->createForm(ChangePasswordType::class, $member);
		
		$form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
        	if (password_verify($form->get('oldPassword')->getData(), $oldPassword )){
				$em->flush();
				$request->getSession()->getFlashBag()->add('info', "Mot de passe modifié");
				return $this->redirectToRoute('oc_westory_memberArea');
			}
			else{
				$request->getSession()->getFlashBag()->add('info', "Mot de passe incorrect");
			}
		}

		return $this->render('@OCWestory/member/changePassword.html.twig', array(
			'form'		=> $form->createView(),
		));
	}

	public function resetPasswordAction(Request $request, Members $member){
		$form = $this->createForm(ResetPasswordType::class, $member);
		$em = $this->getDoctrine()->getManager();

		$form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
			$em->flush();
			$request->getSession()->getFlashBag()->add('info', "Mot de passe modifié");
			return $this->redirectToRoute('oc_westory_memberArea');
		}

		return $this->render('@OCWestory/member/resetPassword.html.twig', array(
			'form'		=> $form->createView(),
		));
	}
}