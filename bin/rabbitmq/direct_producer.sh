#!/bin/bash
docker exec -it --user www lab_php bash -c "php /data1/app/rabbitmq/producer.php --queue=task --ack=1 --durable=1"