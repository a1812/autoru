<?php

namespace App\Controller;

use App\Entity\Cars;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/ajax")
 */
class AjaxController extends AbstractController
{
    private function getModels(int $marka_id): array
    {
        $models = $this->getDoctrine()->getRepository('App:Model')->findBy([
            'marka' => $marka_id
        ]);
        $listModels = [];

        foreach ($models as $item) {
            $listModels[] = [
                'id' => $item->getId(),
                'name' => $item->getName()
            ];
        }

        return $listModels;
    }


    /**
     * @Route("/get-generation", name="getGeneration", methods={"POST"})
     */
    public function getGeneration(Request $request)
    {
        $generations = $this->getDoctrine()->getRepository('App:Generation')->findBy([
            'model' => $request->request->getInt('model_id')
        ]);
        $listGeneration = [];

        foreach ($generations as $item) {
            $listGeneration[] = [
                'id' => $item->getId(),
                'name' => $item->getName()
            ];
        }

        return new JsonResponse($listGeneration);
    }


    /**
     * @Route("/get-marki", name="getMarki", methods={"POST"})
     */
    public function getMarki()
    {
        $allMarka = $this->getDoctrine()->getRepository('App:Marka')->findAll();
        $listMarka = [];

        foreach ($allMarka as $item) {
            $listMarka[] = [
                'id' => $item->getId(),
                'name' => $item->getName()
            ];
        }

        return new JsonResponse($listMarka);
    }


    /**
     * @Route("/get-models-and-generation", name="getModelsAndGeneration", methods={"POST"})
     */
    public function getModelsAndGeneration(Request $request)
    {
        $listModels = $this->getModels($request->request->getInt('marka_id'));
        $listGeneration = [];

        if ($listModels) {
            $generations = $this->getDoctrine()->getRepository('App:Generation')->findBy([
                'model' => $listModels[0]['id']
            ]);

            foreach ($generations as $item) {
                $listGeneration[] = [
                    'id' => $item->getId(),
                    'name' => $item->getName()
                ];
            }
        }

        return new JsonResponse([
            'models' => $listModels,
            'generation' => $listGeneration
        ]);
    }


    /**
     * @Route("/car-del", name="carDelete", methods={"POST"})
     */
    public function carDelete(Request $request)
    {
        $car = $this->getDoctrine()->getRepository('App:Cars')->find($request->request->getInt('id'));

        if ($car) {
            $this->getDoctrine()->getManager()->remove($car);
            $this->getDoctrine()->getManager()->flush();
            return new JsonResponse('OK');
        }

        return new JsonResponse('ERR');
    }


    /**
     * @Route("/car-new", name="carNew", methods={"POST"})
     */
    public function carNew(Request $request)
    {
        $name = $request->request->get('name');
        $marka = $this->getDoctrine()->getRepository('App:Marka')->find($request->request->getInt('marka_id'));
        $model = $this->getDoctrine()->getRepository('App:Model')->find($request->request->getInt('model_id'));
        $generation = $this->getDoctrine()->getRepository('App:Generation')->find($request->request->getInt('generation_id'));

        if (!$name || !$marka || !$model || !$generation) {
            throw new Exception('Required: name, marka, model, generation');
        }

        $car = (new Cars())
            ->setName($name)
            ->setMarka($marka)
            ->setModel($model)
            ->setGeneration($generation);

        $this->getDoctrine()->getManager()->persist($car);
        $this->getDoctrine()->getManager()->flush();

        return new JsonResponse('OK');
    }


    /**
     * @Route("/car-upd", name="carUpdate", methods={"POST"})
     *
     */

    public function carUpdate(Request $request)
    {
        $name = $request->request->get('name');
        $car = $this->getDoctrine()->getRepository('App:Cars')->find($request->request->getInt('id'));
        $marka = $this->getDoctrine()->getRepository('App:Marka')->find($request->request->getInt('marka_id'));
        $model = $this->getDoctrine()->getRepository('App:Model')->find($request->request->getInt('model_id'));
        $generation = $this->getDoctrine()->getRepository('App:Generation')->find($request->request->getInt('generation_id'));

        if (!$name || !$car || !$marka || !$model || !$generation) {
            throw new Exception('Required: name, car, marka, model, generation');
        }

        $car->setName($name)
            ->setMarka($marka)
            ->setModel($model)
            ->setGeneration($generation);

        $this->getDoctrine()->getManager()->flush();

        return new JsonResponse('OK');
    }
}
