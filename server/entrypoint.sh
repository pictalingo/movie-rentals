#!/bin/bash -e

./manage.py migrate --no-input
./manage.py collectstatic --no-input
./manage.py crontab add
./manage.py runserver 0.0.0.0:8001
