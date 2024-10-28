<div class="card mb-3">
    <div class="card-body">
        <h5 class="card-title">Feedback</h5>
        <form wire:submit.prevent="submit">
            <div class="mb-3">
                <textarea wire:model="feedback" class="form-control" rows="3" placeholder="Leave your feedback..."></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</div>
