#TODO 1- Criar conta - Logar na conta  - Alterar dados_pessoal 
#TODO 2- Alterar senha - Logar na conta - mostra os dados_pessoal
#TODO 3- fazer reserva - fazer pagamento - mostrar a reserva - alterar reserva - deletar reserva
#TODO 4- logar no admin (ele é o id_usuario = 1 então cria ele no banco antes de automatizar ) 
#TODO 5- criar funcionario - alterar e deletar funcionario
#TODO 6- deletar usuario
#TODO 7- consultar gastos - cria - altera e deleta o gasto
#TODO 8- consultar reservas - altera e remove


from crawler import Crawler

webCrawler = Crawler()

email = "stephanie.Jorel@hotmail.com"
usuario = "stephanie"
senha = "Qualquersenha123#"
novaSenha = "Qualquersenha456#"

webCrawler.cadastrarUsuario(email, usuario, senha)

webCrawler.logarUsuario(usuario, senha)

webCrawler.alterarDadosUsuario()

webCrawler.alterarSenhaUsuario(email, novaSenha)

senha = novaSenha
webCrawler.logarUsuario(usuario, senha)

webCrawler.verDadosUsuario()

webCrawler.fazerReserva()

webCrawler.cadastrarFuncionario()

webCrawler.alterarFuncionario()

webCrawler.deletarFuncionario()

webCrawler.deletarUsuario()

webCrawler.consultarGastos()

webCrawler.criarGasto()

webCrawler.alterarGasto()

webCrawler.deletarGasto()

webCrawler.consultarReservas()

webCrawler.alterarReserva()

webCrawler.removerReserva()