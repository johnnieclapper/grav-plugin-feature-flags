v0.1.1

# GRAV plugin which integrates Unleash Feature Flags for GitLab

## Description

The **Featureflags** Plugin is an extension for [Grav CMS](http://github.com/getgrav/grav). It integrates the [Feature Flags](https://docs.gitlab.com/ee/operations/feature_flags.html) Service for the DevOps plattform [GitLab](https://gitlab.com/). Grav is a modern flat file-file CMS. It was voted "Best Flat File CMS" in 2017, 2019 & 2020 by CMS Critic's People Choice Award.

### GitLab Feature Flag Dashboard

GitLab provides a deployment dashboard to control feature flags which is ideal for multi-stage continuous deployment CI/CD pipelines in DevOps environments. Gitlab feature flags use [Unleash](https://www.getunleash.io/) as the feature flag engine.

With Feature Flags, you can deploy your application’s new features to production in smaller batches. You can toggle a feature on and off to subsets of users, helping you achieve Continuous Delivery.

### v0.1.1 of this plugin includes the following three features out-of-the-box

Custom feature flags configured inside the plugin will be added in the next development stage of the plugin. For now these three features are very helpful for development of digital projects in web agencies such as websites etc.

![image](https://user-images.githubusercontent.com/30041108/138959349-2327ba26-89fd-4808-ba29-3dcbc00a09fb.png)

### Overview

| Environment              | Development                                                          | Staging                                                                      | Production                                                       |
| ------------------------ | -------------------------------------------------------------------- | ---------------------------------------------------------------------------- | ---------------------------------------------------------------- |
| URL                      | `dev.yourDomain.com`                                                 | `staging.yourDomain.com`                                                     | `(www.)yourDomain.com`                                           |
| Demo                     | [dev.agile-digitalisierung.de](https://dev.agile-digitalisierung.de) | [staging.agile-digitalisierung.de](https://staging.agile-digitalisierung.de) | [www.agile-digitalisierung.de](https://agile-digitalisierung.de) |
| Stabilty                 | allowed to break                                                     | semi-stable                                                                  | stable                                                           |
| Scope                    | internal client                                                      | external client                                                              | public users                                                     |
| Security                 | ip protected                                                         | password protected                                                           | published to everyone                                            |
| Visibility Feature Flags | ip protection                                                        | password protection                                                          | splash screen                                                    |

## Getting Started

**Requirements:**

- GRAV v1.7.4 or higher
- PHP 8.0.11 (cli) or higher

<br><br>

+++++ It's not an official plugin yet, so you'll have to go with Manual Installation for now. Please ignore the other two options. +++++

## Installation

Installing the Featureflags plugin can be done in one of three ways: The GPM (Grav Package Manager) installation method lets you quickly install the plugin with a simple terminal command, the manual method lets you do so via a zip file, and the admin method lets you do so via the Admin Plugin.

## GPM Installation (Preferred)

To install the plugin via the [GPM](http://learn.getgrav.org/advanced/grav-gpm), through your system's terminal (also called the command line), navigate to the root of your Grav-installation, and enter:

    bin/gpm install featureflags

This will install the Featureflags plugin into your `/user/plugins`-directory within Grav. Its files can be found under `/your/site/grav/user/plugins/featureflags`.

## Manual Installation

To install the plugin manually, download the zip-version of this repository and unzip it under `/your/site/grav/user/plugins`. Then rename the folder to `featureflags`. You can find these files on [GitHub](https://github.com//grav-plugin-featureflags) or via [GetGrav.org](http://getgrav.org/downloads/plugins#extras).

You should now have all the plugin files under

    /your/site/grav/user/plugins/featureflags

Please note that Grav should now fail because the plugin is looking for the name of the environment it's running in.
You'll have to point the path in /user/plugins/featureflags/classes/UnleashController.php to your .env file. If you don't have any, just create one in the root directory of your project and fix the $absolutePathToEnvFile variable to your needs.

$absolutePathToEnvFile = '/var/www/html/.env';

Inside your .env file please add the following line: \
CI_ENVIRONMENT_NAME=nameofyourenvironment

It tells the plugin which environment your application runs in.

> NOTE: This plugin is a modular component for Grav which may require other plugins to operate, please see its [blueprints.yaml-file on GitHub](https://github.com//grav-plugin-featureflags/blob/master/blueprints.yaml).

## Admin Plugin

If you use the Admin Plugin, you can install the plugin directly by browsing the `Plugins`-menu and clicking on the `Add` button.

## Configuration

Before configuring this plugin, you should copy the `user/plugins/featureflags/featureflags.yaml` to `user/config/plugins/featureflags.yaml` and only edit that copy.

Here is the default configuration and an explanation of available options:

```yaml
enabled: true
```

Note that if you use the Admin Plugin, a file with your configuration named featureflags.yaml will be saved in the `user/config/plugins/`-folder once the configuration is saved in the Admin.
