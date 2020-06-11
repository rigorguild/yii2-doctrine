<?php

declare(strict_types=1);

namespace app\controllers;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Serializer\SerializerInterface;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\Response;
use YiiDoctrineExample\Application\Command\EmitOrder;
use YiiDoctrineExample\Application\Command\EmitOrderHandler;
use YiiDoctrineExample\DomainModel\Order;

class OrdersController extends Controller
{
    private EmitOrderHandler $emitOrderHandler;
    private EntityManagerInterface $entityManager;
    /**
     * @var SerializerInterface
     */
    private SerializerInterface $serializer;

    public function __construct(
        $id,
        $module,
        EmitOrderHandler $emitOrderHandler,
        EntityManagerInterface $entityManager,
        SerializerInterface $serializer,
        $config = [])
    {
        $this->emitOrderHandler = $emitOrderHandler;
        $this->entityManager = $entityManager;
        $this->serializer = $serializer;

        parent::__construct($id, $module, $config);
    }

    public function actionEmit(): array
    {
        $this->entityManager->transactional(function() {
            $command = new EmitOrder(15.6);
            ($this->emitOrderHandler)($command);
        });

        $response = \Yii::$app->response;
        $response->statusCode = 201;
        $response->format = Response::FORMAT_JSON;

        return ['success' => true];
    }

    public function actionView(int $id): void
    {
        $order = $this->entityManager->find(Order::class, $id);

        if (null === $order) {
            throw new NotFoundHttpException;
        }

        $response = \Yii::$app->response;
        $response->statusCode = 200;
        $response->format = Response::FORMAT_JSON;
        $response->content = $this->serializer->serialize($order, 'json');
    }
}
