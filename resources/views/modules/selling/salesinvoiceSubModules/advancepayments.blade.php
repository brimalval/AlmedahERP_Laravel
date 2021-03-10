<script type="text/javascript">
    function openAdvance()
    {
        var check = document.getElementById('adv');
        if (check.checked) {
            document.getElementById('advances').style.display = 'none';
        }
        else
            document.getElementById('advances').style.display = 'block';                
    }
</script>

<div class="container">
            <div class="row">
                                
                <div class="form-check">
               <input id="adv" type="checkbox" class="form-check-input" onchange="javascript:openAdvance()">
                </div>
                
                <label for="">Allocate Advances Automatically (FIFO)</label><br>
            
            </div>  
<div class="row">
                <div class="col-6">
                <label id="advances" >Get Advances Received</label>
                </div> 
</div>
<div class="row">

<table class="table border-bottom table-hover table-bordered">

  <thead class="border-top border-bottom bg-light">
    <tr class="text-muted">
      <td>
        <div class="form-check">
          <input type="checkbox" class="form-check-input">
        </div>
      </td>
      <td>Type</td>
      <td>Account Head</td>
      <td>Rate</td>
      <td>Amount</td>
      <td>Total</td> 
      <td></td>         
    </tr>
  </thead>
  <tbody class="">
    <tr>
        <td colspan="7"  style="text-align: center;">NO DATA</td>
    </tr>
    <tr>
      <td colspan="7" rowspan="5">
           <button class="btn btn-sm btn-sm btn-secondary">Add Row</button>
      </td>
    </tr>
      
  </tbody>
</table>
</div>

</div>
