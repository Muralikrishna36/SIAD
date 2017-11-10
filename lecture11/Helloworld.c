#include<stdio.h>
#include<stdlib.h>

int main(void)
{
printf("Content-Type: text/plain; charset=utf-8\n\n");

char username[100];
char password[100];

char *data = getenv("QUERY_STRING");
printf("%s",data);

sscanf(data,"name=%[^&]&password=%s",username, password);
printf("Username:%s\n",username);
printf("Password:%s\n",password);


if(username[0]=='\0'||password[0]=='\0')
{
printf("Enter username and password");
}
else{
printf("Hello World \n");
}

return 0;
}
