
<div class="main-menu menu-fixed menu-light menu-accordion    menu-shadow " data-scroll-to-active="true">
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">

            <li class="nav-item active"><a href="{{route('admin.dashboard')}}"><i class="la la-mouse-pointer"></i><span
                        class="menu-title" data-i18n="nav.add_on_drag_drop.main">{{__('admin/sidebar.primary')}} </span></a>
            </li>

            <li class="nav-item  open ">
                <a href=""><i class="la la-home"></i>
                    <span class="menu-title" data-i18n="nav.dash.main">{{__('admin/sidebar.languages')}} </span>
                    <span
                        class="badge badge badge-info badge-pill float-right mr-2"></span>
                </a>
                <ul class="menu-content">
                    <li class="active"><a class="menu-item" href=""
                                          data-i18n="nav.dash.ecommerce">{{__('admin/sidebar.show_all')}}</a>
                    </li>
                    <li><a class="menu-item" href="" data-i18n="nav.dash.crypto">{{__('admin/sidebar.add_new_language')}} </a>
                    </li>
                </ul>
            </li>


            <li class="nav-item"><a href=""><i class="la la-group"></i>
                    <span class="menu-title" data-i18n="nav.dash.main">{{__('admin/sidebar.primary_sections')}} </span>
                    <span
                        class="badge badge badge-danger badge-pill float-right mr-2"> </span>
                </a>
                <ul class="menu-content">
                    <li class="active"><a class="menu-item" href="{{route('admin.categories','main_category')}}"
                                          data-i18n="nav.dash.ecommerce"> {{__('admin/sidebar.show_all')}}</a>
                    </li>
                    <li><a class="menu-item" href="{{route('admin.categories.create','main_category')}}" data-i18n="nav.dash.crypto">{{__('admin/sidebar.add_new_primary_section')}}</a>
                    </li>
                </ul>
            </li>

            <li class="nav-item"><a href=""><i class="la la-group"></i>
                    <span class="menu-title" data-i18n="nav.dash.main">{{__('admin/sidebar.secondary_sections')}} </span>
                    <span
                        class="badge badge badge-danger badge-pill float-right mr-2"> </span>
                </a>
                <ul class="menu-content">
                    <li class="active"><a class="menu-item" href="{{route('admin.categories','child_category')}}"
                                          data-i18n="nav.dash.ecommerce"> {{__('admin/sidebar.show_all')}}</a>
                    </li>
                    <li><a class="menu-item"  href="{{route('admin.categories.create','child_category')}}" data-i18n="nav.dash.crypto">{{__('admin/sidebar.add_new_secondary_section')}}</a>
                    </li>
                </ul>
            </li>



            <li class="nav-item"><a href=""><i class="la la-male"></i>
                    <span class="menu-title" data-i18n="nav.dash.main">{{__('admin/sidebar.brands')}}  </span>
                    <span
                        class="badge badge badge-success badge-pill float-right mr-2"> </span>
                </a>
                <ul class="menu-content">
                    <li class="active"><a class="menu-item" href="{{route('admin.brands')}}"
                                          data-i18n="nav.dash.ecommerce">{{__('admin/sidebar.show_all')}} </a>
                    </li>
                    <li><a class="menu-item" href="{{route('admin.brands.create')}}" data-i18n="nav.dash.crypto">{{__('admin/sidebar.brand-add')}}</a>
                    </li>
                </ul>
            </li>



            <li class=" nav-item"><a href="#"><i class="la la-television"></i><span class="menu-title"
                                                                                    data-i18n="nav.templates.main"> {{__('admin/sidebar.settings')}}</span></a>
                <ul class="menu-content">
                    <li><a class="menu-item" href="#" data-i18n="nav.templates.vert.main"> {{__('admin/sidebar.shipping-methods')}} </a>
                        <ul class="menu-content">
                            <li><a class="menu-item" href="{{route('admin.shipping.edit','free')}}"
                                   data-i18n="nav.templates.vert.classic_menu">{{__('admin/sidebar.shipping-free')}}</a>
                            </li>
                            <li><a class="menu-item" href="{{route('admin.shipping.edit','inner')}}">{{__('admin/sidebar.shipping-inner')}}</a>
                            </li>
                            <li><a class="menu-item"href="{{route('admin.shipping.edit','outer')}}"
                                   data-i18n="nav.templates.vert.compact_menu">{{__('admin/sidebar.shipping-outer')}}</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</div>
