//---------------------------------------------------------------------------
/**
 * @package    IPC
 * @subpackage php
 * @author     ing. Antonio Membrides Espinosa
 * @date       02/10/2008
 * @version    1.0
 */
//---------------------------------------------------------------------------
#include <cstdlib>
#include <windows.h>
#include <psapi.h>
#include <iostream>
using namespace std;
//...................................................................................
/*
/* Matar procesos C++
/*  By Octalh
/* www.aztekmindz.org
/*
*/
//...................................................................................
BOOL tproceso(int pid)
{
   int ret=1;
   HANDLE pHandle;

   if ((pHandle = OpenProcess(PROCESS_ALL_ACCESS,FALSE,pid)) != NULL)
   if(!TerminateProcess(pHandle,0)) 
   {
       ret=0;
       CloseHandle(pHandle);
       return TRUE;
   }
}
//**********************************************************************************
int main(int argc, char *argv[])
{
    int pid;
    cout << "\n\n\t Matar Procesos";
    cout << "\n\t Pid del Proceso:";
    cin >> pid;
    if (tproceso(pid)) {
        printf("\n\n\t Ok proceso [%d] terminado con exito. \n\n",pid);
    } else {
        printf("\n\n\t Error al terminar el proceso [%d] \n\n",pid);
    }
    system("PAUSE");
    return EXIT_SUCCESS;
}
//**********************************************************************************