//---------------------------------------------------------------------------
/**
 * @package    IPC
 * @subpackage php
 * @author     ing. Antonio Membrides Espinosa
 * @date       02/10/2008
 * @version    1.0
 */
//---------------------------------------------------------------------------
#ifndef HilosE_HH
#define HilosE_HH
//-------------------------------------------------------------
#include <pthread.h>
//-------------------------------------------------------------
class CThread
{
  private:
	pthread_mutex_t Mutexr;

  public:
	CThread();
	pthread_t Crear_Hilo(void* (*Funcion)(void *));
	void Bloquear();
	void Desbloquear();
};
//-------------------------------------------------------------
#endif

//-------------------------------------------------------------
CThread::CThread()
{
	pthread_mutex_init (&Mutexr, NULL);
}
//-------------------------------------------------------------
pthread_t CThread::Crear_Hilo(void* (*Funcion)(void *))
{
	pthread_t IDHilo;
	int error = pthread_create(&IDHilo, NULL, Funcion, NULL);
	if(!error)
		return IDHilo;
	else
		return 0;
}
//-------------------------------------------------------------
void CThread::Bloquear()
{
	#ifdef MUTEX
	pthread_mutex_lock (&Mutexr);
	#endif
}
//-------------------------------------------------------------
void CThread::Desbloquear()
{
	#ifdef MUTEX
	pthread_mutex_unlock (&Mutexr);
	#endif
}
//-------------------------------------------------------------
