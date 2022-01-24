<?php

namespace App\Controller;


use App\Entity\Article;
use Doctrine\ORM\EntityManagerInterface;
use JMS\Serializer\Serializer;
use JMS\Serializer\SerializerBuilder;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ArticleController extends AbstractController
{
    private $entityManager;

    public  function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @Route("/articles", name="articles")
     * @method({"POST"})
     */
    public function create(Request $request)
    {
        $data = $request->getContent();

        $article = $this->container->get('serializer')->deserialize($data,'App\Entity\Article','json');

        $this->entityManager->persist($article);
        $this->entityManager->flush();
        /*
        dd($article);*/
        return new Response('',Response::HTTP_CREATED);

    }
}
