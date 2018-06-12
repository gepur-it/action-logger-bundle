<?php
/**
 * @author: Andrii yakovlev <yawa20@gmail.com>
 * @since: 27.09.17
 */

namespace GepurIt\ActionLoggerBundle\Logger;

use GepurIt\ActionLoggerBundle\Document\LogRow;
use Doctrine\ODM\MongoDB\DocumentManager;
use GepurIt\User\Security\User;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

/**
 * Class ActionLogger
 * @package GepurIt\Logger
 */
class ActionLogger implements ActionLoggerInterface
{
    /** @var DocumentManager */
    private $documentManager;
    /** @var TokenStorageInterface  */
    private $tokenStorage;

    /**
     * ActionLogger constructor.
     * @param DocumentManager $entityManager
     * @param TokenStorageInterface $tokenStorage
     */
    public function __construct(
        DocumentManager $entityManager,
        TokenStorageInterface $tokenStorage
    ) {
        $this->documentManager = $entityManager;
        $this->tokenStorage = $tokenStorage;
    }

    /**
     * {@inheritdoc}
     */
    public function log(string $actionName, string $actionLabel, $actionData = null)
    {
        /** @var User $user */
        $user = $this->tokenStorage->getToken()->getUser();
        $log = new LogRow();
        $log->setAuthorId($user->getUserId());
        $log->setAuthorName($user->getName());
        $log->setActionName($actionName);
        $log->setActionLabel($actionLabel);
        $log->setActionData($actionData ?? '');

        $this->documentManager->persist($log);
        $this->documentManager->flush($log);
    }
}

