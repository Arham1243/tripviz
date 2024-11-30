@if (!$content)
    <div class="offers-section section-padding">
        <div class=container>
            <div class="sale-card">
                <div class=sale-card__content>
                    <div class=discount-label>Up to <span>PKR 14.9L</span> OFF</div>
                    <div class=sale-info>
                        <div class=sale-label>on selected trips</div>
                        <div class=sale-title>Monsoon Sale!</div>
                    </div>
                    <div class=enquiry-help-text>Connect with our destination experts to get exciting discounts</div>
                    <div class=enquiry-btn>Know more about the Deal</div>
                </div>
                <div class=timer-details>
                    <div class=timer-label>Hurry - up Sale ends in!</div>
                    <div class=SectionSaleCard_tmDivider__CRa30></div>
                    <div class=timer>
                        <div class=time-box>0</div>
                        <div class=time-box>7</div>
                        <div class=SectionSaleCard_tmRatio>:</div>
                        <div class=time-box>0</div>
                        <div class=time-box>0</div>
                        <div class=SectionSaleCard_tmRatio>:</div>
                        <div class=time-box>4</div>
                        <div class=time-box>2</div>
                    </div>
                    <ul class=clock-detail>
                        <li class=clock-label>Days</li>
                        <li class=clock-label>Hours</li>
                        <li class=clock-label>Minutes</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@else
    @php
        $isBackgroundColor = isset($content->background_type_2)
            ? $content->background_type_2 === 'background_color'
            : null;
        $isBackgroundImage = isset($content->background_type_2)
            ? $content->background_type_2 === 'background_image'
            : null;
    @endphp
    <div class="offers-section section-padding">
        <div class=container>
            <div class="sale-card" style="background-color: {{ $isBackgroundColor ? $content->background_color_2 : '' }}">
                @if ($isBackgroundImage)
                    <img data-src="{{ asset($content->background_image_2 ?? 'admin/assets/images/placeholder.png') }}"
                        alt="{{ $content->background_image_alt_text_2 ?? 'Cta Background Image' }}"
                        class="imgFluid sale-card__bg lazy">
                @endif

                <div class=sale-card__content>
                    <div class=discount-label>{{ $content->title_2 ?? '' }}</div>
                    <div class=sale-info>
                        <div class=sale-label>{{ $content->subTitle_2 ?? '' }}</div>
                        <div class=sale-title>{{ $content->sale_text_2 ?? '' }}</div>
                    </div>
                    <div class=enquiry-help-text>{{ $content->description_2 ?? '' }}</div>
                    @if (isset($content->is_button_enabled_2))
                        <a href="{{ sanitizedLink($content->btn_link_2) ?? '' }}"
                            style="background-color: {{ $content->btn_background_color_2 ?? '' }};color:{{ $content->btn_text_color_2 ?? '' }};"
                            target="_blank" class=enquiry-btn>{{ $content->btn_text_2 ?? '' }}</a>
                    @endif
                </div>
                <div class=timer-details>
                    <div class=timer-label>Hurry - up Sale ends in!</div>
                    <div class=SectionSaleCard_tmDivider__CRa30></div>
                    <div class="timer" data-sale-end="{{ $content->sale_ends_on_2 ?? '' }}">
                        <div class="time-box" id="days-tens">0</div>
                        <div class="time-box" id="days-ones">7</div>
                        <div class="SectionSaleCard_tmRatio">:</div>
                        <div class="time-box" id="hours-tens">0</div>
                        <div class="time-box" id="hours-ones">0</div>
                        <div class="SectionSaleCard_tmRatio">:</div>
                        <div class="time-box" id="minutes-tens">4</div>
                        <div class="time-box" id="minutes-ones">2</div>
                    </div>
                    <ul class="clock-detail">
                        <li class="clock-label">Days</li>
                        <li class="clock-label">Hours</li>
                        <li class="clock-label">Minutes</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endif

@push('js')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Get the sale end time from the data attribute
            const timerElement = document.querySelector('.timer');
            const saleEndTime = new Date(timerElement.getAttribute('data-sale-end'));

            function updateTimer() {
                const now = new Date();
                const difference = saleEndTime - now;

                if (difference <= 0) {
                    timerElement.innerHTML = '<div>00:00:00</div>';
                    clearInterval(interval);
                    return;
                }

                const days = Math.floor(difference / (1000 * 60 * 60 * 24));
                const hours = Math.floor((difference % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                const minutes = Math.floor((difference % (1000 * 60 * 60)) / (1000 * 60));

                document.getElementById('days-tens').textContent = Math.floor(days / 10);
                document.getElementById('days-ones').textContent = days % 10;
                document.getElementById('hours-tens').textContent = Math.floor(hours / 10);
                document.getElementById('hours-ones').textContent = hours % 10;
                document.getElementById('minutes-tens').textContent = Math.floor(minutes / 10);
                document.getElementById('minutes-ones').textContent = minutes % 10;
            }

            // Initial call and interval setup
            updateTimer();
            const interval = setInterval(updateTimer, 1000);
        });
    </script>
@endpush
