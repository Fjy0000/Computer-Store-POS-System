<div class="modal fade" id="removeModal" tabindex="-1" role="dialog" aria-labelledby="removeModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="removeModalLabel">Remove Product Quantity</h5>
                <span aria-hidden="true" data-bs-dismiss="modal" aria-label="Close"><i class="bi bi-x-lg"></i></span>
            </div>

            <div>
                <i class="bi bi-question-circle float-end" style="font-size: 18px" data-bs-toggle="popover" title="Requirement:" data-bs-content="<?php echo $questionStr ?>"></i>
            </div>

            <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <div class="modal-body">
                    <span style="color: #dc3545"><?php echo $checkError; ?></span>
                    <div class="form-group mb-3">
                        <label>Store</label><span style="color: #dc3545">&nbsp;&nbsp; *<?php echo $r_store_id_Err; ?></span>
                        <select class="form-select" aria-label="store" name="r_store_id" id="r_store_id">
                            <option selected value="">- Select Store -</option>
                            <?php
                            if (mysqli_num_rows($get1) > 0) {
                                foreach ($get1 as $get_store) {
                                    ?>
                                    <option value="<?php echo $get_store['store_id']; ?>"><?php echo $get_store['name']; ?></option>
                                    <?php
                                }
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group mb-3">
                        <label>Product</label><span style="color: #dc3545">&nbsp;&nbsp; *<?php echo $r_product_name_Err; ?></span>
                        <select class="form-select" aria-label="product" name="r_product_name" id="r_product_name">
                            <option selected value="">- Select Product -</option>
                            <?php
                            if (mysqli_num_rows($get2) > 0) {
                                foreach ($get2 as $get_product) {
                                    ?>
                                    <option value="<?php echo $get_product['name']; ?>"><?php echo $get_product['name']; ?></option>
                                    <?php
                                }
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group mb-3">
                        <label>Reason</label><span style="color: #dc3545">&nbsp;&nbsp; *<?php echo $reasonErr; ?></span>
                        <textarea class="form-control" name="reason"></textarea>
                    </div>
                    <div class="form-group mb-3">
                        <label>Quantity</label><span style="color: #dc3545">&nbsp;&nbsp; *<?php echo $r_quantity_Err; ?></span>
                        <input type="number" min="0" class="form-control" name="r_quantity">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-danger" name="create_removeDetails">Confirm Remove</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    //popover
    var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'));
    var popoverList = popoverTriggerList.map(function (t) {
        return new bootstrap.Popover(t);
    });
</script>