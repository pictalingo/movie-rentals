from django.urls import path, include
from rest_framework import routers

from movies.views import MovieViewSet, UserRentalsView, RentMovieView
from rest_framework_simplejwt.views import TokenObtainPairView, TokenRefreshView

router = routers.DefaultRouter()
router.register(r'movies', MovieViewSet)
router.register(r'rentals', UserRentalsView)
router.register(r'rent', RentMovieView)

urlpatterns = [

    path('token/', TokenObtainPairView.as_view(), name='token_obtain_pair'),
    path('token/refresh/', TokenRefreshView.as_view(), name='token_refresh'),

    path('', include(router.urls)),

]
