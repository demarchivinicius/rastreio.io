<?php
$TOKEN = "SEU_TOKEN_DO_TELEGRAM";
$API_URL = "https://api.telegram.org/bot$TOKEN/";

// Obtém as mensagens do bot
$updates = file_get_contents($API_URL . "getUpdates");
$dados = json_decode($updates, true);

// Verifica se há mensagens
if (isset($dados["result"]) && !empty($dados["result"])) {
    foreach ($dados["result"] as $mensagem) {
        if (isset($mensagem["message"])) {
            $chat_id = $mensagem["message"]["chat"]["id"];
            $texto = isset($mensagem["message"]["text"]) ? strtoupper(trim($mensagem["message"]["text"])) : "";

            // Verifica se o código enviado é um código de rastreamento válido
            if (preg_match('/^[A-Z]{2}[0-9]{9}[A-Z]{2}$/', $texto)) {
                $resposta = "📦 Seu código de rastreio *$texto* está em trânsito!";
            } else {
                $resposta = "❌ Envie um código de rastreio válido dos Correios, como 'AA123456789BR'.";
            }

            // Envia a mensagem de volta para o Telegram
            file_get_contents($API_URL . "sendMessage?chat_id=$chat_id&text=" . urlencode($resposta) . "&parse_mode=Markdown");
        }
    }
} else {
    echo "Nenhuma mensagem encontrada.";
}
?>
