//---------------------------------------------------------------------------
/**
 * @package    IPC
 * @subpackage php
 * @author     ing. Antonio Membrides Espinosa
 * @date       02/10/2008
 * @version    1.0
 */
//---------------------------------------------------------------------------
//#include <iostream>
//using namespace std;
#include "CThread.h"
#include "MString.cpp"
//.......................................................
CThread*  p = new CThread();
#define TAMANO_BUFFER 1000
int buffer[TAMANO_BUFFER];
//.......................................................
void* funcionThread (void *parametro)
{
	int i;		
	int elementoDistinto = 0;

	while (1)
	{
		p->Bloquear();

		for (i=1; i<TAMANO_BUFFER; i++)
		{
			if (buffer[0] != buffer[i])
			{
				elementoDistinto = 1;
				break;
			}
		}
		if (elementoDistinto)
			printf ("Hijo  : Error. Elementos de buffer distintos\n");
		else
			printf ("Hijo  : Correcto\n");
		elementoDistinto = 0;

		p->Desbloquear();
	}
}
//........................................................
int main(int argc, char **argv) 
{ 
	//p = new CThread();
	//pthread_t hilo1 = Crear_Hilo(funcionThread);
	pthread_t IDHilo;
	pthread_create(&IDHilo, NULL, funcionThread, NULL);

	int i;		
	int elementoDistinto = 0;
	while (1)
	{
		p->Bloquear();

		for (i=1; i<TAMANO_BUFFER; i++)
		{
			if (buffer[0] != buffer[i])
			{
				elementoDistinto = 1;
				break;
			}
		}
		if (elementoDistinto)
			printf ("Hijo  : Error. Elementos de buffer distintos\n");
		else
			printf ("Hijo  : Correcto\n");
		elementoDistinto = 0;

		p->Desbloquear();
	}
	return 0;
}
//........................................................
