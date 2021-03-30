<div class="d-none" id="selects">
  <select required="true" data-id="item_code" data-live-search="true" name="item_code[]" class="form-control selectpicker">
    @foreach ($materials as $material)
        <option value="{{ $material->item_code }}" data-subtext="{{ $material->item_code }}">{{ $material->item_name }}</option>
    @endforeach
  </select>

  <select required="true" data-id="station_id" data-live-search="true" name="station_id[]" class="form-control selectpicker">
    @foreach ($stations as $station)
        <option value="{{ $station->station_id }}" data-subtext="{{ $station->description }}">{{ $station->station_name }}</option>
    @endforeach
  </select>

  <select required="true" data-id="uom_id" data-live-search="true" name="uom_id[]" class="form-control selectpicker">
    @foreach ($units as $unit)
        <option value="{{ $unit->uom_id }}" data-subtext="{{ $unit->conversion_factor }} nos. ea.">{{ $unit->item_uom }}</option>
    @endforeach
  </select>

  @if (isset($suppliers))
    <select onchange="fillSupplierRow($(this))" required="true" data-id="supplier_id" data-live-search="true" name="supplier_id[]" class="form-control selectpicker">
      @foreach ($suppliers as $supplier)
        <option value="{{ $supplier->supplier_id }}" data-subtext="{{ $supplier->supplier_id }}" data-email="{{ $supplier->supplier_email }}">{{ $supplier->company_name }}</option>
      @endforeach
    </select>
  @endif
</div>