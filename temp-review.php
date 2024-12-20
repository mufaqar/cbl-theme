<?php
/** Template Name: Review Page */

$city = get_query_var('city');
$type = get_query_var('type');
// $state = get_query_var('state');
$i = 0;

$query_reviews_args = array(
    'post_type'      => 'providers',
    'posts_per_page' => -1            
);
$query = new WP_Query($query_reviews_args);

// State 
$state = get_terms(array(
    'taxonomy'   => 'zone_state',
    'hide_empty' => false, // Set to true if you only want terms with associated posts
));



get_header();
?>
<!-- Include the Google reCAPTCHA script -->
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
<main class="bg-[#1B559E] py-16">
    <div class="max-w-[1110px] w-full gap-5 md:gap-10 mx-auto px-4 grid grid-cols-1 md:grid-cols-2">
        <div class="text-white">
            <h1 class="text-5xl font-bold ">Review Your Internet Provider</h1>
            <h6 class="py-4 font-medium">Help people make smarter choices with their internet service.</h6>
            <h4 class="pb-4 text-2xl font-bold">What makes a good review?</h4>
        </div>
        <div class="text-white">
            <h4 class="pb-4 text-2xl font-black">Leave a review.</h4>
            <form id="submit-review-form" class="mt-4">

                <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                    <div class="flex-1 bg-white rounded-md pr-2 overflow-hidden">
                        <select id="rew_provider" name="rew_provider"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm outline-none border-none focus:!ring-blue-500 focus:!border-blue-500 block w-full p-4"
                            required>
                            <option value="">Choose your provider</option>
                            <?php
                                        if ($query->have_posts()) {
                                            while ($query->have_posts()) {
                                                $query->the_post();
                                                ?><option value="<?php echo get_the_ID(); ?>">
                                <?php echo the_title(); ?></option><?php
                                            }
                                        } else {
                                            echo '<option>No providers found.</option>';
                                        }
                                        wp_reset_postdata();
                                    ?>
                        </select>
                    </div>


                    <div class="flex-1 bg-white rounded-md pr-2 overflow-hidden">
                        <select id="load_service" name="load_service"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm outline-none border-none focus:!ring-blue-500 focus:!border-blue-500 block w-full p-4"
                            required>
                            <option value="">Choose Service</option>
                        </select>
                    </div>
                </div>



                <div class="bg-white mt-4 flex justify-between items-center rounded-md p-[3px] px-4 overflow-hidden">
                    <p class="text-black text-sm">Your Overall Rating *</p>
                    <div class="stars flex gap-1" id="stars">
                        <?php for ($i = 1; $i <= 5; $i++): ?>
                        <span class="star" data-value="<?php echo $i; ?>">&#9733;</span>
                        <?php endfor; ?>
                    </div>
                </div>

                <div class="bg-white mt-4 rounded-md p-4 px-4 overflow-hidden">
                    <input type="email" placeholder="Enter your email address. *"
                        class="w-full outline-none border-none text-black text-sm" />
                </div>

                <div class="mt-4 flex sm:flex-row flex-col gap-4">
                    <input type="text" id="fname" name="firstName"
                        class="shadow-sm bg-white border border-gray-300 text-gray-900 text-sm rounded-md focus:ring-primary-500 focus:border-primary-500 block w-full p-4"
                        placeholder="First Name *" required />
                    <input type="text" id="lname" name="lastName"
                        class="block p-4 w-full text-sm text-gray-900 bg-white rounded-md border border-gray-300 shadow-sm focus:ring-primary-500 focus:border-primary-500"
                        placeholder="Last Name *" required />
                </div>

                <div class="mt-4 flex sm:flex-row flex-col gap-4">
                    <input type="text" id="street" name="street"
                        class="block p-4 w-full text-sm text-gray-900 bg-white rounded-md border border-gray-300 shadow-sm focus:ring-primary-500 focus:border-primary-500"
                        placeholder="Street Address" />
                </div>

                <div class="mt-4 grid grid-cols-1 sm:grid-cols-3 gap-4">
                    <input type="text" id="city" name="city" value="<?php echo esc_attr($city); ?>"
                        class="shadow-sm bg-white border border-gray-300 text-gray-900 text-sm rounded-md focus:ring-primary-500 focus:border-primary-500 block w-full p-4"
                        placeholder="City" />
                    <div class="bg-white rounded-md pr-1 overflow-hidden">
                        <select id="state" name="state"
                            class="bg-gray-50 border border-gray-300  text-gray-900 text-sm  outline-none border-none focus:!ring-blue-500 focus:!border-blue-500 block w-full p-4"
                            required>
                            <option value="">State</option>
                            <?php
                                    if (!is_wp_error($state) && !empty($state)) {
                                        foreach ($state as $term) { ?>
                            <option value="<?php echo $term->name ?>"><?php echo $term->name ?></option>
                            <?php }
                                    }
                                ?>
                        </select>
                    </div>
                    <input type="text" id="zipcode" name="zipcode"
                        class="block p-4 w-full text-sm text-gray-900 bg-white rounded-md border border-gray-300 shadow-sm focus:ring-primary-500 focus:border-primary-500"
                        placeholder="Zipcode" />
                </div>

                <div class="mt-4">
                    <textarea id="comment" name="comment"
                        class="block p-3 h-[100px] w-full text-sm text-gray-900 bg-gray-50 rounded-md shadow-sm border border-gray-300 focus:ring-primary-500 focus:border-primary-500"
                        placeholder="Leave a comment..." required></textarea>
                </div>

                <input type="hidden" id="rating" name="rating">
                <!-- Add reCAPTCHA widget -->
                <div class="g-recaptcha mt-5" data-sitekey="6LcFlZ8qAAAAANtGg14Tvog-7w-TU5NxRQvqNURL"></div>

                <button type="submit"
                    class="py-4 px-5 mt-4 w-full font-medium text-center bg-[#EF9831] text-white rounded-md bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:outline-none focus:ring-primary-300">Submit
                    Review</button>
            </form>
        </div>
    </div>
