from datetime import datetime, timedelta, date

from rest_framework import serializers
from django.contrib.auth.models import User
from movies.models import Movie, Rental


class UserSerializer(serializers.HyperlinkedModelSerializer):
    class Meta:
        model = User
        fields = ['id', 'username', 'email']


class MovieSerializer(serializers.ModelSerializer):
    rent_days_left = serializers.SerializerMethodField()

    class Meta:
        model = Movie
        fields = ['id', 'name', 'release_date', 'overview', 'image', 'score', 'rent_days_left']

    def get_rent_days_left(self, obj):
        try:
            request = self.context.get('request')
            # request.user.id = 1
            rental_obj = Rental.objects.get(movie=obj, user_id=request.user.id)

            diff = (datetime.now() - rental_obj.start_datetime)
            left_days = 7 - diff.days
            if left_days > 0:
                return left_days
            else:
                return None
        except:
            return None


class RentalSerializer(serializers.ModelSerializer):
    class Meta:
        model = Rental
        fields = ['start_datetime']
