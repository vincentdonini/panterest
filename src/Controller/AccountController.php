<?php

namespace App\Controller;

use App\Form\ChangePasswordFormType;
use App\Form\UserFormType;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("account")
 * @IsGranted("ROLE_USER")
 */
class AccountController extends AbstractController
{
    private $manager;

    public function __construct(
        EntityManagerInterface $manager
    ){
        $this->manager = $manager;
    }
    /**
     * @Route("", name="app_account")
     */
    public function index(): Response
    {
        return $this->render('account/index.html.twig', [
            'controller_name' => 'AccountController',
        ]);
    }

    /**
     * @Route("/edit", name="app_account_edit", methods={"GET", "PUT"})
     * @IsGranted("IS_AUTHENTICATED_FULLY")
     */
    public function edit(
        Request $request
    ): Response
    {
        $user = $this->getUser();
        $form = $this->createForm(UserFormType::class, $user, [
            'method' => 'PUT'
        ]);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $this->manager->flush();

            $this->addFlash('success', 'User successfully updated !');
            return $this->redirectToRoute('app_account');
        }

        return $this->render('account/edit.html.twig', [
            'user' => $user,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/change-password", name="app_account_change_password", methods={"GET", "POST"})
     * @IsGranted("IS_AUTHENTICATED_FULLY")
     */
    public function changePassword(
        Request $request,
        UserPasswordHasherInterface $userPasswordHasher
    ): Response
    {
        $user = $this->getUser();

        $form = $this->createForm(ChangePasswordFormType::class, null, [
            'is_current_password_required' => true
        ]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $encodedPassword = $userPasswordHasher->hashPassword(
                $user,
                $form->get('plainPassword')->getData()
            );

            $user->setPassword($encodedPassword);
            $this->manager->flush();

            $this->addFlash('success', 'Password updated successfully.');

            return $this->redirectToRoute('app_account');
        }
        return $this->render('account/change_password.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
