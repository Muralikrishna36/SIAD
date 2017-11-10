#include <stdio.h>
#include <stdlib.h>
#include<sys/types.h>
#include<sys/socket.h>
#include<netdb.h>
#include<string.h>
int main(int argc, char *argv[])
{

char servername[256];
printf("Client program\n");
if(argc!=3)// to check if all 3 arguments are given
{
printf("Usage : %s <server> <port>\n", argv[0]);
exit(0);
}
strcpy(servername,argv[1]);
printf("server:");
printf("servername);
printf("\n");
return 0;
}
