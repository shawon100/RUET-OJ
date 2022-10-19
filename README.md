# RUET-OJ

[RUET OJ](https://oj.redlimesolutions.ml/) is the 1st Open Source Online Judge 
Platform Of Bangladesh .



# Developer

[Ashadullah Shawon](https://www.facebook.com/ashadullah.shawon)


# Live RUET-OJ 

https://oj.redlimesolutions.ml


# Languages

## Front End

HTML, CSS, BootStrap, JavaScript


## BackEnd 

PHP, MySQL


# Judge Languages
C , C++, C++11 And Java

# Requirements

Linux, gcc, g++ , Java Compilers And Lampp


# Install Compilers

C/C++
```
sudo add-apt-repository ppa:ubuntu-toolchain-r/test
echo "deb http://ftp.us.debian.org/debian/ jessie main contrib non-free" >>  /etc/apt/sources.list.d/toolchain.list
sudo apt-get update
sudo apt-get install g++-4.9


sudo ln -f -s /usr/bin/g++-4.9 /usr/bin/g++

```

Java
```
sudo add-apt-repository ppa:openjdk-r/ppa  
sudo apt-get update   
sudo apt install openjdk-8-jre
```

# Database Set Up
```
Import SQL Files From dbs Folder .

```

# Set Up Conncection
```
If you are using localhost then change configuration of config.php to

$host="localhost";
$user="root";
$pass="";
$db="reg";

```
# Change Permission
```
chmod -R 777 RUET-OJ

```

# Windows OS Version
There is also a windows version of this online judge with partial features. 
https://github.com/shawon100/RUET-Virtual-Lab

# Request
This online judge project is for learning purpose. Do not use it for commercial purpose. If you modify credits of footer, then add this github repository link to footer.

# Deploy Online (Openshift)
See this Video: https://www.youtube.com/watch?v=DGMptYjhGF4

# Deploy in Local Kubernetes

```
Go to deployments folder
cd deployments
kubectl apply -f .
Exec into MySQL Pod
kubectl exec -it pod-name bash
mysql -u root -p roj
Import reg.sql from dbs folder (Just Run the Queries using Copy and Paste)
Then check the service and nodeport on your local kubernetes
http://kubernetes-master-ip:NodePort

```

# Deploy in Cloud Kubernetes

```
Install Nginx Ingress Controller
Resource: https://www.shawonruet.com/2022/08/deploy-sample-live-angular-frontend.html
cd deployments
kubectl apply -f .
Exec into MySQL Pod
kubectl exec -it pod-name bash
mysql -u root -p roj
Import reg.sql from dbs folder (Just Run the Queries using Copy and Paste)
Check your host name from Ingress and Access
```