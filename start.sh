#!/bin/sh
/usr/bin/mariadbd-safe --nowatch
php -S 0.0.0.0:5000
