<?php
/**
 * Created by PhpStorm.
 * User: pavlov
 * Date: 15.12.17
 * Time: 10:18
 */
namespace GepurIt\ActionLoggerBundle\DataFixtures;

use GepurIt\ActionLoggerBundle\Document\LogRow;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

/**
 * Class LogRowFixtures
 * @package ActionLoggerBundle\DataFixtures
 */
class LogRowFixtures extends Fixture
{
    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $fixtures = $this->getFixturesData();

        foreach ($fixtures as $fixture) {
            $log = new LogRow();
            $log->setAuthorId($fixture['author_id']);
            $log->setAuthorName($fixture['author_name']);
            $log->setActionData($fixture['action_data']);
            $log->setActionLabel($fixture['action_label']);
            $log->setActionName($fixture['action_name']);

            $manager->persist($log);
            $manager->flush();
        }
    }

    /**
     * @return array
     */
    protected function getFixturesData()
    {
        return [
            'client_email_take_new_email'=>[
                'author_id' => 'S-1-5-21-821191414-507608688-2850428263-1790',
                'author_name' => 'Test Test',
                'action_data' => [
                                    [
                                        "email_id"      => "bb05233c-daa8-11e7-841e-1c1b0dd4cb8f",
                                        "email_address" => "test@test.com",
                                        "relation_id"   => "7fc7a4d6-db4d-11e7-b8a8-1c1b0dd4cb8f"
                                    ]
                                ],
                'action_label' => 'Take new client',
                'action_name' => 'client_email_take_new_email',
            ],
            'answer_client_mail'=>[
                'author_id' => 'S-1-5-21-821191414-507608688-2850428263-1790',
                'author_name' => 'Test Test',
                'action_data' => '',
                'action_label' => 'Answer client email',
                'action_name' => 'answer_client_mail',
            ],
        ];
    }
}