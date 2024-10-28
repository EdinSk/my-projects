<div class="card mb-3">
    <div class="card-body text-center">
        <h5 class="card-title">Points Progress</h5>
        <div class="progress-circle-container d-flex justify-content-center">
            <div class="progress-circle" style="--percentage: {{ Auth::user()->acquired_points }};">
                <span>{{ Auth::user()->acquired_points }}</span>
            </div>
        </div>
        <p class="mt-2">Points to Next Level</p>
    </div>
    <style>
        .progress-circle-container {
            display: flex;
            justify-content: space-around;
            align-items: center;
        }

        .progress-circle {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            background: conic-gradient(#0d6efd calc(var(--percentage) * 3.6deg), #e0e0e0 0);
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 24px;
            color: #0d6efd;
        }
    </style>
</div>