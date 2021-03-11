<script type="text/javascript">
  function toggleOtherTextboxVisible() {
    var check = document.getElementById('OtherCheckBox');
    if (check.checked) {
      document.getElementById('content').style.display = 'block';
    } else
      document.getElementById('content').style.display = 'none';
  }
</script>


<div id="content" style="display:none">
  <div class="container">
    <div class="row">
      <div class="col-12"><br></div>
      <div class="col-6">
        <div class="form-group">
          <label for="compnay">Loyalty Points</label>
          <input type="text" name="" class="form-control" value="0">
        </div>
      </div>
      <div class="col-6">
        <div class="form-group">
          <label for="compnay">Redemption Account</label>
          <input type="text" name="" class="form-control" value="">
        </div>
      </div>
      <div class="col-6">
        <div class="form-group">
          <label for="compnay">Loyalty Amount</label>
          <input type="text" name="" class="form-control" value="P 0.00">
        </div>
      </div>

      <div class="col-6">
        <div class="form-group">
          <label for="compnay">Redemption Cost Center</label>
          <input type="text" name="" class="form-control" value="">
        </div>
      </div>
    </div>
    <div class="col-12">
      <hr>
    </div>
    <div class="col-12"><br></div>
  </div>

</div>

<div class="row">
  <div class="form-check">
    <input id="OtherCheckBox" type="checkbox" class="form-check-input" onchange="javascript:toggleOtherTextboxVisible()">
  </div>
  <label for="">Redeem Loyalty Points</label>

</div>