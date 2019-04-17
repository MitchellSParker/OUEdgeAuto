#!/bin/sh

#################################
# This Script is to get your linux machine ready to  #
# host our PHP socket and Database.					#
#																			#
#################################

//Update system.
echo -e "\n System updating..."
sudo apt-get update -y && sudo apt-get upgrade -y
echo -e "\n Installing Apache"
sudo apt install apache2 -y
echo -e "\n Installing mysql-server"
sudo apt install mysql-server -y
echo -e "\n Installing PHP"
sudo apt install php libapache2-mod-php php-mysql
echo -e "\n Installing screen"
sudo apt install screen