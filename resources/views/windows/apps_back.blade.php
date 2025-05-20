<div id="apps-container" class="row">
    <!-- App cards will be dynamically inserted here -->
</div>
<div id="pagination-controls" class="d-flex justify-content-center mt-3">
    <!-- Pagination dots will be dynamically inserted here -->
</div>

<style>
    #pagination-controls {
        display: flex;
        gap: 8px;
        justify-content: center;
    }
    .dot {
        width: 12px;
        height: 12px;
        background-color: #ccc;
        border-radius: 50%;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }
    .dot.active {
        background-color: #007aff;
    }
    .dot:hover {
        background-color: #005bb5;
    }
</style>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const apps = @json($store); // Laravel's data as a JavaScript object
        const appsContainer = document.getElementById("apps-container");
        const paginationControls = document.getElementById("pagination-controls");
        const itemsPerPage = 15;
        let currentPage = 1;

        // Render the apps for the current page
        function renderApps(page) {
            const startIndex = (page - 1) * itemsPerPage;
            const endIndex = startIndex + itemsPerPage;
            const pageItems = apps.slice(startIndex, endIndex);

            // Clear and populate the apps container
            appsContainer.innerHTML = "";
            pageItems.forEach((item) => {
                const appCard = `
                    <div class="col-md-2 m-2 app-card" data-name="${item.stream_name.toLowerCase()}">
                        <div class="card hover-expand" style="background-color: transparent; border-radius: 7px; box-shadow: none;">
                            <a href="${item.stream_link}">
                                <img style="width: 100%; border-radius: 7px;" src="/app_icons/${item.file}" class="img-fluid" alt="Responsive image">
                            </a>
                            <p class="truncate-text" style="text-align: center; color: #fff; font-size: 10px; margin-top: 2px; text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.7);">
                                <b>${item.stream_name}</b>
                            </p>
                        </div>
                    </div>
                `;
                appsContainer.insertAdjacentHTML("beforeend", appCard);
            });
        }

        // Render pagination dots
        function renderPagination() {
            const totalPages = Math.ceil(apps.length / itemsPerPage);

            // Clear and populate the pagination controls
            paginationControls.innerHTML = "";
            for (let i = 1; i <= totalPages; i++) {
                const dot = document.createElement("span");
                dot.className = `dot ${i === currentPage ? "active" : ""}`;
                dot.addEventListener("click", function () {
                    currentPage = i;
                    renderApps(currentPage);
                    renderPagination();
                });
                paginationControls.appendChild(dot);
            }
        }

        // Add swipe functionality
        let startX = 0;

        appsContainer.addEventListener("touchstart", (e) => {
            startX = e.touches[0].clientX;
        });

        appsContainer.addEventListener("touchend", (e) => {
            const endX = e.changedTouches[0].clientX;
            const totalPages = Math.ceil(apps.length / itemsPerPage);

            if (startX - endX > 50 && currentPage < totalPages) {
                // Swipe left to go to the next page
                currentPage++;
                renderApps(currentPage);
                renderPagination();
            } else if (endX - startX > 50 && currentPage > 1) {
                // Swipe right to go to the previous page
                currentPage--;
                renderApps(currentPage);
                renderPagination();
            }
        });

        // Initial render
        renderApps(currentPage);
        renderPagination();
    });
</script>
