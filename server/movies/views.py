from datetime import datetime, timedelta

from rest_framework import viewsets
from rest_framework.response import Response

from movies.models import Movie
from movies.serializers import MovieSerializer


class MovieViewSet(viewsets.ModelViewSet):
    queryset = Movie.objects.all()
    serializer_class = MovieSerializer


class RentalsView(viewsets.ModelViewSet):
    queryset = Movie.objects.all()
    serializer_class = MovieSerializer

    def list(self, request, *args, **kwargs):
        rent_date_range = datetime.now() + timedelta(days=-7)
        current = request.user
        # current.id = 1
        rented_movies = Movie.objects.filter(rented_movie__user_id=current.id, rented_movie__start_datetime__gt=rent_date_range)
        serializer = self.get_serializer(rented_movies, many=True)
        return Response(serializer.data)
