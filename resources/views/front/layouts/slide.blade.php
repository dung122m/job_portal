<style>
    #banner {
        position: relative;
        overflow: hidden;
        height: 400px; /* Adjust height as needed */
    }

    .image-container {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        overflow: hidden;
    }

    .bg-image-style {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        object-fit: cover; /* Ensure the image covers the entire area */
        opacity: 0;
        transition: opacity 1s ease-in-out;
    }

    .active {
        opacity: 1;
    }

    .container {
        position: relative; /* Ensure content appears over the images */
        z-index: 1; /* Bring content above the background images */
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const bgImages = document.querySelectorAll('.bg-image-style');
        let currentIndex = 0;

        // Function to change the active background
        setInterval(() => {
            bgImages[currentIndex].classList.remove('active');
            currentIndex = (currentIndex + 1) % bgImages.length; // Loop back to the first image
            bgImages[currentIndex].classList.add('active');
        }, 2000); // Change image every 5 seconds
    });
</script>
