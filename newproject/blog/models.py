# -*- coding: utf-8 -*-
from __future__ import unicode_literals

from django.db import models
from django.utils import timezone
from django.contrib.auth.models import User
class Post(models.Model):
	title=models.CharField(max_length=100)
	content=models.TextField()
	date_posted=models.DateTimeField(default=timezone.now)
	author=models.ForeignKey(User,on_delete=models.CASCADE)

	def __str__(self):
		return self.title

class Code(models.Model):
	title=models.CharField(max_length=100)
	name=models.TextField()

	def __str__(self):
		return self.title
class chefuser(models.Model):
	username=models.CharField(max_length=100)
	currentrating=models.TextField()
	highestrating=models.TextField()
	def __str__(self):
		return self.username
#class ClassName(models.Model):
	
		

