<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags-->
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Icons font CSS-->
  <link href="{{ asset('vendor/mdi-font/css/material-design-iconic-font.min.css') }}" rel="stylesheet" media="all">
  <link href="{{ asset('vendor/font-awesome-4.7/css/font-awesome.min.css') }}" rel="stylesheet" media="all">
  <!-- Font special for pages-->
  <link href="https://fonts.googleapis.com/css?family=Poppins:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Vendor CSS-->
  <link href="{{ asset('../vendor/select2/select2.min.css') }}" rel="stylesheet" media="all">
  <link href="{{ asset('../vendor/datepicker/daterangepicker.css') }}" rel="stylesheet" media="all">

  <!-- Main CSS-->
  <link href="{{ asset('css/main.css') }}" rel="stylesheet" media="all">
  <link href="{{ asset('css/bomtab.css') }}" rel="stylesheet" media="all">

</head>

<body>

  <!-- Tab links -->
  <div class="tab">
    <div class="tablinks btn" onclick="openTab(event, 'Components')">Components</div>
    <div class="tablinks btn" onclick="openTab(event, 'Cost')">Cost</div>
    <div class="tablinks btn" onclick="openTab(event, 'Note')">Note</div>
  </div>

  <!-- Tab content -->
  <div id="Components" class="tabcontent">
    <style>
      /* Component's Table */
      table {
        border-collapse: collapse;
        width: 100%;
      }

      th,
      td {
        text-align: left;
        padding: 8px;
      }
    </style>
    <table>
      <tr>
        <th>Item Code</th>
        <th>Item Name</th>
        <th>Item Image</th>
        <th>Category ID</th>
        <th>Unit Price</th>
        <th>Total Amount</th>
        <th>RM Status</th>
      </tr>

      <tr>
        <td>0001</td>
        <td>Material 1</td>
        <td>Image 1</td>
        <td>1000</td>
        <td>P1000</td>
        <td>P5000</td>
        <td>To Purchase</td>
      </tr>

      <tr>
        <td>0002</td>
        <td>Material 2</td>
        <td>Image 2</td>
        <td>1000</td>
        <td>P1000</td>
        <td>P5000</td>
        <td>Available</td>
      </tr>

      <tr>
        <td>0003</td>
        <td>Material 3</td>
        <td>Image 3</td>
        <td>1000</td>
        <td>P1000</td>
        <td>P5000</td>
        <td>Not Available</td>
      </tr>

    </table>
  </div>

  <div id="Cost" class="tabcontent">
    <h3>Item 2</h3>
    <p>Include some details of Item 2.</p>
  </div>

  <div id="Note" class="tabcontent">
    <h3>Item 3</h3>
    <p>Include some details of Item 3.</p>
  </div>

  </div>

  <!-- Main JS-->
  <script src="js/global.js"></script>

  <script src="js/bomtab.js"></script>

</body>

</html>
<!-- end document-->