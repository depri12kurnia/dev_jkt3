<div class="row">
    <div class="col-12">
        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">Data Logs</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table id="data_logs" class="table table-bordered table-hover small">
                    <input type="text" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                    <thead>
                        <tr>
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

                    </tbody>
                    <tfoot>
                        <tr>
                            <th>#</th>
                            <th>timestamp</th>
                            <th>ip_address</th>
                            <th>user_agent</th>
                            <th>uri</th>
                            <th>method</th>
                            <th>message</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <!-- /.col -->
</div>

<script type="text/javascript">
    // var reg_table;
    var base_url = '<?php echo base_url(); ?>';
    var csrfName = '<?php echo $this->security->get_csrf_token_name(); ?>';
    var csrfHash = '<?php echo $this->security->get_csrf_hash(); ?>';

    $(document).ready(function() {
        
        $.ajaxSetup({
            headers: {
                'X-CSRF-Token': csrfHash
            }
        });
        
        //datatables
        $('#data_logs').DataTable({
            
             processing: true,
             serverSide: true,
             searching: true,
             pages: 10,
             ajax: {
                url: '<?= base_url() ?>admin/logs/getDataAll',
                type: 'POST',
                data: function (d) {
                    d[csrfName] = csrfHash;  // Add CSRF token to request data
                }
            }

            // "processing": true, 
            // "serverSide": true,
            // "searching": true,
            // "paging": true,
            // "pages": 10,

            // "ajax": {
            //     "url": "<?= base_url() ?>admin/logs/getDataAll",
            //     "type": "POST",
            //     "data": function(d) {
            //       d[csrfName]: csrfHash
            //     }
            // }

        });
    });
    
    function getCSRFToken() {
        return {
            [csrfName]: csrfHash
        };
    }
</script>