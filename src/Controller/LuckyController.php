<?php
namespace App\Controller;

use App\Entity\Article;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class LuckyController extends AbstractController
{
    /**
     * @Route("/test/number")
     */
    public function number()
    {
        $number = random_int(0, 100);

        return new Response(
            '<html><body>Lucky number: '.$number.'</body></html>'
        );
    }
    /**
     * @Route("/test/number2")
     */
    public function number2()
    {
        $number = random_int(0, 100);

        return $this->render('test/number.html.twig', [
            'number' => $number,
        ]);
    }
    /**
     * @Route("/index.html")
     */
    public function index()
    {
        $articles = $this->getDoctrine()
            ->getRepository(Article::class)
            ->findAll();

        if(!$articles){
            throw $this->createNotFoundException(
                'no article found '
            );
        }

        return $this->render('index.html.twig',['articles' => $articles]);
    }

}