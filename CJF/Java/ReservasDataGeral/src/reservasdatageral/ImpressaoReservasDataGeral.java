package reservasdatageral;

import java.io.FileOutputStream;
import java.io.OutputStream;

import com.itextpdf.text.Document;
import com.itextpdf.text.Font;
import com.itextpdf.text.Font.FontFamily;
import com.itextpdf.text.PageSize;
import com.itextpdf.text.Paragraph;
import com.itextpdf.text.pdf.PdfWriter;
import com.itextpdf.*;
import com.itextpdf.text.BaseColor;
import com.itextpdf.text.Chunk;
import com.itextpdf.text.DocumentException;
import com.itextpdf.text.Element;
import com.itextpdf.text.Phrase;
import com.itextpdf.text.pdf.PdfPCell;
import com.itextpdf.text.pdf.PdfPTable;
import java.io.FileNotFoundException;
import java.io.IOException;
import javax.swing.JOptionPane;
import javax.swing.JFileChooser;
import javax.swing.filechooser.FileNameExtensionFilter;
import java.lang.Object;
import java.util.ArrayList;

public class ImpressaoReservasDataGeral {
    public ArrayList dadosReservaGeral, dadosReservaData, datas;
    public ImpressaoReservasDataGeral(ArrayList dadosReservaGeral, ArrayList dadosReservaData, ArrayList datas){
        this.dadosReservaGeral = dadosReservaGeral;
        this.dadosReservaData = dadosReservaData;
        this.datas = datas;
    }
    public void imprimindo() throws Exception{
        
        Document doc = null;
        OutputStream os = null;
        
        try {
            //cria o documento tamanho A4, margens de 2,54cm
            doc = new Document(PageSize.A4, 72, 72, 72, 72);
            
            //cria a stream de saída, o arquvivo e salvo na pasta do usuario que eh o desktop
            String arq = System.getProperty("user.home")  + "/Desktop./RelatorioReservas.pdf";
            
            
            //cria a stream de saída, na pasta do programa
            os = new FileOutputStream(arq); 
            
            //associa a stream de saída ao pdf
            PdfWriter.getInstance(doc, os);

            //abre o documento
            doc.open();

            //adiciona o texto ao PDF
            Paragraph p1 = new Paragraph("Relatorio de reservas");
            Font f = new Font(FontFamily.COURIER,20);
            p1.setFont(f);
            p1.setAlignment(1);
            p1.setSpacingAfter(20);
            doc.add(p1);
            
            Paragraph p2 = new Paragraph("\nRelatorio geral:\n");
            p2.setFont(f);
            p2.setAlignment(1);
            p2.setSpacingAfter(20);
            doc.add(p2);
            
            for(int intTemp0 = 0; intTemp0 < dadosReservaGeral.size(); intTemp0++){
                PdfPTable tabelaReservaGeral = new PdfPTable(1);
                //comeca em nome e repete de 6 em 6
                if(intTemp0 % 6 == 0){
                   String quebraLinha = "\n";
                   Paragraph paragrafoTemporario1 = new Paragraph(quebraLinha);
                   doc.add(paragrafoTemporario1); 
                }
                tabelaReservaGeral.addCell((String)dadosReservaGeral.get(intTemp0));
                doc.add(tabelaReservaGeral);
            }
            doc.newPage();
            
            Paragraph p3 = new Paragraph("\n\n\nRelatorio por data:\n");
            p3.setFont(f);
            p3.setAlignment(1);
            p3.setSpacingAfter(20);
            doc.add(p3);
            
            for(int indiceDatas = 0; indiceDatas < datas.size(); indiceDatas++){
                
                Paragraph paragrafoTemporario3 = new Paragraph((String) datas.get(indiceDatas));
                doc.add(paragrafoTemporario3);
                
                for(int intTemp1 = 0; intTemp1 < dadosReservaData.size(); intTemp1++){
                PdfPTable tabelaReservaData = new PdfPTable(1);
                //comeca em nome e repete de 6 em 6
                if(intTemp1 % 6 == 0){
                   String quebraLinha = "\n";
                   Paragraph paragrafoTemporario2 = new Paragraph(quebraLinha);
                   doc.add(paragrafoTemporario2); 
                }
                tabelaReservaData.addCell((String)dadosReservaData.get(intTemp1));
                doc.add(tabelaReservaData);
            }
            }
            
            
        }finally {
            if (doc != null) {
                //fechamento do documento
                doc.close();
            }
            if (os != null) {
               //fechamento da stream de saída
               os.close();
            }
        }
    }
}
