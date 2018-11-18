#!/bin/bash

sudo tshark -Y 'dns.flags.response == 0 and dns.qry.name == "localhost/Index.html"' -V > data.txt
