# Pagar.me SDK - PHP (Implementação DDD)

Este SDK fornece uma integração estruturada com a API do Pagar.me usando **Domain-Driven Design (DDD)**. Compatível com PHP 7.0+, foi projetado para gerenciar objetos como **Cliente**, **Pedido** e **Cartão**.

## Estrutura do Projeto

- **Application**: Serviços e DTOs para lógica de negócio e transferência de dados.
- **Domain**: Entidades principais, Objetos de Valor e Interfaces de Repositório.
- **Infrastructure**: Repositórios e cliente HTTP para interações com a API.
- **Interfaces**: Controladores HTTP e comandos CLI para interações externas.
- **Support**: Funções auxiliares e classes para tarefas comuns.

## Configuração

1. Clone o repositório:
```bash
   git clone https://github.com/seuusuario/pagarme-php-sdk 
```
2. Instale as dependências (se usando Composer):
```bash
    composer install
```
3. Configure as variáveis de ambiente no .env do projeto:
```bash
PAGARME_BASE_URL=https://api.pagar.me
PAGARME_API_VERSION=core/v5
PAGARME_STORE_ACCESS_TOKEN=seu_token_de_acesso
```
## Uso 

1. Instancie OrderDTO com os dados necessários do pedido.
2. Use OrderService para enviar o pedido ao Pagar.me.
```php
use App\Application\Services\OrderService;
use App\Application\DTO\OrderDTO;

$orderDTO = new OrderDTO($customer, $items, $payments);
$orderService = new OrderService($orderRepository);
$response = $orderService->execute($orderDTO);
```
## Contribuição
Contribuições são bem-vindas! Envie um pull request ou abra uma issue.

## Licença
Este projeto é licenciado sob a Licença MIT.

