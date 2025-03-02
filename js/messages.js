// js/messages.js
(function() {
    if(!document.getElementById('messages-page')) return; //only for message page

    const userModule = window.userModule; // Access the userModule

    // Function to load contacts and display them in the sidebar
    function loadContacts() {
        const contactList = document.getElementById('contact-list');
        if (!contactList) return;

        let contacts = localStorage.getItem('contacts');
        contacts = contacts ? JSON.parse(contacts) : [];
        //if no contacts add default
        if(contacts.length === 0){
            contacts = addDefaultContacts();
        }

        contactList.innerHTML = ''; // Clear existing contacts

        contacts.forEach(contact => {
            const contactElement = createContactElement(contact);
            contactList.appendChild(contactElement);
        });
        //update unread messages count in navbar
        updateUnreadMessagesCount();
    }

    // Function to add default contacts
    function addDefaultContacts() {
        const defaultContacts = [
            { id: 'sarahrodriguez', name: 'Sarah Rodriguez', image: 'https://ui-avatars.com/api/?name=Sarah+Rodriguez&background=6b7280&color=fff', lastMessage: "I'm available tomorrow for our lesson!", lastMessageTime: '12m', online: true },
            { id: 'michaelchen', name: 'Michael Chen', image: 'https://ui-avatars.com/api/?name=Michael+Chen&background=10b981&color=fff', lastMessage: 'Hey, I wanted to discuss the web development project.', lastMessageTime: '1h', online: true, unreadCount: 2 },
            { id: 'emmalewis', name: 'Emma Lewis', image: 'https://ui-avatars.com/api/?name=Emma+Lewis&background=fbbf24&color=fff', lastMessage: 'Thanks for your help with the baking class!', lastMessageTime: '2d', online: false },
            { id: 'davidwilson', name: 'David Wilson', image: 'https://ui-avatars.com/api/?name=David+Wilson&background=ef4444&color=fff', lastMessage: 'When is our next piano lesson?', lastMessageTime: '4d', online: true },
            { id: 'isabellagarcia', name: 'Isabella Garcia', image: 'https://ui-avatars.com/api/?name=Isabella+Garcia&background=8b5cf6&color=fff', lastMessage: 'Hola! ¿Cómo va tu práctica de español?', lastMessageTime: '1w', online: false }
        ];
        localStorage.setItem('contacts', JSON.stringify(defaultContacts));
        return defaultContacts;

    }

    // Function to create a contact element in the sidebar
    function createContactElement(contact) {
        const contactItem = document.createElement('div');
        contactItem.className = 'contact-item d-flex align-items-center p-3 border-bottom';
        contactItem.setAttribute('data-contact-id', contact.id); // Store contact ID
        contactItem.innerHTML = `
            <div class="position-relative me-3">
                <img src="${contact.image}" 
                        class="rounded-circle" width="48" height="48" alt="${contact.name}">
                <span class="position-absolute bottom-0 end-0 bg-${contact.online ? 'success' : 'secondary'} rounded-circle p-1 border border-white"></span>
            </div>
            <div class="flex-grow-1 min-width-0">
                <div class="d-flex justify-content-between align-items-center">
                    <h6 class="mb-0 text-truncate">${contact.name}</h6>
                    <small class="text-muted ms-2">${contact.lastMessageTime}</small>
                </div>
                <p class="small text-muted mb-0 text-truncate">${contact.lastMessage}</p>
            </div>
            ${contact.unreadCount ? `<span class="badge rounded-pill bg-primary me-2">${contact.unreadCount}</span>` : ''}
        `;
         // Add click event listener to load messages when a contact is clicked
        contactItem.addEventListener('click', function() {
            loadMessages(contact.id);
             // Remove the 'active' class from all contact items
            document.querySelectorAll('.contact-item').forEach(item => {
                item.classList.remove('bg-light');
            });

            // Add the 'active' class to the clicked contact item
            contactItem.classList.add('bg-light');
        });
        return contactItem;
    }

      // Function to load messages for a specific contact
      function loadMessages(contactId) {
        const chatMessages = document.getElementById('chat-messages');
        const chatHeaderInfo = document.getElementById('chat-header-info'); //for header
        if (!chatMessages || !chatHeaderInfo) return;


        let messages = localStorage.getItem(`messages-${contactId}`);
        messages = messages ? JSON.parse(messages) : [];

        //if messages are not present add default messages
        if(messages.length === 0){
            messages = addDefaultMessages(contactId);
        }

        chatMessages.innerHTML = ''; // Clear existing messages

        // Update chat header with contact info
         let contacts = localStorage.getItem('contacts');
        contacts = contacts ? JSON.parse(contacts) : [];
        const contact = contacts.find(c => c.id === contactId);
        if (contact) {
            chatHeaderInfo.innerHTML = `
                <img src="${contact.image}" class="rounded-circle me-3" width="40" height="40" alt="${contact.name}">
                <div>
                    <h6 class="mb-0">${contact.name}</h6>
                    <small class="text-${contact.online ? 'success' : 'muted'}">
                        <i class="fas fa-circle fa-xs me-1"></i>${contact.online ? 'Online' : 'Offline'}
                    </small>
                </div>
            `;
        }

        //mark messages as read and update contacts and message count
        markMessagesAsRead(contactId);
        updateUnreadMessagesCount();

        messages.forEach(message => {
            const messageElement = createMessageElement(message, contactId);
            chatMessages.appendChild(messageElement);
        });

        // Scroll to the bottom of the chat messages
        chatMessages.scrollTop = chatMessages.scrollHeight;

          // Show chat area on mobile when a contact is clicked
        if (window.innerWidth < 768) {
             document.querySelector('.col-md-4.col-lg-3').style.display = 'none';
            document.getElementById('chat-area').style.display = 'flex';
        }
    }

     // Function to add default messages
    function addDefaultMessages(contactId){
        const user = userModule.getLoggedInUserData(); //use user module
        if (!user) return [];
        let defaultMessages = [];
        if(contactId === 'sarahrodriguez'){
                defaultMessages = [
                { sender: 'sarahrodriguez', text: "Hi "+user.firstname+"! I was wondering if we could schedule our digital marketing exchange session?", time: '10:15 AM', read: true },
                { sender: user.username, text: "Hey Sarah! Sure, I'm available tomorrow afternoon. Would 2 PM work for you?", time: '10:17 AM', read: true },
                { sender: 'sarahrodriguez', text: "2 PM works perfectly! Should we meet at the usual coffee shop?", time: '10:20 AM', read: true },
                { sender: user.username, text: "Yes, let's do that. I'll bring my laptop with some examples of social media campaigns we can review.", time: '10:22 AM', read: true },
                { sender: 'sarahrodriguez', text: "Sounds great! I'm excited to learn more about digital marketing strategies. I'll prepare some questions.", time: '10:25 AM', read: true },
                { sender: 'sarahrodriguez', text: "I've been working on this social media post. What do you think?", image: 'https://via.placeholder.com/300x200?text=Social+Media+Post+Example', time: '10:40 AM', read: false },
            ];
        } else {
            defaultMessages = [ { sender: contactId, text: "Hey there! Let's start our skill exchange!", time: '9:00 AM', read: true },];
        }

        localStorage.setItem(`messages-${contactId}`, JSON.stringify(defaultMessages));
        return defaultMessages;
    }
    // Function to create a message element (bubble)
   function createMessageElement(message, contactId) {
    const loggedInUser = userModule.getLoggedInUserData(); // Use imported function.
    const isSent = message.sender === (loggedInUser ? loggedInUser.username : null);
    const messageDiv = document.createElement('div');
    messageDiv.className = `message-${isSent ? 'sent' : 'received'} mb-3 ${isSent ? 'text-end' : ''}`;

    let messageContent = '';
    if (isSent) {
        messageContent = `
            <div class="d-flex ${isSent ? 'justify-content-end' : ''}">
                <div class="text-start">
                    <div class="message-bubble sent p-3 rounded-3">
                        <p class="mb-0">${message.text}</p>
                        ${message.image ? `<img src="${message.image}" class="img-fluid rounded-3 mt-2" alt="Attachment" style="max-width: 200px;">` : ''}
                    </div>
                    <div class="d-flex align-items-center justify-content-end">
                        <small class="text-muted">${message.time}</small>
                        <i class="fas fa-check-double text-primary ms-1 small"></i>
                    </div>
                </div>
            </div>
        `;
    } else {
        // Use find.  No need for getItem again inside the loop.
        let contacts = localStorage.getItem('contacts');
        contacts = contacts ? JSON.parse(contacts) : [];
        const contact = contacts.find(c => c.id === contactId);  // Correct: Find contact directly
        const userImage = contact ? contact.image : ''; // Use default if not found.

        messageContent = `
            <div class="d-flex">
                <img src="${userImage}"
                    class="rounded-circle me-2 align-self-end" width="30" height="30" alt="">
                <div>
                    <div class="message-bubble received p-3 rounded-3">
                        <p class="mb-0">${message.text}</p>
                        ${message.image ? `<img src="${message.image}" class="img-fluid rounded-3 mt-2" alt="Attachment" style="max-width: 200px;">` : ''}
                    </div>
                    <small class="text-muted">${message.time}</small>
                </div>
            </div>
        `;
    }

    messageDiv.innerHTML = messageContent;
    return messageDiv;
}

    // Function to "send" a message (store it in localStorage)
    function sendMessage(contactId, message) {
         const user = userModule.getLoggedInUserData(); //use user module
        if (!user) {
            alert('You must be logged in to send messages.');
            return;
        }
        if (!message) return; // Don't send empty messages

        let messages = localStorage.getItem(`messages-${contactId}`);
        messages = messages ? JSON.parse(messages) : [];

        const newMessage = {
            sender: user.username, // Use the logged-in user as the sender
            text: message,
            time: new Date().toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' }), // Current time,
            read: true
        };

        messages.push(newMessage);
        localStorage.setItem(`messages-${contactId}`, JSON.stringify(messages));

        // Reload messages to display the new message
        loadMessages(contactId);
    }

 // Function to setup contact search
    function setupContactSearch() {
         const searchInput = document.getElementById('contact-search');
        const contactItems = document.querySelectorAll('.contact-item');
         if(!searchInput) return

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
// Function to mark messages as read
function markMessagesAsRead(contactId) {
    let messages = localStorage.getItem(`messages-${contactId}`);
    messages = messages ? JSON.parse(messages) : [];
    const loggedInUser = userModule.getLoggedInUserData(); //use user module

    const updatedMessages = messages.map(message => {
    if (message.sender !== loggedInUser.username) {
        return { ...message, read: true };
    }
    return message;
    });

    localStorage.setItem(`messages-${contactId}`, JSON.stringify(updatedMessages));

    // Update the unreadCount in the contacts array
    let contacts = localStorage.getItem('contacts');
    contacts = contacts ? JSON.parse(contacts) : [];
    const contactIndex = contacts.findIndex(c => c.id === contactId);
    if (contactIndex !== -1) {
        contacts[contactIndex].unreadCount = 0;
        localStorage.setItem('contacts', JSON.stringify(contacts));
    }
}
//Function to calculate unread messages
function calculateUnreadMessages() {
    const loggedInUser = userModule.getLoggedInUserData(); //use user module
     if (!loggedInUser) {
        return 0; // No user logged in
    }
    let totalUnread = 0;
    let contacts = localStorage.getItem('contacts');
    contacts = contacts ? JSON.parse(contacts) : [];
    //get unread count from each contact
     contacts.forEach(contact => {
        let messages = localStorage.getItem(`messages-${contact.id}`);
        messages = messages ? JSON.parse(messages) : [];
        //filter messages that i have not send and are unread
        const unreadCount = messages.filter(message => message.sender !== loggedInUser.username && !message.read).length;
        totalUnread += unreadCount;
    });

    return totalUnread;
}

// Function to update unread messages count on navbar
function updateUnreadMessagesCount() {
    const unreadCountNav = document.getElementById('unread-count-nav');
    if (unreadCountNav) {
        const count = calculateUnreadMessages();
        unreadCountNav.textContent = count > 0 ? count : ''; // Update count or hide if 0
         unreadCountNav.style.display = count > 0 ? 'inline' : 'none'; //hide if 0
    }
}

    // Event listeners and initial setup.  This is done *within* the IIFE.
    loadContacts(); // Load contacts on page load.

    // Send message on form submit
    const messageForm = document.getElementById('message-form');
    if (messageForm) {
        messageForm.addEventListener('submit', function(event) {
            event.preventDefault();
            const messageInput = document.getElementById('message-input');
            const currentContactId = document.querySelector('.contact-item.bg-light')?.getAttribute('data-contact-id'); // Get active contact.  Optional chaining.
            if (currentContactId) {
                sendMessage(currentContactId, messageInput.value);
                messageInput.value = ''; // Clear input after sending.
            }
        });
    }

    // Mobile view - back button functionality
    const backButton = document.getElementById('back-to-contacts');
    if (backButton) {
        backButton.addEventListener('click', () => {
            document.querySelector('.col-md-4.col-lg-3').style.display = 'block'; // Show contacts
            document.getElementById('chat-area').style.display = 'none'; // Hide chat
        });
    }
    // Setup contact search
    setupContactSearch();

})();