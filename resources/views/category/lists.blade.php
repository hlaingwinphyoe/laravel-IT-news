<table class="table table-hover border-0">
    <thead>
    <tr>
        <th>#</th>
        <th>Title</th>
        <th>Owner</th>
        <th>Control</th>
        <th>Time</th>
    </tr>
    </thead>
    <tbody>
    {{--                        user relationship ကို ပြန်ခေါ်မယ်ဆိုရင် all နဲ့ခေါ်မရတော့ဘူး get နဲ့ပဲရ--}}

    @forelse(\App\Category::with('user')->get() as $category)
        <tr>
            <td>{{ $category->id }}</td>
            <td>{{ $category->title }}</td>
            <td>{{ $category->user->name }}</td>
            <td>
                <a href="{{ route("category.edit",$category->id) }}" title="Edit" class="text-decoration-none">
                    <i class="fas fa-pen text-warning fa-fw mr-2"></i>
                </a>
                <form action="{{ route("category.destroy",$category->id) }}" class="d-inline-block text-decoration-none" method="post">
                    @csrf
                    @method("delete")
                    <button style="padding: 0;background: none;border: none;outline: none;" title="Delete" onclick="return confirm('Are you sure? You want to delete \'{{ $category->title }}\' category')">
                        <i class="fas fa-trash text-danger fa-fw"></i>
                    </button>
                </form>
            </td>
            <td>{{ $category->created_at->format("d M, Y") }}</td>
        </tr>
    @empty
        <tr>
            <td colspan="5" class="text-center">There's no category</td>
        </tr>

    @endforelse
    </tbody>
</table>
