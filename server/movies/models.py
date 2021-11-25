from django.db import models
from django.contrib.auth.models import User
from django.utils.translation import ugettext_lazy as _


class Movie(models.Model):
    name = models.CharField(_('Name'), max_length=254, db_index=True)
    release_date = models.DateField(_('Release date'))
    overview = models.CharField(_('Overview'), max_length=1000)
    image = models.ImageField(_('Image'))
    score = models.PositiveSmallIntegerField(_('Score'))

    class Meta:
        verbose_name = _('Movie')
        verbose_name_plural = _('Movies')
        ordering = ['-score']

    def __str__(self):
        return '%s (%s)' % (self.name, self.release_date.year)


class Rental(models.Model):
    user = models.ForeignKey(User, related_name='rent_user', on_delete=models.deletion.PROTECT)
    movie = models.ForeignKey(Movie, related_name='rented_movie', on_delete=models.deletion.PROTECT)
    start_datetime = models.DateTimeField(_('Start rental date'), db_index=True)

    class Meta:
        verbose_name = _('Rental')
        verbose_name_plural = _('Rentals')
        ordering = ['-start_datetime']
