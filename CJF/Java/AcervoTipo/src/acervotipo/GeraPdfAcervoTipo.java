package acervotipo;

import java.io.FileOutputStream;
import java.io.OutputStream;
import com.itextpdf.text.Document;
import com.itextpdf.text.Font;
import com.itextpdf.text.Font.FontFamily;
import com.itextpdf.text.PageSize;
import com.itextpdf.text.Paragraph;
import com.itextpdf.text.pdf.PdfPTable;
import com.itextpdf.text.pdf.PdfWriter;
import java.util.ArrayList;

public class GeraPdfAcervoTipo {
    
    public ArrayList livros = null, periodicos = null, academicos = null, midias = null;
    
    public GeraPdfAcervoTipo(ArrayList livros, ArrayList periodicos, ArrayList academicos, ArrayList midias){
        this.livros = livros;
        this.periodicos = periodicos;
        this.academicos = academicos;
        this.midias = midias;
    }
    public void imprimindo() throws Exception{
        
        Document documento = null;
        OutputStream os = null;
        
        try {
            //cria o documento tamanho A4, margens de 2,54cm
            documento = new Document(PageSize.A4, 72, 72, 72, 72);
            
            //cria a stream de saída, o arquvivo e salvo na pasta do usuario
            String arq = System.getProperty("user.home")  + "/Desktop./RelatorioAcervoTipo.pdf";
            
            //cria a stream de saída, na pasta do programa
            os = new FileOutputStream(arq); 
            
            //associa a stream de saída ao pdf
            PdfWriter.getInstance(documento, os);

            //abre o documento
            documento.open();

            //adiciona o texto ao PDF
            Paragraph p1 = new Paragraph("Relatorio de acervo por tipo");
            Font f = new Font(FontFamily.COURIER,20);
            p1.setFont(f);
            p1.setAlignment(1);
            p1.setSpacingAfter(20);
            documento.add(p1);
            
            p1 = new Paragraph("Livros");
            p1.setFont(f);
            p1.setAlignment(1);
            p1.setSpacingAfter(20);
            documento.add(p1);
            
            for(int intTemp0 = 0; intTemp0 < livros.size(); intTemp0++){
                PdfPTable tabelaLivros = new PdfPTable(1);
                //comeca em nome e repete de 6 em 6
                if(intTemp0 % 6 == 0){
                   String quebraLinha = "\n";
                   Paragraph paragrafoTemporario1 = new Paragraph(quebraLinha);
                   documento.add(paragrafoTemporario1); 
                }
                tabelaLivros.addCell((String) livros.get(intTemp0));
                documento.add(tabelaLivros);
            }
            documento.newPage();
            
            p1 = new Paragraph("Academicos");
            p1.setFont(f);
            p1.setAlignment(1);
            p1.setSpacingAfter(20);
            documento.add(p1);
            
            for(int intTemp1 = 0; intTemp1 < academicos.size(); intTemp1++){
                PdfPTable tabelaAcademicos = new PdfPTable(1);
                //comeca em nome e repete de 6 em 6
                if(intTemp1 % 6 == 0){
                   String quebraLinha = "\n";
                   Paragraph paragrafoTemporario1 = new Paragraph(quebraLinha);
                   documento.add(paragrafoTemporario1); 
                }
                tabelaAcademicos.addCell((String) academicos.get(intTemp1));
                documento.add(tabelaAcademicos);
            }
            documento.newPage();
            
            p1 = new Paragraph("Periodicos");
            p1.setFont(f);
            p1.setAlignment(1);
            p1.setSpacingAfter(20);
            documento.add(p1);
            
            for(int intTemp2 = 0; intTemp2 < periodicos.size(); intTemp2++){
                PdfPTable tabelaPeriodicos = new PdfPTable(1);
                //comeca em nome e repete de 6 em 6
                if(intTemp2 % 6 == 0){
                   String quebraLinha = "\n";
                   Paragraph paragrafoTemporario2 = new Paragraph(quebraLinha);
                   documento.add(paragrafoTemporario2); 
                }
                tabelaPeriodicos.addCell((String) periodicos.get(intTemp2));
                documento.add(tabelaPeriodicos);
            }
            documento.newPage();
            
            p1 = new Paragraph("Midias");
            p1.setFont(f);
            p1.setAlignment(1);
            p1.setSpacingAfter(20);
            documento.add(p1);
            
            for(int intTemp3 = 0; intTemp3 < midias.size(); intTemp3++){
                PdfPTable tabelaMidias = new PdfPTable(1);
                //comeca em nome e repete de 6 em 6
                if(intTemp3 % 6 == 0){
                   String quebraLinha = "\n";
                   Paragraph paragrafoTemporario3 = new Paragraph(quebraLinha);
                   documento.add(paragrafoTemporario3); 
                }
                tabelaMidias.addCell((String) midias.get(intTemp3));
                documento.add(tabelaMidias);
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
