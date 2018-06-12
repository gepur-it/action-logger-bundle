<?php

namespace Tests;

use Doctrine\ODM\MongoDB\DocumentManager;
use GepurIt\ActionLoggerBundle\Document\LogRow;
use GepurIt\ActionLoggerBundle\Logger\ActionLogger;
use GepurIt\User\Security\User;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

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

        $user = $this->getUserMock();

        $user->expects($this->once())
            ->method('getUserId')
            ->willReturn('string');
        $user->expects($this->once())
            ->method('getName')
            ->willReturn('string');
        $token = $this->createMock(TokenInterface::class);
        $token->expects($this->once())
            ->method('getUser')
            ->willReturn($user);
        $tokenStorageInterface = $this->createMock(TokenStorageInterface::class);
        $tokenStorageInterface->expects($this->once())
            ->method('getToken')
            ->willReturn($token);
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


        $actionLogger = new ActionLogger($entityManagerMock, $tokenStorageInterface);
        $actionLogger->log($actionName, $actionLabel);
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

        $user = $this->getUserMock();

        $user->expects($this->once())
            ->method('getUserId')
            ->willReturn('string');
        $user->expects($this->once())
            ->method('getName')
            ->willReturn('string');
        $token = $this->createMock(TokenInterface::class);
        $token->expects($this->once())
            ->method('getUser')
            ->willReturn($user);
        $tokenStorageInterface = $this->createMock(TokenStorageInterface::class);
        $tokenStorageInterface->expects($this->once())
            ->method('getToken')
            ->willReturn($token);

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

        $actionLogger = new ActionLogger($entityManagerMock, $tokenStorageInterface);
        $actionLogger->log($actionName, $actionLabel, $actionData);
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
            ->setMethods(
                [
                    'getUserId',
                    'getName',
                ]
            )
            ->getMock();
    }
}
