[![Build Status](https://travis-ci.com/Sam-Burns/chip-beekeeper.svg?token=TLaUxgA5QfnLtZX6KwSm&branch=master)](https://travis-ci.com/Sam-Burns/chip-beekeeper)

# Chip Beekeeper Test
## Sam Burns

### How to Run

Build container:

`docker build -t beekeeper-container .`

Get shell:

`docker run --entrypoint "/bin/bash" -it beekeeper-container`

Run application from within container:

`php bin/beekeeper.php play`

Run tests from within container:

`composer test`

## Structural Overview

Source code is in `src/`.

The application uses the PHP DI dependency injection container. Its config is in `config/di.php`.

This is a Symfony Console Component application. You can find the relevant console command in the `src/Application` folder.

There are three kinds of test:
- Behat
- PhpSpec
- PHPUnit

PHPUnit test is just to test directly that the DI config isn't broken.

For a given feature of the domain, the following steps were taken __in this order__:
- Requirements from email captured in `tests/behat/features/feature_files/*.feature`
- Behavioural test step definitions written in `tests/behat/features/bootstrap/ServiceLevelContext.php`
- Domain objects identified in step definitions spec'ed using PhpSpec unit tests at `tests/phpspec`
- Production code written at `src/Domain`

For the CLI app itself, the end-to-end tests were written at `tests/behat/features/feature_files/playing_beekeeper.feature` and `tests/behat/features/bootstrap/CliContext.php`. The production code at `src/Application` was written at kind of the same time.

Travis is used as a CI tool, to run the tests in the Docker container provided.
