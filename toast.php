<?php 
    $x = __FILE__;
    $x = explode(DIRECTORY_SEPARATOR, $x);
    $ihtdocs = -1;
    $ifooter = -1;
    $addpath = "";
    for ($i = 0; $i < count($x); $i++) {
        //echo $i . " " . $x[$i] . ", ";
        if ($x[$i] == "htdocs") {
            $ihtdocs = $i;
        }
        if ($x[$i] == "toast.php") {
            $ifooter = $i;
        }
    }
    //echo $ihtdocs . " " . $ifooter;
    for ($i = $ihtdocs + 1; $i < $ifooter; ++$i) {
        $addpath = $addpath . "/" . $x[$i];
    }
    //echo $addpath;
    //echo $addpath . "/consumer/landingPage.php";
?>

<div class="toast-container position-fixed bottom-0 end-0 p-3">
    <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header">
        <?php echo '<img src="' . $addpath . '/consumer/images/help.png" class="rounded me-2" alt="..." height="20px"><br>' ?>
        <strong class="me-auto">Do you need any help?</strong>
        <small>10 seconds ago</small>
        <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body">
            Our professional team is ready to help you, click on this pop-up to start a talk.
        </div>
    </div>
</div>
<script>
    var toastTrigger = document.getElementById('liveToastBtn')
    var toastLiveExample = document.getElementById('liveToast')
        toastBootstrap = bootstrap.Toast.getOrCreateInstance(toastLiveExample)
    toastBootstrap.show();
</script>