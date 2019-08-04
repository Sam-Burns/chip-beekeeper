[![Build Status](https://travis-ci.com/Sam-Burns/chip-beekeeper.svg?token=TLaUxgA5QfnLtZX6KwSm&branch=master)](https://travis-ci.com/Sam-Burns/chip-beekeeper)

# Chip Beekeeper Test
## Sam Burns

Build container:

`docker build -t beekeeper-container .`

Get shell:

`docker run --entrypoint "/bin/bash" -it beekeeper-container`

Run application from within container:

`php bin/beekeeper.php`

Run tests from within container:

`composer test`
