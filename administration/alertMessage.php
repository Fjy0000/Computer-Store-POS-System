<?php
if (isset($_SESSION['message'])):
    ?>

    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong><?php echo $_SESSION['message']; ?></strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>

    <?php
    unset($_SESSION['message']);
endif;
?>