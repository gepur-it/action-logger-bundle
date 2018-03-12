<?php
/**
 * @author: Andrii yakovlev <yawa20@gmail.com>
 * @since: 27.09.17
 */

namespace GepurIt\ActionLoggerBundle\Logger;

use Symfony\Component\Security\Core\User\AdvancedUserInterface as User;

/**
 * Class ActionLogInterface
 * @package GepurIt\Logger
 */
interface ActionLoggerInterface
{
    /**
     * @param User $user
     * @param string $actionName
     * @param string $actionLabel
     * @param null $actionData
     * @return mixed
     */
    public function log(User $user, string $actionName, string $actionLabel, $actionData = null);
}

