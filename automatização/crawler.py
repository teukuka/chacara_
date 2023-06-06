import shutil
from selenium.webdriver import Firefox
from selenium.webdriver.firefox.options import Options
from selenium import webdriver
from selenium.webdriver.common.by import By
from selenium.webdriver.support.ui import WebDriverWait
from selenium.webdriver.support import expected_conditions as EC
from time import sleep
from selenium.webdriver.common.keys import Keys

#TODO 1- Criar conta - Logar na conta  - Alterar dados_pessoal 
#TODO 2- Alterar senha - Logar na conta - mostra os dados_pessoal
#TODO 3- fazer reserva - fazer pagamento - mostrar a reserva - alterar reserva - deletar reserva
#TODO 4- logar no admin (ele é o id_usuario = 1 então cria ele no banco antes de automatizar ) 
#TODO 5- criar funcionario - alterar e deletar funcionario
#TODO 6- deletar usuario
#TODO 7- consultar gastos - cria - altera e deleta o gasto
#TODO 8- consultar reservas - altera e remove

t = 2

class Crawler:

    def __init__(self) -> None:
        profile = webdriver.FirefoxProfile()
        profile.set_preference("javascript.enabled", True)
        self.driver = webdriver.Firefox(profile)
        self.url_home = "http://localhost/teste/"

    def cadastrarUsuario(self, email, usuario, senha):
        self.driver.get(self.url_home)
        sleep(t)
        xpath = '/html/body/header/nav/ul/li[2]/a'
        loginBt = self.driver.find_element(By.XPATH, xpath)
        loginBt.click()
        sleep(t)
        xpath = '/html/body/section/form/div[3]/a/button'
        criarBt = self.driver.find_element(By.XPATH, xpath)
        criarBt.click()
        sleep(t)
        xpath = '//*[@id="email"]'
        emailFm = self.driver.find_element(By.XPATH, xpath)
        emailFm.send_keys(email)
        sleep(t)
        xpath = '//*[@id="usuario"]'
        usuarioFm = self.driver.find_element(By.XPATH, xpath)
        usuarioFm.send_keys(usuario)
        sleep(t)
        xpath = '//*[@id="senha"]'
        senhaFm = self.driver.find_element(By.XPATH, xpath)
        senhaFm.send_keys(senha)
        sleep(t)
        xpath = '//*[@id="register-form"]/div[4]/input'
        registrarBt = self.driver.find_element(By.XPATH, xpath)
        registrarBt.click()
        sleep(t)

    def logarUsuario(self, usuario, senha):
        self.driver.get('http://localhost/teste/login.php')
        xpath = '//*[@id="usuario"]'
        usuarioFm = self.driver.find_element(By.XPATH, xpath)
        usuarioFm.send_keys(usuario)
        sleep(t)
        xpath = '//*[@id="senha"]'
        senhaFm = self.driver.find_element(By.XPATH, xpath)
        senhaFm.send_keys(senha)
        sleep(t)
        xpath = '/html/body/section/form/div[3]/input'
        logarBt = self.driver.find_element(By.XPATH, xpath)
        logarBt.click()
        sleep(t)

    def alterarDadosUsuario(self):
        xpath = '/html/body/header/nav/ul/li[1]/a'
        dadosPessoaisBt = self.driver.find_element(By.XPATH, xpath)
        dadosPessoaisBt.click()
        sleep(t)
        xpath = '//*[@id="alterarButton"]'
        alterarBt = self.driver.find_element(By.XPATH, xpath)
        alterarBt.click()
        sleep(t)
        xpath = '//*[@id="nome"]'
        nomeFm = self.driver.find_element(By.XPATH, xpath)
        nomeFm.clear()
        nomeFm.send_keys('Fulano')
        sleep(t)
        xpath = '//*[@id="confirmarButton"]'
        confirmarBt = self.driver.find_element(By.XPATH, xpath)
        confirmarBt.click()
        sleep(t)
        xpath = '//*[@id="confirmarButton"]'
        inicioBt = self.driver.find_element(By.XPATH, xpath)
        inicioBt.click()
        sleep(t)

    def alterarSenhaUsuario(self, email, novaSenha):
        self.driver.get('http://localhost/teste/login.php')
        sleep(t)
        xpath = '/html/body/section/form/div[4]/p/a'
        esqueceuSenhaBt = self.driver.find_element(By.XPATH, xpath)
        esqueceuSenhaBt.click()
        sleep(t)
        xpath = '//*[@id="email"]'
        emailFm = self.driver.find_element(By.XPATH, xpath)
        emailFm.send_keys(email)
        sleep(t)
        xpath = '/html/body/section/div/form/div[2]/button'
        confirmarBt = self.driver.find_element(By.XPATH, xpath)
        confirmarBt.click()
        sleep(t)
        xpath = '//*[@id="newPassword"]'
        senhaFm = self.driver.find_element(By.XPATH, xpath)
        senhaFm.send_keys(novaSenha)
        sleep(t)
        xpath = '//*[@id="confirmPassword"]'
        senhaFm = self.driver.find_element(By.XPATH, xpath)
        senhaFm.send_keys(novaSenha)
        sleep(t)
        xpath = '/html/body/section/div/form/div[3]/button'
        confirmarBt = self.driver.find_element(By.XPATH, xpath)
        confirmarBt.click()
        sleep(t)

    def verDadosUsuario(self):
        xpath = '/html/body/header/nav/ul/li[1]/a'
        dadosPessoaisBt = self.driver.find_element(By.XPATH, xpath)
        dadosPessoaisBt.click()
        sleep(t)

    def fazerReserva(self):
        self.driver.get('http://localhost/teste/newindex.php')
        xpath = '/html/body/section[2]/a'
        reserveBt = self.driver.find_element(By.XPATH, xpath)
        reserveBt.click()
        sleep(t)
        xpath = '//*[@id="check-in"]'
        checkinBt = self.driver.find_element(By.XPATH, xpath)
        checkinBt.click()
        checkinBt.send_keys('2023-06-06')
        sleep(t)
        xpath = '//*[@id="check-out"]'
        checkoutBt = self.driver.find_element(By.XPATH, xpath)
        checkoutBt.click()
        checkoutBt.send_keys('2023-06-11')
        sleep(t)
        xpath = '//*[@id="cozinheira-nao"]'
        cozinheiraBt = self.driver.find_element(By.XPATH, xpath)
        cozinheiraBt.click()
        sleep(t)
        xpath = '//*[@id="cafe-da-manha-sim"]'
        cafeBt = self.driver.find_element(By.XPATH, xpath)
        cafeBt.click()
        sleep(t)
        xpath = '/html/body/section/div/form/div[5]/button'
        reservarBt = self.driver.find_element(By.XPATH, xpath)
        reservarBt.click()
        sleep(t)
        xpath = '//*[@id="card"]'
        visaBt = self.driver.find_element(By.XPATH, xpath)
        visaBt.click()
        sleep(t)
        xpath = '//*[@id="cardholder"]'
        nomeFm = self.driver.find_element(By.XPATH, xpath)
        nomeFm.send_keys("Fulano")
        sleep(t)
        xpath = '//*[@id="cardnumber"]'
        cardFm = self.driver.find_element(By.XPATH, xpath)
        cardFm.send_keys('999999')
        sleep(t)
        xpath = '//*[@id="date"]'
        validFm = self.driver.find_element(By.XPATH, xpath)
        validFm.send_keys('02/2025')
        sleep(t)
        xpath = '//*[@id="verification"]'
        cvvFm = self.driver.find_element(By.XPATH, xpath)
        cvvFm.send_keys('999')
        sleep(t)
        xpath = '/html/body/div/div[2]/button[2]'
        nextBt = self.driver.find_element(By.XPATH, xpath)
        nextBt.click()
        sleep(t)
        xpath = '/html/body/section/div/div/div[2]/form[1]/input[2]'
        checkinBt = self.driver.find_element(By.XPATH, xpath)
        checkinBt.click()
        checkinBt.send_keys('2023-06-07')
        sleep(t)
        xpath = '/html/body/section/div/div/div[2]/form[1]/input[3]'
        checkoutBt = self.driver.find_element(By.XPATH, xpath)
        checkoutBt.click()
        checkoutBt.send_keys('2023-06-12')
        sleep(t)
        xpath = '/html/body/section/div/div/div[2]/form[1]/button'
        alterarBt = self.driver.find_element(By.XPATH, xpath)
        alterarBt.click()
        sleep(t)
        xpath = '/html/body/section/div/div/div[2]/form[2]/button'
        cancelarBt = self.driver.find_element(By.XPATH, xpath)
        cancelarBt.click()
        sleep(2)
        self.driver.switch_to.alert.accept()

        sleep(t)
        xpath = '/html/body/header/nav/ul/li[1]/a'
        homeBt = self.driver.find_element(By.XPATH, xpath)
        homeBt.click()
        sleep(t)

    def cadastrarFuncionario(self):
        self.driver.get('http://localhost/teste/admin.php')
        sleep(t)
        xpath = '/html/body/section/div/div/button[1]'
        cadastrarFunc = self.driver.find_element(By.XPATH, xpath)
        cadastrarFunc.click()
        sleep(t)
        nome = 'Ciclano'
        xpath = '//*[@id="nome"]'
        nomeFm = self.driver.find_element(By.XPATH, xpath)
        nomeFm.send_keys(nome)
        sleep(t)
        cpf = '99999999999'
        xpath = '//*[@id="cpf"]'
        cpfFm = self.driver.find_element(By.XPATH, xpath)
        cpfFm.send_keys(cpf)
        sleep(t)
        telefone = '35999999999'
        xpath = '//*[@id="telefone"]'
        telFm = self.driver.find_element(By.XPATH, xpath)
        telFm.send_keys(telefone)
        sleep(t)
        funcao = 'Gerente'
        xpath = '//*[@id="funcao"]'
        funcFm = self.driver.find_element(By.XPATH, xpath)
        funcFm.send_keys(funcao)
        sleep(t)
        salario = '9999'
        xpath = '//*[@id="salario"]'
        salFm = self.driver.find_element(By.XPATH, xpath)
        salFm.send_keys(salario)
        sleep(t)
        xpath = '//*[@id="cadastro-form"]/div[6]/input'
        cadastrarBt = self.driver.find_element(By.XPATH, xpath)
        cadastrarBt.click()
        sleep(t)

    def alterarFuncionario(self):
        xpath = '/html/body/section/div/div/button[3]'
        consultar = self.driver.find_element(By.XPATH, xpath)
        consultar.click()
        sleep(t)
        xpath = '//*[@id="example"]/tbody/tr[1]/td[6]/button[1]'
        alterar = self.driver.find_element(By.XPATH, xpath)
        alterar.click()
        sleep(t)
        xpath = '//*[@id="edit_telefone"]'
        telFm = self.driver.find_element(By.XPATH, xpath)
        telFm.clear()
        telFm.send_keys('35222222222')
        sleep(t)
        xpath = '//*[@id="edit_form"]/form/button'
        salvar = self.driver.find_element(By.XPATH, xpath)
        salvar.click()
        sleep(t)

    def deletarFuncionario(self):
        xpath = '//*[@id="example"]/tbody/tr[1]/td[6]/button[2]'
        remover = self.driver.find_element(By.XPATH, xpath)
        remover.click()
        sleep(t)
        xpath = '//*[@id="remove_form"]/form/button'
        sim = self.driver.find_element(By.XPATH, xpath)
        sim.click()
        sleep(t)
        xpath = '/html/body/header/nav/ul/li/a'
        home = self.driver.find_element(By.XPATH, xpath)
        home.click()
        sleep(t)

    def deletarUsuario(self):
        xpath = '/html/body/section/div/div/button[4]'
        consultarUsuarios = self.driver.find_element(By.XPATH, xpath)
        consultarUsuarios.click()
        sleep(t)
        xpath = '//*[@id="example"]/tbody/tr[1]/td[3]/form/button'
        remover = self.driver.find_element(By.XPATH, xpath)
        remover.click()
        sleep(t)
        xpath = '/html/body/header/nav/ul/li/a'
        home = self.driver.find_element(By.XPATH, xpath)
        home.click()
        sleep(t)

    def consultarGastos(self):
        xpath = '/html/body/section/div/div/button[5]'
        consultarGasto = self.driver.find_element(By.XPATH, xpath)
        consultarGasto.click()
        sleep(t)

    def criarGasto(self):
        xpath = '/html/body/button'
        adicionar = self.driver.find_element(By.XPATH, xpath)
        adicionar.click()
        sleep(t)
        xpath = '//*[@id="create_mes"]'
        mesFm = self.driver.find_element(By.XPATH, xpath)
        mesFm.send_keys('Agosto')
        sleep(t)
        xpath = '//*[@id="create_valor"]'
        valorFm = self.driver.find_element(By.XPATH, xpath)
        valorFm.send_keys('100')
        sleep(t)
        xpath = '//*[@id="create_descricao"]'
        descFm = self.driver.find_element(By.XPATH, xpath)
        descFm.send_keys('Conta de agua')
        sleep(t)        
        xpath = '//*[@id="create_form"]/form/button'
        adicionar = self.driver.find_element(By.XPATH, xpath)
        adicionar.click()
        sleep(t)

    def alterarGasto(self):
        xpath = '//*[@id="example"]/tbody/tr[1]/td[4]/button[1]'
        alterar = self.driver.find_element(By.XPATH, xpath)
        alterar.click()
        sleep(t)
        xpath = '//*[@id="edit_valor"]'
        valor = self.driver.find_element(By.XPATH, xpath)
        valor.clear()
        valor.send_keys('130')
        sleep(t)
        xpath = '//*[@id="edit_form"]/form/button'
        salvar = self.driver.find_element(By.XPATH, xpath)
        salvar.click()
        sleep(t)

    def deletarGasto(self):
        xpath = '//*[@id="example"]/tbody/tr[1]/td[4]/button[2]'
        remover = self.driver.find_element(By.XPATH, xpath)
        remover.click()
        sleep(t)
        xpath = '//*[@id="remove_form"]/form/button'
        sim = self.driver.find_element(By.XPATH, xpath)
        sim.click()
        sleep(t)
        xpath = '/html/body/header/nav/ul/li/a'
        home = self.driver.find_element(By.XPATH, xpath)
        home.click()
        sleep(t)

    def consultarReservas(self):
        xpath = '/html/body/section/div/div/button[2]'
        consultarReservas = self.driver.find_element(By.XPATH, xpath)
        consultarReservas.click()
        sleep(t)

    def alterarReserva(self):
        xpath = '//*[@id="example"]/tbody/tr[1]/td[5]/button[1]'
        alterar = self.driver.find_element(By.XPATH, xpath)
        alterar.click()
        sleep(t)
        xpath = '//*[@id="edit_checkout"]'
        checkout = self.driver.find_element(By.XPATH, xpath)
        checkout.clear()
        checkout.send_keys('2023-07-22')
        sleep(t)
        xpath = '//*[@id="edit_form"]/form/button'
        salvar = self.driver.find_element(By.XPATH, xpath)
        salvar.click()
        sleep(t)

    def removerReserva(self):
        xpath = '//*[@id="example"]/tbody/tr[1]/td[5]/button[2]'
        remover = self.driver.find_element(By.XPATH, xpath)
        remover.click()
        sleep(t)
        xpath = '//*[@id="remove_form"]/form/button'
        sim = self.driver.find_element(By.XPATH, xpath)
        sim.click()
        sleep(5)

        self.driver.quit()
        print("FIM DO TESTE!")





    