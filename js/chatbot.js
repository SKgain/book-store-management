const responses = {
  "good morning": "Good morning, How can I assist you today?",
  "good afternoon": "Good afternoon, How can I assist you today?",
  "good evening": "Good evening, How can I assist you today?",
  "what is your name": "My name is circuit, How can I assist you today?",
  "can you tell me the library timings":
    "Our library is open from 8 AM to 9 PM, Saturday to Wednesday and 9 AM to 10 PM, Thursday and Friday.",
  "which types of books are available":
    "We have a wide range of books.You can check our book list in homepage by scrolling down.",
  "how can i contact":
    "You can reach us at info@bookpoint.com or call us at +880 1319806363.",
  "member": "You can apply for a online registration or at the front desk.",
  "bye": "Goodbye! Have a great day!",
  "default":
    "I'm sorry, I didn't understand that. Can you rephrase your question?",
};

// Get chat elements
const chatbox = document.getElementById("chatbox");
const userInput = document.getElementById("userInput");
const sendBtn = document.getElementById("sendBtn");

// Send message function
function sendMessage() {
  const userText = userInput.value.trim();
  if (userText === "") return;

  // Display user's message
  addMessage(userText, "user");

  // Generate bot response
  const botResponse = getResponse(userText.toLowerCase());
  addMessage(botResponse, "bot");

  // Clear input field
  userInput.value = "";
}

// Add message to chatbox
function addMessage(message, sender) {
  const messageElement = document.createElement("div");
  messageElement.className = sender;
  messageElement.textContent = message;
  chatbox.appendChild(messageElement);

  // Scroll to the bottom
  chatbox.scrollTop = chatbox.scrollHeight;
}

// Get bot response
function getResponse(userText) {
  for (let key in responses) {
    if (userText.includes(key)) {
      return responses[key];
    }
  }
  return responses["default"];
}

// Attach event listener
sendBtn.addEventListener("click", sendMessage);

// Enable 'Enter' key to send message
userInput.addEventListener("keypress", (e) => {
  if (e.key === "Enter") {
    sendMessage();
  }
});
