package selecaonotas;

import java.util.ArrayList;

public class InsercaoMatrizString {
    public String disciplinasTabela = "", etapasTabela = "";
    public int numeroColunas, numeroLinhas;
    public String matrizTabela[][];
    public ArrayList faltas, dadosAluno;
    
    
    public InsercaoMatrizString(String disciplinasTabela, String etapasTabela, ArrayList dadosAluno, ArrayList faltas){
        this.disciplinasTabela = disciplinasTabela;
        this.etapasTabela = etapasTabela;
        this.dadosAluno = dadosAluno;
        this.faltas = faltas;
    }
    
    public void setMatrizTabela(){
        this.matrizTabela = new String[numeroLinhas][numeroColunas+1];   
    }
    
    public void metodoOrganizacao(){
        numeroColunas = 0; 
        numeroLinhas = 0;


        for(int indiceTemp1 = 0; indiceTemp1 < disciplinasTabela.length(); indiceTemp1++){
            if(disciplinasTabela.charAt(indiceTemp1)== '\n'){
                numeroLinhas++;

            }
        }
        
        numeroLinhas++;
        for(int indiceTemp1 = 0; indiceTemp1 < etapasTabela.length(); indiceTemp1++){
            if(etapasTabela.charAt(indiceTemp1) =='x'){
                numeroColunas++;

            }
        }
        setMatrizTabela();
        
        int indiceTemp2 = 0;
        int indiceAnterior = 0; 

        for(int indiceTemp1 = 0; indiceTemp1 < etapasTabela.length(); indiceTemp1++){
            if(etapasTabela.charAt(indiceTemp1) =='x'){
                matrizTabela[0][indiceTemp2] = etapasTabela.substring(indiceAnterior, indiceTemp1);//pega o que tiver escrito etapa
                indiceTemp2++;
                indiceAnterior = indiceTemp1+1;
            }
        }

        indiceAnterior = 0; 
        int linhaAtual = 1;
        int colunaAtual = 0;
        //"Matematicax10x20x30x10x\nPortuguesx10x20x30x10x\n"
        for(int indiceTemp1 = 0; indiceTemp1 < disciplinasTabela.length(); indiceTemp1++){

            if(disciplinasTabela.charAt(indiceTemp1) == 'x'){
                String aux=disciplinasTabela.substring(indiceAnterior, indiceTemp1);

                matrizTabela[linhaAtual][colunaAtual] = aux;
                indiceAnterior = indiceTemp1+1;
                colunaAtual++;
            }

            if(disciplinasTabela.charAt(indiceTemp1)== '\n'){
                colunaAtual=0;
                indiceAnterior++;
                //novalinha
                linhaAtual++;
            }

        }
    }
    public void metodoExibicao(){
        
        metodoOrganizacao();
        System.out.println("Relatorio de notas");
        for(Object objetoDadosAluno: dadosAluno){
            System.out.println((String) objetoDadosAluno);
        }
        System.out.println("Faltas: ");
        for(Object ausencias: faltas){
            System.out.println((String) ausencias);
        }
        
        for(int k=0; k<numeroLinhas; k++){
            for(int j=0; j<numeroColunas; j++){
                System.out.print(matrizTabela[k][j]+" ");
            }
            System.out.print("\n");
        }
    }
    public void metodoImpressao() throws Exception{
        
        metodoOrganizacao();
        
        ImpressaoSelecaoNotas isn = new ImpressaoSelecaoNotas(matrizTabela,numeroLinhas,numeroColunas, dadosAluno, faltas);
           
        isn.imprimindo();
    }
}
