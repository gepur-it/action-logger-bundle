<?php

namespace Tests;

use GepurIt\ActionLoggerBundle\Document\LogRow;
use GepurIt\ActionLoggerBundle\Logger\ActionLogger;
use Symfony\Component\Security\Core\User\AdvancedUserInterface as User;
use Doctrine\ODM\MongoDB\DocumentManager;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;

class ActionLoggerTest extends TestCase
{
    /**
     * Test case:
     * when log() has 2 args: $actionName, $actionLabel;
     */
    public function testLogWithTwoArgs()
    {
        $actionName = 'actionName';
        $actionLabel = 'actionLabel';

        //$entityManagerMock = $this->mockingEntityManager();
        $entityManagerMock = $this->getEntityManagerMock();
        $entityManagerMock
            ->expects($this->once())
            ->method('persist')
            ->with($this->isInstanceOf(LogRow::class))
            ->willReturn(null);
        $entityManagerMock
            ->expects($this->once())
            ->method('flush')
            ->with($this->isInstanceOf(LogRow::class))
            ->willReturn(null);

        $user = $this->getUserMock();

        $user->expects($this->once())
            ->method('getLdapSid')
            ->willReturn('string');
        $user->expects($this->once())
            ->method('getName')
            ->willReturn('string');


        $actionLogger = new ActionLogger($entityManagerMock);
        $actionLogger->log($user, $actionName, $actionLabel);
    }

    /**
     * Test case:
     * when log() has 3 args: $actionName, $actionLabel, $actionData
     */
    public function testLogWithThreeArgs()
    {
        $actionName = 'actionName';
        $actionLabel = 'actionLabel';
        $actionData = ['action' => 'data', 'params' => 2]; //for example

        //$entityManagerMock = $this->mockingEntityManager();
        $entityManagerMock = $this->getEntityManagerMock();
        $entityManagerMock
            ->expects($this->once())
            ->method('persist')
            ->with($this->isInstanceOf(LogRow::class))
            ->willReturn(null);
        $entityManagerMock
            ->expects($this->once())
            ->method('flush')
            ->with($this->isInstanceOf(LogRow::class))
            ->willReturn(null);

        $user = $this->getUserMock();

        $user->expects($this->once())
            ->method('getLdapSid')
            ->willReturn('string');
        $user->expects($this->once())
            ->method('getName')
            ->willReturn('string');

        $actionLogger = new ActionLogger($entityManagerMock);
        $actionLogger->log($user, $actionName, $actionLabel, $actionData);
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject|DocumentManager
     */
    private function getEntityManagerMock()
    {
        return $this->getMockBuilder(DocumentManager::class)
            ->disableOriginalConstructor()
            ->disableOriginalClone()
            ->disableArgumentCloning()
            ->disallowMockingUnknownTypes()
            ->setMethods(
                [
                    'persist',
                    'flush',
                ]
            )
            ->getMock();
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject|User
     */
    private function getUserMock()
    {
        return $this->getMockBuilder(User::class)
            ->disableOriginalConstructor()
            ->disableOriginalClone()
            ->disableArgumentCloning()
            ->setMethods([
                'getLdapSid',
                'getName',
                'isAccountNonLocked',
                'isAccountNonExpired',
                'isCredentialsNonExpired',
                'isEnabled',
                'getRoles',
                'getPassword',
                'getSalt',
                'getUsername',
                'eraseCredentials'
            ])
            ->getMock();
    }
}
