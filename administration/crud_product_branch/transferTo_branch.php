<div class="modal fade" id="transferToModal" tabindex="-1" role="dialog" aria-labelledby="transferModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="transferModalLabel">Transfer To Another Store</h5>
                <span aria-hidden="true" data-bs-dismiss="modal" aria-label="Close"><i class="bi bi-x-lg"></i></span>
            </div>

            <div>
                <i class="bi bi-question-circle float-end" style="font-size: 18px" data-bs-toggle="popover" title="Requirement:" data-bs-content="<?php echo $f_Desc1 ?>"></i>
            </div>

            <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <div class="modal-body">
                    <div class="form-group mb-3">
                        <label>From</label><span style="color: #dc3545">&nbsp;&nbsp; *<?php echo $fromErr; ?></span>
                        <select class="form-select" aria-label="from store" name="fromStoreId" id="fromStoreId">
                            <option selected value="">- Select Store -</option>
                            <?php
                            if (mysqli_num_rows($get1) > 0) {
                                foreach ($get1 as $fromStore) {
                                    ?>
                                    <option value="<?php echo $fromStore['store_id']; ?>"><?php echo $fromStore['name']; ?></option>
                                    <?php
                                }
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group mb-3">
                        <label>To</label><span style="color: #dc3545">&nbsp;&nbsp; *<?php echo $toErr; ?></span>
                        <select class="form-select" aria-label="to store" name="toStoreId" id="toStoreId">
                            <option selected value="">- Select Store -</option>
                            <?php
                            if (mysqli_num_rows($get1) > 0) {
                                foreach ($get1 as $toStore) {
                                    ?>
                                    <option value="<?php echo $toStore['store_id']; ?>"><?php echo $toStore['name']; ?></option>
                                    <?php
                                }
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group mb-3">
                        <label>Product Name</label><span style="color: #dc3545">&nbsp;&nbsp; *<?php echo $t_productErr; ?></span>
                        <select class="form-select" aria-label="Product list" name="product" id="product">
                            <option selected value="">- Select Product -</option>
                            <?php
                            if (mysqli_num_rows($get2) > 0) {
                                foreach ($get2 as $t_product) {
                                    ?>
                                    <option value="<?php echo $t_product['name']; ?>"><?php echo $t_product['name']; ?></option>
                                    <?php
                                }
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group mb-3">
                        <label>Quantity</label><span style="color: #dc3545">&nbsp;&nbsp; *<?php echo $quantityErr; ?></span>
                        <input type="number" min="0" class="form-control" name="transferQuantity">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-danger" name="transfer_product_branch">Confirm Transfer</button>
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
