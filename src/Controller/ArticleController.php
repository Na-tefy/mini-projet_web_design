<?php

namespace App\Controller;

use App\Entity\Article;
use App\Form\ArticleType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Validator\Constraints\DateTime;
use Symfony\Component\Validator\Constraints\Time;

class ArticleController extends AbstractController
{
    /**
     * @Route("/article/back/add", name="article")
     */
    public function index()
    {
        $entityManager = $this->getDoctrine()->getManager();

        $article = new Article();
        $article->setTitre('My first article');
        $article->setDescription('this is bullshit');
        $article->setDatePublication(new \DateTime());
        $article->setTimePublication(new \DateTime());

        $entityManager->persist($article);

        $entityManager->flush();
        return new Response('Saved new article with id '.$article->getId());
    }
    /**
     * @Route("/article/{id}", name="article_show")
     */
    public function show($id)
    {
        $article = $this->getDoctrine()
            ->getRepository(Article::class)
            ->find($id);

        if(!$article){
            throw $this->createNotFoundException(
              'no article found for id '.$id
            );
        }

        return $this->render('fiche1.html.twig', ['article' => $article] );
    }
    /**
     * @Route("/bo/delete/{id}", name="delete")
     */
    public function delete($id)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $article = $this->getDoctrine()
            ->getRepository(Article::class)
            ->find($id);

        if(!$article){
            throw $this->createNotFoundException(
                'no article found for id '.$id
            );
        }

        $entityManager->remove($article);
        $entityManager->flush();
        return $this->redirectToRoute('index');
    }

    /**
     * @Route("/bo/add", name="bo")
     */
    public function ajouter(Request $request)
    {
        $article = new Article();
        $form = $this->createForm(ArticleType::class, $article);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($article);
            $entityManager->flush();
            return $this->redirectToRoute('indexBO');
        }
        return $this->render('ajouter.html.twig', ['articleform'=>$form->createView()] );
    }
    /**
     * @Route("/bo/update/{id}", name="update")
     */
    public function update(Request $request,$id)
    {
        $article = $this->getDoctrine()
            ->getRepository(Article::class)
            ->find($id);

        if(!$article){
            throw $this->createNotFoundException(
                'no article found for id '.$id
            );
        }
        $form = $this->createForm(ArticleType::class, $article);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->flush();
            return $this->redirectToRoute('indexBO');
        }
        return $this->render('ajouter.html.twig', ['articleform'=>$form->createView()] );
    }

}
