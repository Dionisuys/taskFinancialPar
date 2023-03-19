<?php

namespace App\Controller;

use App\Entity\Client;
use App\Entity\Manager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ManagerController extends AbstractController
{
    public function __construct(private readonly EntityManagerInterface $entityManager)
    {
    }

    /**
     * @Route("/manager_home")
     */
    public function index(string $username, Request $request): Response
    {
        // Получаем менеджера по его имени пользователя
        $manager = $this->entityManager->getRepository(Manager::class)->findOneBy(['username' => $username]);

        // Проверяем, что менеджер авторизован
        if (!$manager) {
            throw $this->createNotFoundException('Менеджер не найден');
        }

        // Проверяем, что текущий пользователь может видеть заявки только с четными или только с нечетными id
        $clientIdFilter = ($manager->getId() % 2 === 0) ? 'even' : 'odd';

        // Получаем все связанные с менеджером клиенты, отфильтрованные по id заявок
        $clients = $this->entityManager->getRepository(Client::class)->findByClientIdFilter($clientIdFilter);

        // Получаем все заявки клиентов, отсортированные по убыванию даты создания
        $requests = [];
        foreach ($clients as $client) {
            $clientRequests = $client->getRequests()->toArray();
            usort($clientRequests, fn ($a, $b) => $b->getCreatedAt() <=> $a->getCreatedAt());
            $requests = array_merge($requests, $clientRequests);
        }

        // Обрабатываем добавление комментария к заявке
        if ($request->isMethod('POST')) {
            $comment = $request->request->get('comment');
            $requestId = $request->request->get('requestId');
            $request = $this->entityManager->getRepository(Request::class)->find($requestId);

            // Проверяем, что заявка существует и принадлежит текущему менеджеру
            $client = $request->getClient();
            $clientUsername = $client->getUsername();
            $clientManager = $client->getManager();

            $query = $this->entityManager->createQuery(
                'SELECT r FROM App\Entity\Request r
                 JOIN r.client c
                 JOIN c.manager m
                 WHERE r.id = :id AND m = :manager'
            );
            $query->setParameter('id', $requestId);
            $query->setParameter('manager', $manager);
            $validRequest = $query->getOneOrNullResult();

            if (!$validRequest) {
                throw $this->createNotFoundException('Заявка не найдена');
            }

            // Добавляем комментарий к заявке
            $validRequest->addComment($comment);
            $this->entityManager->flush();

            // Редиректим на текущую страницу, чтобы избежать повторной отправки формы
            return $this->redirectToRoute('manager', ['username' => $username]);
        }

        return $this->render('manager/index.html.twig', [
            'manager' => $manager,
            'requests' => $requests,
        ]);
    }
}
