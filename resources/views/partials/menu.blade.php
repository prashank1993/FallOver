<!-- Sidebar -->

<ul class="menu-inner py-1 ps">
    <!-- Dashboard -->
    <li class="menu-item active">
        <a href="/" class="menu-link">
            <i class="menu-icon tf-icons bx bx-home-circle"></i>
            <div data-i18n="Analytics">Dashboard</div>
        </a>
    </li>

    <li class="menu-header small text-uppercase">
        <span class="menu-header-text">Influencer</span>
    </li>
    <li class="menu-item">
        <a href="javascript:void(0);" class="menu-link menu-toggle">
            <i class="menu-icon tf-icons bx bx-home-circle"></i>
            <div data-i18n="Account Settings">Dashboard</div>
        </a>
    </li>
	@can('user_management_access')
    <li class="menu-item {{ request()->is('admin/permissions*') ? 'active open' : '' }} {{ request()->is('admin/roles*') ? 'active open' : '' }} {{ request()->is('admin/users*') ? 'active open' : '' }}">
        <a href="javascript:void(0);" class="menu-link menu-toggle ">
            <i class='menu-icon bx bx-user'></i>
            <div data-i18n="user-management">{{ trans('cruds.userManagement.title') }}</div>
        </a>
        <ul class="menu-sub">
        @can('permission_access')
            <li class="menu-item {{ request()->is('admin/permissions') || request()->is('admin/permissions/*') ? 'active' : '' }}">
                <a href="{{ route("admin.permissions.index") }}" class="menu-link ">
                    <div data-i18n="Vertical Form">{{ trans('cruds.permission.title') }}</div>
                </a>
            </li>
        @endcan
        @can('role_access')
            <li class="menu-item {{ request()->is('admin/roles') || request()->is('admin/roles/*') ? 'active' : '' }}">
                <a href="{{ route("admin.roles.index") }}" class="menu-link ">
                    <div data-i18n="Vertical Form">{{ trans('cruds.role.title') }}</div>
                </a>
            </li>
        @endcan
        @can('user_access')
            <li class="menu-item {{ request()->is('admin/users') || request()->is('admin/users/*') ? 'active' : '' }}">
                <a href="{{ route("admin.users.index") }}" class="menu-link">
                    <div data-i18n="Vertical Form">{{ trans('cruds.user.title') }}</div>
                </a>
            </li>
        @endcan
        </ul>
    </li>
    @endcan
    <li class="menu-item">
        <a href="javascript:void(0);" class="menu-link menu-toggle">
            <i class="menu-icon tf-icons bx bx-message-rounded-edit"></i>
            <div data-i18n="Account Settings">Social Media</div>
        </a>
    </li>
    
    <li class="menu-item {{ request()->is('admin/influencer-orders*') ? 'active open' : '' }}">
        <a href="javascript:void(0);" class="menu-link menu-toggle">
            <i class="menu-icon tf-icons bx bx-cube-alt"></i>
            <div data-i18n="Misc">Orders</div>
        </a>
		    <ul class="menu-sub">
       
            <li class="menu-item {{ request()->is('admin/influencer-orders') || request()->is('admin/influencer-orders/active') ? 'active' : '' }}">
                <a href="{{route('admin.influencer-orders', 'active')}}" class="menu-link ">
                    <div data-i18n="Vertical Form">Active Orders</div>
                </a>
            </li>
        
            <li class="menu-item {{ request()->is('admin/influencer-orders') || request()->is('admin/influencer-orders/late') ? 'active' : '' }}">
                <a href="{{route('admin.influencer-orders', 'late')}}" class="menu-link ">
                    <div data-i18n="Vertical Form">Late Orders</div>
                </a>
            </li>
        
            <li class="menu-item {{ request()->is('admin/influencer-orders') || request()->is('admin/influencer-orders/delivered') ? 'active' : '' }}">
                <a href="{{route('admin.influencer-orders', 'delivered')}}" class="menu-link">
                    <div data-i18n="Vertical Form">Delivered Orders</div>
                </a>
            </li>
			      <li class="menu-item {{ request()->is('admin/influencer-orders') || request()->is('admin/influencer-orders/completed') ? 'active' : '' }}">
                <a href="{{route('admin.influencer-orders', 'completed')}}" class="menu-link">
                    <div data-i18n="Vertical Form">Completed Orders</div>
                </a>
            </li>
			      <li class="menu-item {{ request()->is('admin/influencer-orders') || request()->is('admin/influencer-orders/cancelled') ? 'active' : '' }}">
                <a href="{{route('admin.influencer-orders', 'cancelled')}}" class="menu-link">
                    <div data-i18n="Vertical Form">Cancelled Orders</div>
                </a>
            </li>
        
        </ul>
    </li>
	  <li class="menu-item">
        <a href="javascript:void(0);" class="menu-link menu-toggle">
            <i class="menu-icon tf-icons bx bx-money"></i>
            <div data-i18n="Authentications">Transactions</div>
        </a>
    </li>
    <li class="menu-item">
        <a href="javascript:void(0);" class="menu-link menu-toggle">
            <i class="menu-icon tf-icons bx bxs-report"></i>
            <div data-i18n="Misc">Analytics</div>
        </a>
    </li>
    
    <!-- Components -->
    <li class="menu-header small text-uppercase"><span class="menu-header-text">Brands</span></li>
    <!-- Cards -->
    <li class="menu-item">
        <a href="javascript:void(0);" class="menu-link menu-toggle">
            <i class="menu-icon tf-icons bx bx-home-circle"></i>
            <div data-i18n="Account Settings">Dashboard</div>
        </a>
    </li>
    <li class="menu-item">
        <a href="javascript:void(0);" class="menu-link menu-toggle">
            <i class="menu-icon tf-icons bx bx-user"></i>
            <div data-i18n="Misc">Users</div>
        </a>
    </li>
    <li class="menu-item {{ request()->is('admin/brand-orders*') ? 'active open' : '' }}">
      <a href="javascript:void(0);" class="menu-link menu-toggle">
          <i class="menu-icon tf-icons bx bx-cube-alt"></i>
          <div data-i18n="Misc">Orders</div>
      </a>
      <ul class="menu-sub">
     
          <li class="menu-item {{ request()->is('admin/brand-orders') || request()->is('admin/brand-orders/active') ? 'active' : '' }}">
              <a href="{{route('admin.brand-orders', 'active')}}" class="menu-link ">
                  <div data-i18n="Vertical Form">Active Orders</div>
              </a>
          </li>
      
          <li class="menu-item {{ request()->is('admin/brand-orders') || request()->is('admin/brand-orders/late') ? 'active' : '' }}">
              <a href="{{route('admin.brand-orders', 'late')}}" class="menu-link ">
                  <div data-i18n="Vertical Form">Late Orders</div>
              </a>
          </li>
      
          <li class="menu-item {{ request()->is('admin/brand-orders') || request()->is('admin/brand-orders/delivered') ? 'active' : '' }}">
              <a href="{{route('admin.brand-orders', 'delivered')}}" class="menu-link">
                  <div data-i18n="Vertical Form">Delivered Orders</div>
              </a>
          </li>
          <li class="menu-item {{ request()->is('admin/brand-orders') || request()->is('admin/brand-orders/completed') ? 'active' : '' }}">
              <a href="{{route('admin.brand-orders', 'completed')}}" class="menu-link">
                  <div data-i18n="Vertical Form">Completed Orders</div>
              </a>
          </li>
          <li class="menu-item {{ request()->is('admin/brand-orders') || request()->is('admin/brand-orders/cancelled') ? 'active' : '' }}">
              <a href="{{route('admin.brand-orders', 'cancelled')}}" class="menu-link">
                  <div data-i18n="Vertical Form">Cancelled Orders</div>
              </a>
          </li>
      
      </ul>
  </li>
	<li class="menu-item">
        <a href="javascript:void(0);" class="menu-link menu-toggle">
            <i class="menu-icon tf-icons bx bx-money"></i>
            <div data-i18n="Authentications">Transactions</div>
        </a>
    </li>
    <li class="menu-item">
        <a href="javascript:void(0);" class="menu-link menu-toggle">
            <i class="menu-icon tf-icons bx bxs-report"></i>
            <div data-i18n="Misc">Analytics</div>
        </a>
    </li>
	

    <!-- Misc -->
    <li class="menu-header small text-uppercase"><span class="menu-header-text">Support</span></li>
    
    <li class="menu-item {{ request()->is('admin/settings') ? 'active' : '' }}">
        <a href="{{route('admin.settings')}}" class="menu-link">
            <i class='menu-icon bx bx-cog me-2'></i>
            <div data-i18n="Setting">Settings</div>
        </a>
    </li>
    <li class="menu-item">
        <a href="javascript:void(0);" class="menu-link">
            <i class="menu-icon tf-icons bx bx-support"></i>
            <div data-i18n="Support">Support</div>
        </a>
    </li>

    <li class="menu-item">
        <a href="javascript:void(0);" onclick="event.preventDefault(); document.getElementById('logoutform').submit();" class="menu-link">
            <i class='menu-icon bx bx-log-in-circle' ></i>
            <div data-i18n="logout">{{ trans('global.logout') }}</div>
        </a>
        <br>
    </li>

