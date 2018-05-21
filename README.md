# Turing Workshop Demo Repo

A Drupal 8 starter kit installed from Elevated Third's Paragon build.

## Requirements
1. [NVM](https://github.com/creationix/nvm) - Node Version Manager
2. [Composer](https://getcomposer.org/) - PHP package manager
3. [DrupalVM](https://www.drupalvm.com/) - Local environment intended for Drupal development.

## Environment Setup
1. Install all dependencies: VirtualBox, Vagrant, Ansible.
2. Ensure DrupalVM submodule is checked out: `git submodule update --init`.
3. Symlink included config.yml in DrupalVM to included config: `ln -s ../settings/config.4.7.2.yml config.yml`.
4. Build the VM: `vagrant up`.
5. Connect to the VM: `vagrant ssh`.
6. Import the included DB: `drush sql-cli < ../db/turing_workshop.sql`.
7. Log in to your Drupal site: `drush uli --uri=http://tw.dvm`.

Environment setup tested with: VirtualBox 5.2.12, Vagrant 2.1.1, Ansible 2.5.3.

## Git workflow

This project uses our standard single master branch workflow with date based tag releases. https://elevatedthird.github.io/docs/docs_git_workflow.html

## Config workflow

This project uses CMI for all configuration changes. To make a configuration update, first, sync the production database to your local environment and export and commit any config changes from the production environment to the project repo. After that, make your new configuration changes on your local environment, export those changes and commit them to the project repo. Once you're finished push those changes to the remote environment and run `drush cim vcs` to import all new configuration.

## Composer

All packages in this project are managed using Composer - see composer.json for detailed information about each package. This project is not being built serverside, so the vendor directory is committed - be sure any new packages you add are committed to this repo.