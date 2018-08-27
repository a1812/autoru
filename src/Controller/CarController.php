<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class CarController extends AbstractController
{
    /**
     * @Route("/", name="car")
     */
    public function index()
    {
        return $this->render('car/index.html.twig', [
            'cars' => $this->getDoctrine()->getRepository('App:Cars')->findBy(
                [], ['id' => 'asc']),
            'marki' => $this->getDoctrine()->getRepository('App:Marka')->findAll()
        ]);
    }
}
