package selecaoconteudos;

import java.io.FileOutputStream;
import java.io.OutputStream;

import com.itextpdf.text.Document;
import com.itextpdf.text.Font;
import com.itextpdf.text.Font.FontFamily;
import com.itextpdf.text.PageSize;
import com.itextpdf.text.Paragraph;
import com.itextpdf.text.pdf.PdfWriter;
import com.itextpdf.text.Chunk;
import com.itextpdf.text.pdf.PdfPCell;
import com.itextpdf.text.pdf.PdfPTable;
import java.io.File;
import java.util.ArrayList;
import javax.swing.filechooser.FileSystemView;

public class GeraPdfSelecaoConteudos{
    public ArrayList bufferConteudos;
    public int idEtapa, idDisciplina;
    public String nomeDisciplina; 
    public GeraPdfSelecaoConteudos(ArrayList bufferConteudos, int idEtapa, String nomeDisciplina, int idDisciplina){
        this.bufferConteudos = bufferConteudos;
        this.idEtapa = idEtapa;
        this.nomeDisciplina = nomeDisciplina;
        this.idDisciplina = idDisciplina;
    }
    public void gerando() throws Exception{
        
        Document documento = null;
        OutputStream saidaDocumento = null;
        
        try {
            //cria o documento tamanho A4, margens de 2,54cm
            documento = new Document(PageSize.A4, 72, 72, 72, 72);
            
            //cria a stream de saída, o arquivo
            String arq = System.getProperty("user.home")  + "/Desktop./RelatorioSelecaoConteudos"+idDisciplina+nomeDisciplina+idEtapa+".pdf";
            
            
            //cria a stream de saída e salva na area de trabalho do usuario
            saidaDocumento = new FileOutputStream(arq); 
            
            //associa a stream de saída ao pdf
            PdfWriter.getInstance(documento, saidaDocumento);

            //abre o documento
            documento.open();
            
            //adiciona o texto ao PDF
            
            //Criando fontes
            Font fonteNegrito = new Font(FontFamily.UNDEFINED, 11, Font.BOLD);
            
            Font fonteNormal = new Font(FontFamily.UNDEFINED, 11, Font.NORMAL);
            
            Paragraph paragrafo1 = new Paragraph("Relatorio de conteudos - por disciplina e etapa");
            
            paragrafo1.setFont(fonteNormal);
            paragrafo1.setAlignment(1);
            paragrafo1.setSpacingAfter(20);
            documento.add(paragrafo1);
            
            
            //Criando as tabelas
            //Cabecalho
            PdfPTable cabecalho = new PdfPTable(2);
            cabecalho.setWidthPercentage(100.0f);
            cabecalho.setHorizontalAlignment(0);
            
            
            
            //Criando duas celula na tabela cabecalho para colocar etapa e disciplina
            //Etapa
            PdfPCell celulaTemp1 = new PdfPCell();
            Chunk pedacoTemp1 = new Chunk("Etapa: "+ idEtapa,fonteNegrito);
            celulaTemp1.addElement(pedacoTemp1);
            cabecalho.addCell(celulaTemp1);
            
            //Disciplina
            PdfPCell celulaTemp2 = new PdfPCell();
            Chunk pedacoTemp2 = new Chunk("Disciplina: "+idDisciplina+".   "+ nomeDisciplina,fonteNegrito);
            celulaTemp2.addElement(pedacoTemp2);
            cabecalho.addCell(celulaTemp2);
            
            //Adicionando ao documento
            documento.add(cabecalho);
            
            //Escrevendo conteudos
            //Tabela dos conteudos
            PdfPTable tabelaConteudos = new PdfPTable(1);
            tabelaConteudos.setWidthPercentage(100.0f);
            tabelaConteudos.setHorizontalAlignment(0);
            
            PdfPCell celulaTemp3 = new PdfPCell();
            Chunk pedacoTemp3 = new Chunk("Conteudos ", fonteNegrito);
            celulaTemp3.addElement(pedacoTemp3);
            tabelaConteudos.addCell(celulaTemp3);
            
            
            //Coloca demais conteudos ocupando uma linha
            for(int indiceTemp = 0; indiceTemp < bufferConteudos.size(); indiceTemp++){
                PdfPCell celulaTemp4 = new PdfPCell();
                Chunk pedacoTemp4 = new Chunk((String) bufferConteudos.get(indiceTemp), fonteNormal);
                celulaTemp4.addElement(pedacoTemp4);
                tabelaConteudos.addCell(celulaTemp4);
            }
            
            //adicionando tabela ao pdf
            documento.add(tabelaConteudos);
            
        }finally {
            if (documento != null) {
                //fechamento do documentoumento
                documento.close();
            }
            if (saidaDocumento != null) {
               //fechamento da stream de saída
               saidaDocumento.close();
            }
        }
    }
}

