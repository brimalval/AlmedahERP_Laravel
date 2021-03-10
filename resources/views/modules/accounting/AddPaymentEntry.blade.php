
<nav class="navbar navbar-expand-lg navbar-light bg-light sticky-top">
  <div class="container-fluid">
    <h2>New Payment Entry</h2>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#responsive">
    <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse"  id="responsive">
      <ul class="navbar-nav ml-auto">
      <input type="submit" class="btn btn-primary dropdown-toggle" style="outline: none; border: none;" value="Save">
                    
               </input>  
        
        
      </ul>
    </div>
  </div>
</nav>

<br>

<div id="accordion">
  <div class="card">
    <div class="card-header" id="headingOne">
      <h5 class="mb-0">
        <button class="btn btn-link" data-toggle="collapse" data-target="#Dashboard" aria-expanded="true" aria-controls="Dashboard">
          Type of Payment
        </button>
      </h5>
    </div>
    <div id="Dashboard" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
      <div class="card-body">
        <?php include 'newPaymentEntry/TypeofPayment.php' ?> 
      </div>
    </div>
    </div>
    <div class="card">
    <div class="card-header" id="headingTwo">
      <h5 class="mb-0">
        <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#Item" aria-expanded="false" aria-controls="Item">
          Payment From / To
        </button>
      </h5>
    </div>
    <div id="Item" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
      <div class="card-body">
        <?php include 'newPaymentEntry/PaymentFromTo.php' ?>
      </div>
    </div>
    </div>

    <div class="card">
    <div class="card-header" id="headingthree">
      <h5 class="mb-0">
        <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#Currency" aria-expanded="false" aria-controls="Currency">
          Accounts
        </button>
      </h5>
    </div>
    <div id="Currency" class="collapse" aria-labelledby="headingthree" data-parent="#accordion">
      <div class="card-body">
        <?php include 'newPaymentEntry/Accounts.php' ?>
      </div>
    </div>
    </div>

    

    <div class="card">
    <div class="card-header" id="headingthree">
      <h5 class="mb-0">
        <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#comm" aria-expanded="false" aria-controls="comm">
          Accounting Dimensions
        </button>
      </h5>
    </div>
    <div id="comm" class="collapse" aria-labelledby="headingthree" data-parent="#accordion">
      <div class="card-body">
        <?php include 'newPaymentEntry/AccountingDimensions.php' ?>
      </div>
    </div>
    </div>

</div>
</div>
