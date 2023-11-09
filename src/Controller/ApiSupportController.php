<?php

namespace App\Controller;

use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpFoundation\Response;

class ApiSupportController extends AbstractFOSRestController
{
    /**
     * @Rest\Get("/api/resource")
     */
    public function getResource(): Response
    {
        // Your logic here
        return $this->json(['message' => 'API resource here!']);
    }
}