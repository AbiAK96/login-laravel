// public/js/batch-scripts.js

$(function() {
    var table = $('.batch-list').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('batch.index') }}",
        columns: [
            { data: 'DT_RowIndex', name: 'No', searchable: false },
            { data: 'batch', name: 'batch' },
            { data: 'actions', name: 'actions' },
        ]
    });

    $(document).on('click', '.edit-btn', function(e) {
        e.preventDefault();

        var batchId = $(this).data('batch-id');

        $.ajax({
            type: 'GET',
            url: '/batch/edit/' + batchId,
            success: function(response) {
                $('#batchEditor').empty();
                $('#batchEditor').append(response.modalContent);
                $('#editBatch').modal('show');
            },
            error: function() {
                // Handle error if needed
            }
        });
    });

    $(document).on('click', '.data-delete', function() {
        dataTable = $('#batch-list').DataTable();
        var url = $(this).data('url');
        var csrf_token = $(this).data('csrf');

        Swal.fire({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#34c38f",
            cancelButtonColor: "#f46a6a",
            confirmButtonText: "Yes, delete it!"
        }).then(function(result) {
            if (result.value) {
                // Send the delete request
                $.ajax({
                    url: url,
                    type: 'delete',
                    headers: { 'X-CSRF-TOKEN': csrf_token },
                    success: function(response) {
                        Swal.fire({
                            title: 'Deleted!',
                            text: response.message,
                            icon: 'success',
                        }).then(function() {
                            dataTable.ajax.reload();
                        });
                    },
                    error: function(xhr, status, error) {
                        Swal.fire({
                            title: 'Error!',
                            text: 'Delete failed',
                            icon: 'error',
                        });
                    }
                });
            } else if (result.dismiss === Swal.DismissReason.cancel) {
                Swal.fire({
                    title: 'Cancelled',
                    text: '',
                    icon: 'error',
                });
            }
        });
    });
});
