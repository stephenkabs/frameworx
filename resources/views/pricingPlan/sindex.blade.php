
<div class="container my-5">
    <h1 class="text-center mb-4">Pricing Plans</h1>
    <div class="row">
        @foreach ($plans as $plan)
            <div class="col-md-4">
                <div class="card text-center">
                    <div class="card-header bg-primary text-white">
                        <h4>{{ $plan->name }}</h4>
                    </div>
                    <div class="card-body">
                        <h3 class="card-title">${{ number_format($plan->price, 2) }}</h3>
                        <p class="card-text">{{ $plan->billing_cycle }}</p>
                        <ul class="list-group">
                            @foreach ($plan->features as $feature)
                                <li class="list-group-item">{{ $feature->feature }}</li>
                            @endforeach
                        </ul>
                        <a href="#" class="btn btn-primary mt-3">Choose Plan</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

