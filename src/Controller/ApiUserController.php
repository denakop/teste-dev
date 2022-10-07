<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\UserRepository;
use App\Utils\Redis;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/api/user", defaults={"_format": "json"})
 */
class ApiUserController extends AbstractController
{
    /**
     * @Route("/getall", name="api_getall_user", methods={"GET"})
     *
     * @param Request $request
     * @param EntityManagerInterface $em
     *
     * @return JsonResponse
     *
     * @throws \JsonException
     * @throws \Exception
     */
    public function getall(EntityManagerInterface $em, Request $request): Response
    {
        $users = $em->getRepository(User::class)->findAll();

        $response = [];
        foreach ($users as $user) {
            $response[] = [
                'Id' => $user->getId(),
                'Name' => $user->getName(),
                'Age' => $user->getAge(),
            ];
        }

        $response = new JsonResponse($response);
        $response->setEncodingOptions( $response->getEncodingOptions() | JSON_PRETTY_PRINT );
        return $response;
    }
}

