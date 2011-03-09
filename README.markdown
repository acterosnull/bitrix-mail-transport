Bitrix Mail Transport
=====================

Simple mail transport module for Bitrix CMS. Providing ability to setup custom SMTP server in settings and send all mail over it.

Installation
------------

Module may be installed over PEAR channel:

    pear channel-discover capall.shockov.com
    pear install capall/mailtransport

Or over Bitrix update system from [marketplace](http://www.1c-bitrix.ru/solutions/marketplace/sh.mailtransport "MailTransport").

With PEAR you need also create symlink in your Bitrix installation(s):

    ln -s /your-pear-directory/capall/sh.mailtransport /your-site-document-root-directory/bitrix/modules/sh.mailtransport
