<?php
/**
 * @author: Andrii yakovlev <yawa20@gmail.com>
 * @since: 27.09.17
 */

namespace GepurIt\ActionLoggerBundle\Logger;

/**
 * Class ActionLogInterface
 * @package GepurIt\Logger
 */
interface ActionLoggerInterface
{
    /**
     * @param string $actionName
     * @param string $actionLabel
     * @param null $actionData
     * @return mixed
     */
    public function log(string $actionName, string $actionLabel, $actionData = null);
}

