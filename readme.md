# cdNode - Open Source CDN

![cdNode Logo](https://cdn.kindling.me/pub.php?id=00000002.jpeg)
<sub>Logo served with production CDN</sub>

---

## 📋 Overview
**cdNode** is a lightweight Content Delivery Network (CDN) designed to efficiently serve static assets such as images, JavaScript, CSS, and other files. The goal is to improve load times and reduce server strain by distributing content across multiple locations.

---

## 📝 Description
This repository includes both the **Routing** and **Origin Server** components, intended to run on `cdn.domain.com`.

- **Origin Server:** Hosts and manages the original content.  
- **Nodes:** Sync to the Origin Server and serve content based on user location.  
- Nodes are built into the Origin at the `/node` endpoint. For dedicated node deployments, Origin components can be removed.

---

## 🚀 How to Deploy (Debian)

### 🏁 Origin Server Setup

#### 📦 Dependencies
- **Apache2** web server  
- **PHP** interpreter  

#### 🛠 Installation Steps
1. **Create a directory and clone the repository:**
   ```bash
   mkdir -p /var/www/cdNode/
   cd /var/www/cdNode/
   git clone https://github.com/Fuushi/cdNode.git .
   ```
Update the configuration:
```
sudo nano config.json
```
Modify the config as needed:

```json
{
    "debug": false,
    "local_addr": "cdn.yourDomain.com",
    "protocol": "http",
    "nodes": [
        "cdn.yourDomain.com",
        "POINT TO YOUR NODES HERE"
    ]
}
```
Restart Apache:
```
sudo systemctl restart apache2
```

🖥️ Node Setup
To deploy a Node, repeat the Origin setup steps, then remove the Origin-specific components:

```
rm index.html origin.php pub.php static_test.php
```

📚 Additional Information
Ensure that config.json is correctly set up with your domain and node information.
For security and performance, consider enabling HTTPS and adjusting caching policies.
