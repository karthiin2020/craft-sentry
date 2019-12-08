<?php

namespace lukeyouell\sentry\models;

use Craft;
use craft\base\Model;

use lukeyouell\sentry\Sentry;

class Settings extends Model
{
    // Public Properties
    // =========================================================================

    /**
     * @var boolean
     */
    public $enabled = true;

    /**
     * @var string
     */
    public $clientDsn;

    /**
     * @var string
     */
    public $environment = '$ENVIRONMENT';

    /**
     * @var string
     */
    public $excludedCodes = '404';

    // Public Methods
    // =========================================================================

    public function rules()
    {
        return [
            ['enabled', 'boolean'],
            [['clientDsn', 'environment', 'excludedCodes'], 'string'],
            [['clientDsn', 'environment'], 'required'],
        ];
    }

    public function getClientDsn()
    {
        return $this->clientDsn ? Craft::parseEnv($this->clientDsn) : null;
    }

    public function getEnvironment()
    {
        return $this->environment ? Craft::parseEnv($this->environment) : Craft::parseEnv('$ENVIRONMENT');
    }

    public function getExcludedStatusCodes()
    {
        return $this->excludedCodes ? array_map('trim', explode(',', Craft::parseEnv($this->excludedCodes))) : null;
    }
}
