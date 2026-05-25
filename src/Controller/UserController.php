<?php

namespace App\Controller;

use App\Form\RegistrationFormType;
use App\Service\UserService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class UserController extends AbstractController
{
    public function __construct(
        private readonly UserService $service,
        private readonly AuthenticationUtils $auth,
    ) {}

    #[Route('/register', name: 'app_register')]
    public function register(Request $request): Response
    {
        $form = $this->createForm(RegistrationFormType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->service->register($form->getData());
            $this->addFlash('success', 'Account created successfully. Please login.');

            return $this->redirectToRoute('app_login');
        }

        return $this->render('shop/login.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
    }

    #[Route('/login', name: 'app_login')]
    public function login(): Response
    {
        if ($this->getUser()) {
            return $this->redirectToRoute('app_profile');
        }

        $form = $this->createForm(RegistrationFormType::class);

        return $this->render('shop/login.html.twig', [
            'last_email'       => $this->auth->getLastUsername(),
            'error'            => $this->auth->getLastAuthenticationError(),
            'registrationForm' => $form->createView(),
        ]);
    }

    #[Route('/logout', name: 'app_logout')]
    public function logout(): void
    {
        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }
}
