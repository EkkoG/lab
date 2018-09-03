#!/bin/bash

docker exec -it --user www lab_php bash -c "cd /data1/app/rabbitmq
                                            rm composer.lock
                                            composer update"