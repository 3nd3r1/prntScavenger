#!/bin/sh
/usr/bin/mariadbd-safe --nowatch --user=appuser
php -S 0.0.0.0:5000
