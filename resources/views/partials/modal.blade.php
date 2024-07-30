<div class="modal" id="modal">
    <div class="modal-dialog">
        <div class="modal-content rounded-3 shadow">
            <div class="modal-body p-4 text-center">
                <p class="mb-0">L'eliminazione sarà irreversibile, sei sicuro?</p>
            </div>
            <div class="my-modal-footer p-2 d-flex w-100">
                @if (Route::currentRouteName() == 'admin.projects.index')
                <form action="{{route('admin.projects.destroy', $project)}}" method="POST" class="col-6">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-lg btn-link fs-6 text-decoration-none py-3 m-0 rounded-0 border-end w-100"><strong>Si, continua</strong></button>
                </form>
                @elseif (Route::currentRouteName() == 'admin.types.index')
                <form action="{{route('admin.types.destroy', $type)}}" method="POST" class="col-6">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-lg btn-link fs-6 text-decoration-none py-3 m-0 rounded-0 border-end w-100"><strong>Si, continua</strong></button>
                </form>
                @endif
                <button id="close" class="btn btn-lg btn-link fs-6 text-decoration-none col-6 py-3 m-0 rounded-0">Annulla</button>
            </div>
        </div>
    </div>
</div>