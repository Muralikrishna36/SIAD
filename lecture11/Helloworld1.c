#include<stdio.h>
#include<stdlib.h>

int main()
{
printf("Content-Type: text/plain; charset=utf-8\n\n");// this indicated the data format sent to browser

char username1[100];
char password1[100];

char *data = getenv("QUERY_STRING");// to get environment variable value
sscanf(data,"username=%[^&]&password=%s",username1, password1);
printf("Username:%s \n",username1);// printing username
printf("Password:%s \n",password1);// printing password

if(username1[0]=='\0'||password1[0]=='\0')// check if username and password are given
{
printf("Invalid details \n");// if username or password no given print this
}
else{
printf("Hello World \n");//if all credentials are given print hello world
}

return 0;
}
