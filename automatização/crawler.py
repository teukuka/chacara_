import shutil
from selenium.webdriver import Firefox
from selenium.webdriver.firefox.options import Options
from selenium import webdriver
from selenium.webdriver.common.by import By
from selenium.webdriver.support.ui import WebDriverWait
from selenium.webdriver.support import expected_conditions as EC
from time import sleep


class Crawler:

    def __init__(self) -> None:
        profile = webdriver.FirefoxProfile()
        profile.set_preference("javascript.enabled", True)
        self.driver = webdriver.Firefox(profile)
        self.url_home = "http://localhost/chacara/"
        

    def cadastro(self, email, usuario, senha):

        self.driver.get(self.url_home)

        registrar = self.driver.find_element(By.XPATH, "/html/body/header/nav/ul/li[1]/a")
        sleep(2)
        registrar.click()

        sleep(2)
        emailForm = self.driver.find_element(By.XPATH, '//*[@id="email"]')
        emailForm.send_keys(email)

        sleep(2)
        usuarioForm = self.driver.find_element(By.XPATH, '//*[@id="usuario"]')
        usuarioForm.send_keys(usuario)

        sleep(2)
        senhaForm = self.driver.find_element(By.XPATH, '//*[@id="senha"]')
        senhaForm.send_keys(senha)

        sleep(2)
        registrarBotao = self.driver.find_element(By.XPATH, '/html/body/section/form/div[4]/input')
        registrarBotao.click()

    def login(self, email, senha):
        
        sleep(2)
        emailForm = self.driver.find_element(By.XPATH, '//*[@id="usuario"]')
        emailForm.send_keys(email)

        sleep(2)
        senhaForm = self.driver.find_element(By.XPATH, '//*[@id="senha"]')
        senhaForm.send_keys(senha)
        
        sleep(2)
        logarBotao = self.driver.find_element(By.XPATH, '/html/body/section/form/div[3]/input')
        logarBotao.click()

    def alterarSenha(self, email, senhaOld, senhaNew):

        sleep(2)
        self.driver.get("http://localhost/chacara/index.php")
        
        sleep(2)
        login = self.driver.find_element(By.XPATH, '/html/body/header/nav/ul/li[2]/a')
        login.click()

        sleep(2)
        alterarSenhaBotao = self.driver.find_element(By.XPATH, '/html/body/section/form/div[4]/p/a')
        alterarSenhaBotao.click()

        sleep(2)
        emailForm = self.driver.find_element(By.XPATH, '//*[@id="email"]')
        emailForm.send_keys(email)

        sleep(2)
        confirmaBotao = self.driver.find_element(By.XPATH, '/html/body/section/div/form/div[2]/button')
        confirmaBotao.click()

        sleep(2)
        novaSenhaForm = self.driver.find_element(By.XPATH, '//*[@id="newPassword"]')
        novaSenhaForm.send_keys(senhaNew)

        sleep(2)
        confirmaSenhaForm = self.driver.find_element(By.XPATH, '//*[@id="confirmPassword"]')
        confirmaSenhaForm.send_keys(senhaNew)

        sleep(2)
        confirmaBotao = self.driver.find_element(By.XPATH, '/html/body/section/div/form/div[3]/button')
        confirmaBotao.click()

    def excluirConta(self):

        sleep(2)
        self.driver.get('http://localhost/chacara/admin.php')

        sleep(2)
        contas = self.driver.find_element(By.XPATH, '/html/body/section/div/div/button[4]')
        contas.click()

        sleep(2)
        remover = self.driver.find_element(By.XPATH, '/html/body/div/div[2]/div/table/tbody/tr/td[3]/form/button')
        remover.click()

    def cadastrarFuncionario(self):

        sleep(2)
        self.driver.get('http://localhost/chacara/admin.php')

        sleep(2)
        cadastrar = self.driver.find_element(By.XPATH, '/html/body/section/div/div/button[1]')
        cadastrar.click()

        nome = "Gabriel"
        cpf = "99999999999"
        telefone = "35999999999"
        funcao = "gerente"
        salario = "2500"

        sleep(2)
        nomeForm = self.driver.find_element(By.XPATH, '//*[@id="nome"]')
        nomeForm.send_keys(nome)
        sleep(2)
        cpfForm = self.driver.find_element(By.XPATH, '//*[@id="cpf"]')
        cpfForm.send_keys(cpf)
        sleep(2)
        telefoneForm = self.driver.find_element(By.XPATH, '//*[@id="telefone"]')
        telefoneForm.send_keys(telefone)
        sleep(2)
        funcaoForm = self.driver.find_element(By.XPATH, '//*[@id="funcao"]')
        funcaoForm.send_keys(funcao)
        sleep(2)
        salarioForm = self.driver.find_element(By.XPATH, '//*[@id="salario"]')
        salarioForm.send_keys(salario)

        sleep(2)
        cadastrarBotao = self.driver.find_element(By.XPATH, '/html/body/section/div/form/div[6]/input')
        cadastrarBotao.click()


    def alterarFuncionario(self):

        sleep(2)
        consultar = self.driver.find_element(By.XPATH, '/html/body/section/div/div/button[3]')
        consultar.click()

        sleep(2)
        alterar = self.driver.find_element(By.XPATH, '/html/body/div[1]/div[2]/div/table/tbody/tr[1]/td[6]/button[1]')
        alterar.click()

        sleep(2)
        nomeForm = self.driver.find_element(By.XPATH, '//*[@id="edit_nome"]')
        nomeForm.clear()
        nomeForm.send_keys('Pablo')

        sleep(2)
        salvar = self.driver.find_element(By.XPATH, '/html/body/div[2]/form/button')
        salvar.click()

        sleep(2)
        remover = self.driver.find_element(By.XPATH, '/html/body/div[1]/div[2]/div/table/tbody/tr[1]/td[6]/button[2]')
        remover.click()

        sleep(2)
        confirmar = self.driver.find_element(By.XPATH, '/html/body/div[3]/form/button')
        confirmar.click()