import csv 
from datetime import datetime,timedelta
import time
import pprint
import math
from time import mktime
#employeReader = csv.reader(open('workrecord.txt, 'rb'), delimiter=',')
employeReader = csv.reader(open('employeerecord.csv', 'rb'), delimiter=',')
employerCount = {}
employer = {}
i = 0
for row in employeReader :
	if i > 0 :
		employer[row[4]]=row
		employerCount[row[4]] = 0
	i+=1
# hoiraire
recordReader = csv.reader(open('workrecord.txt', 'rb'), delimiter=';')
i = 0
for row in recordReader :
	if i > 0 :
		
		dayDate = datetime.fromtimestamp(mktime(time.strptime(row[0][4:6]+'/'+row[0][:3]+'/'+row[0][7:11],'%d/%b/%Y')))
		
		hourStart = datetime.strptime(row[2],'%I:%M %p')
		hourEnd = datetime.strptime(row[3],'%I:%M %p') 
		tdelta =  hourEnd - hourStart
		
		if tdelta.seconds > 0 :
			 if datetime.weekday(dayDate) < 6 :
			 	hours = math.ceil(float(tdelta.seconds)/3600)*float(employer[row[1]][2][1:])
			 else :
			 	hours = math.ceil(float(tdelta.seconds)/3600)*(float(employer[row[1]][2][1:])*1.5)
		employerCount[row[1]]=hours+employerCount[row[1]]
	i+=1

for row in employer :
		print employer[row][0] +' '+ employer[row][1] + ' : ' +str(int(employerCount[row])) + '$'

