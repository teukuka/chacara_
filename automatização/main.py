#Oq tem que automatizar 
#- criar conta 
#- logar 
#- alterar senha 
#- excluir a conta ( isso faz pelo admin ) / 
#cadastrar funcionário + alterar e excluir funcionário / alterar dados_ pessoal
from crawler import Crawler

webCrawler = Crawler()

email = "mateus.Jorel@hotmail.com"
usuario = "Mateus"
senha = "Qualquersenha123#"
webCrawler.cadastro(email, usuario, senha)

webCrawler.login(email, senha)

senhaOld = senha
senhaNew = "Qualquersenha456#"
webCrawler.alterarSenha(email, senhaOld, senhaNew)

webCrawler.excluirConta()

webCrawler.cadastrarFuncionario()

webCrawler.alterarFuncionario()