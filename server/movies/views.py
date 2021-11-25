from datetime import datetime, timedelta

from rest_framework import viewsets, generics, status
from rest_framework.response import Response

from movies.models import Movie, Rental
from movies.serializers import MovieSerializer, RentalSerializer


class MovieViewSet(viewsets.ModelViewSet):
    queryset = Movie.objects.all()
    serializer_class = MovieSerializer


class UserRentalsView(viewsets.ModelViewSet, generics.CreateAPIView):
    queryset = Movie.objects.all()
    serializer_class = MovieSerializer

    def list(self, request, *args, **kwargs):
        rent_date_range = datetime.now() + timedelta(days=-7)
        current = request.user
        # current.id = 1
        rented_movies = Movie.objects.filter(rented_movie__user_id=current.id,
                                             rented_movie__start_datetime__gt=rent_date_range)
        serializer = self.get_serializer(rented_movies, many=True)
        return Response(serializer.data)


class RentMovieView(viewsets.ModelViewSet, generics.CreateAPIView):
    queryset = Rental.objects.all()
    serializer_class = RentalSerializer

    def create(self, request, *args, **kwargs):
        current = request.user
        movie_id = request.data.get('movie_id', None)
        user_rents = Rental.objects.filter(movie_id=movie_id, user_id=current.id)

        if len(user_rents) > 0:
            return Response({'status': 'error', 'message': 'You can\'t rent a movie again'},
                            status=status.HTTP_400_BAD_REQUEST)
        else:
            try:
                new_rent = Rental.objects.create(movie_id=movie_id, user_id=current.id, start_datetime=datetime.now())
                return Response({'status': 'success'}, status=status.HTTP_201_CREATED)
            except:
                return Response({'status': 'error', 'message': 'Error to rent'}, status=status.HTTP_400_BAD_REQUEST)
