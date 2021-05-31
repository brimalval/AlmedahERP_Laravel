<tr>
    <td>
        {{-- Sequence Name Value --}}
        Sequence {{ $index }}
    </td>
    <td>
        {{-- Operation Name Value --}}
        {{ $operation->operation_name }}
        <input type="hidden" name="operation_id[]" value="${operation.operation_id}"> 
    </td>
    <td>
        {{-- Operation Time Value --}}
        Placeholder
        <input type="hidden" name="operation_time[]" value="${data.routingOperations[index].operation_time}">
    </td>
    <td>
        {{-- Predecessor Value --}}
        {{-- {{ $predecessor ?? "N/A" }} --}}
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
            <input type="checkbox" class="form-check-input">
        </div>


    </td>
    <td class="p-3">
        {{-- Planned Start Value --}}
        <input class="form-control form-control-sm" type="text" name="planned_start[]" value="{{ $operation->planned_start }}">
    </td>
    <td class="p-3">
        {{-- Planned End Value --}}
        <input class="form-control form-control-sm" type="text" name="planned_end[]" value="{{ $operation->planned_end }}">
    </td>
    <td class="p-3">
        {{-- Real Start Value --}}
        <input class="form-control form-control-sm" type="text" name="real_start[]" value="{{ $operation->real_start }}">
    </td>
    <td class="p-3">
        {{-- Real End Value --}}
        <input class="form-control form-control-sm" type="text" name="real_end[]" value="{{ $operation->real_end }}">
    </td>
    <td>
        {{-- Status Value --}}
        {{ ($operation->real_end == "") ? "Unfinished" : "Completed" }}
    </td>
    <td>
        {{-- Quantity Finished --}}

    </td>
    {{-- Action Buttons --}}
    <td>
        <a href="javascript:void(0)" @if($jobsched->js_status != "In Progress") onclick="return false" @endif class="operation-play-btn">
            <i class="fas fa-play"></i>
        </a>
    </td>
    <td>
        <a href="javascript:void(0)" @if($jobsched->js_status != "In Progress") onclick="return false" @endif class="operation-pause-btn">
            <i class="fas fa-pause"></i>
        </a>
    </td>
    <td>
        <a href="javascript:void(0)" @if($jobsched->js_status != "In Progress") onclick="return false" @endif class="operation-stop-btn">
            <i class="fas fa-power-off"></i>
        </a>
    </td>
</tr>