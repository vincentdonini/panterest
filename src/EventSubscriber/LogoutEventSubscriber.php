<?php

namespace App\EventSubscriber;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Session\Flash\FlashBagInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Security\Http\Event\LogoutEvent;

class LogoutEventSubscriber implements EventSubscriberInterface
{

    private $urlGenerator;
    private $flashBag;

    public function __construct(
        FlashBagInterface $flashBag,
        UrlGeneratorInterface $urlGenerator
    )
    {
        $this->flashBag = $flashBag;
        $this->urlGenerator = $urlGenerator;
    }

    public function onLogoutEvent(LogoutEvent $event): void
    {
        $this->flashBag->add('success', 'Seen you soon ' . $event->getToken()->getUser()->getFullName() . ' !');
        $event->setResponse(new RedirectResponse($this->urlGenerator->generate('app_login')));
    }

    public static function getSubscribedEvents(): array
    {
        return [
            LogoutEvent::class => 'onLogoutEvent',
        ];
    }
}
