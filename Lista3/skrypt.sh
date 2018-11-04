#!/bin/sh
tshark -d tcp.port==8888:3,http -T json -e http.host -e http.cookie -l --no-duplicate-keys -a duration:1 | sudo tee dane.json &
wait 
python ciasteczka.py;
