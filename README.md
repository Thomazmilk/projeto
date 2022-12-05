<h1 align="center"> Teste Interno Brudam </h1>


Esse projeto tem como objetivo consumir dados de uma API e exibi-los. 



# 📁 Acesso ao projeto
Navegue até o repositório do [GitHub] (https://github.com/Thomazmilk/projeto) e clone o projeto em um diretório local.


# 🛠️ Abrir e rodar o projeto
Para executar o projeto, é necessário ter instalado software que integre o código PHP e o banco de dados, para rodar o sistema foi utilizado o XAMPP.

No mysql workbench realizar a criação das tabelas com os seguintes comandos.


**CRIAR TABELA PARA CONSUMIR AS INFORMAÇÕES DAS MINUTAS.** 
```
create table minuta (
id_minuta int not null primary key,
coleta int,
origem varchar(70),
destino varchar(70),
volume int,
cte varchar(32),
peso float,
tipo int,
status varchar(20),
frete decimal(10,1),
data_emissao timestamp not null,
id_coleta int,
foreign key (id_coleta) references coleta (id_coleta)
 );
```

**CRIAR TABELA PARA CONSUMIR AS INFORMAÇÕES DAS COLETAS.** 
```
create table coleta (
id_coleta int not null primary key,
origem varchar(70),              
destino varchar(70),               
volume int,              
peso float,             
tipo int,              
status varchar (10),              
frete decimal(10,1),              
data_emissao timestamp not null
);
```

**CRIAR TABELA PARA INSERIR O TOKEN (COMPLETA URL DA API).** 
```
create table token (
id_token int not null auto_increment primary key,
token varchar(33) not null
);
```




# Testando Funcionalidade 

**Tela INDEX**

A tela inicial mostra um menu com as opções para acessar a página de cadastro do Token ou entrar no relatório.


**Tela TOKEN** 

O usuário deve acrescentar a palavra–chave que completa URL da API e apertar no botão CADASTRAR. 

A palavra-chave será gravada na tabela “token” coluna “token” no bando de dados. 

PALAVRA–CHAVE: ce019046e010bf7f1aab029cc688c9fd


**Tela RELATÓRIO**

Funcionalidades dos botões: 

IMPORTAR API: O sistema lê os dados da URL se o ultimo cadastro da tabela “token” coluna “token”  for a palavra – chave válida, após deve gravar as informações da API no banco de dados. 

Caso o sistema não consiga reconhecer a URL deve imprimir em tela "ERRO: Token inválido" ao final da página.

PESQUISAR: O sistema consulta e imprime em tela todas as colunas das tabelas minuta e coleta, filtrando por data caso os dois filtros contenham valor. 

Ao final da página tem um link VOLTAR que direciona para o Menu inicial.
