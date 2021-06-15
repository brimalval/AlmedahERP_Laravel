<tr>
    <td id="sequence_name">
        {{-- Sequence Name Value --}}
        Sequence {{ $index }}
    </td>
    <td>
        {{-- Operation Name Value --}}
        {{ $operation->operation_name }}
        <input type="hidden" name="operation_id[]" value="{{ $operation->operation_id }}"> 
    </td>
    <td>
        {{-- Operation Time Value --}}
        Placeholder
        <input type="hidden" name="operation_time[]" value="${data.routingOperations[index].operation_time}">
    </td>
    <td>
        {{-- Predecessor Value --}}
        {{ $predecessor->operation_name ?? "N/A" }}
    </td>
    <td>
        {{-- Machine Code Value --}}
        
    </td>
    <td>
        {{-- WC_Type value --}}
        {{ $operation->wc_code }}
    </td>
    <td class="d-flex align-items-center justify-content-center">
        {{-- Outsourced Value --}}

        <div class="form-check ">
            <input type="checkbox" name="outsourced[]" class="form-check-input">
        </div>


    </td>
    <td class="p-3">
        {{-- Planned Start Value --}}
        <input class="form-control form-control-sm" type="text" name="planned_start[]" value="{{ $operation->planned_start }}" @if($jobsched->js_status == "Planned") readonly @endif>
    </td>
    <td class="p-3">
        {{-- Planned End Value --}}
        <input class="form-control form-control-sm" type="text" name="planned_end[]" value="{{ $operation->planned_end }}" @if($jobsched->js_status == "Planned") readonly @endif>
    </td>
    <td class="p-3">
        {{-- Real Start Value --}}
        <input class="form-control form-control-sm" type="text" name="real_start[]" value="{{ $operation->real_start }}">
    </td>
    <td class="p-3">
        {{-- Real End Value --}}
        <input class="form-control form-control-sm" type="text" name="real_end[]" value="{{ $operation->real_end }}">
    </td>
    <td class="js-status-td">
        {{-- Status Value --}}
        {{ isset($operation->status) ? $operation->status : "Not started" }}
    </td>
    {{-- <td> --}}
        {{-- Quantity Finished --}}

    {{-- </td> --}} 
    {{-- Action Buttons --}}
    <td>
        <a href="" @if($jobsched->js_status != "In Progress") onclick="return false" @else onclick="startOperation(this); return false;" @endif class="operation-play-btn">
            <i class="fas fa-play"></i>
        </a>
    </td>
    <td>
        <a href="" @if($jobsched->js_status != "In Progress") onclick="return false"  @else onclick="pauseOperation(this); return false;" @endif class="operation-pause-btn">
            <i class="fas fa-pause"></i>
        </a>
    </td>
    <td>
        <a href="" @if($jobsched->js_status != "In Progress") onclick="return false"  @else onclick="finishOperation(this); return false;" @endif class="operation-stop-btn">
            <i class="fas fa-power-off"></i>
        </a>
    </td>
</tr>