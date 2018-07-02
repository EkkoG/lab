#!/bin/bash
docker exec -it --user www lab_php bash -c "php /data1/app/rabbitmq/producer.php --queue=event_q1  --queue=event_q2 --exchange=event --exchange_type=fanout  --ack=1"