from django.contrib import admin
from movies.models import Movie, Rental


class MovieAdmin(admin.ModelAdmin):
    list_display = ('name', 'release_date', 'score')


class RentalAdmin(admin.ModelAdmin):
    list_display = ('user', 'movie', 'start_datetime')


admin.site.register(Movie, MovieAdmin)
admin.site.register(Rental, RentalAdmin)
