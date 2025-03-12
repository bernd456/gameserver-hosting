#!/bin/bash
set -e

GREEN='\033[0;32m'
NC='\033[0m'

echo -e "${GREEN}Master-Server Installation startet...${NC}"

# System-Updates & Installation grundlegender Pakete
apt update && apt upgrade -y
apt install -y apache2 mariadb-server php php-cli php-mysql git unzip ufw

# Firewall konfigurieren
ufw allow 22/tcp
ufw allow 80/tcp
ufw allow 443/tcp
ufw allow 3306/tcp
ufw --force enable

# Führe mysql_secure_installation interaktiv aus
echo -e "${GREEN}Bitte führen Sie 'mysql_secure_installation' aus.${NC}"
mysql_secure_installation

read -s -p "MySQL Root-Passwort: " MYSQL_ROOT_PASSWORD
echo ""

# Datenbank erstellen und Nutzer anlegen
mysql -u root -p$MYSQL_ROOT_PASSWORD -e "CREATE DATABASE gameserver_db;"
mysql -u root -p$MYSQL_ROOT_PASSWORD -e "CREATE USER 'gameserver'@'localhost' IDENTIFIED BY '$MYSQL_ROOT_PASSWORD';"
mysql -u root -p$MYSQL_ROOT_PASSWORD -e "GRANT ALL PRIVILEGES ON gameserver_db.* TO 'gameserver'@'localhost';"
mysql -u root -p$MYSQL_ROOT_PASSWORD -e "FLUSH PRIVILEGES;"

# WebUI klonen und installieren
WEB_DIR="/var/www/html"
rm -rf $WEB_DIR/*
git clone https://github.com/bernd456/gameserver-hosting.git /tmp/gs_temp
cp -r /tmp/gs_temp/master-server/webui/* $WEB_DIR/
chown -R www-data:www-data $WEB_DIR
chmod -R 755 $WEB_DIR

# Datenbankschema importieren
mysql -u gameserver -p$MYSQL_ROOT_PASSWORD gameserver_db < $WEB_DIR/database.sql

# Apache-Konfiguration erstellen
cat <<EOL > /etc/apache2/sites-available/gameserver.conf
<VirtualHost *:80>
    ServerAdmin admin@deinedomain.com
    DocumentRoot $WEB_DIR
    <Directory $WEB_DIR>
        AllowOverride All
        Require all granted
    </Directory>
    ErrorLog \${APACHE_LOG_DIR}/gameserver_error.log
    CustomLog \${APACHE_LOG_DIR}/gameserver_access.log combined
</VirtualHost>
EOL

a2ensite gameserver.conf
a2enmod rewrite
systemctl restart apache2
rm -rf /tmp/gs_temp

echo -e "${GREEN}Master-Server Installation abgeschlossen! Bitte prüfen Sie http://<server-ip> im Browser.${NC}"
