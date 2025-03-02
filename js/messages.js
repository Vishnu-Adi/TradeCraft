document.addEventListener('DOMContentLoaded', function() {
    // DOM Elements
    const contactItems = document.querySelectorAll('.contact-item');
    const chatArea = document.querySelector('.col-md-8.col-lg-9');
    const messageInput = document.querySelector('.chat-input input');
    const sendButton = document.querySelector('.chat-input button[type="submit"]');
    const searchInput = document.querySelector('.input-group input');
    const backButton = document.getElementById('back-to-contacts');
    
    // Mobile view - toggle between contacts and chat
    function handleMobileView() {
        if (window.innerWidth < 768) {
            if (backButton) {
                backButton.addEventListener('click', () => {
                    document.querySelector('.col-md-4.col-lg-3').style.display = 'block';
                    chatArea.style.display = 'none';
                });
            }
            
            contactItems.forEach(item => {
                item.addEventListener('click', () => {
                    document.querySelector('.col-md-4.col-lg-3').style.display = 'none';
                    chatArea.style.display = 'flex';
                });
            });
        } else {
            document.querySelector('.col-md-4.col-lg-3').style.display = 'block';
            chatArea.style.display = 'flex';
        }
    }
    
    // Handle sending messages
    function sendMessage() {
        const messageText = messageInput.value.trim();
        if (messageText) {
            const messageHtml = `
                <div class="message-sent mb-3 text-end">
                    <div class="d-flex justify-content-end">
                        <div class="text-start">
                            <div class="message-bubble sent p-3 rounded-3">
                                <p class="mb-0">${escapeHtml(messageText)}</p>
                            </div>
                            <div class="d-flex align-items-center justify-content-end">
                                <small class="text-muted">${getCurrentTime()}</small>
                                <i class="fas fa-check text-primary ms-1 small"></i>
                            </div>
                        </div>
                    </div>
                </div>
            `;
            
            const chatMessages = document.querySelector('.chat-messages');
            chatMessages.insertAdjacentHTML('beforeend', messageHtml);
            messageInput.value = '';
            
            // Scroll to bottom
            chatMessages.scrollTop = chatMessages.scrollHeight;
            
            // Simulate reply after delay
            simulateTyping();
        }
    }
    
    // Contact search functionality
    function setupSearch() {
        searchInput.addEventListener('input', function() {
            const searchTerm = this.value.toLowerCase();
            
            contactItems.forEach(item => {
                const name = item.querySelector('h6').textContent.toLowerCase();
                const message = item.querySelector('p').textContent.toLowerCase();
                
                if (name.includes(searchTerm) || message.includes(searchTerm)) {
                    item.style.display = 'flex';
                } else {
                    item.style.display = 'none';
                }
            });
        });
    }
    
    // Helper functions
    function getCurrentTime() {
        const now = new Date();
        return now.getHours().toString().padStart(2, '0') + ':' + 
               now.getMinutes().toString().padStart(2, '0');
    }
    
    function escapeHtml(text) {
        const div = document.createElement('div');
        div.textContent = text;
        return div.innerHTML;
    }
    
    function simulateTyping() {
        const typingIndicator = document.querySelector('.typing-indicator');
        
        // Show typing indicator
        if (typingIndicator) {
            typingIndicator.style.display = 'block';
            
            // Scroll to see the typing indicator
            const chatMessages = document.querySelector('.chat-messages');
            chatMessages.scrollTop = chatMessages.scrollHeight;
            
            // Hide typing and show response after 2 seconds
            setTimeout(() => {
                typingIndicator.style.display = 'none';
                
                // Sample responses
                const responses = [
                    "Thanks for your message!",
                    "I'll get back to you on that soon.",
                    "Great! Looking forward to our meeting.",
                    "That sounds perfect!"
                ];
                
                const randomResponse = responses[Math.floor(Math.random() * responses.length)];
                
                const responseHtml = `
                    <div class="message-received mb-3">
                        <div class="d-flex">
                            <img src="https://ui-avatars.com/api/?name=Sarah+Rodriguez&background=6b7280&color=fff" 
                                class="rounded-circle me-2 align-self-end" width="30" height="30" alt="Sarah Rodriguez">
                            <div>
                                <div class="message-bubble received p-3 rounded-3">
                                    <p class="mb-0">${randomResponse}</p>
                                </div>
                                <small class="text-muted">${getCurrentTime()}</small>
                            </div>
                        </div>
                    </div>
                `;
                
                chatMessages.insertAdjacentHTML('beforeend', responseHtml);
                chatMessages.scrollTop = chatMessages.scrollHeight;
            }, 2000);
        }
    }
    
    // Initialize
    function init() {
        handleMobileView();
        window.addEventListener('resize', handleMobileView);
        
        // Set up event listeners
        sendButton.addEventListener('click', function(e) {
            e.preventDefault();
            sendMessage();
        });
        
        messageInput.addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                e.preventDefault();
                sendMessage();
            }
        });
        
        setupSearch();
    }
    
    init();
});