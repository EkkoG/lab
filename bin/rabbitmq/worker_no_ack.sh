#!/bin/bash

docker exec -it --user www lab_php bash -c "php /data1/app/rabbitmq/consumer.php --queue=task --ack=0"