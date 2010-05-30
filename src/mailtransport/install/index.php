<?php
/**
 * Module descriptor (and installer).
 */

if (class_exists('mailtransport')) {
    return;
}

IncludeModuleLangFile(__FILE__);

/**
 * Module descriptor for Bitrix.
 *
 * @author Alexey Shockov <alexey@shockov.com>
 */
class mailtransport extends CModule
{
    public $MODULE_ID           = 'mailtransport';
    public $MODULE_VERSION      = '${bitrix.moduleVersion}';
    public $MODULE_VERSION_DATE = '${bitrix.moduleVersionDate}';

    public $MODULE_NAME;
    public $MODULE_DESCRIPTION;
    /**
     *
     */
    public function __construct()
    {
        $this->MODULE_NAME        = GetMessage(strtoupper($this->MODULE_ID).'_MODULE_NAME');
        $this->MODULE_DESCRIPTION = GetMessage(strtoupper($this->MODULE_ID).'_MODULE_DESCRIPTION');
    }
    /**
     * Registration.
     */
    public function DoInstall()
    {
        RegisterModule($this->MODULE_ID);

        // Register to observe any event, that fired before sending mail.
        RegisterModuleDependences(
            'main',
            'OnPageStart',
            $this->MODULE_ID,
            __CLASS__,
            'registerTransport'
        );
        RegisterModuleDependences(
            'main',
            'OnEventLogGetAuditTypes',
            $this->MODULE_ID,
            __CLASS__,
            'getEventLogAuditTypes'
        );
    }
    /**
     * Unregistration.
     */
    public function DoUninstall()
    {
        UnRegisterModuleDependences(
            'main',
            'OnEventLogGetAuditTypes',
            $this->MODULE_ID,
            __CLASS__,
            'getEventLogAuditTypes'
        );
        UnRegisterModuleDependences(
            'main',
            'OnPageStart',
            $this->MODULE_ID,
            __CLASS__,
            'registerTransport'
        );

        UnRegisterModule($this->MODULE_ID);
    }
    /**
     * Audit types for Bitrix event log.
     *
     * @return array
     */
    public static function getEventLogAuditTypes()
    {
        $errorIdentifier = 'MAILTRANSPORT_ERROR';

        return array(
            $errorIdentifier => '['.$errorIdentifier.'] '.GetMessage($errorIdentifier),
        );
    }
    /**
     * Empty method, only for callback (module already included).
     */
    public static function registerTransport()
    {

    }
}
