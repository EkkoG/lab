#!/bin/bash
docker exec -it --user www lab_php bash -c "php /data1/app/rabbitmq/producer.php --queue=tmp --ack=0 --auto_delete=1"