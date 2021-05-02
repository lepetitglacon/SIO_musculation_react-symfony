<?php


namespace App\Controller;


use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ControllerUserAct extends AbstractController
{
    /**
     * @Route(
     *     name="getCurrentUser",
     *     path="/getCurrentUser",
     *     methods={"GET"}
     * )
     */
    public function getCurrentUser(): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $user= $this->getUser();
        $user->eraseCredentials();
        return $this->json($user);
    }
}