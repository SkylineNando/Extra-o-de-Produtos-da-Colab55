## Extração de Produtos da Colab55

Este projeto contém dois scripts PHP que capturam informações de produtos exibidos dinamicamente na Colab55. Os scripts fazem requisições HTTP para URLs específicas, processam o HTML retornado e extraem os links, imagens e preços dos produtos, retornando os dados em formato JSON.

---

## **Finalidade**

O projeto permite:
- Automatizar a extração de informações de produtos.
- Criar interfaces dinâmicas para exibição de produtos.
- Facilitar a integração com outras aplicações ou plataformas.

---

## **Como Funciona**

### **Versão 1 (`index.php`)**

Este script consulta uma única categoria (`data-type`) de produtos da Colab55. Ele:
1. Realiza uma requisição HTTP para o URL de uma categoria específica.
2. Processa o HTML retornado com DOMDocument e XPath.
3. Extrai os links, imagens e preços dos produtos.
4. Retorna os dados em JSON.

### **Versão 2 (`loop-version.php`)**

Este script é uma extensão da versão 1. Ele realiza uma varredura em todas as categorias (`data-types`) suportadas pela Colab55:
1. Itera por todas as categorias conhecidas.
2. Realiza requisições separadas para cada categoria.
3. Extrai e agrupa os dados retornados em um único JSON.

---

## **Exemplo de Retorno JSON**

### **Versão 1 (`index.php`):**

Retorno para uma categoria específica (ex.: `towels`):
```json
[
    {
        "link": "https://www.colab55.com/@isabelaleao/towels/amor-que-tenho-por-voce",
        "image": "https://cdn.colab55.com/images/55002/studio/198786/art/421047/towels.png",
        "price": "51,90"
    }
]
```

---

### **Versão 2 (`loop-version.php`):**

Retorno agrupado para todas as categorias que possuem produtos:
```json
[
    {
        "type": "towels",
        "link": "https://www.colab55.com/@isabelaleao/towels/amor-que-tenho-por-voce",
        "image": "https://cdn.colab55.com/images/55002/studio/198786/art/421047/towels.png",
        "price": "51,90"
    },
    {
        "type": "stickers",
        "link": "https://www.colab55.com/@isabelaleao/stickers/adesivo-personalizado",
        "image": "https://cdn.colab55.com/images/55002/studio/198786/art/421058/stickers.png",
        "price": "15,90"
    }
]
```

---

## **Como Usar**

### Requisitos
- PHP 7.0 ou superior.
- Extensão **cURL** habilitada.

---

### **Passo a Passo**

1. Clone o repositório no seu servidor:
   ```bash
   git clone https://github.com/skylinenando/colab55-extractor.git
   ```

2. Escolha o script a ser usado:
   - Para extrair dados de uma única categoria, use `index.php`.
   - Para varrer todas as categorias, use `loop-version.php`.

3. Configure as variáveis:
   No arquivo selecionado, substitua o nome do estúdio na variável `$data_load`:
   ```php
   $data_load = "@isabelaleao"; // Substitua pelo nome do estúdio
   ```

4. Execute o script em um servidor PHP. Acesse pelo navegador ou ferramenta como Postman:
   ```
   http://seusite.com/index.php          # Para a primeira versão
   http://seusite.com/loop-version.php  # Para a versão com loop
   ```

5. Visualize o JSON retornado com as informações extraídas.

---

## **Pontos Importantes**

1. **Categorias Sem Produtos**:
   - Na versão com loop, categorias que não possuem produtos são ignoradas no resultado final.

2. **Limitações do Endpoint**:
   - A estrutura da Colab55 pode mudar, exigindo ajustes no script.

3. **Uso Responsável**:
   - Utilize os scripts apenas para fins permitidos e de acordo com os Termos de Uso da Colab55.

---

## Estrutura do Projeto

```plaintext
colab55-extractor/
├── README.md            # Documentação completa do projeto
├── index.php            # Código principal - Versão 1 (sem loop de categorias)
├── loop-version.php     # Código principal - Versão 2 (com loop para varredura de categorias)
└── .gitignore           # Arquivos ignorados pelo Git
```

## **Contribuição**

Deseja contribuir? Faça um **fork**, crie uma nova branch com as suas alterações e envie um **pull request**.

---

## **Contato**

Desenvolvido por [Fernando Bueno](https://github.com/skylinenando). Para dúvidas ou sugestões, entre em contato.

---

Pronto! Agora a documentação está detalhada para incluir as duas versões do script, com instruções claras e uma estrutura bem definida para o repositório no GitHub. 😊
