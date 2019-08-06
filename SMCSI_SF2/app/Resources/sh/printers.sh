#Extraer las impresoras
sed -n '/<Printer /p' /etc/cups/printers.conf > temp.txt

#dejar solo el nombre de la impresora
sed -e 's/<Printer //' -e 's/>//' temp.txt > temp1.txt

#hacer que las impresoras usen pykota
sed -i 's/DeviceURI cupspykota:\/\//DeviceURI /g' /etc/cups/printers.conf
sed -i 's/DeviceURI /DeviceURI cupspykota:\/\//g' /etc/cups/printers.conf
