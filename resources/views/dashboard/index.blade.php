<x-layout.app :title="__('Product Categories')">
    <h1>Product Categories</h1>

    <table>
        <thead>
            <tr>
                <th>No.</th>
                <th>Name</th>
                <th>Slug</th>
                <th>Description</th>
                <th>Action</th>
            </tr>

        </thead>
        <body>
            @foreach ($categories as $key=>$category)
            <tr>
                <td>{{ $key+1 }}</td>
                <td>{{ $category->name }}</td>
                <td>{{ $category->slug }}</td>
                <td>{{ $category->description }}</td>
            </tr>
            @endforeach
        </body>
    </table>
</x-layout.app>