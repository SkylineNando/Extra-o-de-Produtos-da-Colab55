# Extração de Produtos da Colab55

Este projeto é um script PHP para capturar informações de produtos exibidos dinamicamente na Colab55. O script faz uma requisição para um URL específico, processa o HTML retornado e extrai os links, imagens e preços dos produtos, retornando os dados em formato JSON.

## Finalidade

A finalidade deste script é automatizar a extração de informações de produtos da Colab55 para facilitar a integração com outras aplicações ou plataformas. O código pode ser usado para criar interfaces dinâmicas, exibir produtos em sites personalizados ou realizar análises de dados.

---

## Como Funciona

### 1. **Requisição HTTP**
O script utiliza a biblioteca **cURL** para realizar uma requisição HTTP para o URL da Colab55, que é construído dinamicamente com base em:
- **Usuário (Studio)**: O nome do estúdio ou criador.
- **Tipo de Produto**: Categoria de produtos a ser exibida (ex.: `towels`).

### 2. **Processamento do HTML**
O HTML retornado pela requisição é processado usando a biblioteca **DOMDocument** e **DOMXPath** para localizar os elementos HTML que contêm as informações desejadas (links, imagens e preços).

### 3. **Extração de Dados**
Os dados extraídos são organizados em um array PHP e convertidos para JSON usando `json_encode`.

---

## Detalhes do Código

### Configuração Básica
Definimos variáveis para construir o URL de requisição:
```php
$c55_domain = "https://www.colab55.com/";
$data_load = "@isabelaleao"; // Nome do estúdio
$data_type = "towels"; // Tipo de produto
$preview = false; // Exibir modo de preview (opcional)
```

### Requisição cURL
O **cURL** é configurado para:
1. Realizar a requisição para o URL.
2. Simular um navegador moderno com o cabeçalho `User-Agent`.
3. Garantir que o script seja reconhecido como uma requisição AJAX com o cabeçalho `X-Requested-With`.

### Processamento do HTML
O HTML retornado é carregado no **DOMDocument**, e utilizamos **XPath** para localizar:
- **Links dos Produtos**: Selecionados pela classe `c55-art-products-link`.
- **Imagens**: Selecionadas como `<img>` dentro dos links.
- **Preços**: Selecionados como `<span>` com a classe `c55-product-price`.

### Retorno JSON
Os dados extraídos são organizados em um array associativo e retornados em formato JSON, com barras normais (`/`) preservadas:
```php
echo json_encode($products, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
```

---

## Exemplo de Retorno JSON

Aqui está um exemplo de JSON retornado pelo script:

```json
[
    {
        "link": "https://www.colab55.com/@isabelaleao/towels/amor-que-tenho-por-voce",
        "image": "https://cdn.colab55.com/images/55002/studio/198786/art/421047/towels.png",
        "price": "51,90"
    },
    {
        "link": "https://www.colab55.com/@isabelaleao/towels/amor-que-sempre-sonhei",
        "image": "https://cdn.colab55.com/images/55002/studio/198786/art/421057/towels.png",
        "price": "51,90"
    }
]
```

---

## Como Usar

### Requisitos
- Servidor com suporte a PHP 7+.
- Biblioteca **cURL** habilitada no PHP.

### Passo a Passo

1. Clone este repositório no seu servidor:
   ```bash
   git clone https://github.com/skylinenando/colab55-extractor.git
   ```

2. Abra o arquivo PHP e substitua as variáveis `$data_load` e `$data_type` pelos valores desejados:
   ```php
   $data_load = "@isabelaleao"; // Substitua pelo nome do estúdio
   $data_type = "towels"; // Substitua pelo tipo de produto
   ```

3. Execute o script em um servidor PHP. O JSON retornado pode ser acessado via navegador ou ferramentas como Postman.

---

## Estrutura do Projeto

```plaintext
colab55-extractor/
├── README.md       # Documentação
├── index.php       # Código principal
└── .gitignore      # Arquivos ignorados pelo Git
```

---

## Pontos Importantes

1. **Limitações do Endpoint**:
   - A Colab55 pode atualizar a estrutura de suas páginas ou endpoints, exigindo ajustes no script.

2. **Restrições de Acesso**:
   - Este script depende do retorno correto do HTML pela Colab55. Certifique-se de que os dados desejados estejam disponíveis na URL configurada.

3. **Uso Ético**:
   - Utilize este script apenas para fins legais e dentro dos Termos de Uso da Colab55.

---

## Contribuição

Se você deseja contribuir, faça um **fork** do repositório, crie uma nova branch com suas alterações e envie um **pull request**.

---

## Contato

Desenvolvido por [Fernando Bueno](https://github.com/skylinenando). Caso tenha dúvidas ou sugestões, fique à vontade para entrar em contato!

--- 

Essa documentação pode ser salva como `README.md` e adicionada ao seu repositório no GitHub. Se precisar de mais ajustes, é só pedir! 😊
