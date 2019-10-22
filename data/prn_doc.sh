#!/bin/bash
while true; do

if [ -f /var/www/html/km/data/cennik_sr.fods ]; then

libreoffice --minimized -pt  "printer" "/var/www/html/km/data/cennik_sr.fods"
rm -f "/var/www/html/km/data/cennik_sr.fods"

fi

if [ -f /var/www/html/km/data/hkod.fods ]; then

libreoffice --minimized -pt  "TSC-TDP-225" "/var/www/html/km/data/hkod.fods"
rm -f "/var/www/html/km/data/hkod.fods"

fi

sleep 2
done
