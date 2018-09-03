#!/bin/bash
# target_hostname=`docker exec -it lab_rabbitmq  /bin/bash -c "hostname -s"`
target_hostname='2b8dbd557623'

docker exec -it lab_rabbitmq2  /bin/bash -c "rabbitmqctl stop_app
                                            rabbitmqctl join_cluster --ram rabbit@${target_hostname}
                                            rabbitmqctl start_app
                                            rabbitmqctl cluster_status"
