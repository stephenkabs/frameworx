<form action="{{ route('event.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <!-- Event fields -->
    <input type="text" name="name" placeholder="Event Name" required>
    <input type="text" name="location" placeholder="Location" required>
    <input type="datetime-local" name="start_time" placeholder="Start Time" required>
    <input type="datetime-local" name="end_time" placeholder="End Time" required>
    <input type="date" name="date" placeholder="Event Date" required>
    <input type="number" name="available_tickets" placeholder="Total Tickets" required>
    <textarea name="description" placeholder="Event Description"></textarea>
    <input type="file" name="image">

    <!-- Ticket fields -->
    <div id="ticket-container">
        <div class="ticket-row">
            <input type="text" name="tickets[0][type]" placeholder="Ticket Type (e.g., VIP)" required>
            <input type="number" name="tickets[0][price]" placeholder="Price" required>
            <input type="number" name="tickets[0][quantity]" placeholder="Quantity" required>
        </div>
    </div>
    <button type="button" id="add-ticket">Add Another Ticket</button>

    <button type="submit">Create Event</button>
</form>

<script>
    document.getElementById('add-ticket').addEventListener('click', function () {
        const container = document.getElementById('ticket-container');
        const index = container.children.length;
        const ticketRow = document.createElement('div');
        ticketRow.className = 'ticket-row';
        ticketRow.innerHTML = `
            <input type="text" name="tickets[${index}][type]" placeholder="Ticket Type (e.g., VIP)" required>
            <input type="number" name="tickets[${index}][price]" placeholder="Price" required>
            <input type="number" name="tickets[${index}][quantity]" placeholder="Quantity" required>
        `;
        container.appendChild(ticketRow);
    });
</script>
