//---------------------------------------------------------------------------
/**
 * @package    IPC
 * @subpackage php
 * @author     ing. Antonio Membrides Espinosa
 * @date       02/10/2008
 * @version    1.0
 */
//---------------------------------------------------------------------------
#ifndef Proces_HH
#define Proces_HH
//-------------------------------------------------------------
#include <stdio.h>
#include <sys/types.h>
#include <wait.h>
#include <unistd.h>
//-------------------------------------------------------------
class Proces
{
  private:
	FILE* _TuberiaW;
	FILE* _TuberiaR;

  private:
	void  Suspender(pid_t IDProceso);
	void  Reanular(pid_t IDProceso);
	void  Terminar(pid_t IDProceso);
	bool  Open(char* Dir);
	void  Close();

  public:
	Proces();
	char* Reed(char* Dir);
	bool  Write(char* Parametro);
	bool  Write(char* Dir, char* Parametro);
};
//-------------------------------------------------------------
#endif

//-------------------------------------------------------------
Proces::Proces()
{
	_TuberiaW = 0;
	_TuberiaR = 0;
}
//-------------------------------------------------------------
bool Proces::Open(char* Dir)
{
	_TuberiaW = popen (Dir, "w");
}
//-------------------------------------------------------------
void Proces::Close()
{
	pclose (_TuberiaW);
}
//-------------------------------------------------------------
bool Proces::Write(char* Parametro)
{
	if (_TuberiaW == NULL)
	{
		perror ("No se puede abrir la Tuberia especificada");
		return 0;
	}
	else
	{
		fprintf (_TuberiaW, "%s", Dir);
	}
	return 1;
}
//-------------------------------------------------------------
bool  Proces::Write(char* Dir, char* Parametro)
{
	Open(Dir);
	Write(Parametro);
	Close();
	exit (0);
}
//-------------------------------------------------------------
char* Proces::Reed(char* Dir)
{
	char Auxiliar[1024];
	_TuberiaR = popen (Dir, "r");
	fgets (Auxiliar, 1024, _TuberiaR);
	while (!feof (_TuberiaR))
	{
		printf ("%s", Auxiliar);
		fgets (Auxiliar, 1024, _TuberiaR);
	}
	pclose (_TuberiaR);
	exit (0);
}
//-------------------------------------------------------------
void  Proces::Suspender(pid_t IDProceso)
{
	kill(IDProceso,STOP);
}
//-------------------------------------------------------------
void  Proces::Reanular(pid_t IDProceso)
{
	kill(IDProceso,CONT);
}
//-------------------------------------------------------------
void  Proces::Terminar(pid_t IDProceso)
{
	kill(IDProceso,KILL);
}
//-------------------------------------------------------------