//---------------------------------------------------------------------------
/**
 * @package    IPC
 * @subpackage php
 * @author     ing. Antonio Membrides Espinosa
 * @date       02/10/2008
 * @version    1.0
 */
//---------------------------------------------------------------------------
#include "MString.cpp"
#include <iostream>
using namespace std;
//........................................................
int main(int argc, char **argv) 
{ 
   /*cout << argc << " ... Cantidad" << endl; 
   for(int i = 0; i < argc; i++) 
      cout << i << " ... "<< argv[i] <<endl; 
   cout << endl;

   char* matriz[argc];
   for(int i = 0; i < argc; i++) 
	matriz[i] = argv[i];
   cout << matriz; */

   char result[1024];
   float m = 12.666;
   char* cc;
   char c = 'X';
   int  d = 124;
   string cadena1 = "cacacacaca";
   string cadena = ToString(c);
   cout << " char to string " << cadena <<endl;
   ToChars(result, cadena1);
   cout << " string to char* " << result <<endl;
   //CharToChars(result,c);
   ToChars(result,c);
   cout << " char to char* " << result <<endl;
   //IntToChars(result, d);
   ToChars(result, d);
   cout << " int to char* " << result <<endl;
   //FloatToChars(result, m);
   ToChars(result, m);
   cout << " float to char* " << result <<endl;
   HexToChars(result, 127);
   cout << " hexadecimal to char* " << result <<endl;

   strcpy(result,ToChars(argc));   //.c_str()
   cout << result <<endl;
   for(int i = 1; i < argc; i++)
   {	
	strcat(result,", ");
	strcat(result,argv[i]);
   } 
   cout << result <<endl;

   return 0;
}
//........................................................
/*
  llamada:

	/media/D/Trabajo/Kdevelop/P1/Receptor parametro1 parametro2 parametro3 parametro4

  salida:
	
	5 ... Cantidad
	0 ... /media/D/Trabajo/Kdevelop/P1/p
	1 ... parametro1
	2 ... parametro2
	3 ... parametro3
	4 ... parametro4

*/
//........................................................
