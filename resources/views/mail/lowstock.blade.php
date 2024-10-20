<h1>Low Stock Alert</h1>

<p>Dear Admin,</p>

<p>The following categories have medicines with low stock:</p>

<ul>
    @foreach ($lowStockCategories as $category)
        <li>{{ $category->name }}: {{ $category->medicines_count }} medicines left.</li>
    @endforeach
</ul>

<p>Please take necessary actions.</p>

<p>Thank you!</p>
