<style>
    /* Isolated menu container */
    .fixed-bottom-menu {
        position: fixed;
        bottom: 0;
        left: 0;
        right: 0;
        background-color: #052a5a; /* Primary color */
        border-top: 1px solid #ddd; /* Slight border on top */
        display: none;
        justify-content: space-around; /* Evenly space the buttons */
        padding: 10px 0;
        z-index: 1000;
        box-shadow: 0 -2px 5px rgba(0, 0, 0, 0.1); /* Light shadow for depth */
    }

    /* Show only on mobile */
    @media (max-width: 768px) {
        .fixed-bottom-menu {
            display: flex; /* Flexbox to align buttons */
        }
    }

    .fixed-bottom-menu .menu-item {
        display: flex;
        flex-direction: column;
        align-items: center;
        color: #007bff; /* Primary color for icons and text */
    }

    .fixed-bottom-menu .btn-icon {
        background-color: #052145; /* Primary color */
        color: rgb(220, 241, 255);
        border-radius: 50%;
        width: 40px; /* Smaller icon button */
        height: 40px;
        display: flex;
        justify-content: center;
        align-items: center;
        margin-bottom: 5px; /* Space between icon and text */
    }

    .fixed-bottom-menu .btn-icon i {
        font-size: 18px; /* Smaller icon size */
    }

    .fixed-bottom-menu .menu-text {
        font-size: 12px; /* Smaller text below the icon */
        color: #f3f3f3; /* Black text */
    }
</style>
