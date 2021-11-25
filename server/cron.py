from datetime import datetime
from django.core.mail import send_mail
from movies.models import Rental


def my_cron_job():

    print(datetime.today())
    rentals_list = Rental.objects.filter(start_datetime__year=datetime.today().year,
                                         start_datetime__month=datetime.today().month,
                                         start_datetime__day=datetime.today().day)

    if rentals_list.count() > 0:
        subject = 'Today rented %s movies' % rentals_list.count()

        body = ''
        for index, rent in enumerate(rentals_list):

            body += '%s' % rent.movie.name
            if index > 0 and index != rentals_list.count():
                body += ', '

        send_mail(
            subject,
            body,
            'dan@pictalingo.com',
            ['dan@ados.co.il'],
            fail_silently=False,
        )
