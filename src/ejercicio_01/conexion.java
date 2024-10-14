/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Classes/Class.java to edit this template
 */

package ejercicio_01;

import java.sql.Connection;
import java.sql.SQLException;
import java.util.logging.Level;
import java.util.logging.Logger;

/**
 *
 * @author MABEL
 */
public class conexion {
    String bd="cecyteim";
    String url="jdbc:mysql://localhost:3306/";
    String user="root";
    String password="";
    String driver="com.mysql.cj.jdbc.Driver";
    Connection cx;
    
    
    public conexion(){
        
    }
    
    public Connection conectar(){
        try {
            Class.forName(driver);  
            cx=DriverManager.getConnection(url+bd, user, password);
            System.out.println(" SE CONECTO A LA BASE DE DATOS"+bd);
        } catch (ClassNotFoundException |SQLException ex) {
            System.out.println("NO SE CONECTO A LA BASE DE DATOS"+bd);
            //Logger.getLogger(conexion.class.getName()).log(Level.SEVERE, null, ex);
        }
        
        return cx;
    }
      
    public void desconectar(){
        
        try {
            cx.close();
        } catch (SQLException ex) {
            Logger.getLogger(conexion.class.getName()).log(Level.SEVERE, null, ex);
        }
    }
    public static void main(String[] args) {
        conexion  conexion=new conexion();
        conexion.conectar();
    }
}           
  