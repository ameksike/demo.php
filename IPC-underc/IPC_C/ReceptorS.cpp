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
#include <string>
#include <stdlib.h>
using namespace std;
//........................................................
int main(int argc, char **argv) 
{ 
   int   N1 =  atoi(argv[1]);
   int   N2 =  atoi(argv[2]);
   int   N3 = N1+N2;
   cout << N3 <<endl;

   return 0;
}
//........................................................

