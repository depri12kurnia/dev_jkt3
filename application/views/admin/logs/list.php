<div class="table-responsive mailbox-messages">
    <table id="data_logs" class="display table table-bordered small" cellspacing="0" width="100%">
        <thead>
            <tr class="bg-info">
                <th>#</th>
                <th>timestamp</th>
                <th>ip_address</th>
                <th>user_agent</th>
                <th>uri</th>
                <th>method</th>
                <th>message</th>
            </tr>
        </thead>
        <tbody>
            <!--Content datatables-->

        </tbody>
    </table>
</div>
<script type="text/javascript">
    // var reg_table;
    var base_url = '<?php echo base_url(); ?>';

    $(document).ready(function() {
        var csrfName = '<?php echo $this->security->get_csrf_token_name(); ?>';
        var csrfHash = '<?php echo $this->security->get_csrf_hash(); ?>';

        $.ajaxSetup({
            data: {
                [csrfName]: csrfHash
            }
        });
        //datatables
        $('#data_logs').DataTable({

            "processing": true, //Feature control the processing indicator.
            "serverSide": true, //Feature control DataTables' server-side processing mode.
            "searching": true,
            "paging": true,
            "pages": 10,

            // Load data for the table's content from an Ajax source
            "ajax": {
                "url": "<?= base_url() ?>admin/log/getDataAll",
                "type": "POST",
                "data": function(data) {
                    data.id = $('#id').val();
                }
            },

        });
    });
</script>