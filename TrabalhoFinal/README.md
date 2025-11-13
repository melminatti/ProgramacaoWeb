# MEL - Sistema de Avaliação de Experiência do Cliente

Sistema moderno de avaliação de feedback que permite coletar e analisar a experiência dos clientes de forma eficiente e intuitiva.

## 🌟 Destaques

- Interface moderna com design glassmórfico
- Escala de avaliação interativa de 0 a 10
- Painel administrativo com visualizações estatísticas
- Gerenciamento flexível de setores e perguntas
- Animações suaves e feedback visual
- Design responsivo e acessível

## 🛠️ Tecnologias Utilizadas

- **Backend**: PHP 7.4+
- **Banco de Dados**: PostgreSQL 12+
- **Frontend**: HTML5, CSS3, JavaScript moderno
- **Visualização**: Chart.js
- **Segurança**: PDO, pgcrypto
- **Autenticação**: Sistema próprio com sessões PHP

## 📁 Estrutura do Projeto

```
├── config.php           # Configurações do banco de dados
├── public/             # Interface pública
│   ├── admin.php       # Painel administrativo
│   ├── index.php       # Formulário de avaliação
│   ├── obrigado.php    # Página de confirmação
│   ├── css/          
│   │   ├── style.css   # Estilos do formulário
│   │   └── admin.css   # Estilos do painel admin
│   └── js/
│       └── script.js   # Lógica do cliente
├── sql/
│   └── setup.sql       # Esquema do banco de dados
└── src/                # Lógica de negócio
        ├── auth.php        # Sistema de autenticação
        ├── db.php          # Conexão com banco
        ├── funcoes.php     # Utilitários
        ├── perguntas.php   # Gestão de perguntas
        ├── respostas.php   # Processamento de respostas
        └── submit.php      # Submissão de formulários
```

## ⚙️ Requisitos

- PHP 7.4 ou superior
- PostgreSQL 12 ou superior
- Extensões PHP: PDO, pdo_pgsql
- Servidor web (Apache/Nginx) ou servidor embutido PHP

## 🚀 Instalação

1. Clone o repositório
```bash
git clone https://github.com/PirataZang/MEL.git
cd MEL
```

2. Configure o banco de dados
```bash
psql -U postgres
CREATE DATABASE trabalho_final;
\c trabalho_final
\i sql/setup.sql
```

3. Configure o ambiente
- Ajuste as credenciais do banco em `config.php`:
```php
define('DB_HOST', 'localhost');
define('DB_NAME', 'trabalho_final');
define('DB_USER', 'seu_usuario');
define('DB_PASS', 'sua_senha');
```

## 🖥️ Execução

### Servidor de Desenvolvimento
```bash
php -S localhost:8080 -t public
```
Acesse: http://localhost:8080

### Servidor Web (Apache/Nginx)
1. Configure o DocumentRoot para a pasta `public/`
2. Ajuste permissões e variáveis de ambiente

## 🎯 Funcionalidades

### Sistema de Avaliação
- Escala interativa de 0-10 com feedback visual
- Transições suaves entre perguntas
- Barra de progresso animada
- Campo de feedback textual opcional
- Confirmação visual de envio

### Painel Administrativo
- Dashboard com visualizações em tempo real
- Gráficos estatísticos por setor
- Gestão de perguntas e setores
- Visualização detalhada de feedbacks

### Segurança
- Proteção contra XSS e SQL Injection (uso de PDO e sanitização)
- Senhas criptografadas com pgcrypto
- Validação de dados de entrada
- Sanitização de outputs
- Controle de sessão seguro

## 👥 Acesso Administrativo
- **URL**: `/admin.php`
- **Usuário**: admin
- **Senha**: 1234

## 🗃️ Banco de Dados

### Tabelas Principais
- `setores`: Departamentos/áreas avaliadas
- `perguntas`: Questões de avaliação
- `avaliacoes`: Registros de feedback
- `dispositivos`: Pontos de coleta
- `usuarios`: Administradores do sistema

## 📚 Documentação das funções (API)

Esta seção descreve as funções PHP disponíveis em `src/` para facilitar manutenção e contribuições.

1) src/funcoes.php — utilitários e CRUD de setores

- sanitize_text(string $text): string
    - O que faz: remove espaços nas extremidades e escapa caracteres HTML.
    - Uso: proteger saídas para evitar XSS.
    - Retorno: string sanitizada.

- sanitize_int(mixed $v, int $default = 0): int
    - O que faz: valida e converte um valor para inteiro, retorna $default se inválido.
    - Uso: sanitizar IDs vindos de GET/POST.

- getSetores(): array
    - O que faz: retorna todos os setores da tabela `setores` ordenados por nome.
    - Retorno: array de arrays associativos: ['id'=>'', 'nome'=>''].

