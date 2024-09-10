function sendUserMessage(option) {
    var userInput = "";
    switch (option) {
        case '1':
            userInput = "Quiero información sobre productos.";
            break;
        case '2':
            userInput = "¿Cómo puedo hacer los pedidos?";
            break;
        case '3':
            userInput = "Contacto";
            break;
        default:
            userInput = "No seleccionaste una opción válida.";
            break;
    }

    var userMessage = '<div class="chat-message user">' + userInput + '</div>';
    var chatBox = document.getElementById("chat-box");
    chatBox.innerHTML += userMessage;

    setTimeout(function() {
        var botResponse = getBotResponse(userInput);
        var botMessage = '<div class="chat-message bot">' + botResponse + '</div>';
        chatBox.innerHTML += botMessage;

        chatBox.scrollTop = chatBox.scrollHeight;
    }, 2000); 
}

function getBotResponse(question) {
    var lowercaseQuestion = question.toLowerCase();

    switch (lowercaseQuestion) {
        case "quiero información sobre productos.":
            return 'Podemos realizar los modelos que ves en nuestra <a href="index.html">página web</a>. Si deseas alguno personalizado, no dudes en contactarte a nuestro WhatsApp <a href="https://web.whatsapp.com/send?phone=51957234063" target="_blank">957234063</a>.';
        case "¿cómo puedo hacer los pedidos?":
            return 'Los pedidos se realizan al por mayor con los precios de la página. Puedes realizarlos con una semana de anticipación a través de nuestro <a href="https://web.whatsapp.com/send?phone=51957234063" target="_blank">WhatsApp</a> o redes sociales.';
        case "contacto":
            return 'Puedes escribirnos las 24 horas del día a nuestro número <a href="https://web.whatsapp.com/send?phone=51957234063" target="_blank">957234063</a>. Se cotizan precios al por mayor con 1 semana de anticipación.';
        default:
            return "Lo siento, no entiendo esa opción.";
    }
}

