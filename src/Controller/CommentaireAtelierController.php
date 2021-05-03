<?php

namespace App\Controller;

use App\Entity\Atelier;
use App\Entity\CommentaireAtelier;
use App\Form\CommentaireAtelierType;
use App\Repository\CommentaireAtelierRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/commentaire/atelier")
 */
class CommentaireAtelierController extends AbstractController
{

    /**
     * @Route("/{id}", name="commentaire_atelier_delete", methods={"DELETE"})
     */
    public function delete(Request $request, CommentaireAtelier $commentaireAtelier): Response
    {
        if ($this->isCsrfTokenValid('delete'.$commentaireAtelier->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($commentaireAtelier);
            $entityManager->flush();
        }

        return $this->redirectToRoute('commentaire_atelier_index');
    }

    /**
     * @Route("/api/commentaire/atelier/{id}", name="ajouterCommentaire_route", methods={"POST"})
     * @param Atelier
     * @return Response
     */
    public function new(Request $request, Atelier $atelier): Response
    {
        $data = $request->toArray();
        $commentaire = new CommentaireAtelier();
        $commentaire->setAtelier($atelier);
        $commentaire->setProprietaire($this->getUser());
        $commentaire->setDate(new \DateTime());
        $commentaire->setTitre($data["titre"]);
        $commentaire->setTitre($data["message"]);

        $em = $this->getDoctrine()->getManager();
        $em->persist($commentaire);
        $em->flush();
        return $this->json($commentaire,200,[],['groups'=>'atelier']);
    }
}
