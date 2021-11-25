from django.urls import path, include
from rest_framework import routers

from movies.views import MovieViewSet, RentalsView
from rest_framework_simplejwt.views import TokenObtainPairView, TokenRefreshView

router = routers.DefaultRouter()
router.register(r'movies', MovieViewSet)
router.register(r'rentals', RentalsView)

urlpatterns = [

    path('token/', TokenObtainPairView.as_view(), name='token_obtain_pair'),
    path('token/refresh/', TokenRefreshView.as_view(), name='token_refresh'),

    path('', include(router.urls)),

]
