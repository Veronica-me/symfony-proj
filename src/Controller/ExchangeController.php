<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\History;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class ExchangeController extends AbstractController
{
    /**
     * @Route("/exchange/values", name="exchange_values", methods={"POST"})
     */
    public function exchangeValues(Request $request, EntityManagerInterface $entityManager, ValidatorInterface $validator): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        if (!isset($data['first']) || !isset($data['second'])) {
            return new JsonResponse(['error' => 'Invalid JSON format'], JsonResponse::HTTP_BAD_REQUEST);
        }

        $constraints = new Assert\Collection([
            'first' => new Assert\Type(['type' => 'integer']),
            'second' => new Assert\Type(['type' => 'integer']),
        ]);
    
        $violations = $validator->validate($data, $constraints);
    
        if (count($violations) > 0) {
            // Handle validation errors, return a response, etc.
            return new JsonResponse(['error' => 'Invalid data type'], JsonResponse::HTTP_BAD_REQUEST);
        }

        $history = new History();
        $history->setFirstIn($data['first']);
        $history->setSecondIn($data['second']);
        $history->setCreateDate(new \DateTime());
        $entityManager->persist($history);
        $entityManager->flush();

        $updatedHistory = $entityManager->getRepository(History::class)->find($history->getId());
        $updatedHistory->setFirstOut($data['second']);
        $updatedHistory->setSecondOut($data['first']);
        $updatedHistory->setUpdateDate(new \DateTime());
        $entityManager->persist($updatedHistory);
        $entityManager->flush();

        return new JsonResponse(['first' => $data['second'], 'second' => $data['first']]);
    }
}
