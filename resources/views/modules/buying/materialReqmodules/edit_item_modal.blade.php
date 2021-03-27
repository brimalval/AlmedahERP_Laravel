<!-- Modal -->
<div class="modal fade" id="itemEditModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Record</h5> 
      </div>

    <div class="modal-body">    
        <form  id="editItemForm">
        @csrf
        <div id="accordion">
        <div class="card">
            <div class="card-header" id="headingOne">
            <h5 class="mb-0">
                <a href="#" class="btn btn-link" data-toggle="collapse" data-target="#itemInfo" aria-expanded="true" aria-controls="itemInfo">
                Item Information
                </a>
            </h5>
            </div>
            <div id="itemInfo" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
            <div class="card-body">

                <!--dashboard contents-->
                <div class="container">
                {{-- <form id="contactForm" name="contact" role="form">
                    @csrf --}}
                    
                    <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                        <label for="item_code">Item Code</label>
                        <select required="true" data-id="item_code" data-live-search="true" name="item_code" id="edit-item-code" class="form-control selectpicker">
                            @foreach ($materials as $material)
                                <option value="{{ $material->item_code }}" data-subtext="{{ $material->item_name }}">{{ $material->item_code }}</option>
                            @endforeach
                        </select>
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="form-group">
                        <label for="required_date">Required Date</label>
                        <input type="date" name="required_date" id="required_date" class="form-control">
                        </div>
                    </div>
                    </div>    
                    
                    <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                        <label for="item_name">Item Name</label>
                        <select required="true" data-id="item_code" data-live-search="true" name="item_code" id="edit-item-name" class="form-control selectpicker">
                            @foreach ($materials as $material)
                                <option value="{{ $material->item_code }}" data-subtext="{{ $material->item_code }}">{{ $material->item_name }}</option>
                            @endforeach
                        </select>
                        </div>
                    </div>
                    <div class="col-6">
                    <!-- EMPTY COLUMN-->
                    </div>
                    </div>
                    
                </div>
                
                <!--end contents-->
            </div>
            </div>
        </div>


        <div class="card">
            <div class="card-header" id="headingUOM">
            <h5 class="mb-0">
                <a href="#" class="btn btn-link" data-toggle="collapse" data-target="#UOM" aria-expanded="true" aria-controls="UOM">
                Unit of Measurement
                </a>
            </h5>
            </div>
            <div id="UOM" class="collapse hidden" aria-labelledby="headingUOM" data-parent="#accordion">
            <div class="card-body">

                <!--dashboard contents-->
                <div class="container">
                {{-- <form id="contactForm" name="contact" role="form">
                    @csrf --}}
                    
                    <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                        <label for="quantity">Quantity</label>
                        <input type="number" name="quantity" id="edit-quantity" min="1" val="1" class="form-control">
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="form-group">
                        <label for="uom">UOM</label>
                            <select required="true" data-id="uom_id" id="edit-uom" data-live-search="true" name="uom_id[]" class="form-control selectpicker">
                                @foreach ($units as $unit)
                                    <option value="{{ $unit->uom_id }}" data-cf="{{ $unit->conversion_factor }}" data-subtext="{{ $unit->conversion_factor }} nos. ea.">{{ $unit->item_uom }}</small></option>
                                @endforeach
                            </select>
                        </div>
                    </div> 
                    </div>    
                        
                    <div class="row">
                        <div class="col-6">
                        <div class="form-group">
                        <label for="stock_uom">Stock UOM</label>
                            <input type="text" readonly id="edit-stock-uom" class="form-control">
                        </div>
                        </div>

                        <div class="col-6">
                        <div class="form-group">
                        <label for="uom_conversion_factor">UOM Conversion Factor</label>
                        <input type="text" readonly id="edit-uom-cf" class="form-control">
                        </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-6">
                        <div class="form-group">
                        <label for="target_station">Target Station</label>
                            <select id="edit-station" required="true" data-id="station_id" data-live-search="true" name="station_id[]" class="form-control selectpicker">
                                @foreach ($stations as $station)
                                    <option value="{{ $station->station_id }}" data-subtext="{{ $station->description }}">{{ $station->station_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        </div>

                        <div class="col-6">
                        <div class="form-group">
                        <label for="stock_quantity">Stock Quantity</label>
                            <input type="text" readonly id="edit-stock-quantity" class="form-control">
                        </div>
                        </div>
                    </div>
                    
                    
                </div>
                
                <!--end contents-->
            </div>
            </div>
        </div>
        </div>
        </form>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" onclick="$('#itemEditModal').modal('hide')">Cancel</button>
            <button type="button" onclick="$('#editItemForm').submit()" class="btn btn-primary">Save</button>
      </div>
  </div>
</div>
</div>