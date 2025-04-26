// Function to load messages
function loadMessages() {
  console.log("Fetching messages for room ID:", room_id);
  $.ajax({
      url: 'GetMessage.php', // Backend script to fetch messages
      type: 'POST',
      data: { room_id: room_id },
      success: function(response) {
          console.log("Response from server:", response);
          try {
              const messages = JSON.parse(response);
              console.log("Parsed messages:", messages);
              $('#chat-box').empty(); // Clear the chat box before reloading messages
              messages.forEach(msg => {
                  // Determine if the message is from the current user
                  const isUserMessage = msg.author == author;
                  const messageClass = isUserMessage ? 'message user' : 'message other';
                  $('#chat-box').append(`<div class="${messageClass}"><strong>${msg.author}:</strong> ${msg.message}</div>`);
              });
              // Scroll to the bottom of the chat box
              $('#chat-box').scrollTop($('#chat-box')[0].scrollHeight);
          } catch (error) {
              console.error("Error parsing response:", error);
          }
      },
      error: function(xhr, status, error) {
          console.error("Error loading messages:", error);
      }
  });
}