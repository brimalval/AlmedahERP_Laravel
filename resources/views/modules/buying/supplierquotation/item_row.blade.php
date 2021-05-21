<tr>
    <td>
        <div class="form-group">
            <div class="form-check">
                <input type="checkbox" class="form-check-input row-checkbox">
            </div>
        </div>
    </td>
    <td>
    <div class="form-group">
        @if (isset($item))
            <select readonly name="item_code[]" id="" 
            class="form-control selectpicker" data-live-search="true">
                <option value="{{ $item->item_code ?? '' }}" data-subtext="{{ $item->item_code ?? '' }}">
                    {{ $item->item_name }}
                </option>
            </select>
        @else
            <select name="item_code[]" id="" 
            class="form-control selectpicker" data-live-search="true">
                @foreach ($items as $mat)
                    <option value="{{ $mat->item_code }}" data-subtext="{{ $mat->item_name }}">
                        {{ $mat->item_code }}
                    </option>
                @endforeach
            </select>
        @endif
    </div>
    </td>
    <td>
    <div class="form-group">
        <input @if(isset($item)) readonly @endif value="{{ $item->quantity_requested ?? '' }}" 
        type="text" class="form-control" id="qty-req" min="1" name="qty_requested[]" placeholder="">
    </div>
    </td>
    <td>
    <select @if(isset($item)) readonly @endif required="true" data-id="uom_id" data-live-search="true" name="uom_id[]" class="form-control selectpicker">
        @foreach ($units as $unit)
            <option value="{{ $unit->uom_id }}" @if($unit->uom_id == ($item->uom_id ?? $item->item->uom_id ?? '')) selected @endif data-subtext="{{ $unit->conversion_factor }} nos. ea.">{{ $unit->item_uom }}</option>
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
    <td>
        @if (isset($deletable))
            <a href="#" class="btn btn-outline-light btn-sm delete-btn text-muted">
                <i class="fa fa-minus" aria-hidden="true"></i>
            </a>
        @endif
    </td>
</tr>