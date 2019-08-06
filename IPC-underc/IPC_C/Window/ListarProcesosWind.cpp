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
#include <stdio.h>
using namespace std;
//...................................................................................
/*
/* Listar procesos C++
/*  By Octalh
/* www.aztekmindz.org
*/
//...................................................................................
void procesos()
{

  DWORD Procesos[200], PN, cProcesos;
  unsigned int i;
  TCHAR procsnombre[200] = TEXT("");

  if( !EnumProcesses( Procesos, sizeof(Procesos), &amp;PN ) )
            return;

  cProcesos = PN / sizeof(DWORD);
  for ( i = 0; i < cProcesos; i++ )
  {
      HANDLE hProcesos = OpenProcess( PROCESS_QUERY_INFORMATION | PROCESS_VM_READ, FALSE, Procesos[i]);
      if (NULL != hProcesos )
      {
         GetModuleBaseName( hProcesos, NULL, procsnombre, sizeof(procsnombre)/sizeof(TCHAR) );
      }
      printf(TEXT("  %s, PID = %u \n"), procsnombre, Procesos[i]);
      CloseHandle( hProcesos );
  }

}
//**********************************************************************************
int main(int argc, char *argv[])
{
    procesos();
    system("PAUSE");
    return EXIT_SUCCESS;
}
//**********************************************************************************