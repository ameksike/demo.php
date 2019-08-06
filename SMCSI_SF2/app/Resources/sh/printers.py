#!/usr/bin/python
import os
from pkipplib import pkipplib

cups = pkipplib.CUPS()
printers = cups.getPrinters()
print printers
