**\*** THIS IS A WORK IN PROGRESS PROJECT, SEE ROADMAP BELOW **\***

# GRAV plugin to install the Unleash Feature Flags for GitLab

### Description

This plugin for Grav CMS (https://getgrav.org/) integrates the Unleash Feature Flag Service for the DevOps plattform GitLab (https://gitlab.com/).

Grav is a modern flat file-file CMS. It was voted "Best Flat File CMS" in 2017, 2019 & 2020 by CMS Critic's People Choice Award. We have experienced it as a stable, fast and flexible content management system to serve all kinds of websites.

Combinded with a multi stage environment CICD pipeline on GitLab and its built in issue Kanban you can easily run your website development in an agile environment which serves comfortable workflows for developmers and development teams in marketing and communication agencies out of the box.

### Getting Started

Requirements:
PHP 8.0.11 (cli)

...

### Roadmap

24. October 2021

- Review project and prepare for upload on https://getgrav.org/downloads/plugins

#### 21. October 2021

- Connect backend with UnleashController.php

#### 19. October 2021

- Initial push to this github repository
- Write a first version of README.md for github

#### 12. October 2021

- Add custom feature flag extension
- Prepare Plugin project for transfer from GitLab to github repository

#### 11. October 2021

- Complete fine tuning and multistage environment testing
- Added environment for localhost

#### 10. October 2021

- Main Development session
- Backend fine tuning

#### 09.  October 2021

- Preparing Plugin Backend

![image](https://user-images.githubusercontent.com/30041108/136654709-934a6743-c063-4969-880c-879769848733.png)

#### 08.  October 2021

- Updating the project title
- Preparing development session

#### 06.  October 2021

- We just started developing. The Plugin will be available soon.

# Featureflags Plugin

**This README.md file should be modified to describe the features, installation, configuration, and general usage of the plugin.**

The **Featureflags** Plugin is an extension for [Grav CMS](http://github.com/getgrav/grav). Bla bla

## Installation

Installing the Featureflags plugin can be done in one of three ways: The GPM (Grav Package Manager) installation method lets you quickly install the plugin with a simple terminal command, the manual method lets you do so via a zip file, and the admin method lets you do so via the Admin Plugin.

### GPM Installation (Preferred)

To install the plugin via the [GPM](http://learn.getgrav.org/advanced/grav-gpm), through your system's terminal (also called the command line), navigate to the root of your Grav-installation, and enter:

    bin/gpm install featureflags

This will install the Featureflags plugin into your `/user/plugins`-directory within Grav. Its files can be found under `/your/site/grav/user/plugins/featureflags`.

### Manual Installation

To install the plugin manually, download the zip-version of this repository and unzip it under `/your/site/grav/user/plugins`. Then rename the folder to `featureflags`. You can find these files on [GitHub](https://github.com//grav-plugin-featureflags) or via [GetGrav.org](http://getgrav.org/downloads/plugins#extras).

You should now have all the plugin files under

    /your/site/grav/user/plugins/featureflags

> NOTE: This plugin is a modular component for Grav which may require other plugins to operate, please see its [blueprints.yaml-file on GitHub](https://github.com//grav-plugin-featureflags/blob/master/blueprints.yaml).

### Admin Plugin

If you use the Admin Plugin, you can install the plugin directly by browsing the `Plugins`-menu and clicking on the `Add` button.

## Configuration

Before configuring this plugin, you should copy the `user/plugins/featureflags/featureflags.yaml` to `user/config/plugins/featureflags.yaml` and only edit that copy.

Here is the default configuration and an explanation of available options:

```yaml
enabled: true
```

Note that if you use the Admin Plugin, a file with your configuration named featureflags.yaml will be saved in the `user/config/plugins/`-folder once the configuration is saved in the Admin.

## Usage

**Describe how to use the plugin.**

## Credits

**Did you incorporate third-party code? Want to thank somebody?**

## To Do

- [ ] Future plans, if any
