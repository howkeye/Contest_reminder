import urllib.request
from urllib.request import Request, urlopen
from bs4 import BeautifulSoup
import datetime
import sqlite3



url="https://codechef.com/contests"
req = urllib.request.Request(
    url, 
    data=None, 
    headers={
        'User-Agent': 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_9_3) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/35.0.1916.47 Safari/537.36'
    }
)

html = urllib.request.urlopen(req)

soup=BeautifulSoup(html,'lxml')



title = soup.title
#print('title')

containers=soup.findAll("tr")
containers=containers[0:20]

now = datetime.datetime.now()

y=int(now.strftime("%Y"))
m=int(now.strftime("%m"))
d=int(now.strftime("%d"))

Dict={'Jan':1,'Feb':2,'Mar':3,'Apr':4,'May':5,'Jun':6,'Jul':7,'Aug':8,'Sep':9,'Oct':10,'Nov':11,'Dec':12}

conn = sqlite3.connect('chefdb.sqlite3')
i=0
i=int(i)

cursor = conn.execute("SELECT id, name, DATETIM,WEBSITE from CONTEST")
for row in cursor:
     i=max(i,int(row[0]))


for container in containers:        
    name=container.findAll("td")	
    if(len(name)>3):	
       l=name[2].text.strip()
       
       lis=l[0:11].split()
       #print(lis)
       
       if    len(lis)!=3 or  Dict.get(lis[1] ,0)==0:
           continue
       lis_m=int(Dict[lis[1]])
       lis_d=int(lis[0])
       lis_y=int(lis[2])
       n=str(name[1].text.strip())
       lis=str(lis)
       x=0
       web="CODECHEF"
       #print(name[0].text.strip(),name[1].text.strip(),name[2].text.strip(),name[3].text.strip())
       if(lis_y>=y ):
           if(lis_y>y):
               #print(name[1].text.strip())
                cursor = conn.execute("SELECT id, name, DATETIM,WEBSITE from CONTEST")
                for rows in cursor:
                  if(n==rows[1]):
                    x=1
                if(x==0):
                  i=i+1
                  para=(i,n,lis,web)
                  conn.execute("INSERT INTO CONTEST (ID,NAME,DATETIM,WEBSITE) \
                    VALUES (?,?,?,?)",para);
                  conn.commit()


           else:
               if(lis_m>=m):
                   if(lis_m>m):
                        #print(name[1].text.strip())
                        cursor = conn.execute("SELECT id, name, DATETIM,WEBSITE from CONTEST")
                        for rows in cursor:
                          if(n==rows[1]):
                            x=1
                        if(x==0):
                          i=i+1
                          para=(i,n,lis,web)
                          conn.execute("INSERT INTO CONTEST (ID,NAME,DATETIM,WEBSITE) \
                            VALUES (?,?,?,?)",para);
                          conn.commit()


                   else:
                       if(lis_d>=d):
                            #print(name[1].text.strip())
                            cursor = conn.execute("SELECT id, name, DATETIM,WEBSITE from CONTEST")
                            for rows in cursor:
                              if(n==rows[1]):
                                x=1
                            if(x==0):
                              i=i+1
                              para=(i,n,lis,web)
                              conn.execute("INSERT INTO CONTEST (ID,NAME,DATETIM,WEBSITE) \
                                VALUES (?,?,?,?)",para);
                              conn.commit()  
conn.close()




##codeforces 





url="https://codeforces.com/contests"

html=urlopen(url)

soup=BeautifulSoup(html, 'lxml')


title = soup.title

containers=soup.findAll("tr")

conn = sqlite3.connect('chefdb.sqlite3')
i=0
i=int(i)

cursor = conn.execute("SELECT id, name, DATETIM,WEBSITE from CONTEST")
for row in cursor:
     i=max(i,int(row[0]))
#print(i)

for container in containers:

	name=container.findAll("td")
	if(len(name)>0):
		l=name[2].text.strip()
		lis=l[0:11].split('/')
		lis_m=Dict[lis[0]]  #month
		lis_d=int(lis[1])   #day
		lis_y=int(lis[2])   #year
		n=str(name[0].text.strip())
		a=lis[0]
		lis[0]=lis[1]
		lis[1]=a
		lis=str(lis)
		web="CODEFORCES"
		x=0
        
		if(lis_y>=y ):
			if(lis_y>y):
				#x=0
				cursor = conn.execute("SELECT id, name, DATETIM, WEBSITE from CONTEST")
				for rows in cursor:
					if(n==rows[1]):
						x=1
				if(x==0):
					i=i+1 # line 54 se 57 tak data ko database me bharne ke liye
					para=(i,n,lis,web)
					conn.execute("INSERT INTO CONTEST (ID,NAME,DATETIM, WEBSITE) \
						VALUES (?,?,?,?)",para);
					conn.commit()
			else:
				if(lis_m>=m):
					if(lis_m>m):
						cursor = conn.execute("SELECT id, name, DATETIM, WEBSITE from CONTEST")
						for rows in cursor:
							if(n==rows[1]):
								x=1		
								
						if(x==0):
							i=i+1
							para=(i,n,lis,web)
							conn.execute("INSERT INTO CONTEST (ID,NAME,DATETIM,WEBSITE) \
								VALUES (?,?,?,?)",para);
							conn.commit()
					else:
						if(lis_d>=d):
							#x=0
							cursor = conn.execute("SELECT id, name, DATETIM, WEBSITE from CONTEST")
							for rows in cursor:
								if(n==rows[1]):
									x=1
									
							if(x==0):
								i=i+1
								para=(i,n,lis,web)
								conn.execute("INSERT INTO CONTEST (ID,NAME,DATETIM,WEBSITE) \
									VALUES (?,?,?,?)",para);
								conn.commit()



cursor = conn.execute("SELECT id, name, DATETIM, WEBSITE from CONTEST")

for row in cursor:
   print ("ID = ", row[0])
   print ("NAME = ", row[1])
   print ("DATETIME = ", row[2])
   print("WEBSITE = ",row[3],"\n")

conn.close()
