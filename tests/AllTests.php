<?php
/**
 * All tests suite.
 *
 * @author Alexey Shockov <alexey@shockov.com>
 */

require_once 'PHPUnit/Framework.php';

require_once dirname(__FILE__).'/Capall/MailTransport/Tests/SenderTest.php';

/**
 * All tests suite.
 *
 * @author Alexey Shockov <alexey@shockov.com>
 */
class AllTests
{

    public static function suite()
    {
        $suite = new PHPUnit_Framework_TestSuite('mailtransport');

        $suite->addTestSuite('Capall_MailTransport_Tests_SenderTest.php');

        return $suite;
    }
}
