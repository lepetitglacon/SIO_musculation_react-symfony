<?php

namespace App\Controller;

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
}
