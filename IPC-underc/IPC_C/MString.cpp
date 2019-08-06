//---------------------------------------------------------------------------
/**
 * @package    IPC
 * @subpackage php
 * @author     ing. Antonio Membrides Espinosa
 * @date       02/10/2008
 * @version    1.0
 */
//---------------------------------------------------------------------------
#ifndef String_H
#define String_H
//........................................................
#include <sstream> 
using namespace std;
//........................................................
/*
   Este fichero contiene funciones para la conversión estandar de cadenas.
   Autor: Antonio Membrides Espinosa
   Fecha: 8/10/2008
   Licencia de uso y distribución: GNU GPL
*/
//........................................................  All To String
 template < class T >
 string ToString(const T &Valor)
 {
    ostringstream out;
    out << Valor;
    return out.str();
 }
//........................................................  All To Char*
 template < class T >
 void ToChars(char* Cadena, const T &Valor)
 {
    ostringstream out;
    out << Valor;
    strcpy(Cadena, (out.str()).c_str());
 }
//........................................................  Int To Char*
 void IntToChars(char* Cadena, int Valor)
 {      //.. convertir un # entero en char*
	sprintf(Cadena, "%6d", Valor);
 }
//........................................................  Float To Char*
 void FloatToChars(char* Cadena, float Valor)
 {      //.. convertir un # float de 2 lugares decimales en char*
	sprintf(Cadena, "%6.2f", Valor);
 }
//........................................................  Hexadecimal To Char*
 void HexToChars(char* Cadena, int Valor)
 {      //.. convertir un # hexadecimal en char*
	sprintf(Cadena, "%04x", Valor);
 } 
//........................................................  Char To Char*
 void CharToChars(char* Cadena, char Valor)
 {      //.. convertir un char en char*
	sprintf(Cadena, "%c", Valor);
 }
//........................................................  String To Char*
 /*void StrToChars(char* Cadena, string Valor, bool C)
 {      //.. convertir un char en char*
	sprintf(Cadena, "%s", Valor);
 }*/
//........................................................  String To Char*
 void StrToChars(char* Cadena, string Valor)
 {      //.. convertir un string en char*
        strcpy(Cadena, Valor.c_str());
 }
//........................................................
/*
 Nota: para convertir de char* a numeros se utilizan la F de stdlib.h:
       1- int atoi(const char *numPtr);       // Para int
       2- long int atol(const char *numPtr);  // Para lon int
       3- double atof(const char *numPtr);    // Para float y double
*/
//........................................................
#endif
