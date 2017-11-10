#include <stdio.h>
#include <stdlib.h>
#include<sys/types.h>
#include<sys/socket.h>
#include<netdb.h>
#include<string.h>
int main(int argc, char *argv[])
{

char servername[256];
int port; // initializing port number to 80
int serversockfd;

printf("Client program\n");
if(argc!=2)// to check if all 3 arguments are given
	{
	printf("Usage : %s <port>\n", argv[0]);
	exit(0);
	}
port = atoi(argv[1]);
// initializing argument 2 (technically third argument) to path
printf("port = %d",port);

serversockfd= socket(AF_INET, SOCK_STREAM, 0);
	if(serversockfd < 0)
	{
		perror("not valid");
		exit(1);
	}
struct sockaddr_in serveraddr;//storing server address

bzero((char *) &serveraddr, sizeof(serveraddr));// bzero clears the server's address

serveraddr.sin_family = AF_INET;// setting family name as AF_INET

//bcopy((char *)server_he->h_addr,(char *)&serveraddr.sin_addr.s_addr,server_he->h_length);

serveraddr.sin_addr.s_addr = htonl(INADDR_ANY);
serveraddr.sin_port=htons(port);// setting port number
int optval = 1;
setsockopt(serversockfd,SOL_SOCKET, SO_REUSEADDR,&optval , sizeof(int));

if(bind(serversockfd,(struct sockaddr *) &serveraddr,sizeof(serveraddr))<0)
	{
	perror("Error on Binding");
	exit(3);
	}
int listen(int serversockfd,int backlog);
if(listen(serversockfd, 5)<0)
	{
	perror("ERROR on listen");
	exit(1);
	}
printf("server is listening to port %d \n",port);

while(1){
struct sockaddr_in clientaddr;
int clientlen= sizeof(clientaddr);
int childfd = accept(serversockfd,(struct sockaddr *) &clientaddr,(socklen_t *) &clientlen);
if(childfd <0)
	{
	perror("Error on accept");
	exit(2);
	}
printf("server established connection with %s\n", inet_ntoa(clientaddr.sin_addr));
//char request[255];
//sprintf(request,"GET /%d HTTP/1.0\r\nHost: %s\r\n\r\n",port,servername);//path & host is from the arguments

//recieving the data
int byte_received;
char buffer[1024]; 
bzero(buffer, 1024); // empties the buffer and allocates 1024 bites
byte_received= recv(childfd,buffer,1024,0);
if(byte_received<0)
	{
	error("ERROR reading from the socket");
	}
printf(" Message recieved : %s", buffer);

//to send data
char *msg="Hello this is server";
int bytes_sent;
bytes_sent=send(childfd, msg, strlen(msg),0);// sending request instead of message


return 0;
}
}

