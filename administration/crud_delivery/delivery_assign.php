
<div class="modal fade" id="deliveryModal" tabindex="-1" role="dialog" aria-labelledby="deliveryModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deliveryModalLabel">Delivery Manage</h5>
                <span aria-hidden="true" data-bs-dismiss="modal" aria-label="Close"><i class="bi bi-x-lg"></i></span>
            </div>
            <div>
                <i class="bi bi-question-circle float-end" data-bs-toggle="popover" title="Requirement:" data-bs-content="<?php echo $f_Desc1; ?>"></i>
            </div>
            <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <div class="modal-body">
                    <div class="form-group mb-3">
                        <label>Order ID</label><span class="text-danger">&nbsp;&nbsp; * &nbsp;<?php echo $id_error; ?></span>
                        <select class="form-select" aria-label="order list" name="order_id" id="order_id">
                            <option selected value="">- Select Order ID -</option>
                            <?php
                            if (mysqli_num_rows($result) > 0) {
                                foreach ($result as $order) {
                                    ?>
                                    <option value="<?php echo $order['id']; ?>"><?php echo $order['id']; ?></option>
                                    <?php
                                }
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group mb-3">
                        <label>Store To Send</label><span class="text-danger">&nbsp;&nbsp; * &nbsp;<?php echo $store_send_error; ?></span>
                        <select class="form-select" aria-label="store list" name="store_send" id="store_send">
                            <option selected value="">- Select Store -</option>
                            <?php
                            if (mysqli_num_rows($result1) > 0) {
                                foreach ($result1 as $store) {
                                    ?>
                                    <option value="<?php echo $store['name']; ?>"><?php echo $store['name']; ?></option>
                                    <?php
                                }
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group mb-3">
                        <label>Delivery Status</label><span class="text-danger">&nbsp;&nbsp; * &nbsp;<?php echo $delivery_status_error; ?></span>
                        <select class="form-select" aria-label="delivery list" name="delivery" id="delivery">
                            <option selected value="">- Select Delivery Status -</option>
                            <option value="Packaging">Packaging</option>
                            <option value="Delivering">Delivering</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" name="assign_delivery">Confirm</button>
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
