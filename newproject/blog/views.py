# -*- coding: utf-8 -*-
from __future__ import unicode_literals
from django.http import HttpResponse
from . models import Post,Code,chefuser
from django.shortcuts import render, redirect
import requests
requests.packages.urllib3.disable_warnings()
import os
import shutil
from bs4 import BeautifulSoup
import datetime
from django.core.files import File
from django.core.files.temp import NamedTemporaryFile
from urllib import urlopen
from django.core.mail import BadHeaderError, send_mail
from django.http import HttpResponse, HttpResponseRedirect
posts=[
{
	'author':'yash',
	'title':'blog post 1',
	'content':'first post',
	'date_posted':'Jan 25,2020'

},
{
	'author':'sumit',
	'title':'blog post 2',
	'content':'second post',
	'date_posted':'Jan 26,2020'

}
]
contents=['Realme 5i (Aqua Blue, 64 GB)',
'Realme 5i (Forest Green, 64 GB)',
'Redmi 8 (Sapphire Blue, 64 GB)',
'Redmi 8A (Ocean Blue, 32 GB)',
'Redmi 8A (Ocean Blue, 32 GB)'
]
users=['yr15','gg1711','howkeye']
def home(request):
	context={
	'posts':posts,
	#'posts':Post.objects.all(),
	'title':'home'
	}
	return render(request,'blog/home.html',context)
def about(request):
	return render(request,'blog/about.html',{'title':'About'})

def scrape(request):
	#columns=contents
	session = requests.Session()
	session.headers = {"User-Agent": "Mozilla/5.0 (Macintosh; Intel Mac OS X 10_12_5) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/59.0.3071.109 Safari/537.36"}
	urle = 'https://codechef.com/contests'

	content = session.get(urle, verify=False).content

	soup = BeautifulSoup(content, "html.parser")

	containers=soup.findAll("tr")
	containers=containers[0:20]

	now = datetime.datetime.now()

	y=int(now.strftime("%Y"))
	m=int(now.strftime("%m"))
	d=int(now.strftime("%d"))
	print(y,m,d)
	Dict={'Jan':1,'Feb':2,'Mar':3,'Apr':4,'May':5,'Jun':6,'Jul':7,'Aug':8,'Sep':9,'Oct':10,'Nov':11,'Dec':12}
	for container in containers: 
		new_contest=Code()
		name=container.findAll("td")
		if(len(name)>3):
			l=name[2].text.strip()
			lis=l[0:11].split()
			if    len(lis)!=3 or  Dict.get(lis[1] ,0)==0:
				continue
			lis_m=int(Dict[lis[1]])
			lis_d=int(lis[0])
			lis_y=int(lis[2])
			if(lis_y>=y ):
				if(lis_y>y):
					#print(str(name[0].text.strip()),str(name[1].text.strip()))
					new_contest.title=str(name[0].text.strip())
					new_contest.name=str(name[1].text.strip())
					new_contest.save()
				else:
					if(lis_m>=m):
						if(lis_m>m):
							#print(str(name[0].text.strip()),str(name[1].text.strip()))
							new_contest.title=str(name[0].text.strip())
							new_contest.name=str(name[1].text.strip())
							new_contest.save()
						else:
							if(lis_d>=d):
								#print(str(name[0].text.strip()),str(name[1].text.strip()))
								new_contest.title=str(name[0].text.strip())
								new_contest.name=str(name[1].text.strip())
								new_contest.save()
	return redirect('home/')


def getuser(request):
	#columns=contents
	session = requests.Session()
	session.headers = {"User-Agent": "Mozilla/5.0 (Macintosh; Intel Mac OS X 10_12_5) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/59.0.3071.109 Safari/537.36"}
	for user in users:
		new_user=chefuser()
		url = 'https://codechef.com/users/'
		f_url=url+user
		content = session.get(f_url, verify=False).content
		soup = BeautifulSoup(content, "html.parser")
		container=soup.find("div","rating-header text-center")
		curr=container.find("div","rating-number")
		high=container.find("small")
		new_user.username=user
		new_user.currentrating=str(curr.text.strip())
		new_user.highestrating=str(high.text.strip())
		new_user.save()
	return redirect('home/')
		#print(user,str(curr.text.strip()),str(high.text.strip()))

def sendemail(request):
    subject='check mail'
    message='checking mailing'
    from_email='yash028raghuwanshi@gmail.com'
    to_email=['yr15@iitbbs.ac.in']
    if subject and message and from_email:
        try:
            send_mail(subject, message, from_email, to_email)
            print("mail sending")
        except BadHeaderError:
            return HttpResponse('Invalid header found.')

def send_email(request):
    subject = request.POST.get('subject', '')
    message = request.POST.get('message', '')
    from_email = request.POST.get('from_email', '')
    subject='check mail'
    message='checking mailing'
    from_email='yash028raghuwanshi@gmail.com'
    if subject and message and from_email:
        try:
            send_mail(subject, message, from_email, ['yash028raghuwanshi@gmail.com'])
        except BadHeaderError:
            return HttpResponse('Invalid header found.')
        return HttpResponseRedirect('admin/')
    else:
        # In reality we'd use a form class
        # to get proper validation errors.
        return HttpResponse('Make sure all fields are entered and valid.')
