<?php
/**
 * @copyright Copyright (c) 2018 Keplerstein
 */

namespace keplerstein\phpmail;

use Craft;
use craft\mail\transportadapters\BaseTransportAdapter;
use Phpmail\Phpmail;
use Swift_Events_SimpleEventDispatcher;

/**
 * PhpmailAdapter implements a Phpmail transport adapter into Craft’s mailer.
 *
 * @property mixed $settingsHtml
 * @author Keplerstein
 * @since 1.0.0
 
 */
class PhpmailAdapter extends BaseTransportAdapter
{
    // Static
    // =========================================================================

    /**
     * @inheritdoc
     */
    public static function displayName(): string
    {
        return 'Phpmail';
    }

    // Properties
    // =========================================================================

    /**
     * @var string The API key that should be used
     */
    public $sendmailPath;

    // Public Methods
    // =========================================================================

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'sendmailPath' => Craft::t('phpmail', 'PHP Sendmail Path')
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['sendmailPath'], 'required'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function getSettingsHtml()
    {
        return Craft::$app->getView()->renderTemplate('phpmail/settings', [
            'adapter' => $this
        ]);
    }

    /**
     * @inheritdoc
     */
    public function defineTransport()
    {
        Craft::info("sendmailPath: ".$this->sendmailPath, __METHOD__);
        return [
            'class' => \Swift_SendmailTransport::class,
            'constructArgs' => [
                'command' => $this->sendmailPath ?? '/usr/sbin/sendmail -bs'
            ],
        ];
    }
}
