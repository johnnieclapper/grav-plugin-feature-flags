<?php
## I'm a testcomment
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
use Grav\Common\Grav;
use Grav\Common\Utils;

## Script that holds and connects feature flags with GitLab
use Unleash\Client\UnleashBuilder;

class UnleashController {
    public static function createUnleashClient() {
        $grav = Grav::instance();
        $env = $grav['config']->get('plugins.featureflags');
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
            ## Print array of IPs
            ## echo '<pre>'; print_r($env['allowed_ip']); echo '</pre>';
            if(!in_array($_SERVER['REMOTE_ADDR'], $env['allowed_ip']))
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
                $adminUser = $env['login_name'];
                $adminPassword = $env['login_password'];
                if(!($_SERVER['PHP_AUTH_USER'] == $adminUser and md5($_SERVER['PHP_AUTH_PW']) == $adminPassword))
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
            // echo "<html>";
            // echo "<head></head>";
            // echo "<body class='page_bg' style='background-image: url(splash-screen-wallpaper.jpg);'>";
            // echo "<h1>This is where my Splash-Screen lives a happy life.</h1>";
            // echo "Hello, today is ";
            // echo date('l, F jS, Y'); //other php code here echo "</body>";
            // echo "</html>";
            echo '
                <!DOCTYPE html>
                <html lang="en">
                <head>
                    <meta charset="UTF-8">
                    <meta http-equiv="X-UA-Compatible" content="IE=edge">
                    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                    <title>Document</title>
                    <style>
                        body {
                            margin: 0;
                            padding: 0;
                            font-family: sans-serif;
                            color: white;
                            overflow: hidden;
                        }
                        
                        .page_bg {
                            /* background-image: url('. $env['splash_screen']['image'] . '); */
                        }

                        .splash-wrapper {
                            position: absolute;
                            top: 50%;
                            left: 50%;
                            transform: translate(-50%, -50%);
                            width: 100vw;
                            height: 100vh;
                            background: linear-gradient(180deg, rgb(10 50 90), rgb(20 10 30));
                            background-position: center;
                            background-size: cover;
                        }
                        .splash-visuals {
                            z-index: -1;
                        }
                        @keyframes rotate {
                            0% {transform: translate(-50%, -50%) rotate(0deg);}

                            100% {transform: translate(-50%, -50%) rotate(360deg);}
                        }
                        .splash-visuals .circle {
                            border: 5px rgba(0, 100, 255 , 0.5);
                            border-style: solid dashed;
                            width: 500px;
                            height: 500px;
                            box-shadow: 0px 0px 50px 0px rgb(0 50 150) inset, 0px 0px 100px 0px rgb(0 50 150);
                            position: absolute;
                            left: 50%;
                            top: 50%;
                            transform: translate(-50%, -50%);
                            border-radius: 1000px;
                            background-image: radial-gradient(rgba(0 50 150 / 0.2), rgba(0 100 255 / 0.3));
                            animation: rotate 240s linear 0s infinite;
                        }
                        .splash-visuals .background {
                            width: 100vw;
                            height: 100vh;
                            position: absolute;
                            left: 50%;
                            top: 50%;
                            transform: translate(-50%, -50%);
                            background-image: url(tech.jpg);
                            opacity: 0.1;
                            background-position: center;
                            background-size: cover;
                            filter: grayscale(0.5);
                        }

                        .splash-content {
                            text-align: center;
                            max-width: 400px;
                            position: absolute;
                            top: 50%;
                            left: 50%;
                            transform: translate(-50%, -50%);
                        }
                    </style>
                </head>
                <body class="page_bg">
                    
                    <div class="splash-wrapper">
                        <div class="splash-visuals">
                            <div class="background"></div>
                            <div class="circle"></div>
                        </div>
                        <div class="splash-content">
                            '. $env['splash_screen']['content'] .'
                        </div>
                    </div>

                </body>
                </html>
            ';
            die();
          } else {
          }
    }
}