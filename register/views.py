from django.http import HttpResponse
from .models import Registration , Contests
import urllib.request
from urllib.request import Request, urlopen
from bs4 import BeautifulSoup
import datetime


def index(request):
   text = """<h1>welcome to my app !</h1>"""
   return HttpResponse(text)


