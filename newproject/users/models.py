# -*- coding: utf-8 -*-
from __future__ import unicode_literals

from django.db import models
from django.contrib.auth.models import User

class Profile(models.Model):
	user=models.OneToOneField(User,on_delete=models.CASCADE)
	image=models.ImageField(default='default.jpeg',upload_to='profile_pics')

	def __str__(self):
		return ('{x} Profile'.format(x=self.user.username))