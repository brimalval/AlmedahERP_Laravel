<tr>
    <td id="sequence_name">
        {{-- Sequence Name Value --}}
        <a href="#" class="operationName" data-id="{{ $operation->operation_id }}">
            Sequence {{ $index }}
        </a>
    </td>
    <td>
        {{-- Operation Name Value --}}
        {{ $operation->operation_name }}
        <input type="hidden" name="operation_id[]" value="{{ $operation->operation_id }}">
    </td>
    <td>
        {{-- RUNNING TIME Value --}}
        @if(isset($operation->running_time))
            {{ $operation->running_time }}
            <input type="hidden" name="running_time[]" value="{{ $operation->running_time }}">
        @endif
    </td>
    <td>
        {{-- Predecessor Value --}}
        {{ $predecessor->operation_name ?? "N/A" }}
    </td>
    <td>
        {{-- Planned Start Value --}}
        <div class="d-flex justify-content-center">
            <input type="datetime-local" name="planned_start[]" class="datePickers" style="width: 130px"
            value="{{ $operation->planned_start }}" @if($jobsched->js_status != "Draft") readonly @endif>
        </div>
    </td>
    <td>
        {{-- Planned End value --}}
        <div class="d-flex justify-content-center">
            <input type="datetime-local" name="planned_end[]" class="datePickers" style="width: 130px"
            value="{{ $operation->planned_end }}" @if($jobsched->js_status != "Draft") readonly @endif>
        </div>
    </td>
    <td>
        {{-- Real Start Value --}}
        <div class="d-flex justify-content-center">
            <input type="datetime-local" name="real_start[]" class="datePickers" style="width: 130px" 
            value="{{ isset($operation->real_start) ? $operation->real_start : "" }}" readonly>
        </div>
    </td>
    <td>
        {{-- Real End --}}
        <div class="d-flex justify-content-center">
            <input type="datetime-local" name="real_end[]" class="datePickers" style="width: 130px"
            value="{{  isset($operation->real_end) ? $operation->real_end : ""  }}" readonly>
        </div>
    </td>
    <td class="js-status-td">
        {{-- Status Value --}}
        {{ isset($operation->status) ? $operation->status : "Not started" }}
    </td>
    {{-- Action Buttons --}}
    <td>
        <a href="" @if($jobsched->js_status != "In Progress") onclick="notStartedWarning(); return false" @else onclick="startOperation(this); return false;" @endif class="operation-play-btn">
            <i class="fas fa-play"></i>
        </a>

    </td>
    <td>
        <a href="" @if($jobsched->js_status != "In Progress") onclick="notStartedWarning(); return false"  @else onclick="pauseOperation(this); return false;" @endif class="operation-pause-btn">
            <i class="fas fa-pause"></i>
        </a>
    </td>
    <td>
        <a href="" @if($jobsched->js_status != "In Progress") onclick="notStartedWarning(); return false"  @else onclick="finishOperation(this); return false;" @endif class="operation-stop-btn">
            <i class="fas fa-power-off"></i>
        </a>
    </td>
</tr>