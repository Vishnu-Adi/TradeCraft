// js/exchanges.js
(function() {
    if(!document.getElementById('exchange-page')) return; //only for exchange page

    const userModule = window.userModule; // Access the userModule

    // Function to create a new exchange proposal
    function createExchangeProposal(proposalData) {
        let proposals = localStorage.getItem('exchangeProposals');
        proposals = proposals ? JSON.parse(proposals) : [];

        // Add a unique ID (simplified - you might want a more robust method)
        proposalData.id = Date.now();
         //get logged in user
        const user = userModule.getLoggedInUserData(); //use user module
        if (!user) {
            return { success: false, message: 'User not logged in.' };
        }
        proposalData.userId = user.username; // Associate proposal with the logged-in user
        proposalData.userImage = user.profileImage;
        proposalData.userName = user.firstname + " "+ user.lastname;
        // Add the new proposal to the array
        proposals.push(proposalData);
        localStorage.setItem('exchangeProposals', JSON.stringify(proposals));

        return { success: true, message: 'Proposal created successfully!' };
    }


 // Function to load and display exchange proposals
    function loadExchangeProposals() {
        const container = document.getElementById('exchangeOffersContainer');
        if (!container) return;

        let proposals = localStorage.getItem('exchangeProposals');
        proposals = proposals ? JSON.parse(proposals) : [];
         //add default exchanges if no exchnages present
        if(proposals.length === 0){
            proposals = addDefaultExchangeProposals();
        }
        container.innerHTML = ''; // Clear existing content

        proposals.forEach(proposal => {
            const proposalElement = createExchangeProposalElement(proposal);
            container.appendChild(proposalElement);
        });
    }
 // Function to add default exchange proposals
    function addDefaultExchangeProposals() {
         const defaultProposals = [
            {
                id: 1,
                userId: "johndoe",
                userName: "John Doe",
                userImage: "https://ui-avatars.com/api/?name=John+Doe&background=4f46e5&color=fff",
                yourSkill: "Guitar Lessons",
                desiredSkill: "Spanish Tutoring",
                message: "I've been playing guitar for over 10 years and can teach acoustic or electric guitar. Looking for someone who can help me improve my Spanish conversation skills.",
                availability: ["weekends", "evenings"],
                status: 'Active',
                postedDate: '2 days ago'
            },
            {
                id: 2,
                userId: "amandasmith",
                userName: "Amanda Smith",
                userImage: "https://ui-avatars.com/api/?name=Amanda+Smith&background=4f46e5&color=fff",
                yourSkill: "Yoga Instruction",
                desiredSkill: "Website Design",
                message: "Certified yoga instructor with 5 years of experience. Can teach beginner to intermediate levels. Need help creating a simple portfolio website for my yoga classes.",
                availability: ["weekdays", "mornings"],
                status: 'Active',
                postedDate: '5 days ago'
            }
        ];

        localStorage.setItem('exchangeProposals', JSON.stringify(defaultProposals));
        return defaultProposals;

    }
     // Function to create an HTML element for a single exchange proposal
    function createExchangeProposalElement(proposal) {
        const card = document.createElement('div');
        card.className = 'card border-0 shadow-sm rounded-3 mb-4 exchange-card';
        card.innerHTML = `
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div class="d-flex align-items-center">
                        <img src="${proposal.userImage}" class="bg-primary rounded-circle text-white d-flex align-items-center justify-content-center me-3" style="width: 40px; height: 40px;" alt="${proposal.userName}"/>
                        <div>
                            <h5 class="mb-0">${proposal.userName}</h5>
                            <span class="text-muted small">Posted ${proposal.postedDate}</span>
                        </div>
                    </div>
                    <span class="badge bg-success px-3 py-2">${proposal.status}</span>
                </div>
                <div class="row g-0 text-center mb-3">
                    <div class="col-5">
                        <div class="p-3 border rounded-3">
                            <h6 class="text-muted small text-uppercase">Offering</h6>
                            <p class="mb-0 fw-medium">${proposal.yourSkill}</p>
                        </div>
                    </div>
                    <div class="col-2 d-flex align-items-center justify-content-center">
                        <i class="fas fa-exchange-alt text-primary"></i>
                    </div>
                    <div class="col-5">
                        <div class="p-3 border rounded-3">
                            <h6 class="text-muted small text-uppercase">Looking For</h6>
                            <p class="mb-0 fw-medium">${proposal.desiredSkill}</p>
                        </div>
                    </div>
                </div>
                <p>${proposal.message}</p>
                <div class="d-flex align-items-center">
                    <div class="me-3">
                        ${proposal.availability.map(avail => `<span class="badge bg-light text-dark me-1">${avail}</span>`).join('')}
                    </div>
                    <div class="ms-auto">
                        <button class="btn btn-outline-primary btn-sm me-2">Contact</button>
                        <button class="btn btn-primary btn-sm">Accept Offer</button>
                    </div>
                </div>
            </div>
        `;
        return card;
    }


    // DOMContentLoaded is not needed *inside* the IIFE if you load
    // the script at the end of the body.  It's only needed if the
    // script is in the <head> and you want to make sure the DOM is ready.

      // Handle exchange form submission
      const exchangeForm = document.getElementById('exchangeForm');
      if (exchangeForm) {
        exchangeForm.addEventListener('submit', function(event) {
            event.preventDefault();

            // Reset error messages
            ['yourSkill', 'desiredSkill', 'message', 'availability'].forEach(field => {
                const errorElement = document.getElementById(`${field}-error`);
                if (errorElement) {
                    errorElement.textContent = '';
                    errorElement.classList.remove('d-block'); // Assuming you use Bootstrap's 'd-block'
                }
             });

            document.getElementById('exchange-form-success').style.display = 'none';

            // Get form values
            const yourSkill = document.getElementById('yourSkill').value.trim();
            const desiredSkill = document.getElementById('desiredSkill').value.trim();
            const message = document.getElementById('message').value.trim();
            const availability = Array.from(document.querySelectorAll('input[name="availability"]:checked')).map(cb => cb.id);

            // Validation
            let isValid = true;
            if (!yourSkill) {
                 document.getElementById('yourSkill-error').textContent = 'Please enter the skill you offer.';
                 document.getElementById('yourSkill-error').classList.add('d-block');
                isValid = false;
            }
            if (!desiredSkill) {
                document.getElementById('desiredSkill-error').textContent = 'Please enter the skill you want to learn.';
                 document.getElementById('desiredSkill-error').classList.add('d-block');
                isValid = false;
            }
            if (!message) {
                 document.getElementById('message-error').textContent = 'Please enter a message.';
                 document.getElementById('message-error').classList.add('d-block');
                isValid = false;
            }
            if (availability.length === 0) {
                document.getElementById('availability-error').textContent = 'Please select at least one availability option.';
                 document.getElementById('availability-error').classList.add('d-block');

                isValid = false;
            }

            if (!isValid) return;

            // Create proposal object
            const proposalData = {
                yourSkill,
                desiredSkill,
                message,
                availability,
                status: 'Active', // You might want to set a default status
                postedDate: 'Just now' // Use current time
            };

            // Create the proposal
            const result = createExchangeProposal(proposalData);

            if (result.success) {
                // Show success and clear form
                 document.getElementById('exchange-form-success').style.display = 'block';
                exchangeForm.reset();
                loadExchangeProposals(); // Reload proposals to show the new one
            } else {
                alert(result.message); // Show error - in a real app, use a better UI
            }
        });
    }

    //call to functions
     loadExchangeProposals();


})();