<tr>
    <td id="sequence_name">
        {{-- Sequence Name Value --}}
        <a href="#" data-toggle="modal" data-target="#operationsDetails">
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
        RUNNING TIME
    </td>
    <td>
        {{-- Predecessor Value --}}
        {{ $predecessor->operation_name ?? "N/A" }}
    </td>
    <td>
        {{-- Planned Start Value --}}
        <div class="d-flex justify-content-center">
            <input type="datetime-local" name="planned_start[]" class="datePickers" style="width: 130px"
            value="{{ $operation->planned_start }}" @if($jobsched->js_status == "Planned") readonly @endif>
        </div>
    </td>
    <td>
        {{-- Planned End value --}}
        <div class="d-flex justify-content-center">
            <input type="datetime-local" name="planned_end[]" class="datePickers" style="width: 130px"
            value="{{ $operation->planned_end }}" @if($jobsched->js_status == "Planned") readonly @endif>
        </div>
    </td>
    <td>
        {{-- Real Start Value --}}
        <div class="d-flex justify-content-center">
            <input type="datetime-local" name="real_start[]" class="datePickers" style="width: 130px" 
            value="{{ $operation->real_start }}">
        </div>
    </td>
    <td>
        {{-- Real End --}}
        <div class="d-flex justify-content-center">
            <input type="datetime-local" name="real_end[]" class="datePickers" style="width: 130px"
            value="{{ $operation->real_end }}">
        </div>
    </td>
    <td class="js-status-td">
        {{-- Status Value --}}
        {{ isset($operation->status) ? $operation->status : "Not started" }}
    </td>
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

<div class="modal fade h-75" id="operationsDetails" tabindex="-1" role="dialog" aria-labelledby="operationsDetails"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="OperationTitle">
                    Operation Details
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <div class="row m-1">
                        <div class="col-lg-6 p-1">
                            <div class="form-group">
                                {{-- Operation Time value --}}
                                <label for="operation_time">Operation Time</label>
                                <input type="hidden" name="operation_time[]" value="${data.routingOperations[index].operation_time}">
                            </div>
                            
                        </div>
                        <div class="col-lg-5 p-1">
                            <div class="form-group">
                                {{-- Machine Code Value --}}
                                <label for="machine_code">Machine Code</label>
                                <input type="text" class="form-control" name="machine_code">
                            </div>
                        </div>
                        
                    </div>
                    <div class="row m-1">
                        <div class="col-lg-6 p-1">
                            <div class="form-group">
                                {{-- Part Code Value --}}
                                <label for="part_code">Part Code</label>
                                <input type="text" class="form-control" name="part_code">
                            </div>
                        </div>
                        <div class="col-lg-6 p-1">
                            <div class="form-group">
                                {{-- WC Type value --}}
                                <label for="wc_type">WC Type</label>
                                <input type="text" class="form-control" name="wc_type" value="{{-- {{ $operation->wc_code }} --}}">
                            </div>
                        </div>
                    </div>
                    <div class="row m-1">
                        <div class="col-lg-12 p-1">
                            <div class="row ml-1">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" name="outsourced[]">
                                </div>
                                <label for="outsourced">Outsourced</label>
                            </div>
                        </div>
                    </div>
                    <div class="row m-1">
                        <div class="col-lg-12 p-1">
                            <div class="form-group">
                                {{-- Where the status should be --}}
                                <label for="operation_status">Status</label>
                                <input type="text" class="form-control" id="operation_status" value="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>