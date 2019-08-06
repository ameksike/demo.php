//---------------------------------------------------------------------------
/**
 * @package    IPC
 * @subpackage php
 * @author     ing. Antonio Membrides Espinosa
 * @date       02/10/2008
 * @version    1.0
 */
//---------------------------------------------------------------------------
#include <iostream>
using namespace std;
#include "MString.cpp"
#include "Proces.h"
//.........................................................
	pid_t idProceso;
	int   estadoHijo;
	int   estadoPadre;
	int   descriptorTuberia[2];
	char  buffer[1000];
//..........................................................
void CrearP()
{
	if (pipe(descriptorTuberia) == -1)
	{
		perror ("No se puede crear Tuberia");
		exit (-1);
	}
	idProceso = fork();
}
//..........................................................
void ProcesE(char Tipo)
{
	if (idProceso == -1)
	{
		perror ("No se puede crear proceso");
		exit (-1);
	}
	else //switch (Tipo) 
	{
        	//case 'E':
		//{
	  	  if (idProceso == 0)     //... Escritura
	 	   {
			/*read(descriptorTuberia[0], buffer, 5);

			if(buffer=="Lectura")
				wait (&estadoPadre);
			else
			{
				strcpy (buffer, "Escritura");
				write (descriptorTuberia[1], buffer, strlen(buffer)+1);			
			}
			exit (0);*/

			read (descriptorTuberia[0], buffer, 1000);
			printf ("Hijo : Recibido \"%s\"\n", buffer);

			strcpy (buffer, "Que tal papa");
			write (descriptorTuberia[1], buffer, strlen(buffer)+1);
			printf ("Hijo : Envio \"%s\"\n", buffer);

			wait (&estadoPadre);                //..........................

			read (descriptorTuberia[0], buffer, 1000);
			printf ("Hijo  : Recibido \"%s\"\n", buffer);

			exit (0);

		  } else printf ("Hijo : Envio \"no estoy\"\n");

	  	  if (idProceso > 0)     //... Lectura
	 	  {
			/*read(descriptorTuberia[0], buffer, 5);
			if(buffer=="Escritura")
				wait (&estadoHijo);
			else
			{
				strcpy (buffer, "Lectura");
				write (descriptorTuberia[1], buffer, strlen(buffer)+1);
			}
			exit (0);*/

			strcpy (buffer, "Estoy leyendo hijo");
			write (descriptorTuberia[1], buffer, strlen(buffer)+1);
			printf ("Padre : Envio \"%s\"\n", buffer);

			wait (&estadoHijo);                //..........................

			read (descriptorTuberia[0], buffer, 1000);
			printf ("Padre : Recibido \"%s\"\n", buffer);

			strcpy (buffer, "Que tal hijo");
			write (descriptorTuberia[1], buffer, strlen(buffer)+1);
			printf ("Padre : Envio \"%s\"\n", buffer);

			wait (&estadoHijo);                //..........................

			printf ("Padre : Envio \"buena comunicacion\"\n");

			exit (0);

		  }  else printf ("Padre : Envio \"no estoy\"\n");
		//}break;
        	//case 'L':
		//{
		//}break;
	}
}
//........................................................
int main(int argc, char **argv) 
{ 
   /*char* dira   = "/media/D/Trabajo/Kdevelop/Procesos/ReceptorES";
   Proces*  p = new Proces();
   p->Open(dira);
   //p->Write("45\n 45\n");
   p->Write("43\n");
   cout << p->Reed(dira) << endl;
   p->Write("10\n");
   p->Close();
   cout << p->Reed(dira) << endl;*/
   CrearP();
   ProcesE('E');
   //ProcesE('L');
   //ProcesE('E');
   //ProcesE('L');
   return 0;
}
//........................................................
