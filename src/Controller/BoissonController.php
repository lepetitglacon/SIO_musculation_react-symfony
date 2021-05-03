<?php


namespace App\Controller;

use App\Entity\Boisson;
use App\Entity\CommentaireBoisson;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BoissonController extends AbstractController
{
    /**
     * @Route("/api/commentaire/boisson/{id}", name="ajouterCommentaireBoisson_route", methods={"POST"})
     *
     * @param \App\Entity\Boisson $boisson
     * @param \Symfony\Component\HttpFoundation\Request $request
     * @return Response
     * @throws \Exception
     */
    public function ajouterCommentaireBoisson_route(Boisson $boisson, Request $request): Response
    {
        //dd($request);
        $data = $request->toArray();
        //dd($data);
        $commentaire = new CommentaireBoisson();

        $commentaire->setBoisson($boisson);
        $commentaire->setProprietaire($this->getUser());
        $commentaire->setDate(new \DateTime());
        $commentaire->setTitre($data["titre"]);
        $commentaire->setMessage($data["message"]);

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($commentaire);

        $entityManager->flush();
        return $this->json($commentaire, 200, [], ['groups' => 'boisson:lecture']);
    }
}