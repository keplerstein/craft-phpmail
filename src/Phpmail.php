<?php
/**
 * Phpmail plugin for Craft CMS 3.x
 *
 * Plugin represents the Phpmail plugin which enables you to change PHP Sendmail path.
 *
 * @link      keplerstein.com
 * @copyright Copyright (c) 2018 Keplerstein
 */

namespace keplerstein\phpmail;


use Craft;
use craft\base\Plugin;
use craft\services\Plugins;
use craft\events\PluginEvent;

use craft\events\RegisterComponentTypesEvent;
use craft\helpers\MailerHelper;

use yii\base\Event;

/**
 * Class Phpmail
 *
 * @author    Keplerstein
 * @package   Phpmail
 * @since     1.0.0
 *
 */
class Phpmail extends Plugin
{
    // Static Properties
    // =========================================================================

    /**
     * @var Phpmail
     */
    public static $plugin;

    // Public Properties
    // =========================================================================

    /**
     * @var string
     */
    public $schemaVersion = '1.0.0';

    // Public Methods
    // =========================================================================

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        Event::on(MailerHelper::class, MailerHelper::EVENT_REGISTER_MAILER_TRANSPORT_TYPES, function(RegisterComponentTypesEvent $event) {
            $event->types[] = PhpmailAdapter::class;
        });
    }

    // Protected Methods
    // =========================================================================

}
