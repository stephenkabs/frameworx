
<div class="container">
    <h2>Create Pricing Plan</h2>
    <form action="{{ route('pricing.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Plan Name</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <div class="mb-3">
            <label for="price" class="form-label">Price</label>
            <input type="number" class="form-control" id="price" name="price" step="0.01" required>
        </div>
        <div class="mb-3">
            <label for="billing_cycle" class="form-label">Billing Cycle</label>
            <select class="form-select" id="billing_cycle" name="billing_cycle" required>
                <option value="Free">Free Trial</option>
                <option value="Monthly">Monthly</option>
                <option value="Yearly">Yearly</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="features" class="form-label">Features</label>
            <div id="feature-list">
                <input type="text" class="form-control mb-2" name="features[]" placeholder="Feature 1" required>
            </div>
            <button type="button" id="add-feature" class="btn btn-secondary">Add Feature</button>
        </div>
        <button type="submit" class="btn btn-primary">Create Plan</button>
    </form>
</div>

<script>
    document.getElementById('add-feature').addEventListener('click', function() {
        const featureList = document.getElementById('feature-list');
        const input = document.createElement('input');
        input.type = 'text';
        input.name = 'features[]';
        input.className = 'form-control mb-2';
        input.placeholder = `Feature ${featureList.children.length + 1}`;
        input.required = true;
        featureList.appendChild(input);
    });
</script>

