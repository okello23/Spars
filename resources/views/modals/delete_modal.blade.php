<div class="modal" id="delete_modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">Delete Confirmation</h4>
            </div>
            <div class="modal-body">
                <p>Are you sure you, want to delete?</p>
            </div>
            <div class="modal-footer">
                {{ Form::open(array('url' => '/reports/visit/delete/', 'class' => 'pull-right form-delete')) }}
                   
                    {{ Form::label('id', 'ID', ['class' => 'col-md-3 control-label hidden']) }}
                    {{ Form::text('id', null,['class' => 'hidden']) }}

                    <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-sm btn-primary" id="delete-btn">Delete</button>                
                {{ Form::close() }} 
            </div>
        </div>
    </div>
</div>