{{-- <li class="header"><b>MENU</b></li> --}}

<li style="margin-top:10px;" class="{{ set_active(['dashboard.index']) }}">
    <a href="{{ route('dashboard.index') }}"><i class="fas fa-chart-line"></i><span>Dashboard</span></a>
</li>

<li class="{{ set_active(['report.index']) }}">
    <a href="{{ route('report.index') }}"><i class="fas fa-book"></i><span>Report</span></a>
</li>

<li class="{{ set_active(['sales.index']) }}">
    <a href="{{ route('sales.index') }}"><i class="fas fa-cash-register"></i><span>Sales</span></a>
</li>


<li class="header"><b>PRODUCT</b></li>
<hr style="margin:0;padding:0;">

<li class="{{ set_active(['product.index']) }}">
    <a href="{{ route('product.index') }}"><i class="fas fa-shopping-bag"></i><span>Product</span></a>
</li>

<li class="treeview {{ set_active(['inventory.index']) }}">
    <a href="#"><i class="fas fa-boxes fa-sm"></i><span>Inventory</span>
        <span class="pull-right-container">
            <i class="fas fa-angle-left pull-right" style="color:#ccc;"></i>
        </span>
    </a>
    <ul class="treeview-menu" style="padding:7px;padding-left:5px;">
        <li class="{{ set_active(['inventory.index']) }}"><a href="{{ route('inventory.index') }}"><span>Stock</span></a></li>
        <li class="{{ set_active(['inventory.index']) }}"><a href="{{ route('inventory.index') }}"><span>Stock In</span></a></li>
        <li class="{{ set_active(['inventory.index']) }}"><a href="{{ route('inventory.index') }}"><span>Stock Out</span></a></li>
        <li class="{{ set_active(['inventory.index']) }}"><a href="{{ route('inventory.index') }}"><span>Stock Opname</span></a></li>
        <li class="{{ set_active(['inventory.index']) }}"><a href="{{ route('inventory.index') }}"><span>Purchase Order</span></a></li>
    </ul>
</li>


<li class="header"><b>BUSINESS</b></li>
<hr style="margin:0;padding:0;">

<li class="{{ set_active(['store.index']) }}">
    <a href="{{ route('store.index') }}"><i class="fas fa-store-alt fa-sm"></i><span>Store</span></a>
</li>

<li class="{{ set_active(['employee.index', 'employee.create', 'employee.edit', 'employee.show']) }}">
    <a href="{{ route('employee.index') }}"><i class="fas fa-user-circle"></i><span>Employee</span></a>
</li>

<li class="{{ set_active(['customer.index', 'customer.create', 'customer.edit', 'customer.show']) }}">
    <a href="{{ route('customer.index') }}"><i class="fas fa-user fa-sm"></i><span>Customer</span></a>
</li>

<li class="{{ set_active(['supplier.index', 'supplier.create', 'supplier.edit', 'supplier.show']) }}">
    <a href="{{ route('supplier.index') }}"><i class="fas fa-user-friends fa-sm"></i><span>Supplier</span></a>
</li>


<li class="header"><b>CONFIGURATION</b></li>
<hr style="margin:0;padding:0;">

<li class="{{ set_active(['config.index']) }}">
    <a href="{{ route('config.index') }}"><i class="fas fa-cog"></i><span>Configuration</span></a>
</li>