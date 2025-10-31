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
                data: function(d) {
                    d[csrfName] = csrfHash; // Add CSRF token to request data
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

    function delete_logs() {
        if (confirm('Are you sure delete this data?')) {
            $.ajax({
                url: "<?php echo site_url('admin/logs/delete_all_logs') ?>",
                type: "POST",
                data: {
                    csrf_token_jkt3: getCsrfToken()
                },
                success: function(data, textStatus, jqXHR) {
                    try {
                        // Try to parse as JSON first
                        let jsonData = typeof data === 'string' ? JSON.parse(data) : data;
                        if (jsonData && jsonData.status) {
                            reload_table();
                            alert('Logs deleted successfully!');
                            // Update CSRF token if provided
                            if (jsonData.csrf_token) {
                                document.cookie = "csrf_cookie_jkt3=" + jsonData.csrf_token + "; path=/";
                            }
                        } else {
                            alert('Failed to delete logs: ' + (jsonData && jsonData.message ? jsonData.message : 'Unknown error'));
                        }
                    } catch (e) {
                        // If JSON parsing fails, treat as plain text response
                        if (typeof data === 'string' && data.includes('Deleted')) {
                            reload_table();
                            alert(data); // Show the server message
                        } else {
                            alert('Logs operation completed, but response format was unexpected.');
                            reload_table(); // Still reload the table
                        }
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    let msg = 'Error deleting data';
                    if (jqXHR.responseText) {
                        msg += ':\n' + jqXHR.responseText;
                    }
                    alert(msg);
                }
            });
        }
    }

    function getCSRFToken() {
        return {
            [csrfName]: csrfHash
        };
    }
</script>