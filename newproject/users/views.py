# -*- coding: utf-8 -*-
from __future__ import unicode_literals

from django.shortcuts import render,redirect
from django.contrib.auth.forms import UserCreationForm
from django.contrib import messages
from django.contrib.auth.decorators import login_required
from .forms import UserRegisterForm, UserUpdateForm, ProfileUpdateForm
def register(request):
	if request.method == 'POST':
		form=UserRegisterForm(request.POST)
		if form.is_valid():
			form.save()
			username=form.cleaned_data.get('Email')
			messages.success(request,'Your account is created , you can now login')
			return redirect('login')
	else:
		form = UserRegisterForm()
	return render(request,'users/register.html',{'form':form})
@login_required
def profile(request):
	u_form = UserUpdateForm()
	p_form = ProfileUpdateForm()
	context = {
	'u_form': u_form,
	'p_form': p_form
	}
	return render(request,'users/profile.html',context)
