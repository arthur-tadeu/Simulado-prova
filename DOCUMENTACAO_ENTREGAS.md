# ENTREGA 01 – Requisitos Funcionais

1.  **RF01 - Autenticação:** O sistema deve permitir que usuários se autentiquem via login e senha.
2.  **RF02 - Gerenciamento de Produtos:** O sistema deve permitir o cadastro, edição, exclusão e visualização de produtos.
3.  **RF03 - Busca de Produtos:** O sistema deve permitir a filtragem de produtos por nome ou especificações.
4.  **RF04 - Gestão de Estoque:** O sistema deve permitir o registro de entradas e saídas de materiais.
5.  **RF05 - Rastreabilidade:** O sistema deve registrar a data e o usuário responsável por cada movimentação de estoque.
6.  **RF06 - Alerta de Estoque Mínimo:** O sistema deve emitir um alerta visual automático sempre que o estoque de um produto ficar abaixo do valor mínimo configurado.

---

# ENTREGA 08 – Casos de Teste

## 8.1 - Casos de Teste
| ID | Caso de Teste | Procedimento | Resultado Esperado |
|:---|:---|:---|:---|
| 01 | Login com sucesso | Inserir usuário e senha corretos e clicar em entrar. | Redirecionamento para a tela principal com o nome do usuário visível. |
| 02 | Cadastro de Produto | Preencher nome, specs e estoque mínimo e salvar. | Produto aparecer na listagem automaticamente. |
| 03 | Busca de Produto | Digitar parte do nome de um produto no campo de busca. | A tabela deve atualizar mostrando apenas os produtos correspondentes. |
| 04 | Alerta de Estoque | Realizar uma saída que deixe o estoque abaixo do mínimo. | O sistema deve exibir uma mensagem de alerta (div vermelha) na tela. |
| 05 | Exclusão com Vínculo | Tentar excluir um produto que possui movimentações. | O sistema deve excluir as movimentações vinculadas e depois o produto (integridade). |

## 8.2 - Ferramentas e Ambientes de Teste
- **Navegador:** Google Chrome / Microsoft Edge.
- **Ambiente:** Servidor Local Apache (XAMPP).
- **Banco de Dados:** MySQL/MariaDB.
- **Ferramentas:** phpMyAdmin para inspeção direta do banco.

---

# ENTREGA 09 – Lista de Requisitos de Infraestrutura

1.  **SGBD:** MySQL (Versão 8.0 ou compatível via MariaDB 10.4).
2.  **Linguagem de Programação:** PHP (Versão 8.2.x).
3.  **Sistema Operacional:** Windows 10/11 (Ambiente de desenvolvimento).
4.  **Servidor Web:** Apache 2.4 (via XAMPP).
