package selecaonotas;

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
import com.itextpdf.text.Image;
import com.itextpdf.text.Phrase;
import com.itextpdf.text.pdf.PdfPCell;
import com.itextpdf.text.pdf.PdfPTable;
import java.awt.Desktop;
import java.io.File;
import java.io.FileInputStream;
import java.io.FileNotFoundException;
import java.io.IOException;
import javax.swing.JOptionPane;
import javax.swing.JFileChooser;
import javax.swing.filechooser.FileNameExtensionFilter;
import java.lang.Object;
import java.util.ArrayList;
import javafx.print.PageLayout;
import javafx.print.PageOrientation;
import javafx.print.Paper;
import javafx.print.Printer;
import javafx.print.PrinterAttributes;
import javafx.print.PrinterJob;
import javax.print.Doc;
import javax.print.DocPrintJob;
import javax.print.PrintException;
import javax.print.PrintService;
import javax.print.SimpleDoc;
import javax.print.attribute.HashPrintRequestAttributeSet;


public class ImpressaoSelecaoNotas {
    //Essa matriz contem etapa, disciplina e nota
    public String matrizTabela[][];
    //numero de linhas e colunas da matriz definida anteriormente
    public int numeroLinhas, numeroColunas;
    //Esses arrayslists armazenam as faltas e os dados dos alunos
    public ArrayList faltas, recebeDadosAluno;
    
    public ImpressaoSelecaoNotas(String[][] matrizTabela, int numeroLinhas,int numeroColunas, ArrayList recebeDadosAluno, ArrayList faltas){
        this.matrizTabela = matrizTabela;
        this.numeroLinhas = numeroLinhas;
        this.numeroColunas = numeroColunas;
        this.recebeDadosAluno = recebeDadosAluno;
        this.faltas = faltas;
    }
    
