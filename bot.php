<?php
$TOKEN = "";
$API_URL = "https://api.telegram.org/bot$TOKEN/";


// Obtém as mensagens mais recentes
$updates = file_get_contents($API_URL . "getUpdates");
$dados = json_decode($updates, true);

// Verifica se há mensagens e pega apenas a última
if (isset($dados["result"]) && !empty($dados["result"])) {
    $ultimaMensagem = end($dados["result"]); // Pega a última mensagem recebida

    if (isset($ultimaMensagem["message"])) {
        $chat_id = $ultimaMensagem["message"]["chat"]["id"];
        $texto = strtoupper(trim($ultimaMensagem["message"]["text"]));

        // Verifica se o texto é um código de rastreamento válido
        if (preg_match('/^[A-Z]{2}[0-9]{9}[A-Z]{2}$/', $texto)) {
            $status = rastrearObjeto($texto);
            enviarMensagem($chat_id, $status);
        } else {
            enviarMensagem($chat_id, "❌ Envie um código de rastreio válido, como 'BU508591038BR'.");
        }
    }
} else {
    echo "Nenhuma mensagem encontrada.";
}

// Função para buscar status da encomenda na API Linketrack
function rastrearObjeto($codigo) {
    global $LINKETRACK_USER, $LINKETRACK_TOKEN, $LINKETRACK_URL;

    $url = "https://api.linketrack.com/track/json?user=teste&token=&codigo=$codigo";
    $resposta = file_get_contents($url);
    $dados = json_decode($resposta, true);

    if (isset($dados['eventos']) && !empty($dados['eventos'])) {
        $mensagem = "📦 *Status do Objeto:* `$codigo`\n\n";
        foreach ($dados['eventos'] as $evento) {
            $mensagem .= "📍 *" . $evento['status'] . "*\n";
            $mensagem .= "📅 " . $evento['data'] . " - 🕒 " . $evento['hora'] . "\n";
            $mensagem .= "📌 " . $evento['local'] . "\n\n";
        }
        return $mensagem;
    }

    return "❌ Código inválido ou erro ao buscar informações.";
}

// Função para enviar mensagem no Telegram
function enviarMensagem($chat_id, $mensagem) {
    global $API_URL;
    $dados = [
        'chat_id' => $chat_id,
        'text' => $mensagem,
        'parse_mode' => 'Markdown'
    ];
    file_get_contents($API_URL . "sendMessage?" . http_build_query($dados));
}
?>
