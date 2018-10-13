* 不同namespace，不互通

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