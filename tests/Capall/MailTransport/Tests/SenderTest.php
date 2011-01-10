<?php
/**
 *
 * @author Alexey Shockov <alexey@shockov.com>
 * @package Capall_MailTransport_Tests
 */

require_once dirname(__FILE__).'/../../../../src/sh.mailtransport/classes/Capall/MailTransport/Sender.php';
require_once 'Net/SMTP.php';

/**
 *
 * @author Alexey Shockov <alexey@shockov.com>
 * @package Capall_MailTransport_Tests
 */
class Capall_MailTransport_Tests_SenderTest
    extends PHPUnit_Framework_TestCase
{

    private $_transport;

    protected function setUp()
    {
        $this->_transport = $this->getMock(
        	'Net_SMTP',
            array(),
            array(),
            '',
            false // Don't call original constructor.
        );
    }
    /**
     *
     */
    public function testMultipleRecipients()
    {
        $this->markTestIncomplete();
    }
    /**
     *
     */
    public function testSimpleSending()
    {
        $this->markTestIncomplete();
    }
}
