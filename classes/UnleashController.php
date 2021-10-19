<?php

## Namespace for DevCoder to load Environment variables into php
namespace DevCoder;

## Script to load .env Environment variables into php
class DotEnv
{
    /**
     * The directory where the .env file can be located.
     *
     * @var string
     */
    protected $path;


    public function __construct(string $path)
    {
        if(!file_exists($path)) {
            throw new \InvalidArgumentException(sprintf('%s does not exist', $path));
        }
        $this->path = $path;
    }

    public function load() :void
    {
        if (!is_readable($this->path)) {
            throw new \RuntimeException(sprintf('%s file is not readable', $this->path));
        }

        $lines = file($this->path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        foreach ($lines as $line) {

            if (strpos(trim($line), '#') === 0) {
                continue;
            }

            list($name, $value) = explode('=', $line, 2);
            $name = trim($name);
            $value = trim($value);

            if (!array_key_exists($name, $_SERVER) && !array_key_exists($name, $_ENV)) {
                putenv(sprintf('%s=%s', $name, $value));
                $_ENV[$name] = $value;
                $_SERVER[$name] = $value;
            }
        }
    }
}

use DevCoder\DotEnv;

$absolutePathToEnvFile = '/var/www/html/.env';

(new DotEnv($absolutePathToEnvFile))->load();

## Namespace for Feature Flags
namespace Grav\Plugin\Featureflags;

## Script that holds and connects feature flags with GitLab
use Unleash\Client\UnleashBuilder;

class UnleashController {
    public static function createUnleashClient() {
        $unleash = UnleashBuilder::create()
        ## This is where PHP fills in an environment variable from .env
        ->withGitlabEnvironment(getenv('CI_ENVIRONMENT_NAME'))
        ->withInstanceId('xqdVGzcUnpKcxE6rySzv')
        ->withAppUrl('https://gitlab.com/api/v4/feature_flags/unleash/28698188')
        ## Next two lines save some unnecessary hhtp requests because these services are active by default.
        ->withAutomaticRegistrationEnabled(false)
        ->withMetricsEnabled(false)
        ->build(); 

        ## Unleash feature flag testcode.
        ##
        ## Copy this section and start developing a new feature.
        # if ($unleash->isEnabled("test")) {
        #     var_dump('The ip-protection feature is ON on ' . getenv('CI_ENVIRONMENT_NAME'));
        #     echo $_SERVER['REMOTE_ADDR'];
        #     echo "PHP Version is " .$_ENV["PHP_VERSION"];
        #     var_dump(getenv('CI_ENVIRONMENT_NAME'));
        #     die();
        #   } else {
        #     var_dump('The ip-protection feature is OFF on ' . getenv('CI_ENVIRONMENT_NAME')); 
        #     echo "PHP Version is " .$_ENV["PHP_VERSION"];
        #     var_dump(getenv('CI_ENVIRONMENT_NAME'));
        #     die();
        #   }

        ## Unleash ip-protection feature
        ##
        if ($unleash->isEnabled("ip-protection")) {
            ## 172.24.0.1 = IP localhost Johnnie
            ## 172.18.0.2 = IP Johnnie web
            $ips = array("172.24.0.1", "172.18.0.2");
            if(!in_array($_SERVER['REMOTE_ADDR'], $ips))
            {
                header("HTTP/1.1 401 Unauthorized");
                exit;
            }
          } else {
          }
       
        ## Unleash pw-protection feature
        ##
        if ($unleash->isEnabled("pw-protection")) {
            ## Very basic Login Script with user = admin and pw = admin as login
            if (!isset($_SERVER['PHP_AUTH_USER']) or isset($_POST['logout'])) {
                header('WWW-Authenticate: Basic realm="My Realm"');
                header('HTTP/1.0 401 Unauthorized');
                echo '<h1>Access Denied!</h1>';
                exit;
            } else {
                if(!($_SERVER['PHP_AUTH_USER']=='admin' and md5($_SERVER['PHP_AUTH_PW'])=='21232f297a57a5a743894a0e4a801fc3'))
                {
                    header('HTTP/1.0 401 Unauthorized');
                    exit;
                }
            }
          } else {
          }

        ## Unleash splash-screen feature
        ##
        if ($unleash->isEnabled("splash-screen")) {
            echo "<html>";
            echo "<head></head>";
            echo "<body class=\"page_bg\">";
            echo "<h1>This is where my Splash-Screen lives a happy life.</h1>";
            echo "Hello, today is ";
            echo date('l, F jS, Y'); //other php code here echo "</body>";
            echo "</html>";
            die();
          } else {
          }
    }
}