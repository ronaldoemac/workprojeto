<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class NewsController extends AbstractController
{
    #[Route('api/news/{id}',name: 'app_api')]
    public function getNew(String|null $id=null): Response
    {
        // TODO - criar uma query real
        $new = [
            "id" => $id,
            "titulo" => "Artista brasileiro é premiado em festival internacional de cinema",
            "categoria" => "Cultura",
            "descricao" => "O artista brasileiro João da Silva ganhou o prêmio de melhor filme no festival internacional de cinema na Suécia",
            "data" => "20251020",
            "imagem" => "https://exemplo.com/imagem/arte.jpg",
        ];
        return new JsonResponse($new);
    }
}