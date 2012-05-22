#!/bin/bash
while :
do
	  today=$(date)
 	  echo "run"
 	  echo  $today >> session.txt
 	  curl --user newcanal:re7_c@n@l -k -w '|Connect: %{time_connect} TTFB: %{time_starttransfer} Total time: %{time_total} \n' --cookie cookie_session.txt --cookie-jar cookie_session.txt --silent 'https://preprod-backoffice.teletoonplus.fr/test_sessions.php'  >> session.txt
	sleep 60
done