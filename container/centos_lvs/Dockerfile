# Dockerfile - CentOS 7
FROM centos:7

LABEL maintainer="Tom <tom_hejiaxi@163.com>"

RUN yum install -y ipvsadm iproute
COPY mybin /mybin
RUN chmod +x -R /mybin

CMD ["/mybin/start.sh"]
