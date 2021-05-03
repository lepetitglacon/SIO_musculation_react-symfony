<?php


namespace App\Controller;


use App\Entity\Utilisateur;
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

    /**
     * @Route(
     *     name="changeUserInfo",
     *     path="/changeUserInfo",
     *     methods={"POST"}
     * )
     */
    public function changeUserInfo(){
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $user = $this->getCurrentUser();

        $user->setLogin = $_POST["login"];
        $user->setUsername = $_POST["username"];
        $user->setLastname = $_POST["lastname"];

    }
}