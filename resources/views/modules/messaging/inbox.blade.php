<div class="row">
    <div class="col-12 d-flex align-items-center">
        <div>
            <div class="dropdown w-100">
                <button class="btn border border-secondary dropdown-toggle" type="button" id="dropdownMenuButton"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span id="msg-group" val="0" class="sm-text">All Messages</span>
                </button>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                    <li><a class="dropdown-item sm-text" href="#" id="empty-val">All Messages</a></li>
                    <li class="dropdown-submenu">
                        <a class="dropdown-item dropdown-toggle sm-text" href="#">Departments</a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">Sales Group</a></li>
                            <li><a class="dropdown-item" href="#">Marketing Group</a></li>
                            <li><a class="dropdown-item" href="#">Manufacturing Group</a></li>
                        </ul>
                    </li>
                    <li class="dropdown-submenu">
                        <a class="dropdown-item dropdown-toggle sm-text" href="#">Role Groups</a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">Assembler</a></li>
                            <li><a class="dropdown-item" href="#">Role 1</a></li>
                            <li><a class="dropdown-item" href="#">Role 2</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
        <div class="ml-auto d-flex align-items-center">
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-md border border-secondary msg-modal-btn">
                <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
            </button>
            <div class="btn-group btn-group-md ml-1" role="group" aria-label="Basic example">
                <a type="button" class="btn border border-secondary msg-modal-btn">
                    <i class="fa fa-reply" aria-hidden="true"></i>
                </a>
                <a type="button" class="btn border border-secondary msg-modal-btn">
                    <i class="fa fa-reply-all" aria-hidden="true"></i>
                </a>
                <a type="button" class="btn border border-secondary" onclick="archiveMsg();">
                    <i class="fa fa-archive" aria-hidden="true"></i>
                </a>
                <a type="button" class="btn border border-secondary" onclick="deleteMsg()">
                    <i class="fa fa-trash" aria-hidden="true"></i>
                </a>
            </div>
            <div>
                <a class="nav-link dropdown-toggle mx-1" type="button" href="#" id="msgDropdown" title="More Actions"
                    data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fa fa-cog" aria-hidden="true"></i>
                </a>
                <ul class="dropdown-menu" aria-labelledby="msgDropdown">
                    <li><a class="dropdown-item" href="#">Replay all</a></li>
                    <li><a class="dropdown-item" href="#">Forward</a></li>
                    <li><a class="dropdown-item" href="#">Archive</a></li>
                    <li><a class="dropdown-item" href="#">Star</a></li>
                    <li><a class="dropdown-item" href="#">Delete</a></li>
                </ul>
            </div>

            <div class="input-group input-group-sm my-3">
                <input type="text" class="form-control">
                <div class="input-group-prepend">
                    {{-- <button class="btn btn-sm border px-4">
                        <i class="fa fa-user-circle-o" aria-hidden="true"></i>
                    </button> --}}
                </div>
            </div>

        </div>
    </div>
