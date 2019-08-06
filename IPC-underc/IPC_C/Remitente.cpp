//---------------------------------------------------------------------------
/**
 * @package    IPC
 * @subpackage php
 * @author     ing. Antonio Membrides Espinosa
 * @date       02/10/2008
 * @version    1.0
 */
//---------------------------------------------------------------------------
#include <stdio.h>
#include <stdlib.h>
//........................................................
main()
{
   FILE* fpipe;
   char* command1 = "ls -l";
   char* command2 = "/media/D/Trabajo/Kdevelop/Procesos/Receptor 45 45";
   char line[256];
 
   if(!(fpipe = (FILE*)popen(command2,"r")) )
   {
     perror("Problemas con el pipe");
     exit(1);
   }
 
   while(fgets(line, sizeof line, fpipe))
   {
     printf("%s", line);
   }
   pclose(fpipe);
} 
//........................................................
