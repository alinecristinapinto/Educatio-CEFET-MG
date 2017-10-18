
package javawtf;

import java.sql.SQLException;
import javax.swing.JOptionPane;


public class JavaWTF {

    
    public static void main(String[] args) throws SQLException {
                     
        
        Professor p1 = new Professor(999999999, 55555, "augusto", "doutorado", "1dsa456d");            
         
        Funcprof funcoesprof1 = new Funcprof(p1);
        
        funcoesprof1.abrebd();               
                           
        funcoesprof1.addprofessor();
        
        JOptionPane.showMessageDialog(null, "batata");
                   
        funcoesprof1.deleteprofessor();
        
        funcoesprof1.fechabd();
        
    }
    
}
