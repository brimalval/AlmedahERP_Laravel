<div class="d-flex align-items-start">
    <!-- message header/title -->
    <div class="nav flex-column nav-pills me-3 message-list-body col-sm-3" id="v-pills-tab" role="tablist" aria-orientation="vertical">
        <form action="">
            <input class="form-control" list="datalistOptions" id="exampleDataList" placeholder="Type to search...">
        </form>
        <?php
        date_default_timezone_set("Asia/Hong_Kong");
        $message = "Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem.Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem.Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem."; //variable for the message
        $subject = "Message Subject"; //variable for the subject
        $from = "Juan Dela Cruz"; //variable for the sender or from
        $date = date("M d, Y, h:i a"); //date placeholder
        $subTemp = $subject;
        // if the subject or sender is longer than 12, turn the remaining characters into ellipsis
        for ($i = 1; $i < 6; $i++) {
            // appends number just to lengthen the subject characters
            $xsub = strlen($subject) > 14 ? substr($subject . $i, 0, 12) . "..." : $subject;
            echo "<a class='nav-link m-list' id='v-pills-message-tab' data-bs-toggle='pill' href='#v-pills-message" . $i . "' role='tab' aria-controls='v-pills-message" . $i . "' aria-selected='false'><p class='message-sender'>" . $from . "</p>" . $xsub . "<i class='far fa-star' onclick='makeImportant(this)';'></i></a>";
            $xsub = $subject;
        }
        ?>

    </div>
    <!-- message content -->
    <div class="tab-content message-body" id="v-pills-tabContent">
        <?php

        for ($i = 1; $i < 6; $i++) {
            // may or may not be editted by WYSIWYG, hence there's no definitive message format
            echo "<div class='tab-pane fade' id='v-pills-message" . $i . "' role='tabpanel' aria-labelledby='v-pills-settings-tab'><div class='dropdown'>
                <i class='fas fa-ellipsis-h btn' data-toggle='dropdown'></i>
                <div class='dropdown-menu' aria-labelledby='dropdownMenuButton'>
                <a class='dropdown-item' onclick='makeImportant();'>Mark as Important</a>
                <a class='dropdown-item' onclick='archiveMsg();'>Archive</a>
                <a class='dropdown-item text-danger' onclick='deleteMsg();'>Delete</a>
                </div>
                </div><br><h1>" . $subject . " " . $i . "</h2><br><h5>by " . $from . "<br>" . $date . "</h5><br> " . $message . "<br><br><br><br><div class='d-flex justify-content-center'><i class='fas fa-backward'></i><i class='fas fa-forward'></i></div></div>";
        }
        ?>
    </div>
</div>

<script src="js/inbox.js"></script>