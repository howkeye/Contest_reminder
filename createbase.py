import sqlite3


conn = sqlite3.connect('db.sqlite3')
'''print ("Opened database successfully")

conn.execute('''CREATE TABLE CONTEST
         (ID INT PRIMARY KEY     NOT NULL,
         NAME           TEXT    NOT NULL,
         DATETIM            TEXT     NOT NULL,
         WEBSITE               TEXT    NOT NULL);''')

print ("Table created successfully")
print ("Table created successfully")  '''


conn.execute("INSERT INTO CONTEST (ID,NAME,DATETIM) \
      VALUES (1, 'XYZ','2019/5/31')");
conn.commit()

conn.execute("DELETE from CONTEST where ID = '1';")
conn.commit()

n="Codeforces Global Round 3"


cursor = conn.execute("SELECT * from models.contest")
for row in cursor:
   print ("ID = ", row[0])
   print ("NAME = ", row[1])
   print ("DATETIME = ", row[2], "\n")

conn.close()