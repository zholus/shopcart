<?php
declare(strict_types=1);

namespace App\WebApi\Middleware;

use App\Common\Application\Command\CommandValidationException;
use App\Common\Application\NotFoundException;
use DomainException;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\HttpKernel\KernelEvents;

final class ErrorHandlerMiddleware implements EventSubscriberInterface
{
    public static function getSubscribedEvents(): array
    {
        return [
            KernelEvents::EXCEPTION => 'onKernelException',
        ];
    }

    public function onKernelException(ExceptionEvent $event): void
    {
        $exception = $event->getThrowable();

        $response = null;

        if ($exception instanceof CommandValidationException) {
            $response = new JsonResponse(
                ['errors' => $exception->getMessages()],
                Response::HTTP_BAD_REQUEST
            );
        }

        if ($exception instanceof DomainException) {
            $response = new JsonResponse(
                ['error' => $exception->getMessage()],
                Response::HTTP_CONFLICT
            );
        }

        if ($exception instanceof NotFoundException) {
            $response = new JsonResponse(
                ['error' => $exception->getMessage()],
                Response::HTTP_NOT_FOUND
            );
        }

        if ($response === null) {
            $response = new JsonResponse(
                ['error' => 'Unexpected internal server error'],
                Response::HTTP_CONFLICT
            );
        }

        $event->setResponse($response);
    }
}
