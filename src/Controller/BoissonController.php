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
     * @Route("commentaire/boisson/api/{id}", name="ajouterCommentaireBoisson_route", methods={"POST"})
     */
    public function ajouterCommentaireBoisson_route(Boisson $boisson, Request $request): Response
    {
        $data = $request->toArray();
        $commentaire = new CommentaireBoisson();
        $commentaire->setBoisson($boisson);
        $commentaire->setProprietaire($this->getUser());
        $commentaire->setDate(new \DateTime());
        $commentaire->setTitre($data["titre"]);
        $commentaire->setMessage($data["message"]);
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($commentaire);
        $entityManager->flush();

        return $this->json($commentaire, 200, [], ['groups' => 'boisson']);
    }

    /**
     * @Route("commentaire/boisson/api/delete/{id}", name="commentaire_atelier_delete", methods={"DELETE"})
     */
    public function deleteBoisson(Request $request, CommentaireBoisson $commentaireBoisson): Response
    {
        if ($this->isCsrfTokenValid('delete'.$commentaireBoisson->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($commentaireBoisson);
            $entityManager->flush();
        }

        return $this->redirectToRoute('commentaire_atelier_index');
    }
}
