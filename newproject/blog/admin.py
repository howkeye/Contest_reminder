# -*- coding: utf-8 -*-
from __future__ import unicode_literals

from django.contrib import admin
from .models import Post,Code,chefuser

admin.site.register(Post)
admin.site.register(Code)
admin.site.register(chefuser)
# Register your models here.
