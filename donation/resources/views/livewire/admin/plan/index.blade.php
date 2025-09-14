<div class="max-w-6xl mx-auto py-8 px-6">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold">Plans</h1>
            <a href="{{ route('admin.plan.create') }}"
               class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg shadow">
               + Create New Plan
            </a>
        </div>

        <div class="bg-white shadow rounded-lg overflow-hidden">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-100 text-gray-700 text-sm uppercase">
                        <th class="px-4 py-3">#</th>
                        <th class="px-4 py-3">Name</th>
                        <th class="px-4 py-3">Amount</th>
                        <th class="px-4 py-3">Description</th>
                        <th class="px-4 py-3">Duration</th>
                        <th class="px-4 py-3 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="text-gray-600 text-sm divide-y divide-gray-200">
                    @forelse($plans as $plan)
                        <tr>
                            <td class="px-4 py-3">{{ $plan->id }}</td>
                            <td class="px-4 py-3">{{ $plan->name }}</td>
                            <td class="px-4 py-3">₹{{ number_format($plan->amount_required, 2) }}</td>
                            <td class="px-4 py-3">{{ $plan->description ?? '—' }}</td>
                            <td class="px-4 py-3">{{ $plan->duration_months ?? '—' }}</td>
                            <td class="px-4 py-3 text-right">
                                <a href="{{route('admin.plan.edit', $plan->id)}}"
                                   class="text-blue-600 hover:underline">Edit</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-4 py-6 text-center text-gray-500">
                                No plans found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>