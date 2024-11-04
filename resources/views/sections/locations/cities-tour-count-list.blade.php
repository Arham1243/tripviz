@if (!$content)
    <div class=top-location>
        <div class=container>
            <div class=section-content>
                <h2 class=heading>Top Location</h2>
            </div>
            <div class="top-location__list pt-4">
                <ul>
                    <li><a href=#>Alanya
                            <span>36</span>
                        </a></li>
                    <li><a href=#>Kemer
                            <span>31</span>
                        </a></li>
                    <li><a href=#>Belek
                            <span>23</span>
                        </a></li>
                    <li><a href=#>Antalya
                            <span>141</span>
                        </a></li>
                    <li><a href=#>Manavgat
                            <span>25</span>
                        </a></li>
                    <li><a href=#>Marmaris
                            <span>21</span>
                        </a></li>
                    <li><a href=#>Fethiye
                            <span>18</span>
                        </a></li>
                    <li><a href=#>Bodrum
                            <span>18</span>
                        </a></li>
                    <li><a href=#>Cappadocia
                            <span>8</span>
                        </a></li>
                    <li><a href=#>Dubai
                            <span>3</span>
                        </a></li>
                    <li><a href=#>Muğla
                            <span>57</span>
                        </a></li>
                    <li><a href=#>Turkey
                            <span>206</span>
                        </a></li>
                    <li><a href=#>United Arab Emirates
                            <span>3</span>
                        </a></li>
                </ul>
            </div>
        </div>
    </div>
@else
    <div class=top-location>
        <div class=container>
            <div class=section-content>
                <h2 class=heading>{{ $content->heading }}</h2>
            </div>
            <div class="top-location__list pt-4">
                <ul>
                    @php
                        $cities = \App\Models\City::whereIn('id', $content->city_ids)
                            ->where('status', 'publish')
                            ->withCount('tours')
                            ->get();
                    @endphp
                    @foreach ($cities as $city)
                        <li><a href=#>{{ $city->name }}
                                @if ($city->tours_count > 0)
                                    <span>{{ $city->tours_count }}</span>
                                @endif
                            </a></li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
@endif
