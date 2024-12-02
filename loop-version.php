<?php
// Configurações básicas
$c55_domain = "https://www.colab55.com/";
$data_load = "@isabelaleao"; // Nome do estúdio
$data_types = [
    "stickers", "tiles", "posters", "notebooks", "wrapping-papers",
    "t-shirts", "fullprint-tshirts", "buttons", "tote-bags",
    "phone-cases", "pillows", "rectangular-pillows", "socks",
    "towels", "mugs", "wallpapers", "flip-flops", "caps",
    "magnets", "greeting-cards", "baby-bodies", "leggings",
    "hoodies", "aprons"
]; // Lista de data-types

$all_products = []; // Armazena todos os produtos encontrados

foreach ($data_types as $data_type) {
    // Construir a URL para o data-type atual
    $url = $c55_domain . $data_load . "/embed/" . $data_type;

    // Inicializar cURL
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        "X-Requested-With: XMLHttpRequest",
        "User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36"
    ]);

    // Executar a requisição e capturar a resposta
    $response = curl_exec($ch);

    // Verificar erros
    if (curl_errno($ch)) {
        echo "Erro na requisição para $data_type: " . curl_error($ch) . "\n";
        curl_close($ch);
        continue;
    }

    // Fechar cURL
    curl_close($ch);

    // Processar o HTML retornado
    if ($response) {
        $dom = new DOMDocument();
        libxml_use_internal_errors(true); // Ignorar erros de parsing
        $dom->loadHTML($response);
        libxml_clear_errors();

        $xpath = new DOMXPath($dom);

        // Seletores XPath para links, imagens e preços
        $product_links = $xpath->query("//a[contains(@class, 'c55-art-products-link')]");
        $product_images = $xpath->query("//a[contains(@class, 'c55-art-products-link')]/img");
        $product_prices = $xpath->query("//a[contains(@class, 'c55-art-products-link')]/span[contains(@class, 'c55-product-price')]");

        $products = [];
        foreach ($product_links as $index => $link) {
            $image = $product_images->item($index);
            $price = $product_prices->item($index);

            if ($link instanceof DOMElement && $image instanceof DOMElement && $price) {
                $products[] = [
                    "type" => $data_type,
                    "link" => $link->getAttribute("href"),
                    "image" => $image->getAttribute("src"),
                    "price" => trim($price->nodeValue)
                ];
            }
        }

        // Adicionar os produtos encontrados para este data-type
        if (!empty($products)) {
            $all_products = array_merge($all_products, $products);
        }
    }
}

// Retornar todos os produtos como JSON
header("Content-Type: application/json");
echo json_encode($all_products, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
?>
