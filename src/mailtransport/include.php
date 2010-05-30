<?php
/**
 * custom_mail for Bitrix.
 */

// Some system functionality for Bitrix (mailtransport::registerTransport()).
require_once dirname(__FILE__).'/install/index.php';

require_once 'Net/SMTP.php';

require_once dirname(__FILE__).'/classes/Capall/MailTransportException.php';
require_once dirname(__FILE__).'/classes/Capall/MailTransport/Sender.php';

if (!function_exists('custom_mail')) {
    /**
     * @see CEvent::HandleEvent()
     * @see bxmail()
     *
     * @param string $to
     * @param string $subject
     * @param string $message
     * @param string $additionalHeaders Additional headers setted by Bitrix.
     *
     * @return bool
     */
    function custom_mail($to, $subject, $message, $additionalHeaders = '')
    {
        // Cache to send many mails in one script run.
        static $transport, $sender;

        try {
            if (!$sender) {
                if (!$transport) {
                    $host     = COption::GetOptionString('mailtransport', 'host');
                    if (COption::GetOptionInt('mailtransport', 'ssl')) {
                        $host = 'ssl://'.$host;
                    }
                    $port     = COption::GetOptionInt('mailtransport', 'port');
                    $user     = COption::GetOptionString('mailtransport', 'username');
                    $password = COption::GetOptionString('mailtransport', 'password');

                    $transport = new Net_SMTP($host, $port);

                    if (PEAR::isError($connectionResult = $transport->connect())) {
                        throw new Capall_MailTransportException($connectionResult);
                    }
                    if (PEAR::isError($authenticationResult = $transport->auth($user, $password))) {
                        throw new Capall_MailTransportException($authenticationResult);
                    }
                }

                $sender = new Capall_MailTransport_Sender($transport);
            }

            $sender->send($to, $subject, $message, $additionalHeaders);

            return true;
        } catch (Capall_MailTransportException $error) {
            CEventLog::Log(
                'WARNING',
                'MAILTRANSPORT_ERROR',
                'mailtransport',
                null, // TODO Or try to get event identifier to here?
                (string)$error
            );

            return false;
        } catch (Exception $error) {
            // Unknown error...

            return false;
        }
    }
}
