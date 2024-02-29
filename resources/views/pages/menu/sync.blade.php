<div id="bank-create" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form method="POST" action="{!! route('menu-all.sync') !!}">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myModalLabel">Sync</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mt-3">
                        <label for="name" class="form-label">Category</label>
                        {!! Form::select('category', $categories, null, [
                            'class' => 'form-control select2',
                            'maxlength' => 191,
                            'required' => 'required',
                            ]) !!}
                        <span class="invalid-feedback" role="alert"><strong id="name_error_mg"></strong></span>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary waves-effect" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary waves-effect waves-light">Sync</button>
                </div>
            </div>
        </form>
    </div>
</div>
