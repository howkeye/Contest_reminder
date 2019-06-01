from django.db import models

# Create your models here.
class  Registration(models.Model):
    email = models.CharField( max_length=256)
    name =  models.CharField( max_length=256)

class Contests(models.Model):
    website =models.CharField(max_length=10)
    name = models.CharField( max_length=256)
    date = models.DateField()
    Time = models.DateField()
    duration = models.DecimalField(max_digits=4,decimal_places=2)

    
    