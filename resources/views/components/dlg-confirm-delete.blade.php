@props(['deleteObjName'])

<!-- 
    Delete Modal Dialog 
    (closed with button - can not be closed by clicking outside)
-->
<dialog id="delete-modal" class="modal">
    <div class="modal-box">
        <h3 class="text-lg font-bold">Confirm Delete</h3>
        <p class="py-4">Are you sure you want to delete this {{ $deleteObjName }}?</p>
        <div class="modal-action">
            <form method="dialog">
                <button class="btn">Cancel</button>
            </form>
            <!-- Delete form (Post - Method hint: DELETE) -->
            <form id="delete-modal-form" method="POST" action="" class="inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-error">Delete</button>
            </form>
        </div>
    </div>
</dialog>