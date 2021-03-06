import java.io.*;
import java.net.*;
import java.util.*;
public class myserver5{
	public static LinkedList<Socket> List = new LinkedList<Socket>();
	public static LinkedList<String> userList = new LinkedList<String>();
	public static void main(String[] args) throws IOException{
   		System.out.println("My server\n");
		int portNumber=8000;
		ServerSocket serverSocket = new ServerSocket(portNumber);
		System.out.println("My server is running at port :   " + serverSocket.getLocalPort());
	
		while(true){
			Socket clientSocket = serverSocket.accept();
			System.out.println("A client is connected from IP:" + clientSocket.getInetAddress().getHostAddress());
			new TCPServerThread(clientSocket).start();
			List.add(clientSocket);
		}
    	}
	public static synchronized void broadcast(String msg , String username) throws IOException{
		for(int i=0;i<List.size();i++){
			Socket clientSocket=List.get(i);
			PrintWriter grp = new PrintWriter(clientSocket.getOutputStream(), true); 
			grp.println(username+": "+msg);
		}
   	}
	public static synchronized void remove(Socket clientSocket){
		List.remove(clientSocket); 
	}

	public static synchronized void getuserList(){
		for(int i=0; i<userList.size(); i++){
      			//System.out.println(userList.get(i));
		}
		//System.out.println("are all the connected clients");
   	}
  }	

class TCPServerThread extends Thread{
private Socket clientSocket = null;
	   TCPServerThread(Socket clientSocket){
  	       super("TCPServerThread");
   	       this.clientSocket=clientSocket;
	   }	

    public void run(){

    	try{    
	 
		BufferedReader in = new BufferedReader(new InputStreamReader(clientSocket.getInputStream()));     
		PrintWriter out=new PrintWriter(clientSocket.getOutputStream(),true);             
		out.println("Enter you name..");
		out.flush();
		String username = in.readLine();
		myserver5.userList.add(username);
		myserver5.broadcast(username+ " has joined chat","App");
		
		while(true){
			String inputLine = in.readLine();
     	   		if(!inputLine.isEmpty()){
				//System.out.println(username+" has sent: " + inputLine);
	   		}
	   		if(inputLine.equals("bye")){
				//out.println(username+" has left the chat");
				myserver5.broadcast(username+ " has left the chat","App"); 
				break;
	   		}
	   		else if(inputLine.equals("List")){
	       			 System.out.println(username + " is requesting list of clients");	 
	       			 myserver5.getuserList();
				 //myserver5.broadcast(inputLine,username); 
				String welcomemessage="The users in the current chat are :\n";
				clientSocket.getOutputStream().write(welcomemessage.getBytes("UTF-8"));
				
				  for(String k : myserver5.userList){
					String l="\n"+k+"\n";
					clientSocket.getOutputStream().write(l.getBytes("UTF-8"));
				}      
           		}myserver5.broadcast(inputLine,username);
		}
      		myserver5.userList.remove(username);
      		clientSocket.close();
		myserver5.broadcast(username+ " has left the chat","App");
   	 	}catch(Exception e){
			System.out.println("Chat Error: "+e);
       		 }
     }
 }
