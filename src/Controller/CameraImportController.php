<?php

namespace App\Controller;

use App\Entity\Camera;
use App\Entity\Owner;
use App\Service\OrionService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/import/cameras", name="import_cameras_")
 */
class CameraImportController extends AbstractController
{
    /**
     * @Route("/orion", name="orion")
     */
    public function orionAction(): Response
    {
        ini_set("memory_limit", "-1");
        ini_set("max_execution_time", "-1");

        $data = OrionService::parseCameras();

        $owner = $this->getDoctrine()->getRepository(Owner::class)->find(1);

        $cntAll = count($data['cameras']);
        $cntNew = 0;
        $cntUpd = 0;

        if ($owner instanceof Owner) {
            foreach ($data['cameras'] as $item) {
                $camera = $this->getDoctrine()->getRepository(Camera::class)->findOneBy([
                    'key' => $item['id'],
                    'owner' => $owner
                ]);

                if (!$camera instanceof Camera) {
                    $camera = new Camera();
                    $camera->setKey($item['id']);
                    $camera->setOwner($owner);

                    $cntNew++;
                } else {
                    $cntUpd++;
                }

                $camera->setTitle($item['title']);
                $camera->setAngle(0);
                $camera->setLatitude($item['latitude']);
                $camera->setLongitude($item['longitude']);
                $camera->setPreview(sprintf(OrionService::ROUTE_CAMERA_PREVIEW, $camera->getKey()));
                $camera->setSource(sprintf(OrionService::ROUTE_CAMERA_SOURCE, $camera->getKey()));

                $this->getDoctrine()->getManager()->persist($camera);
            }

            $this->getDoctrine()->getManager()->flush();
        }

        echo "Всего найдено камер у источника: " . $cntAll . PHP_EOL;
        echo "Создано новых камер: " . $cntNew . PHP_EOL;
        echo "Обновлено камер: " . $cntUpd . PHP_EOL;

        return new Response("");
    }
}