</main>




<?php get_footer();  ?>

<script>
jQuery(document).ready(function($) {
    $('#rew_provider').on('change', function() {
        const providerId = this.value; // Get selected provider ID
        const $serviceDropdown = $('#load_service'); // Get the service dropdown element

        if (providerId) {
            $.ajax({
                url: ajaxurl, // WordPress AJAX URL
                type: 'POST',
                data: {
                    action: 'get_provider_services',
                    provider_id: providerId,
                },
                beforeSend: function() {
                    $serviceDropdown.html(
                    '<option>Loading...</option>'); // Show loading state
                },
                success: function(response) {
                    if (response.success) {
                        $serviceDropdown.html(response.data.html); // Populate the dropdown
                    } else {
                        alert(response.data.message || 'Error loading services.');
                        $serviceDropdown.html('<option>Error loading services</option>');
                    }
                },
                error: function() {
                    alert('An error occurred while processing your request.');
                    $serviceDropdown.html('<option>Error loading services</option>');
                },
            });
        }
    });
});
</script>






<style>
.stars {
    display: flex;
    flex-direction: row;
    justify-content: center;
    cursor: pointer;
}

.star {
    font-size: 2rem;
    color: gray;
    transition: color 0.2s;
}

.star.hover,
.star.selected {
    color: #F3992E;
}
</style>


<script>
const stars = document.querySelectorAll('.star');
const ratingField = document.getElementById('rating');

let selectedRating = 0;

stars.forEach((star, index) => {
    star.addEventListener('mouseover', () => {
        updateStars(index + 1, 'hover');
    });

    star.addEventListener('mouseout', () => {
        updateStars(selectedRating, 'selected');
    });

    star.addEventListener('click', () => {
        selectedRating = index + 1;
        updateStars(selectedRating, 'selected');
    });
});

function updateStars(rating, className) {
    stars.forEach((star, index) => {
        star.classList.remove('hover', 'selected');
        if (index < rating) {
            star.classList.add(className);
        }
    });
}

jQuery(document).ready(function($) {
    $('#submit-review-form').on('submit', function(e) {
        e.preventDefault();
        ratingField.value = selectedRating;

        // Gather form data
        var formData = $(this).serialize();
        // AJAX request
        $.ajax({
            url: ajaxurl, // AJAX URL provided by WordPress
            type: 'POST',
            data: {
                action: 'submit_review', // Custom action name
                formData: formData // Serialized form data
            },
            success: function(response) {
                if (response.success) {
                    alert('Review submitted successfully!');
                    $('#submit-review-form')[0]
                        .reset(); // Reset form after successful submission
                } else {
                    alert('Error: ' + response.data);
                }
            },
            error: function(xhr, status, error) {
                alert('There was an error submitting the review.');
            }
        });
    });
});
</script>