- addSetor(string $nome): bool
    - O que faz: insere um novo setor.
    - Retorno: boolean (true em sucesso, false em falha).
    - Observação: não faz validação de unicidade; o banco pode impor restrições se desejar.

- updateSetor(int $id, string $nome): bool
    - O que faz: atualiza o nome do setor identificado por $id.
    - Retorno: boolean.

- deleteSetor(int $id): bool
    - O que faz: remove um setor por id.
    - Retorno: boolean.
    - Observação: se existirem FKs referenciando o setor (ex.: `avaliacoes`), a operação pode falhar — tratar essa condição no controller.

- getSetor(int $id): array|false
    - O que faz: retorna o setor solicitado ou false se não existir.

2) src/perguntas.php — CRUD de perguntas

- getQuestionsActives(): array
    - O que faz: retorna as perguntas com `ativa = TRUE` (id e texto) ordenadas por id.

- getAllQuestions(): array
    - O que faz: retorna todas as perguntas (para admin).

- addQuestion(string $texto, bool $ativa = true): void
    - O que faz: insere uma nova pergunta. Não retorna valor (executa INSERT).

- getQuestion(int $id): array|false
    - O que faz: busca uma pergunta por id.

- updateQuestion(int $id, string $texto, bool $ativa): void
    - O que faz: atualiza os campos `texto` e `ativa`.

- deleteQuestion(int $id): void
    - O que faz: remove a pergunta do banco.
    - Observação: se houver dependências (ex.: avaliações referenciando perguntas), a exclusão pode falhar por restrição de integridade.

3) src/respostas.php — gravação e consulta de avaliações

- saveFeedback(int $setor_id, int $dispositivo_id, array $respostas, ?string $feedback): void
    - O que faz: salva um conjunto de respostas (uma linha por pergunta) dentro de uma transação.
    - Parâmetros:
        - $setor_id: id do setor avaliado
        - $dispositivo_id: id do dispositivo / ponto de coleta
        - $respostas: array associativo [pergunta_id => valor (0-10)]
        - $feedback: texto opcional
    - Erros: lança Exception se algum valor estiver fora do intervalo [0,10] ou se ocorrer falha na inserção.
    - Observação: executa múltiplos INSERTs dentro de uma transação; em caso de falha, faz rollback.

- getScores(?int $setor_id = null): array
    - O que faz: retorna média e total de respostas por pergunta; se $setor_id informado, filtra por setor.
    - Retorno: array de itens com ['id','texto','media','total'].

- getFeedbackBySetor(int $setor_id): array
    - O que faz: retorna todas as linhas da tabela `avaliacoes` filtradas por setor (ordem desc por data_hora).

4) src/auth.php — autenticação

- login(string $usuario, string $senha): bool
    - O que faz: valida as credenciais comparando com senha criptografada no banco (pgcrypto/crypt).
    - Retorno: true em sucesso; false em falha.
    - Efeito colateral: em sucesso popula $_SESSION['admin_logged'] e $_SESSION['admin_user'].

- require_login(): void
    - O que faz: redireciona para `/public/admin.php` caso não haja sessão válida.

- logout(): void
    - O que faz: limpa a sessão e faz logout.

5) src/db.php — conexão com banco

- Arquivo responsável por criar a variável global $pdo (PDO) a partir de `config.php`.
- DSN usado: `pgsql:host=<DB_HOST>;port=5432;dbname=<DB_NAME>`
- Em caso de falha de conexão o script termina com mensagem de erro.

6) src/submit.php — fluxo de submissão do formulário público

- Expectativa de campos POST:
    - `setor_id` (int) — id do setor selecionado
    - `dispositivo_id` (int) — id do dispositivo (padrão 1 se apenas um)
    - `respostas` (array) — campo em formato nomes `respostas[<pergunta_id>] = <valor>`
    - `feedback` (string, opcional)

- Lógica principal:
    - Valida presença de setor, dispositivo e respostas
    - Sanitiza o `feedback` com `sanitize_text`
    - Converte respostas para inteiros e chama `saveFeedback`

## ✅ Boas práticas e casos de borda

- Validação extra no servidor: embora o frontend force seleção/valores, o servidor valida intervalo (0-10) e tipos.
- Exclusões: atenção às restrições do banco (FK). Se quiser impedir exclusões quando existirem avaliações vinculadas, valide e retorne mensagem amigável no controller.
- Sanitização: use `sanitize_text` sempre que exibir texto fornecido pelo usuário.

## 🤝 Contribuindo

1. Fork o projeto
2. Crie uma branch (`git checkout -b feature/nova-funcionalidade`)
3. Commit suas alterações (`git commit -m 'Adiciona nova funcionalidade'`)
4. Push para a branch (`git push origin feature/nova-funcionalidade`)
5. Abra um Pull Request

## 📝 Licença

Este projeto está sob a licença MIT. Veja o arquivo [LICENSE](LICENSE) para mais detalhes.