</div>
<div class="row">
    <div id="inbox-nav" class="col-lg-4 col-md-4 p-1">
        @forelse($chats as $chat)
            <div class="d-flex w-100 main-item" data-id="{{ $chat->id }}">
                <div class="inbox-item p-3  w-100">
                    <div class="row content">
                        <div class="col d-flex flex-column">
                            <div class="d-flex">
                                <div class="p-2 inbox-selector">
                                    <input class="form-check my-1" type="checkbox" id="blankCheckbox" value="option1"
                                        aria-label="...">
                                </div>
                                <div class="p-2 text-primary">
                                    {{ $chat->created_at->setTimezone('Asia/Singapore')->format('M j, Y') }}
                                </div>
                                <div class="ml-auto px-2 c-py bg-dark rounded d-none align-items-center">
                                    <span class="msg-notif" style="color:white">1</span>
                                </div>
                            </div>
                            <div class="d-flex">
                                <div class="p-2 inbox-selector" style="visibility:hidden">
                                    <input class="form-check my-1" type="radio" id="blankCheckbox" value="option1"
                                        aria-label="...">
                                </div>
                                <div class="col-12 p-2 d-flex flex-column">
                                    <strong
                                        class="limit-text">{{ strtoupper($chat->created_by) }}{{ '' }}@if (count(json_decode($chat->recipients)) != 0){{ ', ' }}@endif{{ '' }}{{ join(', ', json_decode($chat->recipients)) }}
                                    </strong>
                                    <div class="limit-text">{{ $chat->subject }}</div>
                                    <div class="d-flex w-90">
                                        <div class="limit-text" id="message-preview-{{ $chat->id }}">
                                            {!! $chat->messages[count($chat->messages) - 1]->message !!}</div>
                                        <div class="ml-auto mr-4 star-icon">
                                            <i class='far fa-star'></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="sep" style="width:3px;">
                    &nbsp;
                </div>
            </div>
        @empty
            <p>No chats available</p>
        @endforelse
    </div>
    <div class="col-lg-8 col-md-8 col-sm-12">
        {{-- If there are is no selected message --}}
        <div class="msg-content">
            <div class="d-flex justify-content-center mt-5">
                <h1>No Messages Selected</h1>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="messageModal" tabindex="-1" role="dialog" aria-labelledby="messageModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="messageModalLabel">Compose Message</h5>
                <button type="button" class="close msg-modal-close-btn" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body px-4">
                <form action="{{ route('message.store') }}" method="POST" id="messaging-form">
                    @csrf
                    <input type="hidden" name="chat_id" id="chat_id">
                    <div class="row">
                        <div class="col-12">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <label class="input-group-text" for="msg-department">Group</label>
                                </div>
                                <div class="dropdown">
                                    <button class="btn border border-secondary dropdown-toggle" type="button"
                                        id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                        aria-expanded="false">
                                        <span id="msg-group" val="0" class="sm-text msg-grp-lbl">Select Department or
                                            Role
                                            group</span>
                                    </button>
                                    <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                        <li><a class="dropdown-item sm-text" href="#" id="empty-val">Select Department
                                                or
                                                Role
                                                group</a></li>
                                        <li class="dropdown-submenu">
                                            <a class="dropdown-item dropdown-toggle sm-text" href="#">Departments</a>
                                            <ul class="dropdown-menu">
                                                <li><a class="dropdown-item sm-text dept" href="#">Sales Group</a></li>
                                                <li><a class="dropdown-item sm-text dept" href="#">Marketing Group</a>
                                                </li>
                                                <li><a class="dropdown-item sm-text dept" href="#">Manufacturing
                                                        Group</a>
                                                </li>
                                            </ul>
                                        </li>
                                        <li class="dropdown-submenu">
                                            <a class="dropdown-item dropdown-toggle sm-text" href="#">Role Groups</a>
                                            <ul class="dropdown-menu">
                                                <li><a class="dropdown-item sm-text" href="#">Assembler</a></li>
                                                <li><a class="dropdown-item sm-text" href="#">Role 1</a></li>
                                                <li><a class="dropdown-item sm-text" href="#">Role 2</a></li>
                                            </ul>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row" id="row-to">
                        <div class="col-12">
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" placeholder="To..."
                                    title="The recipient of the message" id="msg-to">
                                <button type="button" id="add-recipient-btn">Add Recipient</button>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" name="subject" placeholder="Subject..."
                                    title="Subject of the message">
                            </div>
                        </div>
                    </div>
                    <div class="row" id="checkbox-individual-messages">
                        <div class="col-12">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="individual_messages"
                                    name="individual_messages">
                                <label for="individual_messages">Send an individual message to each recipient</label>
                            </div>
                        </div>
                    </div>
                    <div id="msg-body"></div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary msg-modal-close-btn">Close</button>
                <button type="button" id="message-save-btn" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>

