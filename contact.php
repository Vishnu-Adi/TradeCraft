<?php include 'header.php'; ?>
<div class="container my-5">
  <h1>Contact Us</h1>
  <p>If you have any questions, suggestions, or need assistance, please feel free to reach out using the form below.</p>
  
  <!-- Contact Form -->
  <form action="contact_process.php" method="post">
    <div class="form-group">
      <label for="name">Your Name</label>
      <input type="text" class="form-control" id="name" name="name" placeholder="Enter your name" required>
    </div>
    
    <div class="form-group">
      <label for="email">Your Email</label>
      <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" required>
    </div>
    
    <div class="form-group">
      <label for="subject">Subject</label>
      <input type="text" class="form-control" id="subject" name="subject" placeholder="Subject of your message" required>
    </div>
    
    <div class="form-group">
      <label for="message">Your Message</label>
      <textarea class="form-control" id="message" name="message" rows="5" placeholder="Type your message here..." required></textarea>
    </div>
    
    <button type="submit" class="btn btn-primary">Send Message</button>
  </form>
  
  <hr>
  
  <!-- Contact Details -->
  <h2>Our Contact Details</h2>
  <p><strong>Email:</strong> support@skillxchange.com</p>
  <p><strong>Phone:</strong> +1 (555) 123-4567</p>
  <p><strong>Address:</strong> 123 Community Lane, Skill City, Country</p>
</div>
<?php include 'footer.php'; ?>
