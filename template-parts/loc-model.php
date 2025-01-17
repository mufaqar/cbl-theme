
<div id="locationModal2" class="modal" style="display: none;">
    <div class="modal-content">
        <span id="closeModal2" class="close">&times;</span>
        <section class="min-h-[55vh] flex items-center">
            <div class="container mx-auto px-10">
                <h1 class="sm:text-5xl text-2xl font-bold text-center max-w-[850px] mx-auto capitalize leading-10">Find <span class="text-[#EF9831]">TV, Internet &amp; Home Phone </span> Service Providers</h1>
                <p class="text-xl text-center font-[Roboto] my-5">Enter your zip code so we can find the best providers in your area:</p>
                <div class="grid justify-center">
                    <div class="flex justify-center">
                        <?php get_template_part('template-parts/search', 'form'); ?>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>


<script>
    document.addEventListener("DOMContentLoaded", function () {
        const modal = document.getElementById("locationModal2");
        const btn = document.getElementById("changeLocationBtn2");
        const span = document.getElementById("closeModal2");
        // When the user clicks the button, open the modal
        btn.onclick = function () {
            modal.style.display = "block";
        }
        // When the user clicks on <span> (x), close the modal
        span.onclick = function () {
            modal.style.display = "none";
        }
        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function (event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    });
</script>