<?php

namespace Tests;

use GepurIt\ActionLoggerBundle\Document\LogRow;
use PHPUnit\Framework\TestCase;
use TypeError;


class LogRowTest extends TestCase
{
    public function testSetterGetter()
    {
        $logRaw = new LogRow();

        $actionName = 'Action Name';
        $actionLabel = 'Action Label';
        $authorId = 'authorId';
        $authorName = 'Author Name';
        $actionData = ['action', 'data', 23];

        $logRaw->setActionName($actionName);
        $logRaw->setAuthorId($authorId);
        $logRaw->setAuthorName($authorName);
        $logRaw->setActionLabel($actionLabel);
        $logRaw->setActionData($actionData);

        $this->assertEquals($actionName, $logRaw->getActionName());
        $this->assertEquals($authorId, $logRaw->getAuthorId());
        $this->assertEquals($authorName, $logRaw->getAuthorName());
        $this->assertEquals($actionLabel, $logRaw->getActionLabel());
        $this->assertEquals($actionData, $logRaw->getActionData());

        $logRaw->prePersist();
        $this->assertInstanceOf(\DateTime::class, $logRaw->getCreatedAt());
    }

    public function testExceptionOnGetCreatedBeforePersist()
    {
        $logRaw = new LogRow();
        $this->expectException(TypeError::class);
        $logRaw->getCreatedAt();
    }

    public function testExceptionLogId()
    {
        $logRaw = new LogRow();
        $this->expectException(TypeError::class);
        $logRaw->getLogId();
    }
}
