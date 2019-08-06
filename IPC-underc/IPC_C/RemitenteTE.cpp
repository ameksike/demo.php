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
#include <stdio.h>
//#include <cstdlib>
//........................................................
using namespace std;
//........................................................ 
int main(int argc, char* argv[])
{
   FILE* tuberia = 0;
   char* app_dir = "/media/D/Trabajo/Kdevelop/Procesos/ReceptorA Ichigo Chin Ichi";
   freopen("output_Error.txt","w",stderr);
   //.................................
   tuberia = popen(app_dir,"r");

   char line[256];
   while(fgets(line, sizeof line, tuberia))
     cout<<line;

   pclose(tuberia);
   //.................................
   fclose(stderr); 
   return EXIT_SUCCESS;
 } 
//........................................................ 
