# Create and Connect Kubernetes Cluster

  **Scenario :** 

  **Hands-on Location :** Your Labtop

  **Prerequisition :** 

---


## Create Required Services

### 1. Create File Storage for K8s

    Name: fsb

### 2. Create Load Balancer for K8s


### 3. Create File Storage for API Server client 

    Server Name: lbastiondmz
    Image: CentOS
    Security Group: BASTIONdmzSG (allow 22 port inbound/outbound for servers in bastion subnet)
   

 

 
Download Kubectl Client Program
(클러스터 버전과 일치할것을 권고, CLI와 클러스터 간 +-1 버전만 지원)

    sudo curl -LO https://dl.k8s.io/release/v1.26.8/bin/linux/amd64/kubectl

Install client program

    sudo install -o root -g root -m 0755 kubectl /usr/local/bin/kubectl

If it's not root, run commads to give permissions,

    sudo chmod +x kubectl 
    sudo mkdir -p ~/.local/bin
    sudo mv ./kubectl ~/.local/bin/kubectl

Run commnands for Kubernetes client to connect Kubernetes cluster API Server

     sudo mkdir ~/.kube
     sudo vi ~/.kube/config

In Kubernetes cluster console check private endpoint and download and copy kubeconfig(yaml) file contents
It looks like,

```yaml
apiVersion: v1
clusters:
- cluster:
    certificate-authority-data: LS0tLS1CRUdJTiBDRVJUSUZJQ0FURS0tLS0tCk1JSURBRENDQWVpZ0F3SUJBZ0lCQURBTkJna3Foa2lHOXcwQkFRc0ZBREFWTVJNd0VRWURWUVFERXdwcmRXSmwKY201bGRHVnpNQ0FYRFRJek1USXdOVEV6TURFMU1Gb1lEekl3TlRNeE1USTNNVE13TVRVd1dqQVZNUk13RVFZRApWUVFERXdwW9wVTc4bmFVSWxvenFxYkNpdE9HTmJhbnNFRzVGcApxejRyR1hZL0FCNCtWSlZKRFJLeWFueTFZaUptRyt1QUlKUXRNM1ZrVHE2NzA1UDVUTUloT3BRRkJGWUcrRzF2Ckt5OElZdU92MENrQWsyeitWTCtqemJZaHFrZHlURnNC
    server: https://k8sclb-1.f0sin.com:6443
  name: k8sclb-1f0q8
contexts:
- context:
    cluster: k8sclb-1f0q8
    user: user
  name: user@k8sclb-1f0q8
current-context: user@k8sclb-1f0q8
kind: Config
preferences: {}
users:
- name: user
  user:
    client-certificate-data: LS0tLS1CRUdJTiBDRVJUSUZJQ0FURS0tLS0tCk1JSURGekNDQWYrZ0F3SUJBZ0lJZlQyMlJDbHk3WjB3RFFZSktvWklodmNOQVFFTEJRQXdGVEVUTUJFR0ExVUUKQXhNS2EzVmlaWEp1WlhSbGN6QWdGdzB5TXpFeU1EVXhNekF4TlRCYUdBOHlNRFV6TVRFeU56RXpNREUxTTFvdwpLREVYTUJVR0ExVUVDaE1PYzNsemRHVnRPbTFoYzNSbGNuTXhEVTnJzZEpyeHhaLzhKbDdvUlNIZ3NxSzcKWW1sTHFSUGQrMnY5d1RucGV1KzVGUG9QY1hFWGlxT0hzTWNDCi0tLS0tRU5EIENFUlRJRklDQVRFLS0tLS0K
    client-key-data: LS0tLS1CRUdJTiBSU0EgUFJJVkFURSBLRVktLS0tLQpNSUlFb2dJQkFBS0NBUUVBckp5QjJva1JqRHloNmxhVVV6VkozOC9LdW1NaU9DOGlKVGdqVHpEN3RxZzZ2SEV6CmF6eEpzVnBud2xSTVIwYVd4N21mNmh5MDdlZllMZ0o5bHhNdFJjdlJEeElseVJJNmJVb3ZMeUR2MmpQV2FESUwKUGprQjZWWFlyRHp0Q29lWRrOU1TSmJLN0ZVNFowSDRKTXYwCmY4azFBb0dBSHl2MXpzOWJBU1drUm81dzRjVVZFTVpKSVUvbzJpSDl6YXM9Ci0tLS0tRU5EIFJTQSBQUklWQVRFIEtFWS0tLS0tCg==
```

Run commands where it is connected correctly

    kubectl version
    kubectl get nodes
    
- Test Kubectl commands in the link 

[https://kubernetes.io/ko/docs/reference/kubectl/cheatsheet/](https://kubernetes.io/ko/docs/reference/kubectl/cheatsheet/) 
 
