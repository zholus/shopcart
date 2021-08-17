<?php
declare(strict_types=1);

namespace App\WebApi\Middleware;

use App\Common\Application\Command\CommandValidationException;
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

        $response = match ($exception::class) {
            CommandValidationException::class => new JsonResponse(
                ['error' => $exception->getMessages()],
                Response::HTTP_BAD_REQUEST
            ),
            DomainException::class => new JsonResponse(
                ['error' => $exception->getMessage()],
                Response::HTTP_CONFLICT
            ),
            default => new JsonResponse(
                ['error' => 'Unexpected internal server error'],
                Response::HTTP_CONFLICT
            ),
        };

        $event->setResponse($response);
    }
}
