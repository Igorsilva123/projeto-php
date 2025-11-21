Projeto PHP + MySQL

Este projeto é um sistema simples e funcional para seleção e reserva de cadeiras em um evento, semelhante ao layout de cinemas, teatros e auditórios.
O usuário pode visualizar as cadeiras disponíveis, escolher seu lugar e finalizar a reserva.

Funcionalidades

Exibição do mapa de cadeiras

Identificação de cadeiras ocupadas e disponíveis

Cadastro de usuários

Login e autenticação

Reserva de lugares

Painel do usuário com suas reservas

Painel administrativo

Tecnologias Utilizadas
Backend

PHP 7+

MySQL

MySQLi

Frontend

HTML5, CSS3, JavaScript


Tabela users
Campo	Tipo	Descrição
id	INT PK AI	ID do usuário
name	VARCHAR(100)	Nome do usuário
email	VARCHAR(120) UNIQUE	Email do usuário
password	VARCHAR(255)	Senha criptografada


Tabela seats
Campo	Tipo	Descrição
id	INT PK AI	ID da cadeira
seat_code	VARCHAR(10)	Ex.: A01, B15
is_taken	TINYINT(1)	0 = livre, 1 = ocupada


Tabela reservations
Campo	Tipo	Descrição
id	INT PK AI	ID da reserva
user_id	INT	Relacionado ao usuário
seat_id	INT	Relacionado à cadeira
reserved_at	TIMESTAMP	Data da reserva
