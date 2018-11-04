# kubernetes

# 目录

* 包管理
    * Helm

* [常见问题](#常见问题)

# 常见问题

1. 在mac上运行minikube

```bash

curl -Lo docker-machine-driver-hyperkit https://storage.googleapis.com/minikube/releases/latest/docker-machine-driver-hyperkit \
&& chmod +x docker-machine-driver-hyperkit \
&& sudo cp docker-machine-driver-hyperkit /usr/local/bin/ \
&& rm docker-machine-driver-hyperkit \
&& sudo chown root:wheel /usr/local/bin/docker-machine-driver-hyperkit \
&& sudo chmod u+s /usr/local/bin/docker-machine-driver-hyperkit

minikube config set vm-driver hyperkit
eval $(minikube docker-env)
minikube start
kubectl config use-context minikube

```

参考资料：

https://github.com/kubernetes/minikube/blob/master/docs/drivers.md#hyperkit-driver

* 通过minikube创建的k8s集群，挂载本地目录

```bash

$ nohup minikube mount ~/Repository:/mount/repo &



```


* 不同namespace，常规方式访问不互通

```bash
$ eval $(minikube docker-env)
$ docker build -t lab-k8s-openresty:v1 ./container/centos_openresty
$ kubectl create -f etc/kubernetes/lab-hello-diff-namespace.yaml
$ kubectl create -f etc/kubernetes/lab-hello.yaml

$ kubectl get pods --namespace=lab
NAME                                    READY   STATUS    RESTARTS   AGE
lab-hello-deployment-6f4dd57d9d-fbxfk   1/1     Running   0          5m
lab-hello-deployment-6f4dd57d9d-jzvvl   1/1     Running   0          5m

$ kubectl get services --namespace=lab
NAME                TYPE           CLUSTER-IP       EXTERNAL-IP   PORT(S)        AGE
lab-hello-service   LoadBalancer   10.107.140.137   <pending>     80:31902/TCP   5s

$ curl -x 192.168.64.5:31902 'http://lab.tomhjx.com/aaaa'
abcabc111111

$ kubectl get services
NAME                TYPE           CLUSTER-IP     EXTERNAL-IP   PORT(S)        AGE
kubernetes          ClusterIP      10.96.0.1      <none>        443/TCP        2d
lab-hello-service   LoadBalancer   10.106.84.15   <pending>     80:31467/TCP   2m

$ curl -x 192.168.64.5:31467 'http://lab.tomhjx.com/aaaa'
curl: (7) Failed to connect to 192.168.64.5 port 31467: Connection refused

```

* 动态变更pods，services可以自动发现


```bash
$ kubectl get pods --namespace=lab
No resources found.

$ kubectl create -f etc/kubernetes/lab-hello-pod.yaml
pod/lab-hello-pod created
Error from server (AlreadyExists): error when creating "etc/kubernetes/lab-hello-pod.yaml": services "lab-hello-service" already exists

$ kubectl get pods --namespace=lab
NAME            READY   STATUS    RESTARTS   AGE
lab-hello-pod   1/1     Running   0          1m

$ curl -x 192.168.64.5:30282 'http://lab.tomhjx.com/aaaa'
abcabc111111

```

* service根据`.spec.selector`匹配pods作为路由目标

```bash

$ kubectl exec lab-hello-pod -it --namespace=lab /bin/bash

vi /etc/nginx/conf.d/lab.tomhjx.com.conf

server {
    listen 80;
    server_name lab.tomhjx.com;
    location / {
        echo "111122222";
    }
}

/usr/local/openresty/nginx/sbin/nginx -s reload

$ kubectl exec lab-hello-pod2 -it --namespace=lab /bin/bash

vi /etc/nginx/conf.d/lab.tomhjx.com.conf

server {
    listen 80;
    server_name lab.tomhjx.com;
    location / {
        echo "abcabc111111";
    }
}

/usr/local/openresty/nginx/sbin/nginx -s reload


$ kubectl create -f etc/kubernetes/lab-hello-pod.yaml
$ curl -x 192.168.64.5:30282 'http://lab.tomhjx.com/aaaa'
111122222
$ curl -x 192.168.64.5:30282 'http://lab.tomhjx.com/aaaa'
abcabc111111

```


* service根据`.spec.selector`匹配pods作为路由目标，创建多个deployment结果跟直接创建多个pods是一样的

```bash
$ kubectl create -f etc/kubernetes/lab-hello-multi-deployment.yaml
deployment.apps/lab-hello-deployment created
deployment.apps/lab-hello-deployment2 created
Error from server (AlreadyExists): error when creating "etc/kubernetes/lab-hello-multi-deployment.yaml": services "lab-hello-service" already exists

$ curl -x 192.168.64.5:30282 'http://lab.tomhjx.com/aaaa'
abcabc111111

$ curl -x 192.168.64.5:30282 'http://lab.tomhjx.com/aaaa'
111122222

```


* 外网通过80端口访问集群

1） 使用云服务

```

[云厂商负载均衡器]
       | 
       V
[service (type=LoadBalancer) ]

```

2 ) 自建

```
[ingress]
    | 
    |
    v
[service]

```



* chown: changing ownership of 'test': Input/output error

```bash

nohup minikube mount ~/test:/test --9p-version=9p2000.L >> /dev/null 2>&1 &

```

https://github.com/kubernetes/minikube/issues/2290
