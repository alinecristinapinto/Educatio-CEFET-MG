package blt.java.emprestimo.util;

import java.text.DateFormat;
import java.text.ParseException;
import java.text.SimpleDateFormat;
import java.time.LocalDate;
import java.time.format.DateTimeFormatter;
import java.time.format.DateTimeParseException;
import java.util.Date;

/**
 * Funções auxiliares para lidar com datas.
 * 
 * @author Torres
 */
public class DataUtil {

    /** O padrão usado para conversão.  */
    private static final String DATE_PATTERN = "dd/MM/yyyy";

    /** O formatador de data. */
    private static final DateTimeFormatter DATA_FORMATO = 
            DateTimeFormatter.ofPattern(DATE_PATTERN);

    /**
     * Retorna os dados como String formatado. O 
     * {@link DateUtil#DATE_PATTERN}  (padrão de data) que é utilizado.
     * 
     * @param date A data a ser retornada como String
     * @return String formatado
     */
    public static String formato(LocalDate date) {
        if (date == null) {
            return null;
        }
        return DATA_FORMATO.format(date);
    }
    
    public static long calculaDiferencaDias(LocalDate data1, LocalDate data2) throws ParseException{
        try{
            DateFormat df = new SimpleDateFormat("dd/MM/yyyy");
            
            Date dt1 = df.parse(data1.format(DATA_FORMATO));
            Date dt2 = df.parse(data2.format(DATA_FORMATO));
        
            long diferencaEmMilissegundos = dt1.getTime() - dt2.getTime();
        
            long diferencaEmDias = ((diferencaEmMilissegundos) / (1000*60*60*24));
            
            return diferencaEmDias;
            
        }catch (DateTimeParseException e){
            return -1;
        }
    }
    
    public static String adicionaXDias(String data1, int dias) throws ParseException{
        try{
            DateFormat df = new SimpleDateFormat("dd/MM/yyyy");
            
            LocalDate dt = parse(data1);
            Date dt1 = df.parse(dt.format(DATA_FORMATO));
            
            long adicionaDia = dt1.getTime() + (1000*60*60*24*dias);
            
            Date d1 = new Date(adicionaDia);
            return df.format(d1);
            
        }catch (DateTimeParseException e){
            return null;
        }
    }
    
    /**
     * Converte um String no formato definido {@link DateUtil#DATE_PATTERN} 
     * para um objeto {@link LocalDate}.
     * 
     * Retorna null se o String não puder se convertido.
     * 
     * @param dateString a data como String
     * @return o objeto data ou null se não puder ser convertido
     */
    public static LocalDate parse(String dateString) {
        try {
            return DATA_FORMATO.parse(dateString, LocalDate::from);
        } catch (DateTimeParseException e) {
            return null;
        }
    }
    
    /**
     * Checa se o String é uma data válida.
     * 
     * @param dateString A data como String
     * @return true se o String é uma data válida
     */
    public static boolean validaData(String dateString) {
        // Tenta converter o String.
        return DataUtil.parse(dateString) != null;
    }
}