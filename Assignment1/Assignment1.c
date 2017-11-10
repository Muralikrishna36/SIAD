#include <stdio.h>
#include <stdlib.h>
#include<sys/types.h>
#include<sys/socket.h>
#include<netdb.h>
#include<string.h>
int main(int argc, char *argv[])
{

	char *file;
	file="Muraliindex.html";
	int port=80;
	int sockfd;
	int bytes_left;
	char hostname[1000],pathname[1000],dtm[1000];
	strncpy(dtm,argv[1],100);
	sscanf(dtm,"http://%[^/]/%s",hostname,pathname);

	if(argc!=2){
		printf("Usage : <URL> \n", argv[1]);
		exit(0);
	}

	sockfd= socket(AF_INET, SOCK_STREAM, 0);//socket() function tells our OS that we want a file descriptor for a socket which we can 		use for a network  stream connection

	if(sockfd < 0){
		perror("not valid");
		exit(1);
	}

	struct hostent *server_he;//Host addresses in a struct hostent structure.

	if((server_he = gethostbyname(hostname)) == NULL){//The gethostbyname function returns information about the host named hostname. 			If the lookup fails, it returns a null pointer.
		perror("error in gethostbyname");
		return 2;
	}

	struct sockaddr_in serveraddr;// to store server address(destination address)

	bzero((char *) &serveraddr, sizeof(serveraddr));// clearing variable serveraddr(it puts all zero's)

	serveraddr.sin_family = AF_INET;//sets the address family
	bcopy((char *)server_he->h_addr,(char *)&serveraddr.sin_addr.s_addr,server_he->h_length);

	serveraddr.sin_port=htons(port);//htons() function converts the port number into a Big Endian short integer

	if(connect(sockfd, (struct sockaddr *) &serveraddr, sizeof(serveraddr))< 0){//This tells our OS to use the socket "sockfd" to 		create a connection to the machine specified in serveraddr.
		perror("Cannot connect to the server\n");
     		exit(0);
	}

	else
	printf("Connected to the server\n");

	//constructing a HTTP Request
	char request[1024];
	int bytes_sent;
	sprintf(request, "GET /%s HTTP/1.0\r\nHost: %s\r\n\r\n",pathname,hostname);

	// sending request
	bytes_sent=send(sockfd, request, strlen(request),0);//send() returns the number of bytes that were sent
	//request has the text we wanted to send and its length was stored using strlen()

	//recieving the data
	int byte_received;
	char buffer[10000];// initializing buffer with space 10000 bytes
	bzero(buffer, 10000); // clearing buffer if it has previous data 
	byte_received= recv(sockfd,buffer,10000,0);//receives up to max 10000 bytes of data from the connection and stores them in the 		buffer string

	if(byte_received<0){
		error("ERROR reading from the socket");
	}

	// checking the status if it is 200 ok or not
	int status;
	sscanf(buffer,"HTTP/1.%*[01] %d ",&status);

	if(status==200) {
		printf("The status is: %d ok\n", status);//Printing status 
   		// looking for end of header
		char *EOH;//EOH = End of Header
		EOH =strstr(buffer, "\r\n\r\n");// searching for \r\n\r\n in buffer
		char *data=EOH+4;

		if(EOH){

			printf("The data part is: %s\n",data);// printing the data part
			
			// getting file name from pathname
			const char sh = '/';
			char *filename;
			filename = strrchr(argv[1], sh);// searching for last occurance of slash in pathname
			printf("String after |%c| is - |%s|\n", sh, filename);
			printf("Saving data part to file %s\n",filename);// saving the data part in file
			

			if(filename != NULL ){
				
				FILE *fp=fopen(filename+1,"w+");// fopen opens file with name filename and W+ indicates the mode of 					operation (read,write, append)
				int bytes_left=byte_received-((data-buffer)+4);
				fwrite(data, bytes_left,1,fp);// data- data to be written, 1-size in bytes of each element to be written, 					bytes_left - number of elements,fp-file object

				while((byte_received= recv(sockfd,buffer,10000,0))!=0) 
				{
					fwrite(buffer,byte_received,1,fp);//buffer- data to be written, 1-size in bytes of each element to 						be written, bytes_received - number of elements,fp-file object
				}
				fclose(fp);
			}
			else{
				FILE *fp=fopen(file,"w+");// fopen opens file with name file and W+ indicates the mode of operation 					(read,write, append)
				int bytes_left=byte_received-((data-buffer)+4);
				fwrite(data, bytes_left,1,fp);// data- data to be written, 1-size in bytes of each element to be written, 					bytes_left - number of elements,fp-file object

				while((byte_received= recv(sockfd,buffer,10000,0))!=0) 
				{
				fwrite(buffer,byte_received,1,fp);//buffer- data to be written, 1-size in bytes of each element to be 					written, bytes_received - number of elements,fp-file object
				}

 				fclose(fp);
			}
		}

		else {
      			printf("End of header not found. \n");
		}

	}
	else {
		printf("\n Status not 200 OK %d\n",status);
		exit(1);
	}
return 0;
}
