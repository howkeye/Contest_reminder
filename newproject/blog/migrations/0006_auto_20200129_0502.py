# -*- coding: utf-8 -*-
# Generated by Django 1.11.27 on 2020-01-29 05:02
from __future__ import unicode_literals

from django.db import migrations


class Migration(migrations.Migration):

    dependencies = [
        ('blog', '0005_auto_20200128_1653'),
    ]

    operations = [
        migrations.DeleteModel(
            name='chef',
        ),
        migrations.DeleteModel(
            name='Mobile',
        ),
    ]
