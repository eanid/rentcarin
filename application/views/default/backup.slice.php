@extends('default.layouts.master')

@section('subtitle')
Database Backup
@endsection

@section('title')
Latest Backups
@endsection

@section('content')
<div class="row row-cards">

    <div class="col-lg-3">
        <div class="card">

            <div class="card-header">
                <p class="mb-0 small">Add notes to your backup</p>
            </div>
            <div class="card-body">
                <form id="doBackup">
                    <div class="mb-3">
                        <label class="form-label">Notes</label>
                        <textarea name="backup_notes" class="form-control" placeholder="Add notes to your backup" rows="3"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Backup Now!</button>
                </form>
            </div>

        </div>
    </div>

    <div class="col-lg-9">
        <div class="card">
            <div class="table-responsive">
                <table class="table table-vcenter card-table">
                    <thead>
                        <tr>
                            <th>Note</th>
                            <th>Date</th>
                            <th>User</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($backups as $bak) : ?>
                            <?php $user = $this->ion_auth->user()->row($bak->user_id); ?>
                            <tr>
                                <td>{{ $bak->backup_notes }}</td>
                                <td>
                                    <p class="text-muted small lh-base mb-0">{{ date_format(date_create($bak->backup_date), 'j M Y') }}</p>
                                    <p class="mb-1">{{ $bak->backup_time }}</p>
                                </td>
                                <td>{{ $user->first_name }}</td>
                                <td>
                                    <div class="btn-group mb-1">
                                        <a href="{{ site_url('backups/download/'.$bak->backup_id ) }}" class="btn btn-primary btn-sm">Download</a>
                                        <a href="{{ site_url('backups/delete/'.$bak->backup_id ) }}" class="btn btn-danger btn-sm">Del</a>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
@endsection

@section('js')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
@endsection

@section('js_init')
<script>
    $(function() {
        $('#doBackup').on('submit', function(e) {
            e.preventDefault();
            var datastring = $("#doBackup").serializeArray();
            console.log(datastring);
            $.ajax({
                type: "POST",
                url: "{{ site_url('backups/backup') }}",
                data: datastring,
                dataType: "json",
                success: function(data) {
                    swal.fire({
                        title: data.response.message,
                        text: "Backup OK",
                        icon: "success",
                        onClose: function() {
                            $('#doBackup')[0].reset();
                            $(location).attr('href', '<?php echo site_url('backups') ?>')
                        }
                    })
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log(errorThrown)
                }
            });
        })
    })
</script>
@endsection