<?php
/**
 * @author: Andrii yakovlev <yawa20@gmail.com>
 * @since: 27.09.17
 */

namespace GepurIt\ActionLoggerBundle\Logger;

use GepurIt\ActionLoggerBundle\Document\LogRow;
use Doctrine\ODM\MongoDB\DocumentManager;
use GepurIt\User\Security\User;

/**
 * Class ActionLogger
 * @package GepurIt\Logger
 */
class ActionLogger implements ActionLoggerInterface
{
    /** @var DocumentManager */
    private $documentManager;

    /**
     * ActionLogger constructor.
     * @param DocumentManager $entityManager
     */
    public function __construct(
        DocumentManager $entityManager
    ) {
        $this->documentManager = $entityManager;
    }

    /**
     * {@inheritdoc}
     */
    public function log(User $user, string $actionName, string $actionLabel, $actionData = null)
    {
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

