FROM python:3.8

RUN apt-get update
RUN apt-get -y install cron

WORKDIR /code

COPY requirements.txt /code/
RUN pip install -r requirements.txt

COPY . /code/
COPY entrypoint.sh /entrypoint.sh

RUN touch /var/log/cron.log
CMD /etc/init.d/cron start && tail - f /var/log/cron.log

RUN chmod +x /entrypoint.sh

ENTRYPOINT ["/entrypoint.sh"]
