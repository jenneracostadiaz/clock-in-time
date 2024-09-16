<?php

namespace App\Support;

use App\Support\Settings\Application;

final class Settings
{
    private static ?Settings $instance = null;

    private Application $application;

    public function __construct()
    {
        $this->application = Application::new();
    }

    public static function getInstance(): Settings
    {
        if (self::$instance === null) {
            self::$instance = new self;
        }

        return self::$instance;
    }

    public static function application(): Application
    {
        return self::getInstance()->application;
    }
}
