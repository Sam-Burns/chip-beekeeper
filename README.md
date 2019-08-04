Build container:

`docker build -t beekeeper-container .`

Get shell:

`docker run --entrypoint "/bin/bash" -it beekeeper-container`

Run application:

`php bin/beekeeper.php`
