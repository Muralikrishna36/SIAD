#include <stdio.h>
#include <stdlib.h>
#include<sys/types.h>
#include<sys/socket.h>
#include<netdb.h>
#include<string.h>
int main(int argc, char *argv[])
{

char *servername;
int port=8000; // initializing port number to 80
int sockfd;
char *path;
printf("Client program\n");
if(argc!=3)// to check if all 3 arguments are given
{
printf("Usage : %s <server> <port>\n", argv[0]);
exit(0);
}


servername = argv[1];
path = argv[2]; // initializing argument 2 (technically third argument) to path
printf("Servername = %s, port=%d", servername,port);

sockfd= socket(AF_INET, SOCK_STREAM, 0);
	if(sockfd < 0)
	{
		perror("not valid");
		exit(1);

	}
printf("socket connected");
struct hostent *server_he;
if((server_he = gethostbyname(servername)) == NULL)// to get the host details
	{
	perror("error in gethostbyname");
	return 2;
	}

struct sockaddr_in serveraddr;//storing server address

bzero((char *) &serveraddr, sizeof(serveraddr));// bzero clears the server's address

serveraddr.sin_family = AF_INET;// setting family name as AF_INET

bcopy((char *)server_he->h_addr,
	(char *)&serveraddr.sin_addr.s_addr,
	server_he->h_length);

serveraddr.sin_port=htons(port);// setting port number
printf("before connect");
if(connect(sockfd, (struct sockaddr *) &serveraddr, sizeof(serveraddr))< 0)// connect is used to create connection to server
	{
	perror("Cannot connect to the server");
	exit(0);

	}
else
	printf("Connected to the server");

//char request[255];
//sprintf(request,"GET /%s HTTP/1.0\r\nHost: %s\r\n\r\n",path,servername);//path & host is from the arguments

//to send data
char *msg="hi this is client ";
int bytes_sent;
bytes_sent=send(sockfd, msg, strlen(msg),0);// sending request instead of message

//recieving the data
int byte_received;
char buffer[1024]; 
bzero(buffer, 1024); // empties the buffer and allocates 1024 bites
byte_received= recv(sockfd,buffer,1024,0);
if(byte_received<0)
	{
	error("ERROR reading from the socket");
	}
printf(" Message recieved : %s", buffer);

return 0;
}

