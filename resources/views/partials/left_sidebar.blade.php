
<aside class="main-sidebar" data-widget="tree">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">

            <li class="{{ request()->is('customer_information') ? 'active' : null }}">
                <a href="{{ url('/customer_information') }}">
                    <i class="fa fa-circle-o"></i>
                    Customer Information
                </a>
            </li>

            <li class="{{ request()->is('services') ? 'active' : null }}">
                <a href="{{ url('/services') }}">
                    <i class="fa fa-circle-o"></i>
                    Service Config
                </a>
            </li>

            <li class="{{ request()->is('process_service') ? 'active' : null }}">
                <a href="{{ url('/process_service') }}">
                    <i class="fa fa-circle-o"></i>
                    Process Service
                </a>
            </li>

            <li class="{{ request()->is('process_service_view') ? 'active' : null }}">
                <a href="{{ url('/process_service_view') }}">
                    <i class="fa fa-circle-o"></i>
                    Combind Invoice Generate
                </a>
            </li>

            <li class="{{ request()->is('dueCollection') ? 'active' : null }}">
                <a href="{{ url('/dueCollection') }}">
                    <i class="fa fa-circle-o"></i>
                    Due Collection
                </a>
            </li>

            <li class="{{ request()->is('money_receipt', 'money_receipt/*') ? 'active' : null }}">
                <a href="{{ url('/money_receipt') }}">
                    <i class="fa fa-circle-o"></i>
                    Generate Money Receipt
                </a>
            </li>
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>
