<?php include 'header.php'; ?>
<div class="container my-5">
  <h1 class="mb-4">Frequently Asked Questions</h1>
  <div id="accordion">
    <!-- FAQ Item 1 -->
    <div class="card">
      <div class="card-header" id="headingOne">
        <h5 class="mb-0">
          <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" 
                  aria-expanded="true" aria-controls="collapseOne">
            How do I sign up for the platform?
          </button>
        </h5>
      </div>
      <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
        <div class="card-body">
          Simply click the "Sign Up" button in the navigation bar and fill in the registration form.
        </div>
      </div>
    </div>
    <!-- FAQ Item 2 -->
    <div class="card">
      <div class="card-header" id="headingTwo">
        <h5 class="mb-0">
          <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo" 
                  aria-expanded="false" aria-controls="collapseTwo">
            Is the platform free to use?
          </button>
        </h5>
      </div>
      <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
        <div class="card-body">
          Yes, our platform is completely free to use for all community members.
        </div>
      </div>
    </div>
    <!-- FAQ Item 3 -->
    <div class="card">
      <div class="card-header" id="headingThree">
        <h5 class="mb-0">
          <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseThree" 
                  aria-expanded="false" aria-controls="collapseThree">
            How can I contact support?
          </button>
        </h5>
      </div>
      <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
        <div class="card-body">
          You can contact support by emailing support@skillxchange.com or using our Contact page.
        </div>
      </div>
    </div>
    <!-- Add more FAQ items as needed -->
  </div>
</div>
<?php include 'footer.php'; ?>
