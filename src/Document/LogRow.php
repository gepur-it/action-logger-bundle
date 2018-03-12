<?php
/**
 * @author: Andrii yakovlev <yawa20@gmail.com>
 * @since: 27.09.17
 */

namespace GepurIt\ActionLoggerBundle\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;


/**
 * Class ActionLogRow
 * @package ActionLoggerBundle\Entity
 *
 * @MongoDB\Document(repositoryClass="ActionLoggerBundle\Repository\LogRowRepository")
 * @MongoDB\HasLifecycleCallbacks()
 */
class LogRow
{
    const ACTION__MAIL_WITH_ANSWER = 'answer_client_mail';
    const ACTION__MAIL_WITHOUT_ANSWER = 'close_email_without_answer';
    const ACTION__TAKE_NEW_CLIENT_MAIL = 'client_email_take_new_email';
    const ACTION__CLOSE_RELATION = 'close_relation';
    const ACTION__NEW_OUTGOING_EMAIL = 'new_client_mail';
    const ACTION__DEFER_RELATION = 'defer_relation';

    /**
     * @var string
     * @MongoDB\Id(strategy="UUID")
     */
    private $logId;

    /**
     * @var \DateTime
     * @MongoDB\Field(type="date")
     * @MongoDB\Index(order="asc")
     */
    private $createdAt;

    /**
     * @var string
     * @MongoDB\Field(type="string")
     * @MongoDB\Index()
     */
    private $actionName = '';

    /**
     * @var string
     * @MongoDB\Field(type="string")
     */
    private $actionLabel = '';

    /**
     * @var string
     * @MongoDB\Field(type="string", nullable=false)
     * @MongoDB\Index()
     */
    private $authorId = '';


    /**
     * @var string
     * @MongoDB\Field(type="string", nullable=false)
     */
    private $authorName = '';

    /**
     * @var mixed
     * @MongoDB\Field(type="raw", nullable=true )
     */
    private $actionData = '';


    /**
     * @return string
     */
    public function getLogId(): string
    {
        return $this->logId;
    }

    /**
     * @return string
     */
    public function getActionName(): string
    {
        return $this->actionName;
    }

    /**
     * @param string $actionName
     */
    public function setActionName(string $actionName)
    {
        $this->actionName = $actionName;
    }

    /**
     * @return string
     */
    public function getAuthorId(): string
    {
        return $this->authorId;
    }

    /**
     * @param string $authorId
     */
    public function setAuthorId(string $authorId)
    {
        $this->authorId = $authorId;
    }

    /**
     * @return string
     */
    public function getActionLabel(): string
    {
        return $this->actionLabel;
    }

    /**
     * @param string $actionLabel
     */
    public function setActionLabel(string $actionLabel)
    {
        $this->actionLabel = $actionLabel;
    }

    /**
     * @return string
     */
    public function getAuthorName(): string
    {
        return $this->authorName;
    }

    /**
     * @param string $authorName
     */
    public function setAuthorName(string $authorName)
    {
        $this->authorName = $authorName;
    }

    /**
     * @return mixed
     */
    public function getActionData()
    {
        return $this->actionData;
    }

    /**
     * @param mixed $actionData
     */
    public function setActionData($actionData)
    {
        $this->actionData = $actionData;
    }

    /**
     * @return \DateTime
     */
    public function getCreatedAt(): \DateTime
    {
        return $this->createdAt;
    }

    /**
     * @MongoDB\PrePersist()
     */
    public function prePersist()
    {
        $this->createdAt = new \DateTime('now');
    }
}

