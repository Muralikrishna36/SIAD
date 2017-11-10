import java.io.*;
import java.net.*;

public class myTCPclient{
  public static void main(String[] args) throws IOException{

if(args.length != 2)
	{
      	System.err.println("Usage:java myTCPclient<host name> <port number>");
	System.exit(1);
    }

String hostName =args[0];
int portNumber = Integer.parseInt(args[1]);
//try{
//connect to the server
try {
        	Socket socket = new Socket(hostName, portNumber);
        	System.out.println("Connected to server \'" + hostName +"\' at port "+portNumber);
 
  /*send and receive data here*/
    	} catch (UnknownHostException e) {
        	System.err.println("Don't know about host " + hostName);
        	System.exit(1);
    	} catch (IOException e) {
        	System.err.println("Couldn't get I/O for the connection to " +
            	hostName);
        	System.exit(1);
    	} 
PrintWriter out = new PrintWriter(Socket.getOutputStream(),true);
BufferedReader stdln =new BufferedReader(new InputStreamReader(System.in));

new TCPClientThread(Socket).start();

String userInput;

while((userInput = stdln.readLine())!=null){
  out.println(userInput);
  System.out.println("received from server:" + in.readLine());
	}
    }

class TCPClientThread  extends Thread {
private Socket clientSocket = null;
 
 TCPClientThread(Socket clientSocket) {
    	super("TCPClientThread");
    	this.clientSocket = clientSocket;
    }
  /* handling data communication here */
   

public void run(){
  try{
      BufferedReader in = new BufferedReader(new InputStreamReader(Socket.getInputStream()));
  	while(true){
        String inputLine=in.readLine();
  	while ((inputLine!=null) && !inputLine.isEmpty()) {
      	System.out.println("received from client: " + inputLine);
      	inputLine=in.readLine();
  	}
  	}
        } catch (IOException e) {
        	e.printStackTrace();
        }
    }
  }
}
