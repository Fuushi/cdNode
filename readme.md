# cdNode open source CDN

![img](https://cdn.kindling.me/pub.php?id=00000002.jpeg)

<sub> logo served with production cdn </sub>

### Overview
This is a lightweight Content Delivery Network (CDN) designed to efficiently serve static assets such as images, JavaScript, CSS, and other files to users. The goal is to improve load times and reduce server strain by distributing content across multiple locations.

### Description
This is both the Routing and Origin Server, running on `cdn.domain.com`.

Nodes will sync to the Origin, and IPs will be routed from here.
nodes are built into origin at the node endpoint, for dedicated node deployments, origin components are removed