# repRec

# Table of Contents

- [0 TODO](#0-todo)
- [1 About](#1-about)
- [2 Local Setup](#2-local-setup)
- [3 Server Setup](#3-server-setup)
    - [3.1 Firewall](#31-firewall)
    - [3.2 SSH](#32-ssh)
        - [3.2.1 SSH Setup](#321-ssh-setup)
        - [3.2.2 Simple SSH connection](#322-simple-ssh-connection)
        - [3.2.3 SSH Key setup and connection](#323-ssh-key-setup-and-connection)
        - [3.2.4 Secure the SSH connection (no more PW login)](#324-secure-the-ssh-connection-no-more-pw-login)
    - [3.3 HTTPS/SSL Cert](#33-httpsssl-cert)
    - [3.4 Install all required Tools/Packages](#34-install-all-required-toolspackages)
    - [3.5 Useful Commands](#35-useful-commands)

# 0 TODO

- [x] Version 0.0.1 - Initial Setup
- [x] Version 0.1.0 - Administration and (Workout) Planning Features
- [ ] Version 0.2.0 - Training Features (Training Year, Week, Day)
- [ ] Version 0.3.0 - Plan Sharing, Notification and Email Features
- [ ] Version 0.4.0 - Training Progress and User Profile/Settings
- [ ] Version 0.5.0 - Final Polishing, Fixes, QoL Improvements
- [ ] Version 1.0.0 - GO LIVE

# 1 About
...

# 2 Local Setup

Laravel 11 application

# 3 Server Setup

Setup the hosting environment (Hetzner in this case) on a VPS running Debian 12
Server IPv4: 188.245.213.112
Server IPv6: 2a01:4f8:1c1c:d852::/64

Ensure the system is updated and install necessary dependencies:

```bash
sudo apt update && sudo apt upgrade -y
sudo apt install -y curl zip unzip git nginx
```
Critical updates can also be automated
```bash
apt install unattended-upgrades`
dpkg-reconfigure --priority=low unattended-upgrades
```

## 3.1 Firewall

Install the ufw (Uncomplicated Firewall) tool

`apt install ufw -y`

Configure firewall rules for ssh and web-hosting

`ufw allow 22/tcp      # Allow SSH`

`ufw allow 80/tcp      # Allow HTTP` (optional / only as long as HTTPS/SSL is not configured)

`ufw allow 443/tcp     # Allow HTTPS`

`ufw allow 5432/tcp    # Allow PostgreSQL`

`ufw default deny incoming` (deny ALL incoming that are not specifically allowed - should be default anyway)

Activate and check the status

`ufw enable`

`ufw status verbose`

## 3.2 SSH

### 3.2.1 SSH Setup

Install SSH on the server side (allows the server to accept connections)

`apt install openssh-server`

Install SSH on the client side (allows the client to create connections)

`apt install openssh-client`

Enable SSH services, activate on boot and verify if its running

```bash
systemctl start ssh
systemctl enable ssh
systemctl status ssh
```

### 3.2.2 Simple SSH connection

Simple ssh connect to the server from the client, with username and password

`ssh login-user@server-ip`

### 3.2.3 SSH Key setup and connection

Create a local ssh key

`ssh-keygen -t rsa -b 4096`
> Press Enter to save the key in the default location (~/.ssh/id_rsa).
> Optionally, set a passphrase for additional security.

Copy the public key to the VPS

`ssh-copy-id login-user@server-ip`

Test the connection: This should now work, without requiring a password

`ssh login-user@server-ip`

### 3.2.4 Secure the SSH connection (no more PW login)

Update the Firewall to allow a new port (optional but recommended)

`ufw allow 2222`

Edit the SSH Config File and change these settings

`nano /etc/ssh/sshd_config`

Disable password logins, allow only one user and change the default SSH port (optional but recommended)
> PasswordAuthentication no
> AllowUsers login-user
> Port 2222

Save and close the file (Ctrl+O, Enter, Ctrl+X).
Then restart the SSH service.

`systemctl restart ssh`

Deny the default port (22)

`ufw delete allow ssh`

Test the secure connection

`ssh -p 2222 login-user@server-ip`

To verify that password login is disabled: Try connecting without your SSH key. It should fail.


## 3.3 HTTPS/SSL Cert

To use Auth0 in a dev/prod environment, HTTPS (SSL) certificate is required.
To configure an SSL certificate, it makes sense to have a fixed domain registered.

Domain certificate setup with `certbot`
> Certificate location
> ssl_certificate /etc/letsencrypt/live/www.reprec.com/fullchain.pem;
> ssl_certificate_key /etc/letsencrypt/live/www.reprec.com/privkey.pem;

## 3.4 Install all required Tools/Packages

Install PHP and required extensions for Laravel

```bash
sudo apt install -y php php-cli php-fpm php-pgsql php-mbstring php-xml php-curl php-zip php-bcmath
```

Install PostgreSQL & Configure Database

```bash
sudo apt install -y postgresql postgresql-contrib
sudo systemctl enable postgresql
sudo systemctl start postgresql
```

Create Database & User

```bash
sudo -u postgres psql
```

```sql
CREATE DATABASE laravel_db;
CREATE USER laravel_user WITH PASSWORD 'your-secure-password';
GRANT ALL PRIVILEGES ON DATABASE laravel_db TO laravel_user;
\q
```

Deploy Laravel and clone the git repo
(get the .env from the local machine and update the database connection + the APP_ENV and APP_DEBUG variables)

```bash
cd /var/www
git clone https://github.com/your-repo/your-laravel-app.git laravel-app
cd laravel-app
cp .env.example .env
nano .env
```

```bash
composer install --no-dev --optimize-autoloader
php artisan key:generate
php artisan migrate --force
sudo chown -R www-data:www-data /var/www/laravel-app
sudo chmod -R 775 /var/www/laravel-app/storage /var/www/laravel-app/bootstrap/cache
```

Configure Nginx

Create an basic Nginx config file for Laravel and enter the default configuration, then enable the site and restart Nginx

```bash
sudo nano /etc/nginx/sites-available/laravel
```

```bash
sudo ln -s /etc/nginx/sites-available/laravel /etc/nginx/sites-enabled/
sudo nginx -t && sudo systemctl restart nginx
```

Build Frontend Assets (Vite)

Ensure Node.js & NPM are installed, then install all dependencies and build assets

```bash
cd /var/www/laravel-app
npm install
npm run build
```

Set permissions

```bash
sudo chown -R www-data:www-data /var/www/laravel-app
sudo chmod -R 775 /var/www/laravel-app/public/build
```

## 3.5 Useful Commands

| Task    | Command |
| -------- | ------- |
| Restart Nginx  | sudo systemctl restart nginx |
| Restart PostgreSQL | sudo systemctl restart postgresql |
| Restart PHP-FPM | sudo systemctl restart php-fpm |
| Check Nginx Logs | sudo tail -f /var/log/nginx/error.log |
| Check PostgreSQL Logs | sudo tail -f /var/log/postgresql/postgresql.log |
| Renew SSL Cert | sudo certbot renew |
| Clear Laravel caches | php artisan optimize:clear && php artisan config:cache && php artisan view:cache |

