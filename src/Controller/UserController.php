<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Contracts\Translation\TranslatorInterface;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController implements UserTasksAwareController
{
    /**
     * @param UserRepository $userRepository
     * @param EntityManagerInterface $entityManager
     * @param TranslatorInterface $translator
     */
    public function __construct(
        private UserRepository         $userRepository,
        private EntityManagerInterface $entityManager,
        private TranslatorInterface    $translator
    )
    {
    }

    /**
     * @Route("/delete/{id}", name="delete")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function delete(Request $request)
    {
        $userId = $request->get('id');

        /** @var User $user */
        $user = $this->userRepository->find($userId);
        if ($user) {
            $user->setActive(false);
            $this->entityManager->flush();
            $this->addFlash('success', $this->translator->trans('home.toast.user_deleted'));
        } else {
            $this->addFlash('alert', $this->translator->trans('home.toast.user_not_found'));
        }

        return $this->redirectToRoute('homepage');
    }

    /**
     * @Route("/edit/{id}", name="edit")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function edit(Request $request)
    {
        $userId = $request->get('id');

        $user = $this->userRepository->find($userId);

        $form = $this->createForm(UserType::class, $user);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $user = $form->getData();
            $this->entityManager->persist($user);
            $this->entityManager->flush($user);

            $this->addFlash('success', $this->translator->trans('home.toast.user_updated'));

            return $this->redirectToRoute('homepage');
        }

        return $this->renderForm('views/edit_user.html.twig', [
            'form' => $form,
            'id' => $userId
        ]);
    }
}
