<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\Translation\TranslatorInterface;

/**
 * Class HomeController
 * @package App\Controller
 */
class HomeController extends AbstractController
{
    /**
     * @Route("/", name="homepage")
     */
    public function index(
        UserRepository         $userRepository,
        Request                $request,
        EntityManagerInterface $entityManager,
        TranslatorInterface    $translator
    ): Response
    {
        $users = $userRepository->findBy(['active' => true]);
        $user = new User();

        $form = $this->createForm(UserType::class, $user);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $user = $form->getData();
            $entityManager->persist($user);
            $entityManager->flush($user);

            $this->addFlash('success', $translator->trans('home.toast.user_created'));

            return $this->redirectToRoute('homepage');
        }

        return $this->renderForm('views/home.html.twig', [
            'form' => $form,
            'users' => $users
        ]);
    }
}
