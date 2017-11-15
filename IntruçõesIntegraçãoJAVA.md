# Instruções para ajudar a integração do projeto final - Java

<h3> Primeiro passo:</h3>
Espera-se que seu trabalho esteja funcionando <strong> SEM ERROS</strong> mesmo com a utilização do BD disponibilizado pela Gerência. 
Erros no seu projeto antes da integração não serão tolerados e a não correção deles após pedido da gerência será relatada aos professores e continuará com erro.
Então certifique-se que seus projetos estão funcionando perfeitamente.
    
<h3> Segundo Passo </h3>
Seu projeto possui uma classe principal do JavaFX, aquela com o método start e sua main. Mas na hora de integrar o projeto haverá apenas uma main do JavaFX, logo os passos são os seguintes:
*Crie uma <strong> CLASSE NORMAL DO JAVA </strong> com o mesmo nome da main do JavaFX, (O NOME TEM QUE SER UMA DESCRIÇÃO DO SEU PROJETO Ex: ManutencaoAluno, espera-se que seu pacote principal (que contém os outros) esteja com o mesmo nome). 
*Nessa classe normal, copie todos os métodos da main do JavaFX, exceto pelo método <i> main </i> e pelo método <i> start </i>
*Crie uma variável com o mesmo texto a seguir:"private mainApp mainApp;".
*Essa variável é o acesso da classe com a main Principal do projeto e é necessária imprescindivelmente para a integração. Deixe essa parte do código comentada, pois você não tem como importar o objeto mainApp.
*Espera-se que todos os seu controladores tenham uma variável referenciando a sua classe principal do projeto, (se não estão crie!).
*Espera-se também que os controladores tenham um set que recebe a referência da classe principal direto da main quando você invoca o FXML e o controlador.
*Se já tem, crie outra variável com o nome da sua classe normal do java que equivale a sua main do JavaFX. Ex: "ManutencaoAluno manutencaoAluno;". Deixe esse código comentado também.
*Na sua classe principal existe uma variável que chama-se palcoPrincipal ou primaryStage (que é fora do padrão porém...), ela referencia o palco da sua aplicação e você a utiliza para mostrar as coisas na tela, então, crie um get para ela (apenas isso), você irá precisar disso na hora de chamar os Alert padrões e isso é necessário para a integração.
*Crie outro get comentado (mesmo nome), porém no return dele coloque "mainApp.getPalcoPrincipal();";

<h3> Último Passo </h3>
Mandar para a gerência pela pasta do seu grupo no git, especificando que aquela é a versão final e se pertence a Java ou WEB.
Isso deverá ser feito pelo líder do grupo, por questões de organização do Git.
Se algum dos passos acima não forem cumpridos, dificultará a integração e com o tempo perdido para consertá-lo pode-se não conseguir terminá-la, logo qualquer erro será registrado.
Qualquer dúvida tratar com os gerentes.
