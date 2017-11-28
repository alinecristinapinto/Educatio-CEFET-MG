package emprestimodata;

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

public class GeraPdfEmprestimoDataGeral {
    public ArrayList dadosEmprestimoGeral, dadosEmprestimoData;
    public GeraPdfEmprestimoDataGeral(ArrayList dadosEmprestimoGeral, ArrayList dadosEmprestimoData){
        this.dadosEmprestimoGeral = dadosEmprestimoGeral;
        this.dadosEmprestimoData = dadosEmprestimoData;
        
    }
    public void imprimindo() throws Exception{
        
        Document documento = null;
        OutputStream os = null;
        
        try {
            //cria o documento tamanho A4, margens de 2,54cm
            documento = new Document(PageSize.A4, 72, 72, 72, 72);
            
            //cria a stream de saída, o arquvivo e salvo na pasta do usuario que eh desktop
            String arq = System.getProperty("user.home")  + "/Desktop./RelatorioEmprestimos.pdf";
            
            
            //cria a stream de saída, na pasta do programa
            os = new FileOutputStream(arq); 
            
            //associa a stream de saída ao pdf
            PdfWriter.getInstance(documento, os);

            //abre o documento
            documento.open();

            //adiciona o texto ao PDF
            //Titulo
            Paragraph p1 = new Paragraph("Relatorio de emprestimos ");
            Font f = new Font(FontFamily.COURIER,20);
            p1.setFont(f);
            p1.setAlignment(1);
            p1.setSpacingAfter(20);
            documento.add(p1);
            
            //subtitulo relatorio geral
            Paragraph p2 = new Paragraph("\nRelatorio Geral:\n");
            p2.setFont(f);
            p2.setAlignment(0);
            p2.setSpacingAfter(20);
            documento.add(p2);
            //As tabelas sao organizadas colocando cada celula em um retangulo
            //Quando comecar um novo registro atraves do nome, salta-se um espaco
            
            for(int intTemp0 = 0; intTemp0 < dadosEmprestimoGeral.size(); intTemp0++){
                PdfPTable tabelaEmprestimoGeral = new PdfPTable(1);
                //comeca em nome e repete de 6 em 6
                if(intTemp0 % 6 == 0){
                   String quebraLinha = "\n";
                   Paragraph paragrafoTemporario1 = new Paragraph(quebraLinha);
                   documento.add(paragrafoTemporario1); 
                }
                tabelaEmprestimoGeral.addCell((String)dadosEmprestimoGeral.get(intTemp0));
                documento.add(tabelaEmprestimoGeral);
            }
            documento.newPage();
            
            //subtitulo relatorio por data
            Paragraph p3 = new Paragraph("\nRelatorio por data:\n");
            p3.setFont(f);
            p3.setAlignment(0);
            p3.setSpacingAfter(20);
            documento.add(p3);
            
            //mostra tudo ordenado, porem sem mostrar a data
             
            for(int intTemp1 = 0; intTemp1 < dadosEmprestimoData.size(); intTemp1++){

                //optamos por utilizar uma tabela de uma coluna e uma celula 
                //para obter o retangulo de maneira mais facil
                PdfPTable tabelaEmprestimoData = new PdfPTable(1);
                //comeca em nome e repete de 6 em 6
                if(intTemp1 % 6 == 0){
                   String quebraLinha = "\n";
                   Paragraph paragrafoTemporario2 = new Paragraph(quebraLinha);
                   documento.add(paragrafoTemporario2); 
                }
                tabelaEmprestimoData.addCell((String)dadosEmprestimoData.get(intTemp1));
                documento.add(tabelaEmprestimoData);
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