</ul>

{{-- <ul class="menu-inner py-1">
    <!-- Dashboard -->
    <li class="menu-item active">
      <a href="index.html" class="menu-link">
        <i class="menu-icon tf-icons bx bx-home-circle"></i>
        <div data-i18n="Analytics">Dashboard</div>
      </a>
    </li>

    <li class="menu-header small text-uppercase">
      <span class="menu-header-text">INFLUENCER</span>
    </li>
    <li class="menu-item">
      <a href="javascript:void(0);" class="menu-link menu-toggle">
        <i class="menu-icon tf-icons bx bx-dock-top"></i>
        <div data-i18n="Account Settings">Accounts</div>
      </a>
      <ul class="menu-sub">
        <li class="menu-item">
          <a href="pages-account-settings-account.html" class="menu-link">
            <div data-i18n="Account">Account</div>
          </a>
        </li>
        <li class="menu-item">
          <a href="pages-account-settings-notifications.html" class="menu-link">
            <div data-i18n="Notifications">Notifications</div>
          </a>
        </li>
        <li class="menu-item">
          <a href="pages-account-settings-connections.html" class="menu-link">
            <div data-i18n="Connections">Connections</div>
          </a>
        </li>
      </ul>
    </li>
    <li class="menu-item">
      <a href="javascript:void(0);" class="menu-link menu-toggle">
        <i class="menu-icon tf-icons bx bx-lock-open-alt"></i>
        <div data-i18n="Authentications">Authentications</div>
      </a>
      <ul class="menu-sub">
        <li class="menu-item">
          <a href="auth-login-basic.html" class="menu-link" target="_blank">
            <div data-i18n="Basic">Login</div>
          </a>
        </li>
        <li class="menu-item">
          <a href="auth-register-basic.html" class="menu-link" target="_blank">
            <div data-i18n="Basic">Register</div>
          </a>
        </li>
        <li class="menu-item">
          <a href="auth-forgot-password-basic.html" class="menu-link" target="_blank">
            <div data-i18n="Basic">Forgot Password</div>
          </a>
        </li>
      </ul>
    </li>
    <li class="menu-item">
      <a href="javascript:void(0);" class="menu-link menu-toggle">
        <i class="menu-icon tf-icons bx bx-cube-alt"></i>
        <div data-i18n="Misc">Misc</div>
      </a>
      <ul class="menu-sub">
        <li class="menu-item">
          <a href="pages-misc-error.html" class="menu-link">
            <div data-i18n="Error">Error</div>
          </a>
        </li>
        <li class="menu-item">
          <a href="pages-misc-under-maintenance.html" class="menu-link">
            <div data-i18n="Under Maintenance">Under Maintenance</div>
          </a>
        </li>
      </ul>
    </li>
    <!-- Components -->
    <li class="menu-header small text-uppercase"><span class="menu-header-text">Components</span></li>
    <!-- Cards -->
    <li class="menu-item">
      <a href="cards-basic.html" class="menu-link">
        <i class="menu-icon tf-icons bx bx-collection"></i>
        <div data-i18n="Basic">Cards</div>
      </a>
    </li>
    <!-- User interface -->
    <li class="menu-item">
      <a href="javascript:void(0)" class="menu-link menu-toggle">
        <i class="menu-icon tf-icons bx bx-box"></i>
        <div data-i18n="User interface">User interface</div>
      </a>
      <ul class="menu-sub">
        <li class="menu-item">
          <a href="ui-accordion.html" class="menu-link">
            <div data-i18n="Accordion">Accordion</div>
          </a>
        </li>
        <li class="menu-item">
          <a href="ui-alerts.html" class="menu-link">
            <div data-i18n="Alerts">Alerts</div>
          </a>
        </li>
        <li class="menu-item">
          <a href="ui-badges.html" class="menu-link">
            <div data-i18n="Badges">Badges</div>
          </a>
        </li>
        <li class="menu-item">
          <a href="ui-buttons.html" class="menu-link">
            <div data-i18n="Buttons">Buttons</div>
          </a>
        </li>
        <li class="menu-item">
          <a href="ui-carousel.html" class="menu-link">
            <div data-i18n="Carousel">Carousel</div>
          </a>
        </li>
        <li class="menu-item">
          <a href="ui-collapse.html" class="menu-link">
            <div data-i18n="Collapse">Collapse</div>
          </a>
        </li>
        <li class="menu-item">
          <a href="ui-dropdowns.html" class="menu-link">
            <div data-i18n="Dropdowns">Dropdowns</div>
          </a>
        </li>
        <li class="menu-item">
          <a href="ui-footer.html" class="menu-link">
            <div data-i18n="Footer">Footer</div>
          </a>
        </li>
        <li class="menu-item">
          <a href="ui-list-groups.html" class="menu-link">
            <div data-i18n="List Groups">List groups</div>
          </a>
        </li>
        <li class="menu-item">
          <a href="ui-modals.html" class="menu-link">
            <div data-i18n="Modals">Modals</div>
          </a>
        </li>
        <li class="menu-item">
          <a href="ui-navbar.html" class="menu-link">
            <div data-i18n="Navbar">Navbar</div>
          </a>
        </li>
        <li class="menu-item">
          <a href="ui-offcanvas.html" class="menu-link">
            <div data-i18n="Offcanvas">Offcanvas</div>
          </a>
        </li>
        <li class="menu-item">
          <a href="ui-pagination-breadcrumbs.html" class="menu-link">
            <div data-i18n="Pagination &amp; Breadcrumbs">Pagination &amp; Breadcrumbs</div>
          </a>
        </li>
        <li class="menu-item">
          <a href="ui-progress.html" class="menu-link">
            <div data-i18n="Progress">Progress</div>
          </a>
        </li>
        <li class="menu-item">
          <a href="ui-spinners.html" class="menu-link">
            <div data-i18n="Spinners">Spinners</div>
          </a>
        </li>
        <li class="menu-item">
          <a href="ui-tabs-pills.html" class="menu-link">
            <div data-i18n="Tabs &amp; Pills">Tabs &amp; Pills</div>
          </a>
        </li>
        <li class="menu-item">
          <a href="ui-toasts.html" class="menu-link">
            <div data-i18n="Toasts">Toasts</div>
          </a>
        </li>
        <li class="menu-item">
          <a href="ui-tooltips-popovers.html" class="menu-link">
            <div data-i18n="Tooltips & Popovers">Tooltips &amp; popovers</div>
          </a>
        </li>
        <li class="menu-item">
          <a href="ui-typography.html" class="menu-link">
            <div data-i18n="Typography">Typography</div>
          </a>
        </li>
      </ul>
    </li>

    <!-- Extended components -->
    <li class="menu-item">
      <a href="javascript:void(0)" class="menu-link menu-toggle">
        <i class="menu-icon tf-icons bx bx-copy"></i>
        <div data-i18n="Extended UI">Extended UI</div>
      </a>
      <ul class="menu-sub">
        <li class="menu-item">
          <a href="extended-ui-perfect-scrollbar.html" class="menu-link">
            <div data-i18n="Perfect Scrollbar">Perfect scrollbar</div>
          </a>
        </li>
        <li class="menu-item">
          <a href="extended-ui-text-divider.html" class="menu-link">
            <div data-i18n="Text Divider">Text Divider</div>
          </a>
        </li>
      </ul>
    </li>

    <li class="menu-item">
      <a href="icons-boxicons.html" class="menu-link">
        <i class="menu-icon tf-icons bx bx-crown"></i>
        <div data-i18n="Boxicons">Boxicons</div>
      </a>
    </li>

    <!-- Forms & Tables -->
    <li class="menu-header small text-uppercase"><span class="menu-header-text">Forms &amp; Tables</span></li>
    <!-- Forms -->
    <li class="menu-item">
      <a href="javascript:void(0);" class="menu-link menu-toggle">
        <i class="menu-icon tf-icons bx bx-detail"></i>
        <div data-i18n="Form Elements">Form Elements</div>
      </a>
      <ul class="menu-sub">
        <li class="menu-item">
          <a href="forms-basic-inputs.html" class="menu-link">
            <div data-i18n="Basic Inputs">Basic Inputs</div>
          </a>
        </li>
        <li class="menu-item">
          <a href="forms-input-groups.html" class="menu-link">
            <div data-i18n="Input groups">Input groups</div>
          </a>
        </li>
      </ul>
    </li>
    <li class="menu-item">
      <a href="javascript:void(0);" class="menu-link menu-toggle">
        <i class="menu-icon tf-icons bx bx-detail"></i>
        <div data-i18n="Form Layouts">Form Layouts</div>
      </a>
      <ul class="menu-sub">
        <li class="menu-item">
          <a href="form-layouts-vertical.html" class="menu-link">
            <div data-i18n="Vertical Form">Vertical Form</div>
          </a>
        </li>
        <li class="menu-item">
          <a href="form-layouts-horizontal.html" class="menu-link">
            <div data-i18n="Horizontal Form">Horizontal Form</div>
          </a>
        </li>
      </ul>
    </li>
    <!-- Tables -->
    <li class="menu-item">
      <a href="tables-basic.html" class="menu-link">
        <i class="menu-icon tf-icons bx bx-table"></i>
        <div data-i18n="Tables">Tables</div>
      </a>
    </li>
    <!-- Misc -->
    <li class="menu-header small text-uppercase"><span class="menu-header-text">Misc</span></li>
    <li class="menu-item">
      <a
        href="https://github.com/themeselection/sneat-html-admin-template-free/issues"
        target="_blank"
        class="menu-link"
      >
        <i class="menu-icon tf-icons bx bx-support"></i>
        <div data-i18n="Support">Support</div>
      </a>
    </li>
    <li class="menu-item">
      <a
        href="https://themeselection.com/demo/sneat-bootstrap-html-admin-template/documentation/"
        target="_blank"
        class="menu-link"
      >
        <i class="menu-icon tf-icons bx bx-file"></i>
        <div data-i18n="Documentation">Documentation</div>
      </a>
    </li>
</ul> --}}

<!-- /.sidebar -->