<div id="component-storage" style="display:none">
    <!-- Sample content for message details -->
    <div class="msg-header p-2 d-flex">
        <div>
            <h1 class="msg-subject">Message Subject</h1>
        </div>
        <div class="ml-auto d-flex align-items-center">
            <button style="color:black" class="mx-1 rounded reply-btn" title="Reply">
                <div class="p-2">
                    <i class="fa fa-reply"></i>
                </div>
            </button>
            <a class="nav-link dropdown-toggle mx-1" href="#" id="msgDropdown" title="More Actions"
                data-bs-toggle="dropdown" aria-expanded="false">
                <i class="fa fa-cog" aria-hidden="true"></i>
            </a>
            <ul class="dropdown-menu" aria-labelledby="msgDropdown">
                <li><a class="dropdown-item" href="#">Replay all</a></li>
                <li><a class="dropdown-item" href="#">Forward</a></li>
                <li><a class="dropdown-item" href="#">Archive</a></li>
                <li><a class="dropdown-item" href="#">Star</a></li>
                <li><a class="dropdown-item" href="#">Delete</a></li>
            </ul>
        </div>
    </div>
    <hr>
    <div class="msg-thread-item">
        <div class="row my-2">
            <div class="col-2 mx-0 px-1 d-flex justify-content-end">
                <img src="https://via.placeholder.com/80" class="rounded-circle mr-1 img-fluid p-0" alt="">
            </div>
            <div class="col-6 pl-0 ml-0 d-flex flex-column mt-3 align-content-center">
                <div>
                    <p><strong class="limit-text msg-body-sender"></strong></p>
                </div>
            </div>
            <div class="col-4 align-content-end d-flex flex-column align-content-center mt-3">
                <span class="msg-body-sent"></span>
                <div class="ml-auto d-flex align-items-center py-0">
                    <a href="#" style="color:black" class="mx-1 rounded reply-btn" title="Reply">
                        <div class="p-2">
                            <i class="fa fa-reply"></i>
                        </div>
                    </a>
                    <a class="nav-link dropdown-toggle mx-1 py-0" href="#" id="navbarDropdownMenuLink" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false" title="More Actions">
                        <i class="fa fa-cog" aria-hidden="true"></i>
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <li><a class="dropdown-item" href="#">Replay all</a></li>
                        <li><a class="dropdown-item" href="#">Forward</a></li>
                        <li><a class="dropdown-item" href="#">Delete</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="msg-body my-3">
            {{-- WYSIWYG content --}}
            Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean
            massa.
            Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam
            felis,
            ultricies nec, pellentesque eu, pretium quis, sem.Lorem ipsum dolor sit amet, consectetuer
            adipiscing
            elit.
            Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis
            parturient
            montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis,
            sem.Lorem
            ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa.
            Cum
            sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis,
            ultricies nec, pellentesque eu, pretium quis, sem. Lorem ipsum dolor sit amet, consectetuer
            adipiscing
            elit.
            Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis
            parturient
            montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem.
        </div>
    </div>
    <hr>
    <!-- Chat Item -->
    <div class="d-flex w-100 main-item">
        <div class="inbox-item p-3  w-100">
            <div class="row content">
                <div class="col d-flex flex-column">
                    <div class="d-flex">
                        <div class="p-2 inbox-selector">
                            <input class="form-check my-1" type="checkbox" id="blankCheckbox" value="option1"
                                aria-label="...">
                        </div>
                        <div class="p-2 text-primary created-at">
                        </div>
                        <div class="ml-auto px-2 c-py bg-dark rounded d-none align-items-center">
                            <span class="msg-notif" style="color:white">1</span>
                        </div>
                    </div>
                    <div class="d-flex">
                        <div class="p-2 inbox-selector" style="visibility:hidden">
                            <input class="form-check my-1" type="radio" id="blankCheckbox" value="option1"
                                aria-label="...">
                        </div>
                        <div class="col-12 p-2 d-flex flex-column">
                            <strong class="limit-text created-by">
                            </strong>
                            <div class="limit-text subject"></div>
                            <div class="d-flex w-90">
                                <div class="limit-text msg-body"></div>
                                <div class="ml-auto mr-4 star-icon">
                                    <i class='far fa-star'></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="sep" style="width:3px;">
            &nbsp;
        </div>
    </div>
</div>

<script src="js/inbox.js"></script>

<script src="js/communications/inbox.js">
    // This JS file was compiled using Webpack
    // Use NPM run dev
</script>
