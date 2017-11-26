package relatorio8.controlador;

import java.net.URL;
import java.util.ResourceBundle;

import javafx.fxml.FXML;
import javafx.print.PageLayout;
import javafx.print.PageOrientation;
import javafx.print.Paper;
import javafx.print.Printer;
import javafx.print.PrinterAttributes;
import javafx.print.PrinterJob;
import javafx.scene.control.Button;
import javafx.scene.control.Label;
import javafx.scene.layout.AnchorPane;
import javafx.scene.transform.Scale;
import javafx.stage.Stage;
import model.Relatorio8Aluno;
import relatorio8.view.Relatorio8;

public class CertificadoControlador {

	 private Relatorio8 relatorio8;
	 private boolean okClic = false;
	 private Relatorio8Aluno aluno;
	 @FXML
	 private Label label1;
	 @FXML
	 private Label label2;
	 @FXML
	 private Label label3;
	 @FXML
	 private Label label4;
	 @FXML
	 private AnchorPane certificadoPDF;
	 @FXML
	 private Button imprime;



	 public void setRelatorio8(Relatorio8 relatorio8){
	        this.relatorio8=relatorio8;
	    }
	 public void initialize(URL url, ResourceBundle rb) {

	    }

	 public void setAluno(Relatorio8Aluno aluno){
		 this.aluno = aluno;
		 if(aluno.getModalidadeCurso().equals("Técnico Integrado")){
			 label1.setText("Certifico que "+aluno.getNome()+" concluiu com sucesso o ");
			 label2.setText(aluno.getModalidadeCurso()+" em "+aluno.getNomeCurso());
			 label3.setText("realizado de "+aluno.getMenorAnoMatriculado()
			 				+" a "+aluno.getMaiorAnoMatriculado());
		 }
		 if(aluno.getModalidadeCurso().equals("Graduação")){
			 label1.setText("Certifico que "+aluno.getNome()+" concluiu com sucesso a ");
			 label2.setText(aluno.getModalidadeCurso()+" em "+aluno.getNomeCurso());
			 label3.setText("realizada de "+aluno.getMenorAnoMatriculado()
			 				+" a "+aluno.getMaiorAnoMatriculado());
		 }
		 	label4.setText(aluno.getCoordenadorCurso()+", coordenador(a) do curso");

	 }
	 
	 public void imprimeCertificado() {
	        Printer printer = Printer.getDefaultPrinter();
	        PageLayout pageLayout = printer.createPageLayout(Paper.A4, PageOrientation.LANDSCAPE, Printer.MarginType.HARDWARE_MINIMUM);
	        PrinterAttributes attr = printer.getPrinterAttributes();
	        PrinterJob job = PrinterJob.createPrinterJob();
	        double scaleX = (pageLayout.getPrintableWidth() / certificadoPDF.getBoundsInParent().getWidth());
	        double scaleY = 1.45;
	       
	        Scale scale = new Scale(scaleX, scaleY);
	        certificadoPDF.getTransforms().add(scale);

	        if (job != null && job.showPrintDialog(certificadoPDF.getScene().getWindow())) {
	            boolean success = job.printPage(pageLayout, certificadoPDF);
	            if (success) {
	                job.endJob();
	            }
	        }
	        certificadoPDF.getTransforms().remove(scale);
	    }


	 public boolean seOkClic(){
	        return okClic;
	    }
}
