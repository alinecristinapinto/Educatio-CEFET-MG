package reservasdatageral;

import java.io.FileOutputStream;
import java.io.OutputStream;

import com.itextpdf.text.Document;
import com.itextpdf.text.Font;
import com.itextpdf.text.Font.FontFamily;
import com.itextpdf.text.PageSize;
import com.itextpdf.text.Paragraph;
import com.itextpdf.text.pdf.PdfWriter;
import com.itextpdf.text.pdf.PdfPTable;
import java.util.ArrayList;

public class GeraPdfReservasDataGeral {
    public ArrayList dadosReservaGeral, dadosReservaData;
    public GeraPdfReservasDataGeral(ArrayList dadosReservaGeral, ArrayList dadosReservaData){
        this.dadosReservaGeral = dadosReservaGeral;
        this.dadosReservaData = dadosReservaData;
       
    }
    public void imprimindo() throws Exception{
        
        Document documento = null;
        OutputStream os = null;
        
        try {
            //cria o documento tamanho A4, margens de 2,54cm
            documento = new Document(PageSize.A4, 72, 72, 72, 72);
            
            //cria a stream de saída, o arquvivo e salvo na pasta do usuario que eh o desktop
            String arq = System.getProperty("user.home")  + "/Desktop./RelatorioReservas.pdf";
            
            
            //cria a stream de saída, na pasta do programa
            os = new FileOutputStream(arq); 
            
            //associa a stream de saída ao pdf
            PdfWriter.getInstance(documento, os);

            //abre o documento
            documento.open();

            //adiciona o texto ao PDF
            Paragraph p1 = new Paragraph("Relatorio de reservas");
            Font f = new Font(FontFamily.COURIER,20);
            p1.setFont(f);
            p1.setAlignment(1);
            p1.setSpacingAfter(20);
            documento.add(p1);
            
            Paragraph p2 = new Paragraph("\nRelatorio geral:\n");
            p2.setFont(f);
            p2.setAlignment(1);
            p2.setSpacingAfter(20);
            documento.add(p2);
            
            for(int intTemp0 = 0; intTemp0 < dadosReservaGeral.size(); intTemp0++){
                PdfPTable tabelaReservaGeral = new PdfPTable(1);
                //comeca em nome e repete de 6 em 6
                if(intTemp0 % 6 == 0){
                   String quebraLinha = "\n";
                   Paragraph paragrafoTemporario1 = new Paragraph(quebraLinha);
                   documento.add(paragrafoTemporario1); 
                }
                tabelaReservaGeral.addCell((String)dadosReservaGeral.get(intTemp0));
                documento.add(tabelaReservaGeral);
            }
            documento.newPage();
            
            Paragraph p3 = new Paragraph("\n\n\nRelatorio por data:\n");
            p3.setFont(f);
            p3.setAlignment(1);
            p3.setSpacingAfter(20);
            documento.add(p3);
            
            
            for(int intTemp1 = 0; intTemp1 < dadosReservaData.size(); intTemp1++){
                PdfPTable tabelaReservaData = new PdfPTable(1);
                //comeca em nome e repete de 6 em 6
                if(intTemp1 % 6 == 0){
                   String quebraLinha = "\n";
                   Paragraph paragrafoTemporario2 = new Paragraph(quebraLinha);
                   documento.add(paragrafoTemporario2); 
                }
                tabelaReservaData.addCell((String)dadosReservaData.get(intTemp1));
                documento.add(tabelaReservaData);
            }
            
            
            
        }finally {
            if (documento != null) {
                //fechamento do documento
                documento.close();
            }
            if (os != null) {
               //fechamento da stream de saída
               os.close();
            }
        }
    }
}