    public void imprimindo() throws Exception{
        
        Document documento = null;
        OutputStream saidaDocumento = null;
        String caminhoCompletoArquivo;
        
        
        try {
            //cria o documentoumento tamanho A4, margens de 2,54cm
            documento = new Document(PageSize.A4, 72, 72, 72, 72);
            
            //cria a stream de saída, o arquvivo e salva na pasta do usuario
            caminhoCompletoArquivo = System.getProperty("user.home")  + "./RelatorioSelecaoNotas_"+recebeDadosAluno.get(3)+".pdf";
            
            //cria a stream de saída, na pasta do programa
            saidaDocumento = new FileOutputStream(caminhoCompletoArquivo); 
            
            //associa a stream de saída ao pdf
            PdfWriter.getInstance(documento, saidaDocumento);

            //abre o documento
            documento.open();

            //adiciona o texto ao PDF
            
            //fonte
            Font fonte = new Font(FontFamily.UNDEFINED, 9);
            
            //imagem do cefetmg localizada no projeto do codigo
            Image img = Image.getInstance("Educatio.png");
            float novaAltura = (float) (0.2*img.getHeight());
            float novaLargura = (float) (0.2*img.getWidth());
            img.scaleAbsolute(novaAltura, novaLargura);
            

            ArrayList dadosAluno = new ArrayList();
            dadosAluno.add(img);
            dadosAluno.add("SECRETARIA DE REGISTRO E CONTROLE ACADEMICO\nRelatorio de notas individual");
            for(Object objetoTemporario1: recebeDadosAluno){
                dadosAluno.add(objetoTemporario1);
            }
            
            
            final int numeroColunasTabelaDadosAluno = 6;
            PdfPTable tabelaDadosAluno = new PdfPTable(numeroColunasTabelaDadosAluno);
            tabelaDadosAluno.setWidthPercentage(100.0f);
            tabelaDadosAluno.setHorizontalAlignment(0);

            
            PdfPCell celulaTemporaria1;
            for(Object objetoTemporario1: dadosAluno){
                
                if(objetoTemporario1.equals(dadosAluno.get(0))){
                    tabelaDadosAluno.addCell((Image) objetoTemporario1);
                     
                }else{
                    if(objetoTemporario1.equals(dadosAluno.get(1))){
                        celulaTemporaria1 = new PdfPCell();
                        Phrase fraseAuxiliar1 = new Phrase((String) objetoTemporario1);
                        celulaTemporaria1.addElement(fraseAuxiliar1);
                        celulaTemporaria1.setColspan(5);
                        tabelaDadosAluno.addCell(celulaTemporaria1);
                        

                    }else{
                        if(objetoTemporario1.equals(dadosAluno.get(3))){
                            celulaTemporaria1 = new PdfPCell();
                            Phrase fraseAuxiliar1 = new Phrase((String) objetoTemporario1);
                            celulaTemporaria1.addElement(fraseAuxiliar1);
                            celulaTemporaria1.setColspan(3);
                            tabelaDadosAluno.addCell(celulaTemporaria1);
                        }else{
                            if(objetoTemporario1.equals(dadosAluno.get(9))){
                                celulaTemporaria1 = new PdfPCell();
                                Phrase fraseAuxiliar1 = new Phrase((String) objetoTemporario1);
                                celulaTemporaria1.addElement(fraseAuxiliar1);
                                celulaTemporaria1.setColspan(3);
                                tabelaDadosAluno.addCell(celulaTemporaria1);
                            }else{
                                if(objetoTemporario1.equals(dadosAluno.get(5))){
                                    celulaTemporaria1 = new PdfPCell();
                                    Phrase fraseAuxiliar1 = new Phrase((String) objetoTemporario1, fonte);
                                    
                                    celulaTemporaria1.addElement(fraseAuxiliar1);
                                    tabelaDadosAluno.addCell(celulaTemporaria1);
                                }else{
                                    tabelaDadosAluno.addCell((String) objetoTemporario1);
                                } 
                            }
                        }
                    }
                }
            } 
            
            documento.add(tabelaDadosAluno);
            
            PdfPTable notasDisciplinas = new PdfPTable(2*numeroColunas);
            notasDisciplinas.setWidthPercentage(100.0f);
            notasDisciplinas.setHorizontalAlignment(1);
            
            //armazena notas e faltas
            String notaFalta[] = new String[2*numeroColunas - 1];
            //Coloca 30 espacos
            notaFalta[0] = matrizTabela[0][0];
            //Alterna escrevendo nota e falta para o boletim
            for(int intTemporario1 = 1; intTemporario1 < 2*(numeroColunas -1); intTemporario1 += 2){
                notaFalta[intTemporario1] = "Nota";
                notaFalta[intTemporario1+1] = "Faltas";
            }
            
            int intTemporario1 = 0;
            int indiceFaltas = 0;
            
            for(int intTemporario2 = 0; intTemporario2 < numeroLinhas; intTemporario2++){
                
                for(int intTemporario3 = 0; intTemporario3 < numeroColunas; intTemporario3++){
                    if(intTemporario3 != 0 && intTemporario2 != 0){
                        //As strings da segunda linha notas/faltas nao sao colocadas aqui 
                        //Coloca a nota
                        notasDisciplinas.addCell(matrizTabela[intTemporario2][intTemporario3]+" ");
                        //Coloca a falta
                        String stringAuxiliar = (String) faltas.get(indiceFaltas);
                        notasDisciplinas.addCell(stringAuxiliar+"");
                        indiceFaltas++;
                        
                        
                    }else{
                        
                        PdfPCell celula = new PdfPCell();
                        //Canto superior esquerdo
                        if(intTemporario2 == 0 && intTemporario3 == 0){
                            celula = new PdfPCell();
                            celula.addElement(new Phrase("Disciplina"+" "));
                            celula.setColspan(2);
                            celula.setRowspan(2);
                            notasDisciplinas.addCell(celula);
                            
                        }else{
                            //coloca dado de matrizTabela
                            celula.addElement(new Phrase(matrizTabela[intTemporario2][intTemporario3]+" "));
                            celula.setColspan(2);
                            notasDisciplinas.addCell(celula);
                            //Coloca dados da tabela notaFalta
                            if(intTemporario2 == 0 && intTemporario3 == numeroColunas-1){
                                for(int q = 1; q < 2*numeroColunas-1; q++){
                                        notasDisciplinas.addCell(notaFalta[q]+"");
                                }
                            }
                        }
                        
                    }
                }
            }
            
            
            documento.add(notasDisciplinas);
            
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
