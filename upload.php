<?php
require_once("includes/header.php");
require_once("includes/classes/VideoDetailFormProvider.php");
?>


<div class="column">

    <?php
    $formProvider = new VideoDetailFormProvider($con);
    echo $formProvider->createUploadForm();
    ?>


</div>

<script>
    $("form").submit(function() {
        $("#loadingModal").modal("show");
    });
</script>



<div class="modal fade" id="loadingModal" tabindex="-1" role="dialog" aria-labelledby="loadingModal" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">

            <div class="modal-body">
                Please wait. This might take a while.
                <img src="https://img.icons8.com/ios/50/000000/fidget-spinner--v2.png"/>
            </div>

        </div>
    </div>
</div>




<?php require_once("includes/footer.php"); ?>







