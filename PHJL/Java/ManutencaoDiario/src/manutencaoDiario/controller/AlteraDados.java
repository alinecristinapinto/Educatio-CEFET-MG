
package manutencaoDiario.controller;

public class AlteraDados {
    
    public String[] alteraList(String dados){
        
        String formataList[] = dados.split(",");
        formataList[0] = formataList[0].replace('[', ' ');
        formataList[formataList.length - 1] = formataList[formataList.length - 1].replace(']', ' ');
        return formataList;
    }
}
