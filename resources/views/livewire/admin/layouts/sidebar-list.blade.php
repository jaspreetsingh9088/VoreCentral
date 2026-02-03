<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

    @forelse ($tabs as $tab)

        @if ($tab->url=="section")

        @elseif ($tab->is_tab_main)

            <li class="nav-item {{ request()->segment(\config('constants.url_segment')) == $tab->tabs[0]->url || request()->segment(\config('constants.url_segment')) == $tab->tabs[1]->url ? 'menu-open' : '' }}">

                <a href="#" @class([

                    'active' =>

                        request()->segment(\config('constants.url_segment')) == $tab->tabs[0]->url  || request()->segment(\config('constants.url_segment')) == $tab->tabs[1]->url,

                    'nav-link',

                ])>

                    {!! $tab->icon !!}

                    <p>{{ $tab->name }}

                        @if ($tab->is_tab_main)

                            <i class="fas fa-angle-left right"></i>

                        @endif

                    </p>

                </a>

                <ul class="nav nav-treeview">

                    @forelse ($tab->tabs as $item)

                        <li class="nav-item">

                            <a href="{{ url('/admin') . '/' . $item->url }}" @class([

                                'active' =>

                                    request()->segment(\config('constants.url_segment')) == $item->url,

                                'nav-link',

                            ])>

                                {!! $item->icon !!}

                                <p>{{ $item->name }}</p>

                            </a>

                        </li>

                    @empty

                    @endforelse

                </ul>

            </li>

        @else

            @if (!isset($tab->tab_id))

                <li class="nav-item">

                    <a href="{{ url('/admin') . '/' . $tab->url }}" @class([

                        'active' =>

                            request()->segment(\config('constants.url_segment')) == $tab->url,

                        'nav-link',

                    ])>

                        {!! $tab->icon !!}

                        <p>{{ $tab->name }}</p>

                    </a>

                </li>

            @endif

        @endif

    @empty

    @endforelse

</ul>

