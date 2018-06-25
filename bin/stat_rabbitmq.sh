#!/bin/bash

cmd="rabbitmqctl list_queues name messages_ready messages_unacknowledged"
echo ${cmd}
docker exec -it lab_rabbitmq bash -c "${cmd}"


cmd="rabbitmqctl list_queues name state durable auto_delete arguments consumers"
echo ${cmd}
docker exec -it lab_rabbitmq bash -c "${cmd}"


cmd="rabbitmqctl list_queues name disk_reads disk_writes"
echo ${cmd}
docker exec -it lab_rabbitmq bash -c "${cmd}"