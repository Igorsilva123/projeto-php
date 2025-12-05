Projeto Sistema de Reserva de Assentos
Descrição Geral

Este projeto é um sistema de reservas de assentos para sessões de eventos, cinema ou teatro.
O sistema possui dois tipos de usuários: usuário comum e administrador.
O front-end foi desenvolvido com HTML e CSS.

Principais funcionalidades:

Usuário comum: visualizar sessões e assentos disponíveis, reservar assentos.

Administrador: gerenciar usuários (excluir/atualizar), garantindo que a exclusão de um usuário também libere o assento reservado por ele.

Estrutura do Banco de Dados

O projeto utiliza o banco MySQL com as seguintes tabelas:

1. users

Armazena os usuários comuns do sistema.

Campo	Tipo	Observações
id	int	PK, auto-increment
name	varchar	Nome do usuário
email	varchar	Único, usado para login
password	varchar	Senha criptografada
token	varchar	Opcional, para autenticação
2. usersadmin

Armazena os administradores do sistema.

Campo	Tipo	Observações
id	int	PK, auto-increment
name	varchar	Nome do administrador
email	varchar	Único, usado para login
password	varchar	Senha criptografada

Observação: Apenas administradores podem excluir usuários ou atualizar seus dados. Ao excluir, os assentos reservados por esse usuário são liberados.

3. sessions

Armazena as sessões disponíveis para reserva.

Campo	Tipo	Observações
id	int	PK, auto-increment
start_time	datetime	Início da sessão
end_time	datetime	Fim da sessão
4. seats

Armazena os assentos de cada sessão.

Campo	Tipo	Observações
id	int	PK, auto-increment
session_id	int	FK → sessions(id)
codigo	varchar	Código do assento (ex: A1)
status	enum	'livre' ou 'ocupado'
5. reservations

Armazena as reservas realizadas pelos usuários.

Campo	Tipo	Observações
id	int	PK, auto-increment
user_id	int	FK → users(id)
seat_id	int	FK → seats(id)
session_id	int	FK → sessions(id)
data_reserva	datetime	Data/hora da reserva
Relações entre Tabelas

Como Importar o Banco de Dados

Crie o banco de dados no MySQL:

CREATE DATABASE projeto;
USE projeto;


Importe os dumps SQL das tabelas na seguinte ordem:

sessions.sql

seats.sql

users.sql

usersadmin.sql

reservations.sql

Dica: Certifique-se de que as tabelas sejam importadas nessa ordem para respeitar as chaves estrangeiras.

Observações

A gereção de assentos e de admin deve ser feita pelo banco de dados.

O front-end é feito com HTML e CSS.

Apenas administradores podem excluir ou atualizar usuários.

Ao excluir um usuário, todos os assentos reservados por ele são automaticamente liberados (status volta para 'livre').

Senhas estão armazenadas de forma segura (hash bcrypt no exemplo do admin).
