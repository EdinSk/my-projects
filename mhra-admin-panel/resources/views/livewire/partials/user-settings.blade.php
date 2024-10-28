<div class="modal" id="userSettingsModal" tabindex="-1" aria-labelledby="userSettingsModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="userSettingsModalLabel">Поставки</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form wire:submit.prevent="saveSettings">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="first_name" class="form-label">Име</label>
                            <input type="text" class="form-control" id="first_name" wire:model="first_name">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="last_name" class="form-label">Презиме</label>
                            <input type="text" class="form-control" id="last_name" wire:model="last_name">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Е-маил</label>
                        <input type="email" class="form-control" id="email" wire:model="email">
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Лозинка</label>
                        <input type="password" class="form-control" id="password" wire:model="password">
                        <small class="text-muted">Leave blank if you don't want to change the password</small>
                    </div>

                    <div class="mb-3">
                        <label for="title" class="form-label">Титула</label>
                        <input type="text" class="form-control" id="title" wire:model="title">
                    </div>

                    <div class="mb-3">
                        <label for="phone" class="form-label">Телефон</label>
                        <input type="text" class="form-control" id="phone" wire:model="phone">
                    </div>

                    <div class="mb-3">
                        <label for="city" class="form-label">Град</label>
                        <input type="text" class="form-control" id="city" wire:model="city">
                    </div>

                    <div class="mb-3">
                        <label for="country" class="form-label">Држава</label>
                        <input type="text" class="form-control" id="country" wire:model="country">
                    </div>

                    <div class="mb-3">
                        <label for="bio" class="form-label">Биографија</label>
                        <textarea class="form-control" id="bio" wire:model="bio"></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="cv_url" class="form-label">CV URL</label>
                        <input type="url" class="form-control" id="cv_url" wire:model="cv_url">
                    </div>


                    <!-- File Upload for User Photo -->
                    <div class="mb-4">
                        <label for="photo" class="block text-gray-700">Upload Profile Photo:</label>
                        <input type="file" wire:model="photo" id="photo" class="w-full px-4 py-2 border rounded-lg">
                        @error('photo') <span class="text-red-500">{{ $message }}</span> @enderror

                        <!-- Preview the uploaded image before saving -->
                        @if ($photo)
                        <div class="mt-2">
                            <img src="{{ $photo->temporaryUrl() }}" alt="Photo Preview" class="w-32 h-32 rounded-lg">
                        </div>
                        @elseif (Auth::user()->photo_url)
                        <!-- Display existing profile photo if available -->
                        <div class="mt-2">
                            <img src="{{ asset('storage/' . Auth::user()->photo_url) }}" alt="Current Profile Photo" class="w-32 h-32 rounded-lg">
                        </div>
                        @endif
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Зачувај</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('close-modal', function() {
            var modal = new bootstrap.Modal(document.getElementById('userSettingsModal'));
            modal.hide();
        });
        // Remove modal backdrop manually
        document.querySelectorAll('.modal-backdrop').forEach(function(backdrop) {
            backdrop.remove();
        });
    </script>

</div>