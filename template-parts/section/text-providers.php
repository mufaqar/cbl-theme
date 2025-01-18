<!-- Text Sections for TV -->
<?php 
    if ($type === 'tv'): ?>
<section class="my-16">
    <div class="container mx-auto px-4">
        <div class="mb-10">
            <h2 class="text-2xl font-bold mb-2">
                What Local Channels are Available from Cable TV Providers in <span
                    class="text-[#ef9831]"><?php echo $city?>, <span class="uppercase"><?php echo $state?></span></span>
            </h2>
            <p class="PClass">
                The best part of using a cable provider is accessing the news, sports, events, and special screenings of
                shows in your regional location. Many fans love watching the local college team take on a long-term
                rival but get locked out because streaming services won’t cover the event.</p>
            <p class="PClass">
                Local channels are based on the service provider you choose for your TV service. <a
                    href="https://www.channelmaster.com/pages/free-tv-channels">Click here </a>to find the list of local
                stations you’ll get while living in Glendale CA.
            </p>
        </div>

        

        <div class="mb-10">
            <h2 class="text-2xl font-bold mb-2">
                How We Research TV Companies in <span class="text-[#ef9831]"><?php echo $city?>, <span
                        class="uppercase"><?php echo $state?></span></span>
            </h2>
            <p class="PClass">
                To ensure we provide the best details on different cable TV providers in the area, we look at a list of
                specific factors. These are the details we find new customers and recently moved families want the most.
                That may include:
            </p>
            <ul  class="PClass">
                <li>Type of Service: Whether the cable TV provider works from satellite, traditional coax cable, or a
                    digital service attached to your internet or mobile device. </li>
                <li>Length of Contract: Most cable TV providers working with internet or mobile streaming require a
                    long-term commitment. </li>
                <li>Video Quality: How sharp is the image? Will it maintain that quality during storms or heavy use due
                    to the high demand of all customers? </li>
                <li>Accessories: What equipment and features will the cable TV provider offer, like remotes, DVRs,
                    devices, and more? </li>
                <li>Transparent Pricing: Are there any hidden fees that will increase the initial offer price when you
                    sign up? </li>
                <li>Special Promotions: Can you secure a monthly discount due to being a new customer or reduce your
                    contract when bundling with other services? </li>
                <li>Real Customer Support: When you have a question or need help, you reach a live human being for
                    support. </li>

            </ul>
        </div>

    </div>
</section>
<?php elseif ($type === 'landline'): ?>
<section class="my-16">
    <div class="container mx-auto px-4">
        <div class="mb-10">
            <h2 class="text-2xl font-bold mb-2">
                How We Measure Home Phone Providers in <span class="text-[#ef9831]"><?php echo $city?>, <span
                        class="uppercase"><?php echo $state?></span></span>
            </h2>
            <p class="PClass">
                Offering a cheap home phone line isn’t enough to convince our professional team at CableMovers of a
                provider’s quality. We look at a number of amenities and services to ensure you are only getting the
                best landline phone service. That may include any combination of:
            </p>
            <ul class="PClass">
                <li><strong>Internet Requirements:</strong> Do the landline home phone service providers in Glendale, CA, require you
                    to have internet access to install or use the lines being offered? </li>
                    <li><strong>Hidden Fees & Taxes: Does signing up for the landline home service providers mean paying hidden
                    fees that increase over time or are there any local taxes not worked into the monthly price
                    advertised? </li>
                    <li><strong>Audio Quality:</strong>  Are you getting pristine audio for your landline service so you can easily hear
                    people on the other end of the line, regardless of where they are in the world? </li>
                    <li><strong>Transparent Pricing & Contracts:</strong>  Do the telephone service providers require extended contracts?
                    What about pricing? Is the total price you pay broken down into what you’re receiving in a clear and
                    transparent way? </li>
                    <li><strong>Real Customer Support:</strong>  If you have an issue with your home phone line, will you speak with a human
                    representative for the service provider instead of a robot or audio prompts? </li>
            </ul>
        </div>

    </div>
</section>
<?php else: ?>

<?php endif; ?>