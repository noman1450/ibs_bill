
<aside class="main-sidebar" data-widget="tree">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">

            <li>
                <a href="{{URL::to('/customer_information')}}"><i class="fa fa-circle-o"></i>Customer Information</a>
            </li>

            <li>
                <a href="{{ URL::to('/services') }}"><i class="fa fa-circle-o"></i>Service Confiq</a>
            </li>

            <li>
                <a href="{{ url('/process_service')}}"><i class="fa fa-circle-o"></i>Process Service</a>
            </li>

            <li>
                <a href="{{URL::to('/process_service_view')}}"><i class="fa fa-circle-o"></i>Combind Invoice Generate</a>
            </li>

            <li>
                <a href="{{URL::to('/dueCollection')}}"><i class="fa fa-circle-o"></i>Due Collection</a>
            </li>
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>
