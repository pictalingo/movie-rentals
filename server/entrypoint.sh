#!/bin/bash -e

service cron start

./manage.py migrate --no-input
./manage.py collectstatic --no-input
./manage.py crontab show
./manage.py crontab add
./manage.py crontab show
./manage.py runserver 0.0.0.0:8001
