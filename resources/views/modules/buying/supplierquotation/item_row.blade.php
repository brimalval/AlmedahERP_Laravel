<tr>
    <td>
    <div class="form-check">
        <input type="checkbox" class="form-check-input">
    </div>
    </td>
    <td>
    <div class="form-group">
        <input readonly value="{{ $item->item_code ?? '' }}" type="text"
        class="form-control" name="item_code[]" placeholder="">
    </div>
    </td>
    <td>
    <div class="form-group">
        <input readonly value="{{ $item->quantity_requested ?? '' }}" type="text"
        class="form-control" id="qty-req" name="qty_requested[]" placeholder="">
    </div>
    </td>
    <td>
    <select disabled required="true" data-id="uom_id" data-live-search="true" name="uom_id[]" class="form-control selectpicker">
        @foreach ($units as $unit)
            <option value="{{ $unit->uom_id }}" @if($unit->uom_id == ($item->item->uom_id ?? '')) selected @endif data-subtext="{{ $unit->conversion_factor }} nos. ea.">{{ $unit->item_uom }}</option>
        @endforeach
    </select>
    </td>
    <td>
    <div class="form-group">
        @if (isset($item->rate))
            <input type="number" min="0" required value="{{ $item->rate }}"
            class="form-control item-rate" name="rate[]" placeholder="₱">
        @else
            <input type="number" min="0" required value="0"
            class="form-control item-rate" name="rate[]" placeholder="₱">
        @endif
    </div>
    </td>
    <td>
    <div class="form-group">
        <input readonly type="text" value="@if(isset($item->rate)) {{ $item->rate * $item->quantity_requested }} @endif" 
        class="subtotal form-control" placeholder="">
    </div>
    </td>
</tr>